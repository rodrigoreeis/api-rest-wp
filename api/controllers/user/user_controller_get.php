<?php 

function api_user_get($request) {
  $user = wp_get_current_user();
  
  $user_id = $user->ID;

  if($user_id > 0) {
    $user_meta = get_user_meta($user_id);

    $reponse = array(
      "id" => $user->user_login,
      "name" => $user->display_name,
      "email" => $user->user_email,
      "cep" => $user_meta->cep[0],
      "street" => $user_meta->street[0],
      "city" => $user_meta->city[0],
      "state" => $user_meta->state[0],
      "number" => $user_meta->number[0],
    );
  } else {
    $reponse = new WP_Error('permission', 'User dont have permisso', array(
      'status' => 401
    ));
  }

  return rest_ensure_response($reponse);
}

function register_api_user_api_get() {
  register_rest_route('api', '/user', array(
    array(
      'methods' => WP_REST_Server::READABLE,
      'callback' => 'api_user_get', 
    ),
  ));
}

add_action('rest_api_init', 'register_api_user_api_get');

?>