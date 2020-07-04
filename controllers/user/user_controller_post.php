<?php 

function api_user_post($request) {

  $email = sanitize_email($request['email']);
  $name = sanitize_text_field($request['name']);
  $password = sanitize_text_field($request['password']); 
  $street = sanitize_text_field($request['street']);
  $cep = sanitize_text_field($request['cep']);
  $number = sanitize_text_field($request['number']);
  $city = sanitize_text_field($request['city']);
  $state = sanitize_text_field($request['state']);

  $user_exists = username_exists($email);
  $email_exists = email_exists($email);

  if(!$user_exists && !$email_exists && $email && $password) {
    $user_id = wp_create_user($email, $password, $email);

    $response = array(
      'status' => 200,
      'message' => 'user_create with success',
      'ID' => $user_id,
      'display_name' => $name,
      'first_name' => $name,
      'role' => 'subscriber',
    );

    wp_update_user($reponse);

    update_user_meta($user_id, 'cep', $cep);
    update_user_meta($user_id, 'street', $street);
    update_user_meta($user_id, 'number', $number);
    update_user_meta($user_id, 'city', $city);
    update_user_meta($user_id, 'state', $state);
  
  } else {
    $response = new WP_Error('email', 'Email já cadastrado.', 
      array(
        'status' => 403
      ));
  }

  return rest_ensure_response($response);
}

function register_api_user_api_post() {
  register_rest_route('api', '/user', array(
    array(
      'methods' => 'POST',
      'callback' => 'api_user_post', 
    ),
  ));
}

add_action('rest_api_init', 'register_api_user_api_post');

?>