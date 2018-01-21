<?php

namespace Emitente\Controller;

use Emitente\Entity\Emitente;
use Controle\Controller\AbstractRestController;
use Zend\View\Model\JsonModel;

class EmitenteController extends AbstractRestController
{
    private function getVariaveis()
    {
        $this->entity = '\Emitente\Entity\Emitente';
        $this->model = new Emitente();
        $this->foreignKeys = array();
    }
    
    
    public function getList()
    {
        $this->getVariaveis();
        
        /*return new JsonModel([
            'data' => 'controller'
        ]);*/
        return parent::getList();
    }
    
    
    public function get($id)
    {
        $this->getVariaveis();
        
        
        return parent::get($id);
    }
    
    public function create($data)
    {
        $this->getVariaveis();
        
        $this->getForeignKeys($data);
        
        return parent::create($data);
        
    }
    
    public function update($id, $data)
    {
        $this->getVariaveis();
        
        $this->getForeignKeys($data);
        
        return  parent::update($id, $data);
    }
    
    public function delete($id)
    {
        $this->getVariaveis();
        
        return parent::delete($id);
    }
    
    public function prevAction()
    {
        $this->getVariaveis();
        
        return parent::prevAction();
    }
    
    public function nextAction()
    {
        $this->getVariaveis();
        
        return parent::nextAction();
    }
    
    private function getForeignKeys($data)
    {
        
    }
    
}
