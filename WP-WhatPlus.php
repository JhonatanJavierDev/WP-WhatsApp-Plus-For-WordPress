<?php
/*
Plugin Name: WP WhatsApp Plus For WordPress
Description: Add a floating WhatsApp window on your WordPress website.
Version: 1.1
Author: Author: <a href="https://github.com/jhonatanjavierdev">TioJhon07</a>
*/


function mi_funcion_de_renderizado() {
  echo "Contenido de mi página";
}
function wp_whatsapp_plus_settings_section() {
  add_options_page(
    'WP WhatsApp Plus Settings',
    'WP WhatsApp Plus',
    'manage_options',
    'wp-whatsapp-plus',
    'wp_whatsapp_plus_settings_page',
    4
  );
}
add_action( 'admin_menu', 'wp_whatsapp_plus_settings_section' );


function wp_whatsapp_plus_settings_page() {
  if ( !current_user_can( 'manage_options' ) )  {
    wp_die( __( 'No tiene permisos suficientes para acceder a esta página.' ) );
  }
  echo '<div class="wrap">';
  echo '<h1>Configuración de WP WhatsApp Plus</h1>';
  echo '<form action="options.php" method="post">';
  settings_fields( 'wp-whatsapp-plus-settings-group' );
  do_settings_sections( 'wp-whatsapp-plus' );
  submit_button();
  echo '</form>';
  echo '</div>';
}


function wp_whatsapp_plus_settings() {
  register_setting( 'wp-whatsapp-plus-settings-group', 'wp_whatsapp_plus_phone' );
  register_setting( 'wp-whatsapp-plus-settings-group', 'wp_whatsapp_plus_message' );
  add_settings_section( 'wp-whatsapp-plus-section', '', '', 'wp-whatsapp-plus' );
  add_settings_field( 'wp-whatsapp-plus-phone', 'Número de teléfono', 'wp_whatsapp_plus_phone_field', 'wp-whatsapp-plus', 'wp-whatsapp-plus-section' );
  add_settings_field( 'wp-whatsapp-plus-message', 'Mensaje predeterminado', 'wp_whatsapp_plus_message_field', 'wp-whatsapp-plus', 'wp-whatsapp-plus-section' );
}
add_action( 'admin_init', 'wp_whatsapp_plus_settings' );


function wp_whatsapp_plus_phone_field() {
  $phone = esc_attr( get_option( 'wp_whatsapp_plus_phone' ) );
  echo '<input type="text" name=" wp_whatsapp_plus_phone" value="' . $phone . '" placeholder="Ingresa tu número de teléfono">';
}

function wp_whatsapp_plus_message_field() {
$message = esc_attr( get_option( 'wp_whatsapp_plus_message' ) );
echo '<textarea name="wp_whatsapp_plus_message" rows="5" placeholder="Ingresa tu mensaje predeterminado">' . $message . '</textarea>';
}

// Ventana Flotante(El front By Demon)
function wp_whatsapp_plus_floating_window() {
$phone = esc_attr( get_option( 'wp_whatsapp_plus_phone' ) );
$message = esc_attr( get_option( 'wp_whatsapp_plus_message' ) );
$whatsapp_url = 'https://wa.me/' . $phone . '?text=' . urlencode( $message );
echo '<a href="' . $whatsapp_url . '" target="_blank" id="wp-whatsapp-plus-floating-window">Chat en WhatsApp</a>';
}
add_action( 'wp_footer', 'wp_whatsapp_plus_floating_window' );


function wp_whatsapp_plus_styles() {
echo '<style>
   #wp-whatsapp-plus-floating-window {
   position: fixed;
   bottom: 20px;
   right: 20px;
   background-color: green;
   color: white;
   padding: 10px 15px;
   border-radius: 50px;
   display: none;
  }
   #wp-whatsapp-plus-floating-window:hover {
   background-color: darkgreen;
    cursor: pointer;
  }
</style>';
}
add_action( 'wp_head', 'wp_whatsapp_plus_styles' );
