<?php

namespace Modelo\Controller;

use Modelo\Entity\Modelo;
use Controle\Controller\AbstractRestController;
use Zend\View\Model\JsonModel;

class ModeloController extends AbstractRestController
{
    private function getVariaveis()
    {
        $this->entity = '\Modelo\Entity\Modelo';
        $this->model = new Modelo();
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
    
}
