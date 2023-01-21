<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Offer.php';

class OfferRepository extends Repository
{
    public function getOffersByItemId(int $id): array {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT offers.id, offers.offer_from_id, offers.city_name, offers.price, offers.item_id, offers.lng, offers.lat, users.email, offers.data, offers.state_of_offer FROM public.offers INNER JOIN users ON offers.offer_from_id = users.id WHERE offers.item_id = :id 
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($offers as $offer) {
            $result[] = new  Offer(
                $offer['id'],
                $offer['offer_from_id'],
                $offer['city_name'],
                $offer['price'],
                $offer['item_id'],
                $offer['lng'],
                $offer['lat'],
                $offer['email'],
                $offer['data'],
                $offer['state_of_offer']
            );
        }
        return $result;
    }

    public function addOffer(Offer $offer): void {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO offers (offer_from_id, city_name, price, item_id, lng, lat, data, state_of_offer) VALUES (?, ?, ?, ?, ? ,?, ?, ?)
        ');
        session_start();
        $stmt->execute([
            $_SESSION['id'],
            $offer->getCityName(),
            $offer->getPrice(),
            $_SESSION['item-id'],
            $offer->getLng(),
            $offer->getLat(),
            $offer->getData(),
            $offer->getState()
        ]);
    }

    public function getOfferObjectById(int $id) : ?Offer {
        $stmt = $this->database->connect()->prepare("
            SELECT offers.id, offers.offer_from_id, offers.city_name, offers.price, offers.item_id, offers.lng, offers.lat, users.email, offers.data, offers.state_of_offer FROM public.offers INNER JOIN users ON offers.offer_from_id = users.id WHERE offers.id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $offer = $stmt->fetch(PDO::FETCH_ASSOC);
        return new Offer(
            $offer['id'],
            $offer['offer_from_id'],
            $offer['city_name'],
            $offer['price'],
            $offer['item_id'],
            $offer['lng'],
            $offer['lat'],
            $offer['email'],
            $offer['data'],
            $offer['state_of_offer']
        );
    }

    public function getOfferById(int $id) : array {
        $stmt = $this->database->connect()->prepare("
            SELECT offers.id, offers.offer_from_id, offers.city_name, offers.price, offers.item_id, offers.lng, offers.lat, users.email, offers.data, offers.state_of_offer FROM public.offers INNER JOIN users ON offers.offer_from_id = users.id WHERE offers.id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOffersForItem(int $id): array {
        $stmt = $this->database->connect()->prepare("
            SELECT offers.id, offers.offer_from_id, offers.city_name, offers.price, offers.item_id, offers.lng, offers.lat, users.email, offers.data, offers.state_of_offer FROM public.offers INNER JOIN users ON offers.offer_from_id = users.id WHERE offers.item_id = :id AND offers.state_of_offer = 'active'
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getOfferItemId(int $id) : int {
        $stmt = $this->database->connect()->prepare('
            SELECT offers.item_id FROM offers WHERE id = :id
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_BOTH);
        return $result[0];
    }

    public function removeOtherOffers(int $acceptedOfferId, int $itemId) : void {
        $stmt = $this->database->connect()->prepare('
            DELETE FROM offers WHERE item_id = :itemId AND id != :acceptedOfferId
        ');
        $stmt->bindParam(':itemId', $itemId, PDO::PARAM_INT);
        $stmt->bindParam(':acceptedOfferId', $acceptedOfferId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function getOfferByItemId(int $id) : ?Offer {
        $stmt = $this->database->connect()->prepare("
            SELECT offers.id, offers.offer_from_id, offers.city_name, offers.price, offers.item_id, offers.lng, offers.lat, users.email, offers.data, offers.state_of_offer FROM public.offers INNER JOIN users ON offers.offer_from_id = users.id WHERE offers.item_id = :id AND offers.state_of_offer = 'active'
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $offer = $stmt->fetch(PDO::FETCH_BOTH);

        return new  Offer(
            $offer['id'],
            $offer['offer_from_id'],
            $offer['city_name'],
            $offer['price'],
            $offer['item_id'],
            $offer['lng'],
            $offer['lat'],
            $offer['email'],
            $offer['data'],
            $offer['state_of_offer']
        );
    }

    public function setOfferAccepted(int $id) : void {
        $stmt = $this->database->connect()->prepare("
            UPDATE offers SET state_of_offer = 'accepted' WHERE offers.id = :id
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function declineOffer(int $id) : void {
        $stmt = $this->database->connect()->prepare("
            UPDATE offers SET state_of_offer = 'declined' WHERE offers.id = :id;
        ");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
}