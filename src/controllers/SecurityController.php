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

        $url = "http://$_SERVER[HTTP_HOST]";
        header("Location: {$url}/actions");
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
        $boughtArticles = $this->articleRepository->getBoughtArticlesByUserId($_SESSION['id']);

        if(!$user) {
            return $this->render('login', ['messages' => ['You are not logged in!']]);
        }
        else return $this->render('info', ['user' => $user, 'activeArticles' => $activeArticles, 'inactiveArticles' => $inactiveArticles, 'biddedArticles' => $biddedArticles, 'boughtArticles' => $boughtArticles]);
    }

    public function userItems() {
        if(!$this->isGet()) {
            return $this->render('login');
        }
        elseif(isset($_SESSION['email']) && isset($_GET['UserItems'])) {
            $user = $this->userRepository->getUser($_SESSION['email']);
            $activeArticles = $this->articleRepository->getArticlesByEmail($_SESSION['email']);
            if(!$user) {
                return $this->render('login', ['messages' => ['You are not logged in!']]);
            }
            elseif($activeArticles != null) return $this->render('active-items', ['user' => $user, 'activeArticles' => $activeArticles]);
            else return $this->render('active-items', ['messages' => ['Brak artykułów do wyświetlenia'], 'activeArticles' => $activeArticles]);
        }
        else return $this->render('login', ['messages' => ['Something went wrong!']]);
    }

    public function archiveItems() {
        if(!$this->isGet()) {
            return $this->render('login');
        }
        elseif(isset($_SESSION['email']) && isset($_GET['ArchiveItems'])) {
            $user = $this->userRepository->getUser($_SESSION['email']);
            $inactiveArticles = $this->articleRepository->getInactiveArticlesByEmail($_SESSION['email']);
            if(!$user) {
                return $this->render('login', ['messages' => ['You are not logged in!']]);
            }
            elseif($inactiveArticles != null) return $this->render('archive-items', ['user' => $user, 'inactiveArticles' => $inactiveArticles]);
            else return $this->render('archive-items', ['messages' => ['Brak artykułów do wyświetlenia'], 'inactiveArticles' => $inactiveArticles]);
        }
        else return $this->render('login', ['messages' => ['Something went wrong!']]);
    }

    public function biddedItems() {
        if(!$this->isGet()) {
            return $this->render('login');
        }
        elseif(isset($_SESSION['email']) && isset($_GET['BiddedItems'])) {
            $user = $this->userRepository->getUser($_SESSION['email']);
            $biddedArticles = $this->articleRepository->getBiddedArticlesByUserId($_SESSION['id']);
            if(!$user) {
                return $this->render('login', ['messages' => ['You are not logged in!']]);
            }
            elseif($biddedArticles != null) return $this->render('bidded-items', ['user' => $user, 'biddedArticles' => $biddedArticles]);
            else return $this->render('bidded-items', ['messages' => ['Brak artykułów do wyświetlenia'], 'biddedArticles' => $biddedArticles]);
        }
        else return $this->render('login', ['messages' => ['Something went wrong!']]);
    }

    public function boughtItems() {
        if(!$this->isGet()) {
            return $this->render('login');
        }
        elseif(isset($_SESSION['email']) && isset($_GET['BoughtItems'])) {
            $user = $this->userRepository->getUser($_SESSION['email']);
            $boughtArticles = $this->articleRepository->getBoughtArticlesByUserId($_SESSION['id']);
            if(!$user) {
                return $this->render('login', ['messages' => ['You are not logged in!']]);
            }
            elseif($boughtArticles != null) return $this->render('bought-items', ['user' => $user, 'boughtArticles' => $boughtArticles]);
            else return $this->render('bought-items', ['messages' => ['Brak artykułów do wyświetlenia'], 'boughtArticles' => $boughtArticles]);
        }
        else return $this->render('login', ['messages' => ['Something went wrong!']]);
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