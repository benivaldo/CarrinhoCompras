<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overridding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */
use Doctrine\DBAL\Driver\PDOMysql\Driver as PDOMySqlDriver;
use Zend\Session\Storage\SessionArrayStorage;
use Zend\Session\Validator\RemoteAddr;
use Zend\Session\Validator\HttpUserAgent;


return array(
    // Session configuration.
    'session_config' => [
        'cookie_lifetime'     => 60*60*1, // Session cookie will expire in 1 hour.
        'gc_maxlifetime'      => 60*60*24*30, // How long to store session data on server (for 1 month).
    ],
    
    'jwt' => [
        'key'       => 'RCXe6mMBQs8mP2lbX35vNO/opIF9nCxp0hoCdLznh5dbu1/NwTeCt80/6PNvINvRGt5psxnbFyfcaV4C1FyTeg==',     // Key for signing the JWT's, I suggest generate it with base64_encode(openssl_random_pseudo_bytes(64))
        'algorithm' => 'HS512' // Algorithm used to sign the token, see https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40#section-3
    ],
    
    // Session storage configuration.
    'session_storage' => [
        'type' => SessionArrayStorage::class
    ],
    
    // Session manager configuration.
    'session_manager' => [
        // Session validators (used for security).
        'validators' => [
            RemoteAddr::class,
            HttpUserAgent::class,
        ]
    ],
   	'doctrine' => [
		'connection' => [
			'orm_default' => [
				'driverClass' => PDOMySqlDriver::class,
				'params' => [
					'host'     => '127.0.0.1',
					'port'     => '3306',
					'user'     => 'root',
					'password' => '',
					'dbname'   => 'compras',
					'driver' => 'pdo_mysql',
				    'mapping_types' => ['_numeric' => 'string'],
				    'driverOptions' => array(
				        1002 => 'SET NAMES utf8'
				    )
				]
			],
		],
	],    
);