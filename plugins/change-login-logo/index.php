<?php
/* 
Plugin Name: Thay logo trang login
Description: Thay logo trang login
Author: thshop
Version: 0.1
*/
function sm_custom_logo() { 
    $logo = get_theme_mod('login_logo');
    var_dump($logo);
?>
<style type="text/css">
    #login h1 a{
        background-image: url( <?php echo $logo ?> );
        height: 120px;
        width:120px;
        background-size: cover;
        background-repeat: no-repeat;
    }
</style>

 <?php }
add_action( 'login_enqueue_scripts', 'sm_custom_logo');

    //add section to edit login page
    function customize_login_page_register($wp_customize) {
    //adding section in wordpress customize
    $wp_customize->add_section('login_extras_section', array (
        'title'         => 'Login page'
    )); 

    //adding setting for copyright text
    $wp_customize->add_setting('login_logo', array(
        'capability'        => 'edit_theme_options',
        'default'           =>'',
        'sanitize_callback' =>'ic_sanitize_image',
        'sanitize_callback' =>'esc_url_raw',    
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'login_logo',
        array(
            'label'     => __('Upload Login Logo', 'storefront'),
                'description' => __( 'Height: &gt:80px', 'storefront'),
                'section'     => 'login_extras_section',
                'settings'    => 'login_logo',
                'priority'    => 1,     
        )
    ));
    }
    add_action('customize_register', 'customize_login_page_register');
?>