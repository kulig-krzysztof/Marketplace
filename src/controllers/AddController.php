<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Article.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../models/Offer.php';
require_once __DIR__.'/../repository/ArticleRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';
require_once __DIR__.'/../repository/OfferRepository.php';

session_start();

class AddController extends AppController
{
    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpeg'];
    const UPLOAD_DIRECTORY = '/../public/img/form-images/';
    private $messages = [];
    private $articleRepository;
    private $userRepository;
    private $offerRepository;

    public function __construct()
    {
        parent::__construct();
        $this->articleRepository = new ArticleRepository();
        $this->userRepository = new UserRepository();
        $this->offerRepository = new OfferRepository();
    }

    public function results() {
        if(isset($_COOKIE['email']) && !isset($_POST['name-search'])) {
            $articles = $this->articleRepository->getAllArticles();
            if($articles != null) {
                $this->render('result', ['articles' => $articles]);
            }
            else {
                $this->render('result', ['articles' => $articles, 'messages' => ['Nie znaleziono żadnych artykułów do wyświetlenia.']]);
            }
        }
        elseif (isset($_COOKIE['email']) && isset($_POST['name-search'])) {
            $articles = $this->articleRepository->getArticlesByString($_POST['name-search']);
            if($articles != null) {
                $this->render('result', ['articles' => $articles]);
            }
            else {
                $this->render('result', ['articles' => $articles, 'messages' => ['Nie znaleziono żadnych artykułów do wyświetlenia.']]);
            }
        }
        else {
            $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
        }
    }


    public function add() {

        if($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {

            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );
            if($_POST['state'] == "true" || $_POST['state'] == 1) {
                $state = true;
            }
            else {
                $state = false;
            }

                $article = new Article(0,$_POST['title'],$_POST['category'],$_POST['desc'],$_POST['price'],$_COOKIE['email'], $_FILES['file']['name'], floatval($_POST['lng']), floatval($_POST['lat']), $_POST['city-name'], $_POST['size'], $state);
                $this->articleRepository->addArticle($article);

                return $this->render('categories', ['messages' => $this->messages]);

        }
        if(!isset($_COOKIE['email'])) {
            return $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
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
            if ($this->isGet() && isset($_COOKIE['email'])) {
                $articles = $this->articleRepository->getArticleByCategory($_GET['category']);
                if ($articles != null) {
                    return $this->render('result', ['articles' => $articles]);
                } else {
                    return $this->render('result', ['articles' => $articles, 'messages' => ['Nie znaleziono artykułów w tej kategorii']]);
                }
            }
            else {
                return $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
            }
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
        if($this->isGet() && isset($_GET['item-id']) && isset($_COOKIE['email'])) {
            $id = trim($_GET['item-id']);
            $user_id = $_COOKIE['id'];
            $_SESSION['item-id'] = $id;
            $articles = $this->articleRepository->getArticle($id);
            $result = $this->offerRepository->checkForActiveOfferForItemById($id, $user_id);
            $currentHighestBid = $this->offerRepository->checkCurrentHighestBidForItemId($id);
            if($currentHighestBid == null) {
                $currentHighestBid = $articles->getPrice();
            }
            //var_dump($result);
            if($result > 0) {
                $offers = $this->offerRepository->getOfferByItemId($_SESSION['item-id']);
                return $this->render('bidded-item-data', ['articles' => $articles, 'offers' => $offers, 'messages' => ['Dodałeś już ofertę do tego produktu! Oto jej detale:']]);
            }
            else {
                $this->render('item', ['articles' => $articles, 'currentHighestBid' => $currentHighestBid]);
            }
        }
        elseif (!isset($_GET['item-id']) && isset($_COOKIE['email'])){
            $this->render('categories');
        }
        elseif (!isset($_COOKIE['email'])) {
            $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
        }
    }

    public function activeItemSite() {
        $id = intval($_GET['item-id']);
        $articles = $this->articleRepository->getArticle($id);
        $_SESSION['item-id'] = $id;
        $offers = $this->offerRepository->getOffersByItemId($_SESSION['item-id']);
        $_SESSION['default-image'] = $articles->getImg();
        return $this->render('active-item-data' , ['articles' => $articles, 'offers' => $offers]);
    }

    public function updateItemSite() {
        $id = intval($_GET['item-id']);
        $articles = $this->articleRepository->getArticle($id);
        $_SESSION['item-id'] = $id;
        $offers = $this->offerRepository->getOffersByItemId($_SESSION['item-id']);
        $_SESSION['default-image'] = $articles->getImg();
        return $this->render('update-item-data' , ['articles' => $articles, 'offers' => $offers]);
    }


    public function updateItemData() {
        if($this->isPost() && isset($_COOKIE['email']) && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name']
            );
            $this->articleRepository->updateItem($_SESSION['item-id']);
            $articles = $this->articleRepository->getArticle($_SESSION['item-id']);
            //$inactiveArticles = $this->articleRepository->getInactiveArticlesByEmail($_COOKIE['email']);
            //$biddedArticles = $this->articleRepository->getBiddedArticlesByUserId($_SESSION['id']);
            $offers = $this->offerRepository->getOffersByItemId($_SESSION['item-id']);
            //$user = $this->userRepository->getUser($_COOKIE['email']);
            return $this->render('active-item-data' , ['articles' => $articles, 'offers' => $offers]);

        }
        elseif (!isset($_COOKIE['email'])) {
            return $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
        }

        elseif (!is_uploaded_file($_FILES['file']['tmp_name'])) {
            $_FILES['file']['name'] = $_SESSION['default-image'];
            $this->articleRepository->updateItem($_POST['item-id']);
            $articles = $this->articleRepository->getArticle($_SESSION['item-id']);
            $offers = $this->offerRepository->getOffersByItemId($_SESSION['item-id']);
            //unset($_SESSION['item-id']);
            return $this->render('active-item-data' , ['articles' => $articles, 'offers' => $offers]);
        }

        else {
            return $this->render('login', ['messages' => ['Coś poszło nie tak!']]);
        }
    }

