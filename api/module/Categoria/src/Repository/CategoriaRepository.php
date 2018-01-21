<?php
namespace Categoria\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Zend\Db\Sql\Where;
use Categoria\Entity\Categoria;



class CategoriaRepository extends EntityRepository
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
            ->addSelect('p')
            ->from(Categoria::class, 'p')
            ->where('p.codigo = ?1')
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
        $queryBuilder->select('p')->from(Categoria::class, 'p');
                
        $result = $queryBuilder->getQuery();
        return $result;
    } 
}