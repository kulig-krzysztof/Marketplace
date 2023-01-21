<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Article.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/ArticleRepository.php';

class SecurityController extends AppController
{
    private array $messages = [];
    private array $userInfo = [];
    private UserRepository $userRepository;
    private ArticleRepository $articleRepository;

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
        $activeArticles = $this->articleRepository->getArticlesByEmail($_SESSION['email']);
        $inactiveArticles = $this->articleRepository->getInactiveArticlesByEmail($_SESSION['email']);
        $biddedArticles = $this->articleRepository->getBiddedArticlesByUserId($_SESSION['id']);

        if(!$user) {
            return $this->render('login', ['messages' => ['You are not logged in!']]);
        }
        else return $this->render('info', ['user' => $user, 'activeArticles' => $activeArticles, 'inactiveArticles' => $inactiveArticles, 'biddedArticles' => $biddedArticles]);
    }

    public function updateUserData() {
        if(!$this->isPost()) {
            return $this->render('login');
        }
        elseif ($_POST['password'] != null && $_POST['repeatPassword'] == $_POST['password'] && $_POST['name'] != null && $_POST['surname'] != null) {
            $password = md5($_POST['password']);
            $user = $this->userRepository->getUser($_SESSION['email']);
            if(!$user) {
                return $this->render('change-user-data', ['messages' => ['Wrong email or password!']]);
            }

            if($user->getPassword() !== $password) {
                return $this->render('change-user-data', ['messages' => ['Wrong password!']]);
            }
            $this->userRepository->changeData($_SESSION['email']);
            $user = $this->userRepository->getUser($_SESSION['email']);
            $activeArticles = $this->articleRepository->getArticlesByEmail($_SESSION['email']);
            $inactiveArticles = $this->articleRepository->getInactiveArticlesByEmail($_SESSION['email']);
            return $this->render('info', ['user' => $user, 'activeArticles' => $activeArticles, 'inactiveArticles' => $inactiveArticles]);
        }
        else {
            return $this->render('change-user-data', ['messages' => ['Wrong data!']]);
        }

    }
}