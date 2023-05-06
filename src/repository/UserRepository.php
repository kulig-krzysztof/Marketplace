<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository
{
    public function getUser(string $email): ?User {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM public.users WHERE email = :email 
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user == false) {
            return null;
        }

        session_start();
        setcookie('id', $user['id'], time() + 7 * 24 * 60 * 60);
        //$_SESSION['id'] = $user['id'];

        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname']
        );
    }

    public function addUser(User $user): void {
        $stmt = $this->database->connect()->prepare('
            INSERT INTO users (email, password, name, surname) 
            VALUES (?,?,?,?)
        ');
        $stmt->execute([
            $user->getEmail(),
            $user->getPassword(),
            $user->getName(),
            $user->getSurname()
        ]);
    }

    public function changeData(string $email): void {
        $name = ucfirst(strtolower($_POST['name']));
        $surname = ucfirst(strtolower($_POST['surname']));
        $stmt = $this->database->connect()->prepare('
            UPDATE users SET name = :name, surname = :surname WHERE email = :email
        ');
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    }
}