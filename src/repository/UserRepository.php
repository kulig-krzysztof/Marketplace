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
        if(!isset($_COOKIE['id'])) {
            setcookie('id', $user['id'], time() + 7 * 24 * 60 * 60);
            //$_SESSION['id'] = $user['id'];
        }


        return new User(
            $user['email'],
            $user['password'],
            $user['name'],
            $user['surname'],
            $user['account_type']
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

    public function isAdmin(string $email) : bool {
        $stmt = $this->database->connect()->prepare("
            SELECT account_types.account_type FROM account_types INNER JOIN users u on account_types.id = u.account_type WHERE u.email = :email;
        ");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if($result['account_type'] === "Administrator") {
            return true;
        }
        else {
            return false;
        }
    }

    public function getAllOtherUsers(string $email) : array {
        $result = [];

        $stmt = $this->database->connect()->prepare("
            SELECT users.name as name, users.email as email, users.surname as surname, users.account_type as account_type FROM users WHERE users.email != :email;
        ");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($users as $user) {
            $result[] = new User(
                $user['email'],
                'temp',
                $user['name'],
                $user['surname'],
                $user['account_type']
            );
        }
        return $result;
    }

    public function deleteUser(string $email) : void {
        $stmt = $this->database->connect()->prepare("
            DELETE FROM users WHERE users.email = :email
        ");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    }
}