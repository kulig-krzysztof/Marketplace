<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Article.php';

class ArticleRepository extends Repository
{
    public function getArticle(int $id): ?Article {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM public.articles WHERE id = :id 
        ');
        $stmt->bindParam(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        $article = $stmt->fetch(PDO::FETCH_ASSOC);

        if($article == false) {
            return null;
        }

        return new Article(
            $article['title'],
            $article['category'],
            $article['description'],
            $article['number'],
            $article['price'],
            $article['email'],
            $article['location'],
            $article['img']
        );
    }

    public function addArticle(Article $article): void {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO articles (title, category, description, number, price, email, location, img, user_id) 
            VALUES (?, ?, ?, ?, ? ,? ,?, ?, ?)
        ');
        $user = 1;
        $stmt->execute([
            $article->getTitle(),
            $article->getCategory(),
            $article->getDesc(),
            $article->getPhone(),
            $article->getPrice(),
            $article->getEmail(),
            $article->getLocation(),
            $article->getImg(),
            $user
        ]);
    }

    public function getAllArticles() : array {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM articles;
        ');
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($articles as $article) {
            $result[] = new Article(
                $article['title'],
                $article['category'],
                $article['description'],
                $article['number'],
                $article['price'],
                $article['email'],
                $article['location'],
                $article['img']
            );
        }

        return $result;
    }

    public function getArticleByTitle(string $searchString) {
        $searchString = '%'.strtolower($searchString).'%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM articles WHERE LOWER(title) LIKE :search OR LOWER(location) LIKE :search;
        ');

        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


}