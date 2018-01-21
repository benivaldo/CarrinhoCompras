<?php

namespace Cliente\Controller;

use Cliente\Entity\Cliente;
use Controle\Controller\AbstractRestController;
use Zend\View\Model\JsonModel;

class ClienteController extends AbstractRestController
{
    private function getVariaveis()
    {
        $this->entity = '\Cliente\Entity\Cliente';
        $this->model = new Cliente();
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
    
    public function listaAction()
    {
        $this->getVariaveis();
        
        /*return new JsonModel([
         'data' => 'controller'
         ]);*/
        $id =$this->params()->fromRoute('id'); 
        return parent::getLisProdCat($id);
    }
    
}
