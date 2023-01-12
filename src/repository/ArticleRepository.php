<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Article.php';

class ArticleRepository extends Repository
{
    public function getArticle(int $id): ?Article {
        $stmt = $this->database->connect()->prepare('
        SELECT items.id, items.title, categories.category, items.description, items.price, users.email, items.img, items.lng, items.lat, items.city_name, items.size FROM items INNER JOIN users ON items.user_id = users.id INNER JOIN categories ON items.category = categories.id  WHERE items.id = :id
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
            $article['price'],
            $article['email'],
            $article['img'],
            $article['lng'],
            $article['lat'],
            $article['city_name'],
            $article['size']
        );
    }

    public function addArticle(Article $article): void {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO items (title, category, description, price, img, user_id, lng, lat, city_name, size) 
            VALUES (?, ?, ?, ?, ? ,? ,?, ?, ?, ?)
        ');
        session_start();
        if($article->getCategory() == "Buty") {
            $category = 1;
        }
        elseif ($article->getCategory() == "Koszulki") {
            $category = 2;
        }
        elseif ($article->getCategory() == "Bluzy") {
            $category = 3;
        }
        elseif ($article->getCategory() == "Kurtki") {
            $category = 4;
        }
        elseif ($article->getCategory() == "Akcesoria") {
            $category = 5;
        }
        else {
            $category = -1;
        }
        $stmt->execute([
            $article->getTitle(),
            $category,
            $article->getDescription(),
            $article->getPrice(),
            $article->getImg(),
            $_SESSION['id'],
            $article->getLng(),
            $article->getLat(),
            $article->getLocation(),
            $article->getSize()
        ]);
    }

    public function getAllArticles() : array {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT items.id, items.title, categories.category, items.description, items.price, users.email, items.img, items.lng, items.lat, items.city_name, items.size FROM items INNER JOIN categories ON items.category = categories.id INNER JOIN users ON items.user_id = users.id;
        ');
        $stmt->execute();
        $articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($articles as $article) {
            $result[] = new Article(
                $article['id'],
                $article['title'],
                $article['category'],
                $article['description'],
                $article['price'],
                $article['email'],
                $article['img'],
                $article['lng'],
                $article['lat'],
                $article['city_name'],
                $article['size']
            );
        }

        return $result;
    }

    public function getArticleByTitle(string $searchString) {
        $searchString = '%'.strtolower($searchString).'%';

        $stmt = $this->database->connect()->prepare('
            SELECT * FROM items INNER JOIN categories ON items.category = categories.id WHERE LOWER(title) LIKE :search OR LOWER(categories.category) LIKE :search OR LOWER(city_name) LIKE :search;
        ');

        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleByLocation(string $searchString) {
        $searchString = '%'.strtolower($searchString).'%';

        $stmt = $this->database->connect()->prepare('
            SELECT items.id, items.title, categories.category, items.description, items.price, users.email, items.img, items.lng, items.lat, items.city_name, items.size FROM items INNER JOIN categories ON items.category = categories.id INNER JOIN users ON items.user_id = users.id WHERE LOWER(items.city_name) LIKE :search OR LOWER(items.title) LIKE :search OR LOWER(categories.category) LIKE :search;
        ');

        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getArticleByCategory(string $searchString) : array {
        $searchString = '%'.strtolower($searchString).'%';
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT items.id, items.title, categories.category, items.description, items.price, users.email, items.img, items.lng, items.lat, items.city_name, items.size FROM categories INNER JOIN items ON categories.id = items.category INNER JOIN users ON items.user_id = users.id WHERE LOWER(categories.category) LIKE :search;
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
                $article['price'],
                $article['email'],
                $article['img'],
                $article['lng'],
                $article['lat'],
                $article['city_name'],
                $article['size']
            );
        }

        return $result;
    }

    public function getArticlesByString(string $searchString) : array {
        $searchString = '%'.strtolower($searchString).'%';
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT items.id, items.title, categories.category, items.description, items.price, users.email, items.img, items.lng, items.lat, items.city_name, items.size FROM items INNER JOIN categories ON items.category = categories.id INNER JOIN users ON items.user_id = users.id WHERE LOWER(items.city_name) LIKE :search OR LOWER(items.title) LIKE :search OR LOWER(categories.category) LIKE :search;
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
                $article['price'],
                $article['email'],
                $article['img'],
                $article['lng'],
                $article['lat'],
                $article['city_name'],
                $article['size']
            );
        }

        return $result;
    }

    public function getArticlesByEmail(string $email) : array {
        $result = [];

        $stmt = $this->database->connect()->prepare('
            SELECT items.id, items.title, categories.category, items.description, items.price, users.email, items.img, items.lng, items.lat, items.city_name, items.size FROM users INNER JOIN items ON users.id = items.user_id INNER JOIN categories ON items.category = categories.id WHERE LOWER(users.email) LIKE :email;
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
                $article['price'],
                $article['email'],
                $article['img'],
                $article['lng'],
                $article['lat'],
                $article['city_name'],
                $article['size']
            );
        }
        return $result;
    }

    public function updateItem(int $id): void {
        $stmt = $this->database->connect()->prepare('
            UPDATE items SET title = ?, category = ?, description = ?, price = ?, img = ?, lng = ?, lat = ?, city_name = ?, size = ? WHERE id = ?
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

        if($_POST['category'] == "Buty") {
            $category = 1;
        }
        elseif ($_POST['category'] == "Koszulki") {
            $category = 2;
        }
        elseif ($_POST['category'] == "Bluzy") {
            $category = 3;
        }
        elseif ($_POST['category'] == "Kurtki") {
            $category = 4;
        }
        elseif ($_POST['category'] == "Akcesoria") {
            $category = 5;
        }
        else {
            $category = -1;
        }

        if ($_POST['lng'] == null && $_POST['lat'] == null) {
            $_POST['lng'] = 0;
            $_POST['lat'] = 0;
        }
        $stmt->execute([
            $_POST['title'],
            $category,
            $_POST['desc'],
            $_POST['price'],
            $_FILES['file']['name'],
            $_POST['lng'],
            $_POST['lat'],
            $_POST['city-name'],
            $_POST['size'],
            $id
        ]);
    }
}