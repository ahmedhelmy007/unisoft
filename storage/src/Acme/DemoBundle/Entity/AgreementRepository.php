<?php
namespace Acme\DemoBundle\Entity;

use Doctrine\ORM\EntityRepository;

class AgreementRepository extends EntityRepository
{
    
    public function getMaxtId($entity,$field='id')
    {
        $max =$this->getEntityManager()
            ->createQuery('SELECT MAX(a.'.$field.') as max_id FROM AcmeDemoBundle:'.$entity.' a')
            ->getSingleScalarResult();
        $max++;
         return $max;
    }
    
    public function getAgreementNo($entity,$field='id',$agreementType=0)
    {
        $max =$this->getEntityManager()
            ->createQuery('SELECT MAX(a.'.$field.') as max_id FROM AcmeDemoBundle:'.$entity.' a where a.agreementType = :agreementType')
            ->setParameter('agreementType', $agreementType )
            ->getSingleScalarResult();
        $max++;
        
         return $max;
    }
    
    public function getNextId($entity,$id,$agreementType)
    {
        if($id==0) return 0;
         $query =$this->getEntityManager()
            ->createQuery('SELECT p.id as next FROM AcmeDemoBundle:'.$entity.' p where p.id > :id and p.agreementType = :agreementType order by p.id ASC')
            ->setParameter('id', $id )
            ->setParameter('agreementType', $agreementType )
            ->setMaxResults(1)
            ->getResult();
         return (isset($query[0]['next']))?$query[0]['next']:0;
//         return $query['next'];
        
    }
    
    public function getPreviousId($entity,$id,$agreementType)
    {
        if($id==0) return $this->getLastId($entity, $agreementType);
         $query =$this->getEntityManager()
            ->createQuery('SELECT p.id as previous FROM AcmeDemoBundle:'.$entity.' p where p.id < :id and p.agreementType = :agreementType order by p.id DESC')
            ->setParameter('id', $id )
            ->setParameter('agreementType', $agreementType )
            ->setMaxResults(1)
            ->getResult();
         return (isset($query[0]['previous']))?$query[0]['previous']:0;        
    }
    
    public function getFirstId($entity,$agreementType)
    {
         $query =$this->getEntityManager()
            ->createQuery('SELECT p.id as first FROM AcmeDemoBundle:'.$entity.' p where p.agreementType = :agreementType order by p.id ASC')
            ->setParameter('agreementType', $agreementType )     
            ->setMaxResults(1)
            ->getResult();
         return (isset($query[0]['first']))?$query[0]['first']:0;        
    }
    
    public function getLastId($entity,$agreementType)
    {
         $query =$this->getEntityManager()
            ->createQuery('SELECT p.id as first FROM AcmeDemoBundle:'.$entity.' p where p.agreementType = :agreementType order by p.id DESC')
            ->setParameter('agreementType', $agreementType )
            ->setMaxResults(1)
            ->getResult();
         return (isset($query[0]['first']))?$query[0]['first']:0;        
    }
    
    public function getPagingWidget($entity,$id,$agreementType)
    {
        $PagingWidget=array();
        $PagingWidget['nextId']=$this->getNextId($entity, $id,$agreementType);
        $PagingWidget['previousId']=$this->getPreviousId($entity, $id,$agreementType);
        $PagingWidget['firstId']=$this->getFirstId($entity,$agreementType);
        $PagingWidget['lastId']=$this->getLastId($entity,$agreementType);
        
        return $PagingWidget;
        
    }
    
    
}

