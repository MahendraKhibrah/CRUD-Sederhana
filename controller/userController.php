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

            if ($isExist == true) {
                header("location: /praktikum_5/view/auth/register.php");
            } else {
                session_start();
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

                        header("location: /praktikum_5/view/tabelMahasiswa/home.php");
                    }
                }
            }
        }

        public function logoutUser()
        {
            session_start();
            $_SESSION['auth'] = false;

            header("location: /praktikum_5/view/home.php");
        }
    }
}
