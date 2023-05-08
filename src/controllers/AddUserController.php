<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class AddUserController extends AppController
{
    private UserRepository $userRepository;

    public function __construct()
    {
        parent::__construct();
        $this->userRepository = new UserRepository();
    }

    public function register()
    {


        if ($this->isPost() && $_POST['email'] != null && $_POST['password'] != null && $_POST['repeatPassword'] == $_POST['password'] && $_POST['name'] != null && $_POST['surname'] != null) {
            $hash = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $user = new User($_POST['email'], $hash, $_POST['name'], $_POST['surname'], 1);

            $email = $_POST['email'];
            $check = $this->userRepository->getUser($email);
            if ($check) {
                return $this->render('register', ['messages' => ['Użytkownik o takim adresie e-mail już istnieje!']]);
            }
            $this->userRepository->addUser($user);
            return $this->render('login', ['messages' => ['Dodano użytkownika!']]);


        }
        elseif ($_POST['email'] == null || $_POST['password'] == null || $_POST['repeatPassword'] != $_POST['password'] || $_POST['name'] == null || $_POST['surname'] == null) {
            return $this->render('register', ['messages' => ['Błędne dane!']]);
        }


        return $this->render('register');
    }
}