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
            $article['id'],
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
        session_start();
        $user = $_SESSION['id'];
        $stmt->execute([
            $article->getTitle(),
            $article->getCategory(),
            $article->getDescription(),
            $article->getPhone(),
            $article->getPrice(),
            $_SESSION['email'],
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
                $article['id'],
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
            SELECT * FROM articles WHERE LOWER(title) LIKE :search OR LOWER(category) LIKE :search OR LOWER(location) LIKE :search;
        ');

        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleByLocation(string $searchString) {
        $searchString = '%'.strtolower($searchString).'%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM articles WHERE LOWER(location) LIKE :search;
        ');

        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleByCategory(string $searchString) : array {
        $searchString = '%'.strtolower($searchString).'%';
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM articles WHERE LOWER(category) LIKE :search;
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($articles as $article) {
            $result[] = new Article(
                $article['id'],
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

    public function getArticlesByString(string $searchString) : array {
        $searchString = '%'.strtolower($searchString).'%';
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM articles WHERE LOWER(location) LIKE :search OR LOWER(title) LIKE :search OR LOWER(category) LIKE :search;
        ');
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($articles as $article) {
            $result[] = new Article(
                $article['id'],
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

    public function getArticlesByEmail(string $email) : array {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM articles WHERE LOWER(email) LIKE :email;
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($articles as $article) {
            $result[] = new Article(
                $article['id'],
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

    public function updateItem(int $id): void {
        $stmt = $this->database->connect()->prepare('
            UPDATE articles SET title = ?, category = ?, description = ?, number = ?, price = ?, email = ?, location = ?, img = ?, user_id = ? WHERE id = ?
        ');
        //$stmt->bindParam(":id", $id, PDO::PARAM_INT);
        /*
        $stmt->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
        $stmt->bindParam(":category", $_POST['category'], PDO::PARAM_STR);
        $stmt->bindParam(":description", $_POST['desc'], PDO::PARAM_STR);
        $stmt->bindParam(":number", $_POST['phone'], PDO::PARAM_INT);
        $stmt->bindParam(":price", $_POST['price'], PDO::PARAM_INT);
        $stmt->bindParam(":email", $_SESSION['email'], PDO::PARAM_STR);
        $stmt->bindParam(":location", $_POST['location'], PDO::PARAM_STR);
        $stmt->bindParam(":file", $_FILES['file']['name'], PDO::PARAM_STR);
        $stmt->bindParam(":user_id", $_SESSION['id'], PDO::PARAM_INT);
        */
        $stmt->execute([
            $_POST['title'],
            $_POST['category'],
            $_POST['desc'],
            $_POST['phone'],
            $_POST['price'],
            $_SESSION['email'],
            $_POST['location'],
            $_FILES['file']['name'],
            $_SESSION['id'],
            $id
        ]);
    }
}