<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Offer.php';
require_once __DIR__.'/../models/Article.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/OfferRepository.php';
require_once __DIR__.'/../repository/ArticleRepository.php';
require_once __DIR__.'/../repository/UserRepository.php';

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
        if(isset($_COOKIE['email']) && isset($_POST['bid'])) {
            $offer = new Offer(0, $_COOKIE['id'], $_POST['location'], $_POST['bid-value'], $_SESSION['item-id'], $_POST['lng'], $_POST['lat'], $_COOKIE['email'], $_POST['meeting-time'], "active");
            $articles = $this->articleRepository->getArticle($_SESSION['item-id']);
            $offers = $this->offerRepository->getOfferByItemId($_SESSION['item-id']);
            $this->offerRepository->addOffer($offer);
            return $this->render('bidded-item-data', ['messages' => ['Dodano ofertę!'], 'articles' => $articles, 'offers' => $offers]);
        }
        if(!isset($_COOKIE['email'])) {
            return $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
        }
        else {
            return $this->render('result');
        }
    }

    public function offers() {
        $offers = $this->offerRepository->getWinnerOfferForItem($_SESSION['item-id'], $_COOKIE['id']);
        header('Content-type: application/json');
        http_response_code(200);
        echo json_encode($offers);
    }

    public function allOffersForItem() {
        $offers = $this->offerRepository->getOffersForItem($_SESSION['item-id'], $_COOKIE['id']);
        header('Content-type: application/json');
        http_response_code(200);
        echo json_encode($offers);
    }

    public function offersOfBidder() {
        $offersOfBidder = $this->offerRepository->getOffersForItemBidder($_SESSION['item-id'], $_COOKIE['id']);
        $_SESSION['offer-id'] = $offersOfBidder[0]["id"];
        header('Content-type: application/json');
        http_response_code(200);
        echo json_encode($offersOfBidder);
    }

    public function counterOffer() {
        $counterOffer = $this->offerRepository->getResponseOffer($_SESSION['item-id'], $_COOKIE['id']);
        header('Content-type: application/json');
        http_response_code(200);
        echo json_encode($counterOffer);
    }

    public function acceptOffer() {
        if(isset($_COOKIE['email']) && isset($_POST['accept'])) {
            $id = $this->offerRepository->getOfferItemId($_POST['id']);
            $this->articleRepository->setArticleInactive($id);
            $user = $this->userRepository->getUser($_COOKIE['email']);
            $articles = $this->articleRepository->getArticlesByEmail($_COOKIE['email']);
            $this->offerRepository->removeOtherOffers($id, $_POST['id']);
            $this->offerRepository->setOfferAccepted($_POST['id'], $_COOKIE['id']);
            $article = $this->articleRepository->getArticle($_SESSION['item-id']);
            if ($articles != null) $this->render('info', ['messages' => ['Zaakceptowano ofertę'], 'user' => $user, 'articles' => $articles]);
            else $this->render('item', ['messages' => ['Zaakceptowano ofertę!'], 'articles' => $article]);
        }
    }

    public function declineOffer() {
        if(isset($_COOKIE['email']) && isset($_POST['decline'])) {
            $user = $this->userRepository->getUser($_COOKIE['email']);
            $this->offerRepository->declineOffer($_POST['id']);
            $articles = $this->articleRepository->getArticlesByEmail($_COOKIE['email']);
            $article = $this->articleRepository->getArticle($_SESSION['item-id']);
            if ($articles != null) $this->render('info', ['messages' => ['Odrzucono ofertę'], 'user' => $user, 'articles' => $articles]);
            else $this->render('item', ['messages' => ['Odrzucono ofertę!'], 'articles' => $article]);
        }
    }

    public function respondToOffer() {
        if(isset($_COOKIE['email']) && $this->isPost()) {
            $article = $this->articleRepository->getArticle($_SESSION['item-id']);
            $offer = $this->offerRepository->getOfferObjectById(intval($_POST['id']));
            $_SESSION['offer-id'] = intval($_POST['id']);
            $this->render('active-item-data', ['articles' => $article, 'offers' => $offer]);
        }
    }

    public function respondTo() {
        $offers = $this->offerRepository->getOfferById($_SESSION['offer-id']);
        header('Content-type: application/json');
        http_response_code(200);
        echo json_encode($offers);
    }

    public function respond() {
        if(isset($_COOKIE['email']) && $this->isPost()) {
            $_SESSION['offer-id'] = intval($_POST['id']);
            $article = $this->articleRepository->getArticle($_SESSION['item-id']);
            $user = $this->userRepository->getUser($_COOKIE['email']);
            $offer = new Offer(0, $_COOKIE['id'], $_POST['location'], $_POST['bid-value'], $_SESSION['item-id'], floatval($_POST['lng']), floatval($_POST['lat']), $_COOKIE['email'], $_POST['meeting-time'], "active");
            $this->offerRepository->setOfferResponded($_SESSION['offer-id']);
            $user_id_2 = $this->offerRepository->getUserIdByOfferId($_SESSION['offer-id']);
            $this->offerRepository->respondToOffer($offer, $user_id_2);
            $articles = $this->articleRepository->getArticlesByEmail($_COOKIE['email']);
            if ($articles != null) $this->render('info', ['messages' => ['Wysłano odpowiedź'], 'user' => $user, 'articles' => $articles]);
            else $this->render('item', ['messages' => ['Wysłano odpowiedź!'], 'articles' => $article]);
        }
    }

    public function deleteOffer() {
        if($this->isGet() && isset($_COOKIE['email']) && isset($_GET['offer-id'])) {
            $id = intval($_GET['offer-id']);
            $article = $this->articleRepository->getArticleByOfferId($id);
            $this->offerRepository->deleteOffer($id);
            return $this->render('item', ['messages' => ['Oferta usunięta'], 'articles' => $article]);
        }
        if(!isset($_COOKIE['email'])) {
            return $this->render('login', ['messages' => ['Nie jesteś zalogowany!']]);
        }
        else {
            return $this->render('login', ['messages' => ['Coś poszło nie tak']]);
        }
    }
}