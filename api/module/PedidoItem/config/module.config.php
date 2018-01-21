<?php
namespace PedidoItem;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use PedidoItem\Controller\PedidoItemController;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'pedido_itens' => [
                'type'    => Segment::class,
                'options' => [
                    'route' => "/pedido_itens[/:id]",
                    'constraints' => [
                        'id'     => '[a-zA-Z0-9]+',
                    ],
                    'defaults' => [
                        'controller'    => PedidoItemController::class,
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