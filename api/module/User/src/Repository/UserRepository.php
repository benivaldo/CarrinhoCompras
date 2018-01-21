<?php
namespace User\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use User\Entity\User;

// This is the custom repository class for Post entity.
class UserRepository extends EntityRepository
{
 // Finds all published posts having the given tag.
  public function findAllData($orderBy, $order, $search = '', $data_ini = null, $data_fin = null)
  {
    $entityManager =  $this->getEntityManager();       
        
    $queryBuilder = $entityManager->createQueryBuilder();
    //Select normal 
    $queryBuilder
        ->select('t')
        ->from(User::class, 't');  	
    
	
    
    $users = $queryBuilder->getQuery();

    return $users;
  }        
}