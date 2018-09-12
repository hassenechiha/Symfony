<?php
/**
 * Created by PhpStorm.
 * User: Hasse
 * Date: 11/09/2018
 * Time: 13:14
 */

namespace MarsupilamiBundle\Repository;


use Doctrine\ORM\EntityRepository;

class MarsupilamiRepository extends EntityRepository
{
    public function findpeopleqb()
{   $userconnected = $this->container->get('security.token_storage')->getToken()->getUser()->getId();
    $query=$this->createQueryBuilder('u');
    $query->where('u.id != :identifier')
        ->setParameter('identifier', $userconnected);
    return $query->getQuery()->getResult();

}
}