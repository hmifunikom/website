<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Upload dir
    |--------------------------------------------------------------------------
    |
    | The dir where to store the images (relative from public)
    |
    */
    'dir' => [],

    /*
    |--------------------------------------------------------------------------
    | Filesystem disks (Flysytem)
    |--------------------------------------------------------------------------
    |
    | Define an array of Filesystem disks, which use Flysystem.
    | You can set extra options, example:
    |
    | 'my-disk' => [
    |        'URL' => url('to/disk'),
    |        'alias' => 'Local storage',
    |    ]
    */
    'disks' => [
        'dropbox'
    ],

    /*
    |--------------------------------------------------------------------------
    | Routes group config
    |--------------------------------------------------------------------------
    |
    | The default group settings for the elFinder routes.
    |
    */

    'route' => [
        'prefix' => 'elfinder',
        'middleware' => null, //Set to null to disable middleware filter
    ],

    /*
    |--------------------------------------------------------------------------
    | Access filter
    |--------------------------------------------------------------------------
    |
    | Filter callback to check the files
    |
    */

    'access' => 'Barryvdh\Elfinder\Elfinder::checkAccess',

    /*
    |--------------------------------------------------------------------------
    | Roots
    |--------------------------------------------------------------------------
    |
    | By default, the roots file is LocalFileSystem, with the above public dir.
    | If you want custom options, you can set your own roots below.
    |
    */

    'roots' => [
        [
            'driver' => 'LocalFileSystem',
            'alias' => 'Local Media',
            'path' => public_path('media/contents'),
            'URL' => env('SITE_URL').'/media/contents',
            'accessControl' => 'Barryvdh\Elfinder\Elfinder::checkAccess'
        ],
        [
            'driver' => 'Dropbox',
            'alias' => 'Dropbox HMIF',
            'path' => '/',
            'tmpPath' => storage_path('elfinder-tmp'),
            'consumerKey' => '6hbiue0eoa6n7yl',
            'consumerSecret' => 'n29wqad7758oue1',
            'accessToken' => 'tks8ws9qq3tibhc0',
            'accessTokenSecret' => 'q3qu4uyf4gsvoik'
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Options
    |--------------------------------------------------------------------------
    |
    | These options are merged, together with 'roots' and passed to the Connector.
    | See https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options-2.1
    |
    */

    'options' => array(
        'bind' => [
 			'upload.presave' => [
 				'Plugin.AutoResize.onUpLoadPreSave'
			]
 		],
        'plugin' => [
            'PluginAutoResize' => [
                'enable'         => true,       // For control by volume driver
                'maxWidth'       => 1024,       // Path to Water mark image
                'maxHeight'      => 1024,       // Margin right pixel
                'quality'        => 90,         // JPEG image save quality
                'targetType'     => IMG_GIF|IMG_JPG|IMG_PNG|IMG_WBMP // Target image formats ( bit-field )
            ]
        ],
        'netVolumesSessionKey' => 'netVolumes',
    ),

);
