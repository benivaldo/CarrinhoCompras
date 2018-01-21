<?php
namespace Cliente;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Cliente\Controller\ClienteController;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'clientes' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => "/clientes[/:id]",
                    'constraints' => [
                        'id'     => '[a-zA-Z0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => ClienteController::class,
                        'order' => 'ASC',
                        'page' => 1,
                        'search_frase' => '',
                    ],
                ],
            ],
        ],
    ],
 
    
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
    
    'view_manager' => [
        'strategies' => [
    		'ViewJsonStrategy',
        ],
    ],
   
];