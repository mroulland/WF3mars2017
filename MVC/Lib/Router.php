<?php
namespace Lib;

class Router{
    /**
     *
     * @var Router 
     * 
     * @return Router
     */
    private static $instance;
    
    /**
     * 
     * @var array
     */
    private $routes = [];
    
    /**
     *
     * @var string
     */
    private $prefix = '';
    
    private function __construct(){}
    
    public static function getInstance()
    {
        if(is_null(self::$instance)){
            self::$instance = new self(); 
        }
        
        return self::$instance;
    }
    
    public function addRoute(
        $name,
        $uri,
        $controller,
        $action
    ){
        $this->routes[$name] = [
            'uri' => $uri,
            'controller' => $controller,
            'action' => $action,
        ];
        
        return $this;
    }
    
    public function findRoute()
    {
        $uri = str_replace(
            $this->prefix,
            '',
            strtok($_SERVER['REQUEST_URI'], '?')
            # Si dans la chaine de caractère je trouve un ?, je renvoie tout ce qui se trouvait avant. C'est une manière d'éliminer ce qui se trouve après ! y
        );
        
        foreach($this->routes as $route){
            if($route['uri'] == $uri){
                return $route;
            }
        }
        
        return null; 
        #Retourne null si jamais il ne trouve pas de route. Même si la condition renvoie null par défaut, on l'explicite ici. 
    }
    
    public function run()
    {
        $route = $this->findRoute();
        
        if (!is_null($route)){
            // Construit la chaine Controller\UserController
            $controllerName = 'Controller\\'
                . ucfirst($route['controller'])
                . 'Controller'
            ;
            $actionName = $route['action'] . 'Action'; 
            
            $controller = new $controllerName();
            $controller->$actionName();
            
            /*
             * revient à faire : 
             * $controller = new Controller\UserController();
             * $controller->listAction();
             */
            
        }else{
            header('HTTP/1.0 404 Not Found');
            die; 
            # Si on tape quelque chose qui ne convient pas dans l'URL, on est redirigé vers une page HTTP Error 404
        }
    }
    
    public function getPrefix() {
        return $this->prefix;
    }

    public function setPrefix($prefix) {
        $this->prefix = $prefix;
        return $this;
    }
}
