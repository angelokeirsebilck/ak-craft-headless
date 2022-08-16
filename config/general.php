<?php
/**
 * General Configuration
 *
 * All of your system's general configuration settings go in here. You can see a
 * list of the available settings in vendor/craftcms/cms/src/config/GeneralConfig.php.
 *
 * @see \craft\config\GeneralConfig
 */

use craft\config\GeneralConfig;
use craft\helpers\App;

$isDev = App::env('CRAFT_ENVIRONMENT') === 'dev';
$isProd = App::env('CRAFT_ENVIRONMENT') === 'production';

return GeneralConfig::create()

->aliases([
    '@web' => craft\helpers\App::env('PRIMARY_SITE_URL'),
    '@previewUrl' => craft\helpers\App::env('PREVIEW_URL'),
    '@webroot' => dirname(__DIR__) . '/web',
])

    // Set the default week start day for date pickers (0 = Sunday, 1 = Monday, etc.)
    ->defaultWeekStartDay(1)
    // Prevent generated URLs from including "index.php"
    ->omitScriptNameInUrls()
    // Enable Dev Mode on the dev environment (see https://craftcms.com/guides/what-dev-mode-does)
    ->devMode($isDev)

    ->allowUpdates(App::env('ALLOW_UPDATES'))

    ->allowAdminChanges(App::env('ALLOW_ADMIN_CHANGES'))

    // Disallow robots everywhere except the production environment
    ->disallowRobots(!$isProd)

    ->extraFileKinds([
        'svg' => [
            'label' => 'SVG',
            'extensions' => ['svg'],
        ],
        'mp4' => [
            'label' => 'MP4',
            'extensions' => ['mp4'],
        ],
    ])

    ->enableGql(true)

    ->headlessMode(true)

    ->maxUploadFileSize('50M')
;
