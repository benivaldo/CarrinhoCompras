<?php
namespace PedidoItem\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Zend\Db\Sql\Where;
use PedidoItem\Entity\PedidoItem;
use Produto\Entity\Produto;

class PedidoItemRepository extends EntityRepository
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
            ->Select('p.codigo')
            ->addSelect('p.quantidade')
            ->addSelect('p.valor')
            ->addSelect('p.total')
            ->addSelect('i.imagem')
            ->from(PedidoItem::class, 'p')
            ->innerJoin(Produto::class, 'i')
            ->where('i.codigo = p.codigo')
            ->andWhere('p.pedido = ?1')
            ->groupBy('p.idItem')
            ->setParameter(1, $id);

        $result = $queryBuilder->getQuery()->getArrayResult();

        return $result;
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
        $queryBuilder->select('p')->from(PedidoItem::class, 'p');
                
        $result = $queryBuilder->getQuery();
        return $result;
    } 
}