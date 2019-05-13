<?php
namespace Controle\Controller\Plugin;

use Zend\Mvc\Controller\Plugin\AbstractPlugin;
use Zend\InputFilter\InputFilter;
use Controle\Service\ControleService;
use Zend\Form\Form;

/**
 * Plugin para execução do metodo save
 * @author jose.benivaldo
 *
 */
class SaveModel extends AbstractPlugin
{
   /**
    * Plugin para salvar dados
    * @param object $entity
    * @param ControleService $controleService
    * @param Form $form
    * @param string $route
    * @return \Controle\Service\multitype:unknown|string[]
    */
	public function save($entity, ControleService $controleService, Form $form, $route = 'home')
	{
	    $erro = '';
		$request = $this->getController()->getRequest();

		if ($request->getPost()->offsetExists('id')) {
		    $id = $request->getPost('id');
		    if ((int) $id == 0) {
                $request->getPost()->offsetUnset('id');
		    }
		}
		
		if ($request->isPost() && count($request->getPost()) != 0) {		    
		    $form->setInputFilter($entity->getInputFilter());
        	$form->setData($request->getPost()); 

			if ($form->isValid()) {			    
				$data = $form->getData();
				if (!$resp = $controleService->save($entity, $data)) {
				    return $resp;
				} else {
				    return $resp;
				}
			} else {	
			    foreach ($form->getMessages() as $key => $campo) {
    			    foreach ($campo as $key1 => $value) {
    			    	$erro .= "Campo $key: $value \n";
    			    }
			    }
			   return  array('id' => '', 'erro' => $erro);
			}
		}		
	}
	
	public function saveRest($model, $controleService,  $data, $foreignKeys)
	{
	    $erro = '';
	    $inputFilter = $model->getInputFilter();
	    
	    $inputFilter->setData($data);	   
	    
        if ($inputFilter->isValid()) {	
            $model->exchangeArray($data);
	       
            if (!$resp = $controleService->save($model, $foreignKeys)) {
	            return $resp;
	        } else {
	            return $resp;
	        }
	    } else {
	        foreach ($inputFilter->getMessages() as $key => $campo) {
	            foreach ($campo as $key1 => $value) {
	                $erro .= "Campo $key: $value \n";
	            }
	        }
	        return  array('id' => '', 'erro' => $erro);
	    }
	    
	}
	
}