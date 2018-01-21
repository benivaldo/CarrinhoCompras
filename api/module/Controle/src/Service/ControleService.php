<?php
namespace Controle\Service;

use DoctrineORMModule\Paginator\Adapter\DoctrinePaginator as DoctrineAdapter;
use Doctrine\ORM\Tools\Pagination\Paginator as ORMPaginator;
use Zend\Paginator\Paginator;
use Zend\Form\Annotation\Object;
use Zend\View\Model\JsonModel;
//use function Zend\Mvc\Controller\params;

class ControleService 
{    
    /**
     * Entity manager.
     * @var Doctrine\ORM\EntityManager
     */
    protected $entityManager;
    protected $container;
    
    public function __construct($entityManager, $container)
    {
        $this->entityManager = $entityManager;
        $this->container = $container;
    }
    
    /**
     * Retorna Container para ser usado como getServiceLocator
     */
    public function getContainer ()
    {
        return $this->container;
    }
    
    /**
     * 
     * @return \Controle\Service\Doctrine\ORM\EntityManager
     */
    public function getEntity()
    {
        return $this->entityManager;
    }
    
    /**
     * Criar uma uma função findAllData em todos reposistórios da entidade
     * @param string $entity
     * @param string $orderBy
     * @param string $order
     * @param string $search
     * @return array
     */
    public function findAll($entity, $orderBy, $order, $search, $data_ini, $data_fin)
    {
        $query = $this->entityManager->getRepository($entity)->findAllData($orderBy, $order, $search, $data_ini, $data_fin);
 
        return $query;
    }
    
    /**
     * Retorna dados por id
     * @param unknown $id
     * @return Object
     */
    public function findById($entity, $id)
    {
        $query = $this->entityManager->getRepository($entity)->findById($id);
      
        return $query;
    }
    
    /**
     * Retorna dados por id
     * @param unknown $id
     * @return Object
     */
    public function findByCategoria($entity, $id)
    {
        $query = $this->entityManager->getRepository($entity)->findByCategoria($id);
        
        return $query;
    }
    
    
    
    /**
     * Função do paginator
     * @param Object $query
     * @param integer $page
     * @return \Zend\Paginator\Paginator
     */
    public function getPaginator($query, $page, $nItens = 1)
    {
        $query->setHydrationMode(\Doctrine\ORM\Query::HYDRATE_SCALAR);

        $adapter = new DoctrineAdapter(new ORMPaginator($query, false));
        $paginator = new Paginator($adapter);
        $paginator->setDefaultItemCountPerPage($nItens);
        $paginator->setCurrentPageNumber($page);
        
        return  $paginator;        
    }
    
    /**
     * Retorna dados id anterior
     * @param array $params
     */
    public function getPreviousData($params = array())
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        $queryBuilder
            ->select('c')
            ->from($params['entity'], 'c')
            ->where('c.id < ?1')
            ->setParameter('1', $params['id'])
            ->orderBy('c.id', 'DESC')
            ->setMaxResults(1);
        
        return $queryBuilder->getQuery()->getArrayResult();
    }
    
    /**
     * Retorna dados proximo id
     * @param array $params
     */
    public function getNextData($params = array())
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();
    
        $queryBuilder
	        ->select('c')
	        ->from($params['entity'], 'c')
	        ->where('c.id > ?1')
	        ->orderBy('c.id', 'ASC')
	        ->setParameter('1', $params['id'])
	        ->setMaxResults(1);
    
        return $queryBuilder->getQuery()->getArrayResult();
    }
    
    /**
     * Função para salvar dados na tabela
     * @param object $entity
     * @param array $data
     * @return multitype:unknown string
     */
    public function save($model, $foreignKeys)
    {
        $id = '';
        $erro = '';
        /**Verirfica se existes colunas com chaves estrangeiras e modifica o valor*/
        if (count($foreignKeys) > 0) {
            foreach ($foreignKeys as $val) {
                $modelId = $this->entityManager->getRepository($val[0])->findBy(array("id" => $val[2]));
                call_user_func_array(array($model, $val[1]), array($modelId[0]));
            }
        }
        
        try { 
            $this->entityManager->persist($model);
            $this->entityManager->flush();
            $id = $model->getId();
            $erro = 'Operação efetuada com sucesso';
        }catch (\Exception $e) {
            $erro =  $e->getMessage();
           
            echo $erro;
        }finally {
            return array('id' => $id, 'erro' =>  $erro );
        }
    }
    
    public function delete($entity)
    {
        $id = '';
        try {
            $this->entityManager->remove($entity);
            $this->entityManager->flush();
            $id = 0;
            $erro = 'Operação efetuada com sucesso';
        }catch (\Exception $e) {
            $erro =  $e->getMessage();
        }finally {
            return array('id' => 0, 'erro' =>  $erro );
        }
    }
    
    public function exchangeArray($data)
    {
        foreach ($data as $key => $value) {
            $this->$key = (!empty($value) ? $value: null);
        }
    }
    
    public function toArray()
    {
        return $this->getArrayCopy();
    }
    
    public function getArrayCopy()
    {
        $data =  get_object_vars($this);
        unset($data['inputFilter']);
        unset($data['voltar']);
        unset($data['limpar']);
        unset($data['submit']);
        return $data;
    }
}