<?php
namespace Emitente;
use Zend\Router\Http\Segment;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return array(
    'router' => [
        'routes' => [
            'emitentes' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => "/emitentes[/:id]",
                    'constraints' => [
                        'id'     => '[a-zA-Z0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => Controller\EmitenteController::class,
                        'order' => 'ASC',
                        'page' => 1,
                        'search_frase' => '',
                    ],
                ],
            ],
            
            'nextemitentes' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => "/nextemitentes[[/:action][/:id]]",
                    'constraints' => [
                        'id'     => '[a-zA-Z0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => Controller\EmitenteController::class,
                        'order' => 'ASC',
                        'page' => 1,
                        'search_frase' => '',
                    ],
                ],
            ],
            
            'prevemitentes' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => "/prevemitentes[[/:action][/:id]]",
                    'constraints' => [
                        'id'     => '[a-zA-Z0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => Controller\EmitenteController::class,
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
    
    'view_manager' => array(
        'strategies' => array(
    		'ViewJsonStrategy',
        ),
    ),
   
);