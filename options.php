<?php


function wp_whatsapp_plus_settings_init() {
  add_settings_section(
    'wp_whatsapp_plus_settings_section',
    'Configuraciones de WP WhatsApp Plus',
    'wp_whatsapp_plus_settings_section_cb',
    'general'
  );
  
  add_settings_field(
    'wp_whatsapp_plus_phone',
    'Número de teléfono',
    'wp_whatsapp_plus_phone_field',
    'General',
    'wp_whatsapp_plus_settings_section'
  );
  
  add_settings_field(
    'wp_whatsapp_plus_message',
    'Mensaje predeterminado',
    'wp_whatsapp_plus_message_field',
    'General',
    'wp_whatsapp_plus_settings_section'
  );
  
  register_setting( 'general', 'wp_whatsapp_plus_phone' );
  register_setting( 'General', 'wp_whatsapp_plus_message' );
}
add_action( 'admin_init', 'wp_whatsapp_plus_settings_init' );


function wp_whatsapp_plus_settings_section_cb() {
  echo '<p>Personaliza la ventana flotante de WhatsApp en tu sitio web.</p>';
}


function wp_whatsapp_plus_phone_field() {
  $phone = esc_attr( get_option( 'wp_whatsapp_plus_phone' ) );
  echo '<input type="tel" name="wp_whatsapp_plus_phone" value="' . $phone . '">';
}


function wp_whatsapp_plus_message_field() {
$message = esc_attr( get_option( 'wp_whatsapp_plus_message' ) );
echo '<input type="text" name="wp_whatsapp_plus_message" value="' . $message . '">';
}
