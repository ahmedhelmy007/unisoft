<?php

namespace Unisoft\AssetsBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpFoundation\Response;

class BeforeListener {

    protected $container;
    protected $request;

    public function __construct($container) {
        $this->container = $container;
        if ($this->container->isScopeActive('request')) {
        $this->request = $this->container->get('request');
        }
    }

    public function onKernelController(FilterControllerEvent $event) {
        $controllers = $event->getController();
        $controller = $controllers[0];
        $request = $event->getRequest();
//        $breadcrumbs = $this->container->get("white_october_breadcrumbs");
//        $this->generatBreadcrumbs($controller, $request);
    }

    public function onKernelView(GetResponseForControllerResultEvent $event) {
        $request = $event->getRequest();
        $parameters = $event->getControllerResult();
//            $response = array();        
//            if (!empty($response)) {$request->attributes->set('_response', $response);}
    }

    /**
     * @param GetResponseForControllerResultEvent $event A GetResponseForControllerResultEvent instance
     */
    public function onKernelResponse(FilterResponseEvent $event) {
        $request = $event->getRequest();
        $parameters = $request->attributes->get('_response');
//        if (!empty($parameters)) {
//            $response = $event->getResponse();
//            foreach ($parameters as $parameter => $value) {
//                $method = $this->_responseParameters[$parameter];
//                $response->{$method}($value);
//            }
//        }
    }
    
    /**
     * generate default breadcrumb
     * @param type $controller
     * @param type $request
     */

    private function generatBreadcrumbs($controller, $request) {
        $_route = $request->attributes->get('_route');
        $_controller = $request->attributes->get('_controller');
        $params = $request->attributes->get('_route_params');

        $controllerName=$_route;
        $actionName = $_route;
        if (strpos($_route, '_') !== false) {
            $_route_arr = explode("_", $_route);
            $controllerName=(string)$_route_arr[0];
            $actionName = $_route_arr[1];
        }
        
        if(!empty($controllerName) && $controllerName!=NULL){
        $breadcrumbs = $this->container->get("white_october_breadcrumbs");
        $breadcrumbs->addItem("Home", $this->container->get("router")->generate("home"), 'icon-home');
        if ($_route != 'home')
            $breadcrumbs->addItem(ucfirst($controllerName), $this->container->get("router")->generate($controllerName));
//            $breadcrumbs->addItem(ucfirst($controllerName), $controller->get("router")->generate($controllerName));

        if ($actionName == 'edit' || $actionName == 'update')
            $breadcrumbs->addItem("Edit", $this->container->get("router")->generate($controllerName . "_edit", array('id' => $params['id'])));

        if ($actionName == 'new' || $actionName == 'create')
            $breadcrumbs->addItem("Create", $this->container->get("router")->generate($controllerName . "_new"));

        if ($actionName == 'show')
            $breadcrumbs->addItem("View", $this->container->get("router")->generate($controllerName . "_show", array('id' => $params['id'])));
//        exit;
        }
    }

}