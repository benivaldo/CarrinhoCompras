<?php
namespace Pedido\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Zend\Db\Sql\Where;
use Pedido\Entity\Pedido;
use PedidoItem\Entity\PedidoItem;
use Cliente\Entity\Cliente;

class PedidoRepository extends EntityRepository
{
    /**
     * Busca por id
     * @param integer $id
     * @return array
     */
    public function findById($id)
    {
        $entityManager = $this->getEntityManager();
        
        $queryBuilder = $entityManager->createQueryBuilder();
     
        $queryBuilder
            ->Select('p')
            ->addSelect('c.nome')
            ->addSelect('c.logradouro')
            ->addSelect('c.numero')
            ->addSelect('c.bairro')
            ->addSelect('c.cep')
            ->addSelect('c.estado')
            ->addSelect('c.cidade')
            ->addSelect('c.email')
            ->addSelect('sum(i.total) as total_nota')
            ->from(Pedido::class, 'p')            
            ->innerJoin(Cliente::class, 'c')
            ->innerJoin(PedidoItem::class, 'i')
            ->where('c.id = p.clienteId')
            ->andWhere('i.pedido = p.id')
            ->andWhere('p.id = ?1')
            ->setParameter(1, $id);

        $result = $queryBuilder->getQuery()->getArrayResult();
 
        $data = [];
        $data2 = [];
        
        if (count($result) > 0){
            foreach ($result[0] as $key => $val) {
                if (is_array($val )) {
                    foreach ($val as $key2 => $val2) {
                        $data[$key2] = $val2;
                    }
                } else if(is_object($val)){
                    $data[$key] = $val;
                } else{
                    $data[$key] = $val;
                }
            }
        }
        return $data;
    }
    
    /**
     *
     * @param string $orderBy
     * @param string $order
     * @param string $search
     * @param string $data_ini
     * @param string $data_fin
     * @return \Doctrine\ORM\Query
     */
    public function findAllData($orderBy, $order, $search = '', $data_ini = null, $data_fin = null)
    {
        $entityManager =  $this->getEntityManager();
        
        $queryBuilder = $entityManager->createQueryBuilder();
        
        //Select normal
        $queryBuilder->select()
        ->addSelect('p.id')
        ->addSelect('p.clienteId')
        ->addSelect('p.dateCreate')
        ->addSelect('p.status')
        ->addSelect('sum(i.total) as total')
        ->from(Pedido::class, 'p')
        ->innerJoin(PedidoItem::class, 'i')
        ->where('i.pedido = p.id')
        ->andWhere('p.clienteId = ?1')
        ->setParameter(1, $search)
        ->groupBy('p.id');
                
        $result = $queryBuilder->getQuery();
        return $result;
    } 
}