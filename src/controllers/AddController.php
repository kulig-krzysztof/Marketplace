<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Article.php';
require_once __DIR__.'/../repository/ArticleRepository.php';

session_start();

class AddController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image.png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/img/form-images/';
    private $messages = [];
    private $articleRepository;

    public function __construct()
    {
        parent::__construct();
        $this->articleRepository = new ArticleRepository();
    }

    public function results() {
        if(isset($_SESSION['email']) && !isset($_POST['name-search'])) {
            $articles = $this->articleRepository->getAllArticles();
            $this->render('result', ['articles' => $articles]);
        }
        elseif (isset($_SESSION['email']) && isset($_POST['name-search'])) {
            $articles = $this->articleRepository->getArticlesByString($_POST['name-search']);
            $this->render('result', ['articles' => $articles]);
        }
        else {
            $this->render('login', ['messages' => ['You are not logged in!']]);
        }
    }


    public function add() {

        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $article = new Article(0,$_POST['title'],$_POST['category'],$_POST['desc'],$_POST['phone'],$_POST['price'],$_POST['email'],$_POST['location'], $_FILES['file']['name']);
            $this->articleRepository->addArticle($article);

            return $this->render('result', [
                'articles' => $this->articleRepository->getAllArticles(),
                'messages' => $this->messages]);
        }
        if(!isset($_SESSION['email'])) {
            return $this->render('login', ['messages' => ['You are not logged in!']]);
        }
        else {
            return $this->render('add');
        }
    }

    public function search() {
        $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';

        if($contentType === "application/json") {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);

            header('Content-Type : application/json');
            http_response_code(200);

            echo json_encode($this->articleRepository->getArticleByTitle($decoded['search']));
        }
    }

    public function category() {
            $articles = $this->articleRepository->getArticleByCategory($_POST['category']);
            $this->render('result', ['articles' => $articles]);
    }


    private function validate(array $file) : bool
    {
        if($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] ='File is too large';
            return false;
        }

        if(!isset($file['type']) && !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File type is not supported';
            return false;
        }
        return true;
    }

    public function item() {
        if($this->isPost() && isset($_POST['item-id']) && isset($_SESSION['email'])) {
            $id = trim($_POST['item-id']);
            $articles = $this->articleRepository->getArticle($id);
            $this->render('item', ['articles' => $articles]);
        }
        elseif (!isset($_POST['item-id']) && isset($_SESSION['email'])){
            $this->render('categories');
        }
        elseif (!isset($_SESSION['email'])) {
            $this->render('login', ['messages' => ['You are not logged in!']]);
        }
    }
}