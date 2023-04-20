<?php

namespace Models {
    class User
    {
        public function __construct(private string $status = "", private string $username = "", private string $email = "", private string $password = "")
        {
        }

        private int $id;

        public function setId(string $data)
        {
            $this->id = $data;
        }
        public function setStatus(string $data)
        {
            $this->status = $data;
        }

        public function setUsername(string $data)
        {
            $this->username = $data;
        }

        public function setPassword(string $data)
        {
            $this->password = md5($data);
        }

        public function setEmail(string $data)
        {
            $this->email = $data;
        }

        public function getUsername()
        {
            return $this->username;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function getStatus()
        {
            return $this->status;
        }

        public function getId()
        {
            return $this->id;
        }
    }
}
