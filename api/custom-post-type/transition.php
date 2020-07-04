<?php 

function register_cpt_transition() {
  register_post_type('transition', array(
    'label' => 'Transition',
    'description' => 'Transition',
    'public' => true,
    'show_ui' => true,
    'capability_type' => 'post',
    'rewrite' => array(
      'slug' => 'transition', 
      'width_front' => true
    ),
    'query_var' => true,
    'supports' => array('custom-fields', 'author', 'title'),
    'publicly_queryable' => true
  ));
}

add_action('init', 'register_cpt_transition');

?>