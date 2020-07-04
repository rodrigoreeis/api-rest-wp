<?php 

$template_directory = get_template_directory();

require_once($template_directory . '/custom-post-type/product.php');
require_once($template_directory . '/custom-post-type/transition.php');

require_once($template_directory . '/controllers/user/user_controller_post.php');
require_once($template_directory . '/controllers/user/user_controller_get.php');

function expire_token() {
  return time() + (60 * 60 * 24);
}

add_action('jwt_auth_expire', 'expire_token')

?>