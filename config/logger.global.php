<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 07.08.14
 * Time: 0:12
 */

return array(

    // configure logger
    'logger' => array(
        // Default log level
        // Make a best choice: debug|info|notice|warning|error|critical|alert|emergency
        // 'level' => 'info',

        // Log paths
        // By default logs will write in temporary directory in dao-system.log for default (system) stream,
        //  and dao-error.log for error stream.

        // Main log path
        // 'system' => '/path/to/system.log',

        // Error log path
        // 'error' => '/path/to/error.log',

        // Real log adapter
        // Log adapter can be changed, just in case
        // Adapter must inherit Logger\Adapter
        // 'adapter' => 'AdapterClassName'

        // Log format, depends on Adapter
        // 'format' => "[%datetime%] [%level_name%] [%extra.session-id%] %channel%: %message% %context% %extra%\n',

        // Customization of log streams
        // If stream parameters doesn't set logging will go to the system and error log
        // For a stream you can customize level and/or path and/or log format
        // This customization can be done in separate configuration file, e.g. in module configuration
        // 'Some\Stream\Name' => array(
        //     'level' => 'debug',
        //     'path' => '/tmp/custom.log',
        //     'format' => '[%datetime%] [%level_name%] [%extra.session-id%] %channel%: %message% %context% %extra%'
        // )
    ),


/* ************************************************************** */
/* ********************** DO NOT CHANGE IT ********************** */
/* ************************************************************** */

    // make logger configuration run on bootstrap
    'listeners' => array(
        'Application\Logger\Launcher'
    ),
    'service_manager' => array(
        'invokables' => array(
            'Application\Logger\Launcher' => 'Application\Logger\Launcher'
        )
    ),
);