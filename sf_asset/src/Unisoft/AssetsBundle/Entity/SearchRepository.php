<?php

// src/Unisoft/AssetsBundle/Entity/SearchRepository.php
namespace Unisoft\AssetsBundle\Entity;

use Doctrine\ORM\EntityRepository;

class SearchRepository extends EntityRepository
{
    public function findByField($entity,$filed,$keyword='')
    {
       // if ($keyword=="all")
           // $keyword="";
$operator="LIKE";
$parameter='%'.$keyword.'%';
        if(is_numeric($keyword)){
            $operator="=";
            $parameter=$keyword;
        }
//        return $this->getEntityManager()
//            ->createQuery('SELECT s FROM UnisoftAssetsBundle:'.$entity.' s where s.'.$filed.' '.$operator.' :param  ORDER BY s.id ASC')
//            ->setParameter('param', $parameter)
//            ->getResult();
        
        
        $sql='SELECT s FROM UnisoftAssetsBundle:'.$entity.' s';
        if ($keyword!="all" && !empty($keyword))
         $sql.=' where s.'.$filed.' '.$operator.' :param';
         $sql.=' ORDER BY s.id ASC';
        
         if ($keyword!="all" && !empty($keyword))
         return $this->getEntityManager()
            ->createQuery($sql)
            ->setParameter('param', $parameter)
            ->getResult();
         else
             return $this->getEntityManager()
            ->createQuery($sql)
            ->getResult();
    }
    
    public function findByFieldAsoc($entity,$filed,$keyword='')
    {
        if ($keyword=="all")
            $keyword="";
        
        return $this->getEntityManager()
            ->createQuery('SELECT s FROM UnisoftAssetsBundle:'.$entity.' s where s.'.$filed.' = :param  ORDER BY s.id ASC')
            ->setParameter('param', $keyword)
            ->getResult();
    }
}

