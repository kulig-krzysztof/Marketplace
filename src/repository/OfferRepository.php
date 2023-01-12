<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Offer.php';

class OfferRepository extends Repository
{
    public function getOffersByItemId(int $id): array {
        $result = [];
        $stmt = $this->database->connect()->prepare('
            SELECT offers.id, users.email, offers.location_id, offers.price, offers.item_id FROM public.offers INNER JOIN users ON offers.offer_from_id = users.id WHERE offers.item_id = :id 
        ');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $offers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($offers as $offer) {
            $result[] = new  Offer(
                $offer['id'],
                $offer['email'],
                $offer['location'],
                $offer['price'],
                $offer['item_id']
            );
        }
        return $result;
    }

    public function addOffer(Offer $offer): void {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO offers (offer_from_id, location_id, price, item_id) VALUES (?, ?, ?, ?)
        ');
        session_start();
        $stmt->execute([
            $_SESSION['id'],
            $offer->getLocation(),
            $offer->getPrice(),
            $_SESSION['item-id']
        ]);
    }
}