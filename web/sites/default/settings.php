<?php

/**
 * Load services definition file.
 */
$settings['container_yamls'][] = __DIR__ . '/services.yml';

/**
 * Include the Pantheon-specific settings file.
 *
 * n.b. The settings.pantheon.php file makes some changes
 *      that affect all environments that this site
 *      exists in.  Always include this file, even in
 *      a local development environment, to ensure that
 *      the site settings remain consistent.
 */
include __DIR__ . "/settings.pantheon.php";

/**
 * Place the config directory outside of the Drupal root.
 */
$settings['config_sync_directory'] = DRUPAL_ROOT . '/../config/sync';

// Automatically enable the correct config_split based on the Pantheon environment.
$_env_is_live = isset($_ENV['PANTHEON_ENVIRONMENT']) && ($_ENV['PANTHEON_ENVIRONMENT'] == 'live' || $_ENV['PANTHEON_ENVIRONMENT'] == 'test');
$config['config_split.config_split.dev']['status'] = !$_env_is_live;
$config['config_split.config_split.live']['status'] = $_env_is_live;

/**
 * If there is a local settings file, then include it
 */
$local_settings = __DIR__ . "/settings.local.php";
if (file_exists($local_settings)) {
  include $local_settings;
}

/**
 * Always install the 'standard' profile to stop the installer from
 * modifying settings.php.
 */
$settings['install_profile'] = 'standard';

