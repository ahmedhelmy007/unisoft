<?php

// src/Acme/DemoBundle/Twig/AcmeExtension.php

namespace Unisoft\AssetsBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;

class UnisoftExtension extends \Twig_Extension {

    protected $container;
    protected $request;

    public function __construct(ContainerInterface $container) {
        $this->container = $container;
        if ($this->container->isScopeActive('request')) {
        $this->request = $this->container->get('request');
        }
    }

    public function getFilters() {
        return array(
            'var_dump' => new \Twig_Filter_Function('var_dump'),
            'price' => new \Twig_Filter_Method($this, 'priceFilter'),
        );
    }

    public function getFunctions() {
        return array(
            'get_controller_name' => new \Twig_Function_Method($this, 'getControllerName'),
            'get_action_name' => new \Twig_Function_Method($this, 'getActionName'),
        );
    }

    /**
     * Get current controller name
     */
    public function getControllerName() {
        $pattern = "#Controller\\\([a-zA-Z]*)Controller#";
        $matches = array();
        preg_match($pattern, $this->request->get('_controller'), $matches);

        return strtolower($matches[1]);
    }

    /**
     * Get current action name
     */
    public function getActionName() {
        $pattern = "#::([a-zA-Z]*)Action#";
        $matches = array();
        preg_match($pattern, $this->request->get('_controller'), $matches);

        return $matches[1];
    }

    public function priceFilter($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',') {
        $price = number_format($number, $decimals, $decPoint, $thousandsSep);
        $price = '$' . $price;

        return $price;
    }

    public function getName() {
        return 'unisoft_extension';
    }

}