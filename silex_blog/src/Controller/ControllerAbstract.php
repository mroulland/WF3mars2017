<?php
namespace Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Validator\RecursiveValidator;
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
     * @var RecursiveValidator
     */
    protected $validator;
    
    /**
     * 
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->twig = $app['twig'];
        $this->session = $app['session'];
        $this->validator = $app['validator'];
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
    
    /**
     * 
     * @param mixed $value
     * @param Constraint $contraint
     * @return bool
     */
    public function validate($value, Constraint $contraint)
    {
        
        // Retourne un tableau contenant les erreurs
        $errors = $this->validator->validate($value, $contraint);
        
        // s'il est vide, c'est que la valeur n'est pas valide
        return $errors->count() == 0;
    }
}
