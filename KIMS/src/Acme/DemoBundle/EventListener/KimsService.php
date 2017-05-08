<?php

namespace Acme\DemoBundle\EventListener;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Acme\DemoBundle\Twig\Extension\DemoExtension;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Routing\Router;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;

class KimsService {

    protected $request;
    protected $container;
    protected $security_context;

    public function __construct(
    SecurityContextInterface $security_context = NULL, ContainerInterface $container = NULL
    ) {
        $this->security_context = $security_context;
        $this->container = $container;
    }

    /**
     * 
     * @param string $method * || route_url "user_edit"
     * @return actions array in case * || bool in case route_url
     * if role admin return true
     */
    public function isAllowMethod($method = '*') {
//        if (HttpKernelInterface::MASTER_REQUEST == $event->getRequestType()) {
        if ($this->security_context->isGranted('ROLE_ADMIN'))
            return true;

        $user = $this->security_context->getToken()->getUser();
        $roles = $user->getRoles();
        $aclActions = $user->getAclActionsArray();
        if($method=='*')
       return $aclActions;
        else
            return (in_array (strtolower($method), $aclActions));
//        }
    }

  
}