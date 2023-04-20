<?php

namespace Repository {

    use PDO;
    use Models\User;

    class UserRepository
    {
        public function __construct(private PDO $koneksi)
        {
        }

        public function insert(User $user)
        {
            $query = "INSERT INTO user(status, username, email, password) VALUES (?, ?, ?, ?)";
            $data = $this->koneksi->prepare($query);
            $data->execute([$user->getStatus(), $user->getUsername(), $user->getEmail(), $user->getPassword()]);
        }

        public function findAll()
        {
            $result = [];

            $sql = "SELECT * FROM user";
            $statement = $this->koneksi->prepare($sql);
            $statement->execute();

            foreach ($statement as $row) {
                $user = new User($row['status'], $row['username'], $row['email'], $row['password']);
                $user->setId($row["id"]);
                array_push($result, $user);
            }
            return $result;
        }

        public function find(int $id)
        {
            $sql = "SELECT * FROM user WHERE id = ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->execute([$id]);

            if ($row = $statement->fetch()) {
                $user = new User($row['status'], $row['username'], $row['email'], $row['password']);
                $user->setId($row["id"]);

                return $user;
            } else {
                return false;
            }
        }
    }
}
