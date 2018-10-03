<?php

/**
 * Default Environment File
 * altenate to your local needs and remove _default from filename
 *
 * see http://doc.silverstripe.org/framework/en/topics/environment-management
 */

/* Database connection */
define('SS_DATABASE_CLASS', 'MySQLPDODatabase');
define('SS_DATABASE_SERVER', '__DB_HOST__');
define('SS_DATABASE_USERNAME', '__DB_USERNAME__');
define('SS_DATABASE_PASSWORD', '__DB_PASSWORD__');
define('SS_DATABASE_NAME', '__DATABASE__');


/* What kind of environment is this: dev, test, or live (ie, production)? */
define('SS_ENVIRONMENT_TYPE', '__ENV_TYPE__');

/* Project Folder */
define('SS_GLOBAL_PROJECT', 'app');

// These two defines sets a default login which, when used, will always log
// you in as an admin, even creating one if none exist.
define('SS_DEFAULT_ADMIN_USERNAME', '__ADMIN__');
define('SS_DEFAULT_ADMIN_PASSWORD', '__PASSWORD__');

// This causes errors to be written to the silverstripe.log file in the same directory as this file, so /var.
// Before PHP 5.3.0, you'll need to use dirname(__FILE__) instead of __DIR__
//define('SS_ERROR_LOG', '/'.__DIR__ . '/silverstripe.log');

// You can set a specific TEMP_FOLDER
// Default silverstripe-cache is used, if available
//define('TEMP_FOLDER', __DIR__ . '/silverstripe-cache');

// On Development Environments all Emails can be directed to only one Email Adress
// Also you can specify the Form field
//define('SS_SEND_ALL_EMAILS_TO','');
//define('SS_SEND_ALL_EMAILS_FROM','');

// To be able to use opcode for manifest files define one of the following
define('SS_MANIFESTCACHE', 'ManifestCache_File_PHP'); // on zend opcache installation, this might be faster
//define('SS_MANIFESTCACHE', 'ManifestCache_APC');

// if varnish stays in front and geoip is used, this variable will read the geolocation from x-forwarded-for
//define('GEOIP_SERVER_VAR', 'HTTP_X_FORWARDED_FOR');

// geolocation needs a UDF (mysql user defined function) to be created
// either create this function manually or on each /dev/build
//define('CREATE_GEODISTANCE_UDF', true);

// Self Defined Variables
// Admin Email Address (From)
define('ADMIN_EMAIL','__EMAIL__');

// Default Destionation path after successfull login
define('DEFAULT_LOGIN_DESTINATION', 'tasklist/index');

// Modules

// smtpmailer
define('SMTPMAILER', json_encode([
    "charset_encoding" => "utf-8", // E-mails characters encoding, e.g. : 'utf-8' or 'iso-8859-1'
    "debug_level" => "0", // Print debugging informations. 0 = no debuging, 1 = print errors, 2 = print errors and messages, 4 = print full activity
    "debug_stop" => true, // Stop Script on debugging. true = echo and die, false = echo can be catched by ob_start(); $var = ob_get_clean();
    "credentials" => [
        "default" => [
            "server_address" => "smtp.gmail.com", // SMTP server address
            "server_port" => "465", // SMTP server port. Set to 25 if no encryption or tls. Set to 465 if ssl
            "secure_connection" => "ssl", // SMTP encryption method : Set to '' or 'tls' or 'ssl'
            "do_authenticate" => true, // Turn on SMTP server authentication. Set to false for an anonymous connection
            "username" => "__EMAILADDRESS__", // SMTP server username, if do_authenticate == true
            "password" => "__PASSWORD__", // SMTP server password, if do_authenticate == true
            "from" => "__EMAILADDRESS__" // From Address: e.g. "My Name" <my.account@gmail.com>, optional, use when from address needs to be fixed
        ],
        "log" => false // false or array with credentials
    ]
]));

// Error Log Email Address
define('LOG_EMAIL','__EMAIL__'); // logs will be send to this address, if defined

global $_FILE_TO_URL_MAPPING;
$_FILE_TO_URL_MAPPING['__ABSOLUTEPATH__'] = 'http://__DOMAIN__';

// Silverstripe behind ReverseProxy (nginx e.g.)
//define('SS_TRUSTED_PROXY_IPS', 'IP_1,IP_2,IP_3,...');
// Additionals, see framework/core/startup/ParameterConfirmationToken.php
// HTTP_X_FORWARDED_FOR
// HTTP_X_FORWARDED_HOST
// HTTP_X_FORWARDED_PROTO/HTTP_X_FORWARDED_PROTOCOL = https