    public function showOffersForItem() {
        if($this->isGet() && isset($_COOKIE['email'])) {
            $offers = $this->offerRepository->getOffersByItemId($_SESSION['item-id']);
            $articles = $this->articleRepository->getArticle($_SESSION['item-id']);
            return $this->render('offers-for-item', ['articles' => $articles, 'offers' => $offers]);
        }
        elseif(!isset($_COOKIE['email'])) {
            return $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
        }
        else {
            return $this->render('login', ['messages' => ['Coś poszło nie tak!']]);
        }
    }

    public function inactiveItemData() {
        $id = intval($_GET['item-id']);
        $articles = $this->articleRepository->getArticle($id);
        $_SESSION['item-id'] = $id;
        $offers = $this->offerRepository->getWinnerOfferByItemId($_GET['item-id']);
        return $this->render('inactive-item-data' , ['articles' => $articles, 'offers' => $offers]);
    }

    public function biddedItemData() {
        $id = intval($_GET['item-id']);
        $articles = $this->articleRepository->getArticle($id);
        $_SESSION['item-id'] = $id;
        $offers = $this->offerRepository->getOfferByItemId($_SESSION['item-id']);
        return $this->render('bidded-item-data', ['articles' => $articles, 'offers' => $offers]);
    }

    public function boughtItemData() {
        $id = intval($_GET['item-id']);
        $articles = $this->articleRepository->getArticle($id);
        $_SESSION['item-id'] = $id;
        $offers = $this->offerRepository->getWinnerOfferByItemId($_SESSION['item-id']);
        return $this->render('bought-item-data', ['articles' => $articles, 'offers' => $offers]);
    }

    public function deleteItem() {
        if($this->isGet() && isset($_COOKIE['email']) && !isset($_COOKIE['admin-email'])) {
            $id = intval($_GET['item-id']);
            $this->articleRepository->deleteItem($id);
            $this->offerRepository->deleteOffers($id);
            $articles = $this->articleRepository->getArticlesByEmail($_COOKIE['email']);
            return $this->render('active-items', ['activeArticles' => $articles, 'messages' => ['Usunięto aukcję pomyślnie']]);
        }
        elseif (isset($_COOKIE['admin-email'])) {
            $id = intval($_GET['item-id']);
            $this->articleRepository->deleteItem($id);
            $this->offerRepository->deleteOffers($id);
            $allUsers = $this->userRepository->getAllOtherUsers($_COOKIE['email']);
            if ($allUsers != null) {
                return $this->render('admin-panel', ['users' => $allUsers, ['messages' => 'Usunięto aukcję użytkownika']]);
            }
            else {
                return $this->render('admin-panel', ['users' => $allUsers, ['messages' => 'W bazie nie ma żadnych użytkowników']]);
            }
        }
        elseif(!isset($_COOKIE['email'])) {
            return $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
        }
        else {
            return $this->render('login', ['messages' => ['Coś poszło nie tak!']]);
        }
    }

    public function getRandomFromArray(array $randomArticles, int $counter) : ?Article {
        return $randomArticles[$counter];
    }

    /*
    public function getRandom() : array
    {
        return $this->articleRepository->getRandomArticlesArray($_COOKIE['id']);
    }
    */

    public function roulette() {
        if($this->isGet() && isset($_COOKIE['email'])) {
            $counter = 0;
            $randomArticles = $this->articleRepository->getRandomArticlesArray($_COOKIE['id']);
            $articles = $this->getRandomFromArray($randomArticles, $counter);
            $currentHighestBid = $this->offerRepository->checkCurrentHighestBidForItemId($articles->getId());
            return $this->render('item', ['articles' => $articles, 'currentHighestBid' => $currentHighestBid, 'roulette' => true]);
        }
        elseif(!isset($_COOKIE['email'])) {
            return $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
        }
        else {
            return $this->render('login', ['messages' => ['Coś poszło nie tak!']]);
        }
    }
}