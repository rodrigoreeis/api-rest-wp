<?php 

function register_cpt_product() {
  register_post_type('product', array(
    'label' => 'Product',
    'description' => 'Product',
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'rewrite' => array(
      'slug' => 'product', 
      'width_front' => true
    ),
    'query_var' => true,
    'supports' => array('custom-fields', 'author', 'title'),
    'publicly_queryable' => true
  ));
}

add_action('init', 'register_cpt_product');

?>