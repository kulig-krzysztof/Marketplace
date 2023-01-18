<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Offer.php';
require_once __DIR__.'/../models/Article.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/OfferRepository.php';
require_once __DIR__.'/../repository/ArticleRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';

session_start();

class OfferController extends AppController
{
    private $messages = [];
    private $offerRepository;
    private $articleRepository;
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->offerRepository = new OfferRepository();
        $this->articleRepository = new ArticleRepository();
        $this->userRepository = new UserRepository();
    }

    public function bid() {
        if(isset($_SESSION['email']) && isset($_POST['bid'])) {
            $offer = new Offer(0, $_SESSION['id'], $_POST['location'], $_POST['bid-value'], $_SESSION['item-id'], $_POST['lng'], $_POST['lat'], $_SESSION['email'], $_POST['meeting-time']);
            $articles = $this->articleRepository->getArticle($_SESSION['item-id']);
            $this->offerRepository->addOffer($offer);
            return $this->render('item', ['messages' => ['Bid added!'], 'articles' => $articles]);
        }
        if(!isset($_SESSION['email'])) {
            return $this->render('login', ['messages' => ['You are not logged in!']]);
        }
        else {
            return $this->render('result');
        }
    }

    public function offers() {
        $offers = $this->offerRepository->getOffersForItem($_SESSION['item-id']);
        header('Content-type: application/json');
        http_response_code(200);
        echo json_encode($offers);
    }

    public function acceptOffer() {
        if(isset($_SESSION['email']) && isset($_POST['accept'])) {
            $id = $this->offerRepository->getOfferItemId($_POST['id']);
            $this->articleRepository->setArticleInactive($id);
            $user = $this->userRepository->getUser($_SESSION['email']);
            $articles = $this->articleRepository->getArticlesByEmail($_SESSION['email']);
            $this->offerRepository->removeOtherOffers($_POST['id'], $id);
            $article = $this->articleRepository->getArticle($_SESSION['item-id']);
            if ($articles != null) $this->render('info', ['messages' => ['Offer Accepted'], 'user' => $user, 'articles' => $articles]);
            else $this->render('item', ['messages' => ['Bid added!'], 'articles' => $article]);
        }
    }
}