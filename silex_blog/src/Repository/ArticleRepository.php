<?php


namespace Repository;

use Entity\Article;
use Entity\Category;

class ArticleRepository extends RepositoryAbstract
{
    
    public function findAll()
    {
        $query = <<<EOS
SELECT a.*, c.name FROM article a JOIN category c ON a.category_id = c.id              
EOS;
        // <<<EOS indique que tout ce qui se trouve entre ce marqueur et sa fermeture est une chaine de caractère entre " 
        // Il doit être ABSOLUMENT seul sur la ligne (attention aux espaces)
        
        $dbArticles = $this->db->fetchAll($query);
        $articles = [];
        
        foreach ($dbArticles as $dbArticle) {
            $article = $this->buildArticleFromArray($dbArticle);
            $articles[] = $article;
        }
        return $articles;
        # Retourne un tableau d'objets où chaque ligne est un objet qui contient une ligne du tableau #
    }
    
    public function find($id)
    {
        $query = <<<EOS
SELECT a.*, c.name
FROM article a
JOIN category c ON a.category_id = c.id
WHERE c.id = :id
EOS;
        
        $dbArticle = $this->db->fetchAssoc(
            $query, 
            [':id' => $id]
        );
        
        $article = $this->buildArticleFromArray($dbArticle);
        
        return $article;
    }
    
    public function findByCategory(Category $category)
    {
        $query = <<<EOS
SELECT a.*, c.name 
FROM article a 
JOIN category c 
ON a.category_id = c.id
WHERE c.id = :id
EOS;
        $dbArticles = $this->db->fetchAll(
            $query, 
            [':id' =>$category->getId()]
        );
        $articles = [];
        
        foreach($dbArticles as $dbArticle){
            $article = $this->buildArticleFromArray($dbArticle);

            $articles[] = $article;
        }
        
        return $articles;
    }
    
    
    public function save(Article $article)
    {
        if (!empty($article->getId())) {
            $this->update($article);
        } else {
            $this->insert($article);
        }
    }
    
    public function insert(Article $article)
    {
        $this->db->insert(
            'article', // nom de la table
             [ // valeurs 
                 'title' => $article->getTitle(),
                 'content' => $article->getContent(),
                 'short_content' => $article->getShortContent(),  
                 'category_id' => $article->getCategoryId(),
             ]
        );
    }
    
    public function update(Article $article)
    {
        $this->db->update(
            'article', // nom de la table
            [ // valeurs
                'title' => $article->getTitle(),
                'content' => $article->getContent(),
                'short_content' => $article->getShortContent(),
                'category_id' => $article->getCategoryId(),
            ],
            ['id' => $article->getId()] // clause WHERE
        );
    }
    
    public function delete(Article $article)
    {
        $this->db->delete(
            'article', 
            ['id' =>$article->getId()]
        );
    }
    
    /**
     * 
     * @param array $dbArticle
     * @return Article
     */
    private function buildArticleFromArray(array $dbArticle)
    { // Fonction privée utilisable uniquement dans la classe où elle est crée
    
        $category = new Category();
            
        $category
            ->setId($dbArticle['category_id'])
            ->setName($dbArticle['name']);
        // Dans l'instanciation de notre objet Article, nous allons avoir besoin d'un objet Categorie, donc
        // on instancie d'abord un objet catégorie, qu'on appelle via le setter pour l'utiliser dans l'instanciation en dessous
        
        $article = new Article();
        $article
            ->setId($dbArticle['id'])
            ->setTitle($dbArticle['title'])
            ->setContent($dbArticle['content'])
            ->setShortContent($dbArticle['short_content'])
            ->setCategory($category)
        ;
        
        return $article;
    }
}
