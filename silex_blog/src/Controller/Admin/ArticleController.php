<?php


namespace Controller\Admin;

use Controller\ControllerAbstract;
use Entity\Article;
use Entity\Category;


class ArticleController extends ControllerAbstract {
    public function listAction()
    {
        $articles = $this->app['article.repository']->findAll();
        
        return $this->render(
            'admin/article/list.html.twig', 
            ['articles' => $articles]
        );
    }
    
    public function editAction($id = null)
    {
        $categories = $this->app['category.repository']->findAll();
        // $this->app est un container de service, les services sont déclarés dans app donc pas besoin d'un use puisqu'il est hérité dans le controlleur abstract
        
        if (!is_null($id)) {
            $article = $this->app['article.repository']->find($id);
  
        } else {
            $article = new Article();
            $article->setCategory(new Category());
        }
        
        if(!empty($_POST)){
            $article
                ->setTitle($_POST['title'])
                ->setContent($_POST['content'])
                ->setShortContent($_POST['short_content'])
            ;
            
            $article->getCategory()->setId($_POST['category']); // One shot
            // On récupère la catégorie enregistrée sur l'article, puis on set l'id qu'on a récupéré dans le formulaire
            
            $this->app['article.repository']->save($article);
            // save vérifie que l'id existe bien. Si il existe il fait un update, sinon un insert.
            $this->addFlashMessage("L'article est enregistré");
            
            return $this->redirectRoute("admin_articles");
            // si on rentre dans cette condition et qu'on arrive jusqu'au return, on fait une redirection
            // Donc on ne rentre pas dans le render en dessous qui affiche la vue
        }
        
        return $this->render(
            'admin/article/edit.html.twig',
            [
                'article' => $article,
                'categories' => $categories,
                // Désormais, dans la vue, on a accès à deux variables : $article et $categories
            ]
                
        );
    }
    
    public function deleteAction($id)
    {
        $article = $this->app['article.repository']->find($id);
        
        $this->app['article.repository']->delete($article);
        $this->addFlashMessage("L'article est supprimée");
        
        return $this->redirectRoute('admin_articles');
    }
    

}
