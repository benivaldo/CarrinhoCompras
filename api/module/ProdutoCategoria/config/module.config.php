<?php
namespace ProdutoCategoria;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Router\Http\Segment;
use ProdutoCategoria\Controller\ProdutoCategoriaController;


return [
    'router' => [
        'routes' => [
            'produtoscat' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => "/produtoscat[/:id]",
                    'constraints' => [
                        'id'     => '[a-zA-Z0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => ProdutoCategoriaController::class,
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