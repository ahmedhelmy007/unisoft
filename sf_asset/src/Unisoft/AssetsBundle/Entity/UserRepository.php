<?php
namespace Unisoft\AssetsBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

class UserRepository extends EntityRepository implements UserProviderInterface
{
   public function loadUserByUsername($username) {
     return $this->getEntityManager()
         ->createQuery('SELECT u FROM
         UnisoftAssetsBundle:User u
         WHERE u.username = :username')
         ->setParameters(array(
                       'username' => $username
                        ))
         ->getOneOrNullResult();
    }
    public function refreshUser(UserInterface $user) {
        return $this->loadUserByUsername($user->getUsername());
    }
    public function supportsClass($class) {
        return $class === 'Unisoft\AssetsBundle\Entity\User';
    }
}