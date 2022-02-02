<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Article.php';
require_once __DIR__.'/../repository/ArticleRepository.php';

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


    public function add() {

        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );

            $article = new Article($_POST['title'],$_POST['category'],$_POST['desc'],$_POST['phone'],$_POST['price'],$_POST['email'],$_POST['location'], $_FILES['file']['name']);
            $this->articleRepository->addArticle($article);

            return $this->render('add', ['messages' => $this->messages, 'add' => $article]);
        }
        
        $this->render('add');
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
}