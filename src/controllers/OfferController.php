<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Offer.php';
require_once __DIR__.'/../models/Article.php';
require_once __DIR__.'/../repository/OfferRepository.php';
require_once __DIR__.'/../repository/ArticleRepository.php';

session_start();

class OfferController extends AppController
{
    private $messages = [];
    private $offerRepository;
    private $articleRepository;

    public function __construct()
    {
        parent::__construct();
        $this->offerRepository = new OfferRepository();
        $this->articleRepository = new ArticleRepository();
    }

    public function bid() {
        if(isset($_SESSION['email']) && isset($_POST['bid'])) {
            $offer = new Offer(0, $_SESSION['email'], $_POST['location'], $_POST['bid-value'], $_SESSION['item-id']);
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
}