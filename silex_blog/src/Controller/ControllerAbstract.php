<?php
namespace Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Twig_Environment;

abstract class ControllerAbstract
{
    /**
     *
     * @var Application 
     */
    protected $app;

    /**
     *
     * @var Twig_Environment
     */
    protected $twig;

    /**
     *
     * @var Session
     */
    protected $session;
    /**
     * 
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->twig = $app['twig'];
        $this->session = $app['session'];
    }
    
    /**
     * Affiche une vue twig
     * 
     * @param string $view
     * @param array $parameters
     * @return string
     */
    public function render($view, $parameters = [])
    {
        return $this->twig->render($view, $parameters);
    }
    
    /**
     * Redirige vers une autre page en lui passant le nom de la route
     * 
     * @param string $routeName
     * @param array $parameters
     * @return Response
     */
    public function redirectRoute($routeName, array $parameters = [])
    {
        return $this->app->redirect(
            $this->app['url_generator']->generate($routeName, $parameters)
        );
    }
    
    public function addFlashMessage($message, $type = 'success')
    {
        $this->session->getFlashBag()->add($type, $message);
    }
}
