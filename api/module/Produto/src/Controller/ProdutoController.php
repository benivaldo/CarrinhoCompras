<?php

namespace Produto\Controller;

use Produto\Entity\Produto;
use Controle\Controller\AbstractRestController;
use Zend\View\Model\JsonModel;

class ProdutoController extends AbstractRestController
{
    private function getVariaveis()
    {
        $this->entity = '\Produto\Entity\Produto';
        $this->model = new Produto();
        $this->foreignKeys = array();
        $this->search = '';
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
    
    public function searchAction()
    {
        $this->getVariaveis();
        $this->search = $this->params()->fromRoute('search'); 
        
        return parent::getList();
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
