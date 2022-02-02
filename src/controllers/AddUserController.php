<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class AddUserController extends AppController
{
    private $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function register()
    {


        if ($this->isPost()) {
            $user = new User($_POST['email'], $_POST['password'], $_POST['name'], $_POST['surname']);

            $email = $_POST['email'];
            $check = $this->userRepository->getUser($email);
            if ($check) {
                return $this->render('register', ['messages' => ['User with this email already exists!']]);
            }
            $this->userRepository->addUser($user);
            return $this->render('login', ['messages' => ['User added!']]);


        }


        $this->render('register');
    }
}