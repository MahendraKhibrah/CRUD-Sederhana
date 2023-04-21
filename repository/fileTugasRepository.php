<?php

namespace Repository {

    use PDO;
    use Models\FileTugas;

    class FileTugasRepository
    {
        public function __construct(private PDO $koneksi)
        {
        }

        public function insert(FileTugas $file)
        {
            $query = "INSERT INTO file_tugas(nama, ukuran, tipe, deskripsi, path) VALUES (?, ?, ?, ?, ?)";
            $data = $this->koneksi->prepare($query);
            $data->execute([$file->getNama(), $file->getUkuran(), $file->getTipe(), $file->getDeskripsi(), $file->getPath()]);
        }

        public function findAll()
        {
            $result = [];

            $sql = "SELECT * FROM file_tugas";
            $statement = $this->koneksi->prepare($sql);
            $statement->execute();

            foreach ($statement as $row) {
                $user = new FileTugas($row['nama'], $row['ukuran'], $row['tipe'], $row['deskripsi'], $row['path']);
                $user->setId($row["id"]);
                array_push($result, $user);
            }
            return $result;
        }

        public function find(int $id)
        {
            $sql = "SELECT * FROM file_tugas WHERE id = ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->execute([$id]);

            if ($row = $statement->fetch()) {
                $file = new FileTugas(
                    $row['nama'],
                    $row['ukuran'],
                    $row['tipe'],
                    $row['deskripsi'],
                    $row['path']
                );
                $file->setId($row["id"]);

                return $file;
            } else {
                return false;
            }
        }
    }
}
