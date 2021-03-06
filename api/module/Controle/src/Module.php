<?php

namespace Controle;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Zend\Validator\AbstractValidator;
use Zend\I18n\Translator\Loader\PhpArray;

class Module implements ConfigProviderInterface
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
        
        //Cria o translator
        $translator = new \Zend\Mvc\I18n\Translator(new \Zend\I18n\Translator\Translator());
        $translator->addTranslationFile(
            phpArray::class,
            './vendor/zendframework/zend-i18n-resources/languages/pt_BR/Zend_Validate.php',
            'default',
            'pt_BR'
            );
        
        AbstractValidator::setDefaultTranslator($translator);
        
        // Seta CORS headers para permitir todas as solicitações
        $response = $e->getResponse();
        
        $headers = $response->getHeaders();
        $headers->addHeaderLine('Access-Control-Allow-Origin: *');
        $headers->addHeaderLine('Access-Control-Allow-Methods: PUT, GET, POST, PATCH, DELETE, OPTIONS');
        $headers->addHeaderLine('Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept');
        
        $request = $e->getRequest();
        
        if ($request->getMethod() == 'OPTIONS') {
            $response->setStatusCode(200);
        }
    }
    
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
 
}
