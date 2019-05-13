<?php

namespace Produto\Controller;

use Produto\Entity\Produto;
use Controle\Controller\AbstractRestController;
use Zend\View\Model\JsonModel;
use Controle\Service\ControleService;

class ProdutoController extends AbstractRestController
{
    
    public function __construct(ControleService $controleService) 
    {
        parent::__construct($controleService);
        
        $this->entity = '\Produto\Entity\Produto';
        $this->model = new Produto();
        $this->foreignKeys = array();
        $this->search = '';
    }
    
  
    public function getList()
    {
        /*return new JsonModel([
            'data' => 'controller'
        ]);*/
        return parent::getList();
    }
    
    
    public function get($id)
    {
        return parent::get($id);
    }
    
    public function create($data)
    {
        $this->getForeignKeys($data);
        
        return parent::create($data);
        
    }
    
    public function update($id, $data)
    {
        $this->getForeignKeys($data);
        
        return  parent::update($id, $data);
    }
    
    public function delete($id)
    {
        return parent::delete($id);
    }
    
    public function searchAction()
    {
        $this->search = $this->params()->fromRoute('search'); 
        
        return parent::getList();
    }
    
    public function listaAction()
    {
        $id =$this->params()->fromRoute('id'); 
        return parent::getLisProdCat($id);
    }
    
}
