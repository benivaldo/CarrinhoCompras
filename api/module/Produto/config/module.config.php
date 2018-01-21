<?php
namespace Produto;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Produto\Controller\ProdutoController;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'produtos' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => "/produtos[/:id]",
                    'constraints' => [
                        'id'     => '[a-zA-Z0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => ProdutoController::class,
                        'order' => 'ASC',
                        'page' => 1,
                        'search_frase' => '',
                    ],
                ],
            ],
            
            'busca_produtos' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => "/busca_produtos[[/:action][/:search]]",
                    'constraints' => [
                        'id'     => '[a-zA-Z0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => ProdutoController::class,
                        'action'    =>  'search'
                    ],
                ],
            ],
            
            'lista_categorias' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => "/lista_categorias[[/:action][/:id]]",
                    'constraints' => [
                        'id'     => '[a-zA-Z0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => ProdutoController::class,
                        'action'    => 'lista'
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