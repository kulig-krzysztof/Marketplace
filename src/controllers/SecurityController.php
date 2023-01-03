<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    private $messages = [];
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function login() {

        if(!$this->isPost()) {
            return $this->render('login');
        }

        $email = $_POST['email'];
        $password = md5($_POST['password']);
        session_start();
        $_SESSION['email'] = $email;

        $user = $this->userRepository->getUser($email);

        if(!$user) {
            return $this->render('login', ['messages' => ['Wrong email or password!']]);
        }

        if($user->getEmail() !== $email) {
            return $this->render('login', ['messages' => ['Wrong email or password!']]);
        }

        if($user->getPassword() !== $password) {
            return $this->render('login', ['messages' => ['Wrong password!']]);
        }

        return $this->render('actions');
    }

    public function logout() {
        session_start();
        session_unset();
        return $this->render('login', ['messages' => ['Logged out successfully!']]);
    }
}