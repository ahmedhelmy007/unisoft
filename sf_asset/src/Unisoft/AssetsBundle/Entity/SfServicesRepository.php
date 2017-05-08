<?php
namespace Unisoft\AssetsBundle\Entity;

use Doctrine\ORM\EntityRepository;

class SfServicesRepository extends EntityRepository
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
    
    public function getMaxtId($entity)
    {
        $max =$this->getEntityManager()
            ->createQuery('SELECT MAX(a.id) as max_id FROM UnisoftAssetsBundle:'.$entity.' a')
            ->getSingleScalarResult();
        $max++;
         return $max;
    }
    
    public function getNextId($entity,$id)
    {
         $query =$this->getEntityManager()
            ->createQuery('SELECT p.id as next FROM UnisoftAssetsBundle:'.$entity.' p where p.id > :id order by p.id ASC')
            ->setParameter('id', $id )
            ->setMaxResults(1)
            ->getResult();
         return (isset($query[0]['next']))?$query[0]['next']:0;
//         return $query['next'];
        
    }
    
    public function getPreviousId($entity,$id)
    {
         $query =$this->getEntityManager()
            ->createQuery('SELECT p.id as previous FROM UnisoftAssetsBundle:'.$entity.' p where p.id < :id order by p.id DESC')
            ->setParameter('id', $id )
            ->setMaxResults(1)
            ->getResult();
         return (isset($query[0]['previous']))?$query[0]['previous']:0;        
    }
    
    public function getFirstId($entity)
    {
         $query =$this->getEntityManager()
            ->createQuery('SELECT p.id as first FROM UnisoftAssetsBundle:'.$entity.' p order by p.id ASC')
            ->setMaxResults(1)
            ->getResult();
         return (isset($query[0]['first']))?$query[0]['first']:0;        
    }
    
    public function getLastId($entity)
    {
         $query =$this->getEntityManager()
            ->createQuery('SELECT p.id as first FROM UnisoftAssetsBundle:'.$entity.' p order by p.id DESC')
            ->setMaxResults(1)
            ->getResult();
         return (isset($query[0]['first']))?$query[0]['first']:0;        
    }
    
    public function getPagingWidget($entity,$id)
    {
        $PagingWidget=array();
        $PagingWidget['nextId']=$this->getNextId($entity, $id);
        $PagingWidget['previousId']=$this->getPreviousId($entity, $id);
        $PagingWidget['firstId']=$this->getFirstId($entity);
        $PagingWidget['lastId']=$this->getLastId($entity);
        
        return $PagingWidget;
        
    }
    
    
}

