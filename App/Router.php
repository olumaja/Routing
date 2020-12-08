<?php

    namespace App;

    class Router{

        protected $serverInfo;
        protected $requestedUrl = '/';
        protected static $routes = [];
        protected static $allowedHttpMethods = ['get', 'post', 'patch', 'put', 'delete'];

        public function __construct(){
            $this->serverInfo = $_SERVER;
        }

        public function executeUrl(){
            
           $url = $this->getRequestedUrl();
           $requestMethod = strtolower($_SERVER['REQUEST_METHOD']);
           $foundRoute = null;

           foreach(static::$routes as $route){

               if(!static::BeginWith($route['path'], '/')){
                   $route['path'] = '/' . $route['path'];
               }

               if($route['path'] === $url && $route['method'] === $requestMethod){
                   $foundRoute = $route;
                   break;
               }
           }
           
           if($foundRoute){
                $splitCallback = explode('@', $route['callback']);
                $controller = 'App\Controllers\\' . $splitCallback[0];
                return call_user_func_array(array(new $controller, $splitCallback[1]), array());
           }

           $controller = 'App\Controllers\NotFoundController';
           return call_user_func_array(array(new $controller, 'index'), array());

        }

        private function getRequestedUrl(){
            $this->requestedUrl = isset($this->serverInfo['PATH_INFO']) ? $this->serverInfo['PATH_INFO'] : '/';
            $url = trim($this->requestedUrl, '/');
            if(!Static::BeginWith($url, '/')){
                $url = '/' . $url;
            }
            return $url;
        }

        private static function BeginWith($str, $char) : bool {
            return $str === $char;
        }

        public static function __callStatic($methodName, $pathArguments){
           if(in_array($methodName, static::$allowedHttpMethods)){
                static::addRoute($pathArguments[0], $pathArguments[1], $methodName);
                return;
           }
           throw new \BadMethodCallException('Method not found: ' . $methodName);
        }

        private static function addRoute($path, $callback, $method = 'get'){
            $foundRoute = false;
            foreach(static::$routes as $route){
                if($route['path'] === $path && $route['method'] === $method){
                    $foundRoute = true;
                    break;
                }
            }

            if(!$foundRoute){
                static::$routes[] = ['path' => $path, 'callback' => $callback, 'method' => $method];
            }
        }

    }