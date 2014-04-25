<?php

namespace WWII\Service\Provider\Route;

class RouteManager implements \WWII\Service\ServiceProviderInterface
{
    protected $serviceManager;

    protected $module = 'index';

    protected $controller = 'index';

    protected $action = 'index';

    protected $key = '';

    protected $page = 1;

    protected $bypass = false;

    public function __construct(\WWII\Service\ServiceManagerInterface $serviceManager)
    {
        $this->serviceManager = $serviceManager;

        $module     = isset($_GET['c']) ? $_GET['c'] : null;
        $controller = isset($_GET['sub']) ? $_GET['sub'] : null;
        $action     = isset($_GET['action']) ? $_GET['action'] : null;
        $key        = isset($_GET['key']) ? $_GET['key'] : null;
        $bypass     = isset($_GET['bypass']) ? true : false;
        $page       = isset($_GET['page']) ? $_GET['page'] : null;

        if (!empty($module)) {
            $this->module = $module;
        }

        if (!empty($controller)) {
            $this->controller = $controller;
        }

        if (!empty($action)) {
            $this->action = $action;
        }

        if (!empty($key)) {
            $this->key = $key;
        }

        $this->bypass = $bypass;

        if (!empty($page)) {
            $this->page = $page;
        }
    }

    /**
     * available options:
     *      module
     *      controller
     *      action
     *      key
     *      bypass
     *      page
     */
    public function setRoute(array $options)
    {
        if (isset($options['module'])) {
            $this->module = $options['module'];
        }

        if (isset($options['controller'])) {
            $this->controller = $options['controller'];
        }

        if (isset($options['action'])) {
            $this->action = $options['action'];
        }

        if (isset($options['key'])) {
            $this->key = $options['key'];
        }

        if (isset($options['key'])) {
            $this->key = $options['key'];
        }

        if (isset($options['bypass'])) {
            $this->bypass = $options['bypass'];
        }

        if (isset($options['page'])) {
            $this->page = $options['page'];
        }
    }

    public function getModule($classify = false)
    {
        if ($classify) {
            return $this->classify($this->module);
        }

        return $this->module;
    }

    public function getController($classify = false)
    {
        if ($classify) {
            return $this->classify($this->controller);
        }

        return $this->controller;
    }

    public function getAction($methodify = false)
    {
        if ($methodify) {
            return $this->methodify($this->action);
        }

        return $this->action;
    }

    public function getKey()
    {
        return $this->key;
    }

    public function isBypass()
    {
        return $this->bypass;
    }

    public function getPage()
    {
        return $this->page;
    }

    protected function classify($data)
    {
        $temps = explode('_', $data);
        $result = '';

        foreach ($temps as $temp) {
            $result .= ucfirst($temp);
        }

        return $result;
    }

    protected function methodify($data)
    {
        $temps = explode('_', $data);
        $result = '';

        $skip = true;
        foreach ($temps as $temp) {
            if ($skip) {
                $result .= $temp;
                $skip = false;
                continue;
            }

            $result .= ucfirst($temp);
        }

        return $result;
    }

    /**
     * available options:
     *      module
     *      controller
     *      action
     *      key
     *      bypass
     *      page
     */
    public function redirect(array $options)
    {
        $route = $this->generateRoute($options);

        ob_end_clean();
        exit(header("Location: ./$route"));
    }

    /**
     * available options:
     *      module
     *      controller
     *      action
     *      key
     *      bypass
     *      page
     */
    public function generateRoute(array $options)
    {
        $route = '?c=' . ((!empty($options['module'])) ? $options['module'] : $this->module)
            . '&sub=' . ((!empty($options['controller'])) ? $options['controller'] : $this->controller)
            . '&action=' . ((!empty($options['action'])) ? $options['action'] : $this->action)
            . ((!empty($options['key'])) ? '&key=' . $options['key'] : '')
            . ((!empty($options['bypass'])) ? '&bypass=' . $options['bypass'] : '')
            . ((!empty($options['page'])) ? '&page=' . $options['page'] : '');;

        return $route;
    }
}
