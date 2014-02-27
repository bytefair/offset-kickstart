<?php
/**
 * register-theme-dir.php
 *
 * When you move the wp-content directory, WordPress can't find the default
 * themes. This snippet repairs that issue.
 */

register_theme_directory( ABSPATH . 'wp-content/themes' );
