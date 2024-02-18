<?php
// Include this file in your main plugin file

// Add settings section
add_action('admin_init', 'loginpress_hCaptcha_settings');

function loginpress_hCaptcha_settings() {
    register_setting('loginpress_hCaptcha', 'loginpress_hCaptcha_enabled');
    register_setting('loginpress_hCaptcha', 'loginpress_hCaptcha_site_key');

    add_settings_section(
        'loginpress_hCaptcha_section',
        'hCaptcha Settings',
        'loginpress_hCaptcha_section_callback',
        'loginpress_hCaptcha'
    );

    add_settings_field(
        'loginpress_hCaptcha_enabled',
        'Enable hCaptcha',
        'loginpress_hCaptcha_enabled_callback',
        'loginpress_hCaptcha',
        'loginpress_hCaptcha_section'
    );

    add_settings_field(
        'loginpress_hCaptcha_site_key',
        'Site Key',
        'loginpress_hCaptcha_site_key_callback',
        'loginpress_hCaptcha',
        'loginpress_hCaptcha_section'
    );
}

function loginpress_hCaptcha_section_callback() {
    echo 'Configure hCaptcha settings below:';
}

function loginpress_hCaptcha_enabled_callback() {
    $enabled = get_option('loginpress_hCaptcha_enabled');
    echo '<input type="checkbox" name="loginpress_hCaptcha_enabled" ' . checked(1, $enabled, false) . ' />';
}

function loginpress_hCaptcha_site_key_callback() {
    $site_key = get_option('loginpress_hCaptcha_site_key');
    echo '<input type="text" name="loginpress_hCaptcha_site_key" value="' . esc_attr($site_key) . '" />';
}

// Frontend Integration
add_action('login_form', 'loginpress_hCaptcha_frontend');

function loginpress_hCaptcha_frontend() {
    $enabled = get_option('loginpress_hCaptcha_enabled');
    if ($enabled) {
        $site_key = get_option('loginpress_hCaptcha_site_key');
        echo '<div class="h-captcha" data-sitekey="' . esc_attr($site_key) . '"></div>';
    }
}
