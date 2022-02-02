<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    public function login() {
        $userRepository = new UserRepository();


        if(!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = $userRepository->getUser($email);

        if(!$user) {
            return $this->render('login', ['messages' => ['User does not exist!']]);
        }

        if($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['User with this email does not exist!']]);
        }

        if($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        return $this->render('actions');
    }

    public function register() {

        $user = new User('jsnow@aaa.com', 'admin', 'Jon', 'Snow');

        if(!$this->isPost()) {
            return $this->render('register');
        }

        $email = $_POST['email'];

        if($user->getEmail() == $email) {
            return $this->render('register', ['messages' => ['User with this email already exists!']]);
        }

        return $this->render('actions');
    }
}