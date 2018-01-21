<?php
namespace Pedido;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Pedido\Controller\PedidoController;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'pedidos' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => "/pedidos[/:id]",
                    'constraints' => [
                        'id'     => '[a-zA-Z0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => PedidoController::class,
                        'order' => 'ASC',
                        'page' => 1,
                        'search_frase' => '',
                    ],
                ],
            ],
            
            'list_pedidos' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => "/list_pedidos[[/:action][/:search]]",
                    'constraints' => [
                        'id'     => '[a-zA-Z0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => PedidoController::class,
                        'action'    =>  'list'
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