<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Article.php';
require_once __DIR__.'/../models/Offer.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/ArticleRepository.php';
require_once __DIR__.'/../repository/OfferRepository.php';

class SecurityController extends AppController
{
    private array $messages = [];
    private array $userInfo = [];
    private UserRepository $userRepository;
    private ArticleRepository $articleRepository;
    private OfferRepository $offerRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
        $this->articleRepository = new ArticleRepository();
        $this->offerRepository = new OfferRepository();
    }

    public function login() {

        if(!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];
        session_start();

        $user = $this->userRepository->getUser($email);

        if(!$user) {
            return $this->render('login', ['messages' => ['Błędny adres e-mail lub hasło!']]);
        }

        elseif($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['Błędny adres e-mail lub hasło!']]);
        }

        elseif(password_verify($password, $user->getPassword()) != true) {
            return $this->render('login', ['messages' => ['Błędne hasło!']]);
        }

        else {
            setcookie('email', $email, time() + 7 * 24 * 60 * 60);
            //$_SESSION['email'] = $email;
            //$url = "http://$_SERVER[HTTP_HOST]";
            //header("Location: {$url}/actions");
            return $this->render('actions');
        }
    }

    public function logout() {
        session_start();
        session_unset();
        setcookie('email', "", time() - 3600);
        setcookie('id', "", time() - 3600);
        return $this->render('login', ['messages' => ['Pomyślnie wylogowano!']]);
    }

    public function info() {
        if(!$this->isPost()) {
            return $this->render('login');
        }

        $user = $this->userRepository->getUser($_COOKIE['email']);
        $activeArticles = $this->articleRepository->getArticlesByEmail($_COOKIE['email']);
        $inactiveArticles = $this->articleRepository->getInactiveArticlesByEmail($_COOKIE['email']);
        $biddedArticles = $this->articleRepository->getBiddedArticlesByUserId($_COOKIE['id']);
        $boughtArticles = $this->articleRepository->getBoughtArticlesByUserId($_COOKIE['id']);
        $isAdmin = $this->userRepository->isAdmin($_COOKIE['email']);

        if(!$user) {
            return $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
        }
        elseif ($isAdmin == true) {
            return $this->render('admin-info', ['user' => $user]);
        }
        //elseif ()
        elseif ($isAdmin == false) {
            return $this->render('info', ['user' => $user, 'activeArticles' => $activeArticles, 'inactiveArticles' => $inactiveArticles, 'biddedArticles' => $biddedArticles, 'boughtArticles' => $boughtArticles]);
        }

        else {
            return $this->render('login', ['messages' => ['Coś poszło nie tak!']]);
        }
    }

    public function userItems() {
        if(!$this->isGet()) {
            return $this->render('login');
        }
        elseif(isset($_COOKIE['email']) && isset($_GET['UserItems'])) {
            $user = $this->userRepository->getUser($_COOKIE['email']);
            $activeArticles = $this->articleRepository->getArticlesByEmail($_COOKIE['email']);
            if(!$user) {
                return $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
            }
            elseif($activeArticles != null) return $this->render('active-items', ['user' => $user, 'activeArticles' => $activeArticles]);
            else return $this->render('active-items', ['messages' => ['Brak artykułów do wyświetlenia'], 'activeArticles' => $activeArticles]);
        }
        else return $this->render('login', ['messages' => ['Coś poszło nie tak!']]);
    }

    public function archiveItems() {
        if(!$this->isGet()) {
            return $this->render('login');
        }
        elseif(isset($_COOKIE['email']) && isset($_GET['ArchiveItems'])) {
            $user = $this->userRepository->getUser($_COOKIE['email']);
            $inactiveArticles = $this->articleRepository->getInactiveArticlesByEmail($_COOKIE['email']);
            if(!$user) {
                return $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
            }
            elseif($inactiveArticles != null) return $this->render('archive-items', ['user' => $user, 'inactiveArticles' => $inactiveArticles]);
            else return $this->render('archive-items', ['messages' => ['Brak artykułów do wyświetlenia'], 'inactiveArticles' => $inactiveArticles]);
        }
        else return $this->render('login', ['messages' => ['Coś poszło nie tak!']]);
    }

    public function biddedItems() {
        if(!$this->isGet()) {
            return $this->render('login');
        }
        elseif(isset($_COOKIE['email']) && isset($_GET['BiddedItems'])) {
            $user = $this->userRepository->getUser($_COOKIE['email']);
            $biddedArticles = $this->articleRepository->getBiddedArticlesByUserId($_COOKIE['id']);
            if(!$user) {
                return $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
            }
            elseif($biddedArticles != null) return $this->render('bidded-items', ['user' => $user, 'biddedArticles' => $biddedArticles]);
            else return $this->render('bidded-items', ['messages' => ['Brak artykułów do wyświetlenia'], 'biddedArticles' => $biddedArticles]);
        }
        else return $this->render('login', ['messages' => ['Coś poszło nie tak!']]);
    }

    public function boughtItems() {
        if(!$this->isGet()) {
            return $this->render('login');
        }
        elseif(isset($_COOKIE['email']) && isset($_GET['BoughtItems'])) {
            $user = $this->userRepository->getUser($_COOKIE['email']);
            $boughtArticles = $this->articleRepository->getBoughtArticlesByUserId($_COOKIE['id']);
            if(!$user) {
                return $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
            }
            elseif($boughtArticles != null) return $this->render('bought-items', ['user' => $user, 'boughtArticles' => $boughtArticles]);
            else return $this->render('bought-items', ['messages' => ['Brak artykułów do wyświetlenia'], 'boughtArticles' => $boughtArticles]);
        }
        else return $this->render('login', ['messages' => ['Coś poszło nie tak!']]);
    }

    public function updateUserData() {
        if(!$this->isPost()) {
            return $this->render('login');
        }
        elseif ($_POST['password'] != null && $_POST['repeatPassword'] == $_POST['password'] && $_POST['name'] != null && $_POST['surname'] != null) {
            $password = $_POST['password'];
            $user = $this->userRepository->getUser($_COOKIE['email']);
            if(!$user) {
                return $this->render('change-user-data', ['messages' => ['Błędny adres e-mail lub hasło!']]);
            }

            if(password_verify($password, $user->getPassword()) != true) {
                return $this->render('change-user-data', ['messages' => ['Błędne hasło!']]);
            }
            $this->userRepository->changeData($_COOKIE['email']);
            $user = $this->userRepository->getUser($_COOKIE['email']);
            $activeArticles = $this->articleRepository->getArticlesByEmail($_COOKIE['email']);
            $inactiveArticles = $this->articleRepository->getInactiveArticlesByEmail($_COOKIE['email']);
            return $this->render('info', ['user' => $user, 'activeArticles' => $activeArticles, 'inactiveArticles' => $inactiveArticles]);
        }
        else {
            return $this->render('change-user-data', ['messages' => ['Błędne dane!']]);
        }

    }

    public function userProfile() {
        if(!$this->isGet()) {
            return $this->render('login', ['messages' => ['Coś poszło nie tak!']]);
        }
        elseif (!isset($_COOKIE['email'])) {
            return $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
        }
        elseif ($_GET['user-email']) {
            $user = $this->userRepository->getUser($_GET['user-email']);
            $activeArticles = $this->articleRepository->getArticlesByEmail($_GET['user-email']);
            return $this->render('user-profile', ['user' => $user, 'activeArticles' => $activeArticles]);
        }
        else {
            return $this->render('login', ['messages' => ['Coś poszło nie tak!']]);
        }
    }

    public function admin() {
        if(!$this->isGet()) {
            return $this->render('login', ['messages' => ['Coś poszło nie tak!']]);
        }
        elseif (!isset($_COOKIE['email'])) {
            return $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
        }
        elseif ($this->userRepository->isAdmin($_COOKIE['email']) == false) {
            return $this->render('categories', ['messages' => ['Nie masz odpowiednich uprawnień!']]);
        }
        else{
            $allUsers = $this->userRepository->getAllOtherUsers($_COOKIE['email']);
            if ($allUsers != null) {
                return $this->render('admin-panel', ['users' => $allUsers]);
            }
            else {
                return $this->render('admin-panel', ['users' => $allUsers, ['messages' => 'W bazie nie ma żadnych użytkowników']]);
            }
        }
    }

    public function deleteUser() {
        if(!$this->isPost()) {
            return $this->render('login', ['messages' => ['Coś poszło nie tak!']]);
        }
        elseif (!isset($_COOKIE['email'])) {
            return $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
        }
        elseif ($this->userRepository->isAdmin($_COOKIE['email']) == false) {
            return $this->render('categories', ['messages' => ['Nie masz odpowiednich uprawnień!']]);
        }
        else{
            $this->userRepository->deleteUser($_POST['user-email']);
            $this->offerRepository->deleteOffersOfUser($_POST['user-email']);
            $this->articleRepository->deleteItemsOfUser($_POST['user-email']);
            $allUsers = $this->userRepository->getAllOtherUsers($_COOKIE['email']);
            if ($allUsers != null) {
                return $this->render('admin-panel', ['users' => $allUsers, ['messages' => 'Usunięto użytkownika']]);
            }
            else {
                return $this->render('admin-panel', ['users' => $allUsers, ['messages' => 'W bazie nie ma żadnych użytkowników']]);
            }
        }
    }
}