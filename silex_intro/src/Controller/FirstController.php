<?php
namespace Controller;

use Silex\Application;

class FirstController {
    
    /**
     * Il suffit de demander une instance de Silex\Application
     * en paramètre de la méthode pour y avoir accès
     * 
     * @param Application $app
     */
    public function testAction(Application $app)
    {
        return $app['twig']->render('hello.html.twig');  
    }
    
    /**
     * 
     * @param Application $app
     * @return string $name variable passée par le routeur venant de l'URL {{name}} = $name
     */
    public function testParamAction(Application $app, $name)
    {
        return $app['twig']->render(
            'hello.html.twig',
            ['name' => $name]
        );  
    }
    
    public function usersAction(Application $app)
    {
        /**
         * @var Doctrine\DBAL
         */
        $db = $app['db']; 
        
        /**
         * équivaut à faire query puis fetchAll() avec PDO
         */
        $users = $db->fetchAll('SELECT * FROM user');
        
        return $app['twig']->render(
                'users.html.twig',
                ['users' => $users]
        );
     
    }
    
    public function userAction(Application $app, $userId )
    {
        $user = $app['db']->fetchAssoc('SELECT * FROM user WHERE id=' . (int)$userId);
        
        return $app['twig']->render(
                'user.html.twig',
                ['user' => $user]
        );
        
    }
}
