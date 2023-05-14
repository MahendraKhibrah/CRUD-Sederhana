<?php

namespace Repository {

    use PDO;
    use Models\FileTugass;
    use Models\Matkul;
    use Models\Tugass;

    class FileTugasRepository
    {
        public function __construct(private PDO $koneksi)
        {
        }

        // DETAIL TUGAS
        public function insert(FileTugass $file)
        {
            $query = "INSERT INTO file_tugas(nama, ukuran, tipe, deskripsi, path, nama_user, id_tugas) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $data = $this->koneksi->prepare($query);
            $data->execute([$file->getNama(), $file->getUkuran(), $file->getTipe(), $file->getDeskripsi(), $file->getPath(), $file->getNamaUser(), $file->getIdTugas()]);
        }

        public function update($nilai, $id)
        {
            $query = "UPDATE file_tugas SET nilai=? WHERE id=?";
            $data = $this->koneksi->prepare($query);
            $data->execute([$nilai, $id]);
        }

        public function findAll()
        {
            $result = [];

            $sql = "SELECT * FROM file_tugas";
            $statement = $this->koneksi->prepare($sql);
            $statement->execute();

            foreach ($statement as $row) {
                $user = new FileTugass($row['nama'], $row['ukuran'], $row['tipe'], $row['deskripsi'], $row['path'], $row['nama_user'] ?? "", $row['id_tugas'] ?? "");
                $user->setId($row["id"]);
                array_push($result, $user);
            }
            return $result;
        }

        public function find(int $id = 0, string $nama = "", int $idFile = 0)
        {
            if ($id != 0 && $nama != "") {
                $sql = "SELECT * FROM file_tugas WHERE id_tugas = ? AND nama_user = ?";
                $statement = $this->koneksi->prepare($sql);
                $statement->execute([$id, $nama]);

                if ($row = $statement->fetch()) {
                    $file = new FileTugass(
                        $row['nama'],
                        $row['ukuran'],
                        $row['tipe'],
                        $row['deskripsi'],
                        $row['path'],
                        $row['nama_user'],
                        $row['id_tugas'],
                        $row['nilai']
                    );
                    $file->setId($row["id"]);

                    return $file;
                }
            } else if ($idFile != 0) {
                $sql = "SELECT * FROM file_tugas WHERE id = ?";
                $statement = $this->koneksi->prepare($sql);
                $statement->execute([$idFile]);

                if ($row = $statement->fetch()) {
                    $file = new FileTugass(
                        $row['nama'],
                        $row['ukuran'],
                        $row['tipe'],
                        $row['deskripsi'],
                        $row['path'],
                        $row['nama_user'],
                        $row['id_tugas'],
                        $row['nilai']
                    );
                    $file->setId($row["id"]);

                    return $file;
                }
            } else if ($nama == "") {
                $result = [];
                $sql = "SELECT * FROM file_tugas WHERE id_tugas = ?";
                $statement = $this->koneksi->prepare($sql);
                $statement->execute([$id]);

                foreach ($statement as $row) {
                    $file = new FileTugass($row['nama'], $row['ukuran'], $row['tipe'], $row['deskripsi'], $row['path'], $row['nama_user'] ?? "", $row['id_tugas'] ?? "", $row['nilai']);
                    $file->setId($row["id"]);
                    array_push($result, $file);
                }
                return $result;
            } else {
                return false;
            }
        }

        // MATKUL
        public function insertMatkul(Matkul $file)
        {
            $query = "INSERT INTO matkul (nama, nama_dosen) VALUES (?, ?)";
            $data = $this->koneksi->prepare($query);
            $data->execute([$file->getNama(), $file->getNamaDosen()]);
        }

        public function findMatkul(string $username = "")
        {
            $result = [];
            if ($username != "") {
                $sql = "SELECT * FROM matkul WHERE nama_dosen = ?";
                $statement = $this->koneksi->prepare($sql);
                $statement->execute([$username]);
            } else {
                $sql = "SELECT * FROM matkul";
                $statement = $this->koneksi->prepare($sql);
                $statement->execute();
            }

            foreach ($statement as $row) {
                $matkul = new Matkul(
                    $row['nama'],
                    $row['nama_dosen']
                );

                $matkul->setId($row['id']);
                array_push($result, $matkul);
            }
            return $result;
        }


        // TUGAS
        public function insertTugas(Tugass $tugas)
        {
            $query = "INSERT INTO tugas (nama, deskripsi, id_matkul) VALUES (?, ?, ?)";
            $data = $this->koneksi->prepare($query);
            $data->execute([$tugas->getNama(), $tugas->getDeskripsi(), $tugas->getIdMatkul()]);
        }

        public function findTugas(int $id = 0, int $idTugas = 0)
        {
            $result = [];

            if ($idTugas != 0) {
                $sql = "SELECT * FROM tugas WHERE id = ?";
                $statement = $this->koneksi->prepare($sql);
                $statement->execute([$idTugas]);

                if ($row = $statement->fetch()) {

                    $tugaas = new Tugass($row['nama'], $row['deskripsi'], $row['id_matkul']);
                    $tugaas->setId($row["id"]);
                    return $tugaas;
                } else {
                    return false;
                }
            }

            $sql = "SELECT * FROM tugas WHERE id_matkul = ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->execute([$id]);

            foreach ($statement as $row) {
                $tugas = new Tugass($row['nama'], $row['deskripsi'], $row['id_matkul']);
                $tugas->setId($row["id"]);
                array_push($result, $tugas);
            }
            return $result;
        }
    }
}
