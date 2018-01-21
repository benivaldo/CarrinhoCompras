<?php
namespace Categoria;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Categoria\Controller\CategoriaController;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'categorias' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => "/categorias[/:id]",
                    'constraints' => [
                        'id'     => '[a-zA-Z0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => CategoriaController::class,
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