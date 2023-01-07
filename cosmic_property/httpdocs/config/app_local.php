<?php
/*
 * Local configuration file to provide any overrides to your app.php configuration.
 * Copy and save this file as app_local.php and make changes as required.
 * Note: It is not recommended to commit files with credentials such as app_local.php
 * into source code version control.
 */
return [
    /*
     * Debug Level:
     *
     * Production Mode:
     * false: No error messages, errors, or warnings shown.
     *
     * Development Mode:
     * true: Errors and warnings shown.
     */
    'debug' => filter_var(env('DEBUG', true), FILTER_VALIDATE_BOOLEAN),

    /*
     * Security and encryption configuration
     *
     * - salt - A random string used in security hashing methods.
     *   The salt value is also used as the encryption key.
     *   You should treat it as extremely sensitive data.
     */
    'Security' => [
        'salt' => env('SECURITY_SALT', '4c6fe45676d6eede59aea0fc456409c33a2e15ea26ee8ff869a3c177e0ba81f7'),
    ],

    /*
     * Connection information used by the ORM to connect
     * to your application's datastores.
     *
     * See app.php for more configuration options.
     */
    'Datasources' => [
        'default' => [
            'host' => 'localhost',
            /*
             * CakePHP will use the default DB port based on the driver selected
             * MySQL on MAMP uses port 8889, MAMP users will want to uncomment
             * the following line and set the port accordingly
             */
            //'port' => 'non_standard_port_number',
            'username' => 'root',
            'password' => '',
            'database' => 'cosmicprop_db',
            'log' => true,
            'url' => env('DATABASE_URL', null),
        ],
    ],

    /*
     * Email configuration.
     *
     * Host and credential configuration in case you are using SmtpTransport
     *
     * See app.php for more configuration options.
     */
    'EmailTransport' => [
        'default' => [
            'host' => 'localhost',
            'port' => 25,
            'username' => null,
            'password' => null,
            'client' => null,
            'url' => env('EMAIL_TRANSPORT_DEFAULT_URL', null),
        ],
        'mailgun' => [
            'className' => 'Mailgun.Mailgun',
            'from'=>'auto_reply@cosmicproperty.com.au',
            'apiEndpoint' => 'https://api.mailgun.net/v3', // optional, api endpoint
            'domain' => 'cosmicproperty.com.au', // your domain
            'apiKey' => '746aa8c8fc6b9c98cb56ddf3e8ddc1ba-73e57fef-67debf5c', // your api key,

        ],
    ],
    'Site' => [
        'PAYPAL_clientId' => 'AWZDscVlQRDDH4eAuQQUwmyyd4KZHBXje4FDpWLXCc_-BFlznIFdrGzPf_S3MrTAiwCick1gx2z-xtK2',
        'PAYPAL_secret' => 'ENQktHz1RtpQAIgsn9nz04jaO5gG6vmoL2E4Wc-r6V8pf3xN8qmqUUvYeuCThe1-Q4moru8OprBoOTth',
        'PAYPAL_mode' => 'live',
    ],
    'Recaptcha' => [
// Register API keys at https://www.google.com/recaptcha/admin
        'sitekey' => '6Lcd-RYbAAAAALVWjh8P4mhDSCHomGymPHCHhLkc',
        'secret' => '6Lcd-RYbAAAAAIqnadJXZ0rIYFlU_GqJmwU_Uk_Q',
// reCAPTCHA supported 40+ languages listed
// here: https://developers.google.com/recaptcha/docs/language
        'lang' => 'en',
// either light or dark
        'theme' => 'light',
// either image or audio
        'type' => 'image',
// either normal or compact
        'size' => 'normal'
    ]
];
