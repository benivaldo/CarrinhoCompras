<?php
namespace Controle\Service\Factory;

use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use Controle\Service\ControleService;

class ControleServiceFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
      	$entityManager = $container->get('doctrine.entitymanager.orm_default');
      	
		return new ControleService($entityManager, $container);
    }
  
    
}

