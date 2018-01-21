<?php
namespace Tabelas;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return array( 
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ]
    ],
    
    'view_manager' => array(
        'strategies' => array(
    		'ViewJsonStrategy',
        ),
    ),
   
);