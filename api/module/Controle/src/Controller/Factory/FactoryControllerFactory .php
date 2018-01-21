<?php

namespace Controle\Controller\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Sac\Controller\Factory\CommonControllerFactory;

/**
 * This is the factory for UserController. Its purpose is to instantiate the
 * controller and inject dependencies into it.
 */
class FactoryControllerFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $serviceControle = $container->get('Controle\Service\ControleService');

        // Instantiate the controller and inject dependencies
        return new CommonControllerFactory($serviceControle);
    }
}