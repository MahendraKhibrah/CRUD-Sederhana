<?php

namespace Controller {

    use Models\User;
    use Repository\UserRepository;

    class UserController
    {
        public function __construct(private UserRepository $userRepository)
        {
        }

        public function createUser($status, $username, $email, $password)
        {
            $users = $this->userRepository->findAll();
            $isExist = false;

            foreach ($users as $user) {
                if ($user->getUsername() == $username || $user->getEmail() == $email) {
                    $isExist = true;
                }
            }

            session_start();
            if ($isExist == true) {
                $_SESSION['message'] = ['register' => 'data sudah terdaftar'];
            } else {
                $_SESSION['username'] = $username;
                $_SESSION['auth'] = true;

                $user = new User($status, $username, $email, $password);
                $user->setPassword($password);
                $this->userRepository->insert($user);

                header("location: /praktikum_5/view/tabelMahasiswa/home.php");
            }
        }

        public function loginUser($username, $password)
        {
            $users = $this->userRepository->findAll();
            session_start();
            $_SESSION['auth'] = false;

            foreach ($users as $user) {
                if ($user->getUsername() == $username) {
                    if ($user->getPassword() == md5($password)) {
                        $_SESSION['auth'] = true;
                        $_SESSION['username'] = $username;
                        $_SESSION['role'] = $user->getStatus();

                        header("location: /praktikum_5/view/tabelMahasiswa/home.php");
                    } else {
                        $_SESSION['message'] = ['login' => 'password salah'];
                    }
                } else {
                    $_SESSION['message'] = ['login' => 'username salah'];
                }
            }
        }

        public function logoutUser()
        {
            session_start();
            session_destroy();
            $_SESSION['auth'] = false;

            header("location: /praktikum_5/view/home.php");
        }
    }
}
