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

class ControllerListener {

    protected $extension;
    protected $request;
    protected $router;
    protected $security_context;
    protected $allowed = array('home', '_welcome', '_user_login', '_security_check', '_user_logout', '_profiler', '_wdt');

    public function __construct(DemoExtension $extension, SecurityContextInterface $security_context = NULL, ContainerInterface $container = NULL, Router $router = NULL) {
        $this->extension = $extension;
        $this->security_context = $security_context;
        $this->container = $container;
        $this->router = $router;
    }

    public function onKernelController(FilterControllerEvent $event) {
        $this->request = $event->getRequest();
        if (!is_null($this->security_context)) {
//if the requested page is in allow list, or if the request is an internal (sub) request, then the 
            //Grant check will be skipped
            if (!in_array(strtolower($this->container->get('request')->get('_route')), $this->allowed)
                    &&
                    $event->getRequestType() == HttpKernelInterface::MASTER_REQUEST) {
                
                // if user role not admin then get user allowed actions 
                if (false === $this->security_context->isGranted('ROLE_ADMIN')) {
                    $user = $this->security_context->getToken()->getUser();
                    // get Roles Actions
//                        $aclActions = $user->getRoleActions();
                    // get User Actions
//                        $aclActions = $user->getAclActionsArray();
                    // get All Actions user and role
                    $aclActions = $user->getAllActions();

                    if (!in_array(strtolower($this->container->get('request')->get('_route')), $aclActions)) {
                        throw new AccessDeniedException();
                    }
                }
            }
        }

        if (HttpKernelInterface::MASTER_REQUEST === $event->getRequestType()) {
            $this->extension->setController($event->getController());
        }
    }

//    public function onKernelController(GetResponseEvent $event) {
//        $this->request = $event->getRequest();
////        print_r($this->container->get('request')->get('_route'));
//        if (!is_null($this->security_context)) {
//            if (!in_array(strtolower($this->container->get('request')->get('_route')), $this->allowed)) {
//                if (false === $this->security_context->isGranted('ROLE_ADMIN')) {
////                    $controllers = $event->getController();
//                    $user = $this->security_context->getToken()->getUser();
//                    $roles = $user->getRoles();
//                    $aclActions=$user->getAclActionsArray();
////                    print_r($aclActions);
//                    $routeName = $this->container->get('request')->get('_route');
//                    print_r($routeName);
////                    print_r($this->router);
////                    exit;
//                    if (!in_array(strtolower($this->container->get('request')->get('_route')), $aclActions)) {
////                        $event->setResponse(new RedirectResponse('http://www.google.com'));
//                    }
//                }
//            }
//        }
//
//    }
}
