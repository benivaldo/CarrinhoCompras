<?php

namespace Controle\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\AbstractFactoryInterface; // <-- note the change!
use Zend\Stdlib\DispatchableInterface;

class AbstractControllerFactory implements AbstractFactoryInterface
{
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        /*echo "</br>";
        echo 'Solicitação'.$requestedName;
        echo "</br>";*/
        $isClassExists = class_exists($requestedName);
        if ( $isClassExists) {
            $isDispatchable = in_array(DispatchableInterface::class, class_implements($requestedName));
            $isController = preg_match('/^[a-z]+\\\Controller\\\.*Controller/i', $requestedName);
            
            return ( $isClassExists && $isDispatchable && $isController );
        }
        else {
            return false;
        }
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        //echo  'Retorno'.$requestedName;
        $serviceControle = $container->get('Controle\Service\ControleService');
         
        return new $requestedName($serviceControle);
    }
}