<?php

namespace Pedido\Controller;

use Pedido\Entity\Pedido;
use Controle\Controller\AbstractRestController;
use Zend\View\Model\JsonModel;
use PedidoItem\Entity\PedidoItem;

class PedidoController extends AbstractRestController
{
    private function getVariaveis()
    {
        $this->entity = '\Pedido\Entity\Pedido';
        $this->model = new Pedido();
        $this->foreignKeys = array();
        $this->search;
    }
    
    
    public function getList()
    {
        $this->getVariaveis();
        
        /*return new JsonModel([
            'data' => 'controller'
        ]);*/
        return parent::getList();
    }
    
    public function listAction()
    {
        $this->getVariaveis();
        $this->search =$this->params()->fromRoute('search'); 
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

        $pedido = [];
        $pedido['clienteId'] = $data['user']['userId'];
        $pedido['status'] = 'Aguardando pagamento';
        $resposta = parent::create($pedido);
        
        foreach ($data['data'] as $dados) {
            if ($resposta->id > 0) {                
                $retorno = $this->gravaItensPedido($resposta->id, $dados);
            }
         }
        return $retorno;
    }
    
    private function gravaItensPedido($id, $data) 
    {
        $this->entity = '\PedidoItem\Entity\PedidoItem';
        $this->model = new PedidoItem();
        $item =[];
        
        $item['codigo'] = $data['codigo'];
        $item['quantidade'] = $data['quantidade'];
        $item['valor'] = $data['valor'];
        $item['total'] = $data['total'];
        $item['pedido'] = $id;
        
        $this->getForeignKeys($item);
        
        return parent::create($item);
    }
    
    public function options() {
        
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
    
    private function getForeignKeys($data)
    {
        $pedido = $data['pedido'];
        
        if (is_numeric($pedido)) {
            array_push($this->foreignKeys, array("Pedido\Entity\Pedido", 'setPedido', $pedido));
        }
    }
    
}
