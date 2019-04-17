<?php

// Video Section
$wp_customize->add_section( 'video_section', array(
    'priority' => 1,
    'capability' => 'edit_theme_options',
    'theme_supports' => '',
    'title' => __( 'Video Settings', 'csoon' ),
    //'description' => __( 'Define your home slider.', 'csoon' ),
    'panel' => 'csoon_theme_panel',
) );


// Video Settings
$wp_customize->add_setting( 'video_mp4', array(
  'default' => '',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'transport' => 'refresh',
) );

$wp_customize->add_setting( 'video_webm', array(
  'default' => '',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'transport' => 'refresh',
) );

$wp_customize->add_setting( 'video_ogv', array(
  'default' => '',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'transport' => 'refresh',
) );

$wp_customize->add_setting( 'video_bg', array(
  'default' => '',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'transport' => 'refresh',
) );

$wp_customize->add_setting( 'home_text', array(
  'default' => '',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'transport' => 'refresh',
) );


// Video Controls
$wp_customize->add_control( new  WP_Customize_Upload_Control(
  $wp_customize,
  'video_mp4_control',
    array(
      'section'    => 'video_section',
      'settings'   => 'video_mp4',
      'priority'   => 1,
      'label' => __( 'Video .mp4 format', 'csoon' ),
      'description' => ''
    )
));

$wp_customize->add_control( new WP_Customize_Upload_Control(
  $wp_customize,
  'video_webm_control',
    array(
      'section'    => 'video_section',
      'settings'   => 'video_webm',
      'label' => __( 'Video .webm format', 'csoon' ),
    )
));

$wp_customize->add_control( new WP_Customize_Upload_Control(
  $wp_customize,
  'video_ogv_control',
    array(
      'section'    => 'video_section',
      'settings'   => 'video_ogv',
      'label' => __( 'Video .ogv format', 'csoon' ),
    )
));

$wp_customize->add_control( new WP_Customize_Upload_Control(
  $wp_customize,
    'video_bg_control',
      array(
        'section'    => 'video_section',
        'settings'   => 'video_bg',
        'label'      => __( 'Video Background', 'csoon' ),
      )
  )
);

$wp_customize->add_control( new WP_Customize_Control(
  $wp_customize,
  'home_text_control',
    array(
      'type' => 'textarea',
      'section'    => 'video_section',
      'settings'   => 'home_text',
      'label' => __( 'Texto a apresentar', 'csoon' ),
    )
  ));
