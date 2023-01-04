<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Article.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/ArticleRepository.php';

class SecurityController extends AppController
{
    private $messages = [];
    private $userInfo = [];
    private $userRepository;
    private $articleRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->articleRepository = new ArticleRepository();
    }

    public function login() {

        if(!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = md5($_POST['password']);
        session_start();
        $_SESSION['email'] = $email;

        $user = $this->userRepository->getUser($email);

        if(!$user) {
            return $this->render('login', ['messages' => ['Wrong email or password!']]);
        }

        if($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['Wrong email or password!']]);
        }

        if($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        return $this->render('actions');
    }

    public function logout() {
        session_start();
        session_unset();
        return $this->render('login', ['messages' => ['Logged out successfully!']]);
    }

    public function info() {
        if(!$this->isPost()) {
            return $this->render('login');
        }

        $user = $this->userRepository->getUser($_SESSION['email']);
        $articles = $this->articleRepository->getArticlesByEmail($_SESSION['email']);

        if(!$user) {
            return $this->render('login', ['messages' => ['You are not logged in!']]);
        }
        else return $this->render('info', ['user' => $user, 'articles' => $articles]);
    }
}