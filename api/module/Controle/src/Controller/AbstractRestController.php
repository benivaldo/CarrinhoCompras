<?php

namespace Controle\Controller;

use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\Session\Container;
use Controle\Service\ControleService;
use Zend\Form\Annotation\Object;
use Zend\View\Model\JsonModel;

abstract class AbstractRestController extends AbstractRestfulController
{	
	/**
	 * 
	 * @var string mensagem de erro e retrono do id
	 */
	protected  $errorMessage = array('id' => '','erro' => '');

	/**
	 * 
	 * @var array Remove variaves do post
	 */
	protected $removeFromPost = array();
	
	/**
	 * Array com retorno dem dados de consulta a ser retornado no jsaon
	 * @var array
	 */
	protected $resultSet = array();	

	/**
	 * Container
	 * @var Object
	 */
    protected $container;
	
    /**
     * Servico
     * @var Object
     */
	protected  $controleService;
	
	/**
	 * Entity manager.
	 * @var Doctrine\ORM\EntityManager
	 */
	protected  $entityManager;
	
	/**
	 * Caminho da entidade;
	 * @var PathExpression
	 */
	protected $entity;
	
	/**
	 * Model
	 * @var Object
	 */
	protected $model;
	
	/**
	 * Chaves estrangeiras
	 * array(chave, valor)
	 * @var array
	 */
	protected $foreignKeys;
	
	protected $search = '';
	
	public function __construct(ControleService $controleService)
	{
	    $this->controleService = $controleService;
	    $this->entityManager = $controleService->getEntity();
	    $this->container = $controleService->getContainer();	  
	}
	
	/**
	 * Função para retorno de todos os dados
	 * @param Object $query
	 * @return \Zend\View\Model\JsonModel|\Controle\Controller\array
	 */
	public function getList()	
	{
	    $orderBy = 'id';
	    $order = "ASC";
	    $search = $this->search;
	    $page = 1;
	    $data_ini = '';
	    $data_fin = '';
	    
	    $query = $this->controleService->findAll($this->entity, $orderBy, $order, $search, $data_ini, $data_fin);
	    $this->resultSet = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
	    
	    $result = new JsonModel([
	        'resultSet' => $this->resultSet,
	        'errorMessage' => $this->errorMessage['erro'],
	        'id' => $this->errorMessage['id'],
	    ]);
	   
	   return $result;	    
	}
	
	/**
	 * Função para retorno de todos os dados
	 * @param Object $query
	 * @return \Zend\View\Model\JsonModel|\Controle\Controller\array
	 */
	public function getLisProdCat($id)
	{
	    $query = $this->controleService->findByCategoria($this->entity, $id);
	    
	    $this->resultSet = $query->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
	    
	    $result = new JsonModel([
	        'resultSet' => $this->resultSet,
	        'errorMessage' => $this->errorMessage['erro'],
	        'id' => $this->errorMessage['id'],
	    ]);
	    
	    return $result;
	}
	
	/**
	 * Retorna dados por id
	 * {@inheritDoc}
	 * @see \Zend\Mvc\Controller\AbstractRestfulController::get()
	 */
	public function get($id)
	{
	    $this->resultSet = $this->controleService->findById($this->entity, $id);
	    
	    if (!$this->resultSet) {
	        $status = 404;
	    }
	    
	    $result = new JsonModel([
	        'resultSet' => $this->resultSet,
	        'errorMessage' => $this->errorMessage['erro'],
	        'id' => $this->errorMessage['id'],
	    ]);
	    
	    return $result;
	}
	
	/**
	 * Função para retornar o id anterior
	 */
	public function prevAction()
	{
	    $key = (int) $this->params()->fromRoute('id', 0);  
	    $params = array();
	    $params['id'] = $key;
	    $params['entity'] = $this->entity;
	    
	    $prevId =  $this->controleService->getPreviousData($params);
	    
	    $id = (!empty($prevId[0]['id']) ? $prevId[0]['id'] : $key);
	    
	    return  $result = new JsonModel([
	        'resultSet' => $id,
	        'errorMessage' => $this->errorMessage['erro'],
	        'id' => $id,
	    ]);;
	}
	
	/**
	 * Função para retornar o id posterior
	 */
	public function nextAction()
	{
	    $key = (int) $this->params()->fromRoute('id', 0);
        $params = array();
	    $params['id'] = $key;
	    $params['entity'] = $this->entity;
	    
	    $nextId =  $this->controleService->getNextData($params);
	    
	    $id = (!empty($nextId[0]['id']) ? $nextId[0]['id'] : $key);
	
	    return  $result = new JsonModel([
	        'resultSet' => $id,
	        'errorMessage' => $this->errorMessage['erro'],
	        'id' => $id,
	    ]);;
	}
	
	/**
	 * Método para criar dados na tabela (Restfull)
	 * $data array
	 * @see \Zend\Mvc\Controller\AbstractRestfulController::create()
	 */
	public function create($data)
	{
	    $this->errorMessage = $this->saveModel()->saveRest($this->model, $this->controleService, $data, $this->foreignKeys);
	    
	   	    
	    return  $result = new JsonModel([
	        'resultSet' => '',
	        'errorMessage' => $this->errorMessage['erro'],
	        'id' => $this->errorMessage['id'],
	    ]);
	}
	
	/**
	 * Método para atualizar dados na tabela
	 * @var $id integer
	 * @var $data array
	 * @see \Zend\Mvc\Controller\AbstractRestfulController::update()
	 */
	public function update($id, $data)
	{
	    if (!$id) {
	    }
	    
	    $model =  $this->entityManager->find($this->entity, $id);
	    
	    $this->errorMessage = $this->saveModel()->saveRest($model, $this->controleService, $data, $this->foreignKeys);
	    
	    return  $result = new JsonModel([
	        'resultSet' => '',
	        'errorMessage' => $this->errorMessage['erro'],
	        'id' => $this->errorMessage['id'],
	    ]);
	}
	
	/**
	 * Função para deletar um item da tabela
	 * @var $id integer
	 * @see \Zend\Mvc\Controller\AbstractRestfulController::delete()
	 */
	public function delete($id) 
	{
	    $entity =  $this->entityManager->find($this->entity, $id);
	    
	    $this->errorMessage = $this->deleteModel()->deleteRest($entity, $this->controleService);
	    
	    return  $result = new JsonModel([
	        'resultSet' => '',
	        'errorMessage' => $this->errorMessage['erro'],
	        'id' => $this->errorMessage['id'],
	    ]);
	}
}