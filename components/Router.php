<?php

    class Router
    {
        private $routes;

        public function __construct () {
        $routespath = ROOT.'/config/Routes.php';
        $this->routes = include ($routespath);
    }
        private function getURI () {
            if (!empty($_SERVER['REQUEST_URI'])) {
            return trim($_SERVER['REQUEST_URI'], '/');
        }


    }

        public function run()
    {
        $uri = $this->getURI();
        foreach ($this->routes as $uriPattern => $path) {

            if (preg_match("~$uriPattern~", $uri)) {
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute);

                var_dump($segments);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                $actionName = 'action' . ucfirst(array_shift($segments));


                $parametrs = $segments;

                $controllerFile = ROOT . '/Controllers/' . $controllerName . '.php';

                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parametrs);
                if ($result != null) {
                    break;
                }
            }
        }
    }

}
