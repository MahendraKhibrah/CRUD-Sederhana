<?php

namespace Repository {

    use Models\Mahasiswa;
    use PDO;

    class MahasiswaRepository
    {
        public function __construct(private PDO $koneksi)
        {
        }

        public function insert(Mahasiswa $mahasiswa)
        {
            $query = "INSERT INTO mahasiswa(nama, nrp, jenis_kelamin, kelas, jurusan, email, alamat, no_hp, asal_sma) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $data = $this->koneksi->prepare($query);
            $data->execute([
                $mahasiswa->getNama(),
                $mahasiswa->getNrp(),
                $mahasiswa->getJenisKelamin(),
                $mahasiswa->getKelas(),
                $mahasiswa->getJurusan(),
                $mahasiswa->getEmail(),
                $mahasiswa->getAlamat(),
                $mahasiswa->getNoHp(),
                $mahasiswa->getAsalSMA()
            ]);
        }

        public function delete(int $id)
        {
            $query = "DELETE FROM mahasiswa WHERE id='$id'";
            $data = $this->koneksi->prepare($query);
            $data->execute();
        }

        public function update(Mahasiswa $mahasiswa)
        {
            $query = "UPDATE mahasiswa SET nrp='?', nama='?', jenis_kelamin='?', kelas='?', jurusan='?', email='?', alamat='?', no_hp='?', asal_sma='?' WHERE id='?'";
            $data = $this->koneksi->prepare($query);
            $data->execute([
                $mahasiswa->getNrp(),
                $mahasiswa->getNama(),
                $mahasiswa->getJenisKelamin(), $mahasiswa->getKelas(), $mahasiswa->getJurusan(),
                $mahasiswa->getEmail(), $mahasiswa->getAlamat(), $mahasiswa->getNoHp(),
                $mahasiswa->getAsalSMA(), $mahasiswa->getId()
            ]);
        }

        public function findAll()
        {
            $result = [];

            $sql = "SELECT * FROM mahasiswa";
            $statement = $this->koneksi->prepare($sql);
            $statement->execute();

            foreach ($statement as $row) {
                $mahasiswa = new Mahasiswa(
                    $row["nrp"],
                    $row["nama"],
                    $row["jenis_kelamin"],
                    $row["kelas"],
                    $row["jurusan"],
                    $row["wmail"],
                    $row["alamat"],
                    $row["no_hp"],
                    $row["asal_sma"]
                );
                $mahasiswa->setId($row["id"]);

                array_push($result, $mahasiswa);
            }

            return $result;
        }

        public function find(int $id)
        {
            $sql = "SELECT * FROM mahasiswa WHERE id = ?";
            $statement = $this->koneksi->prepare($sql);
            $statement->execute([$id]);

            if ($row = $statement->fetch()) {
                $mahasiswa = new Mahasiswa(
                    $row["nrp"],
                    $row["nama"],
                    $row["jenis_kelamin"],
                    $row["kelas"],
                    $row["jurusan"],
                    $row["wmail"],
                    $row["alamat"],
                    $row["no_hp"],
                    $row["asal_sma"]
                );
                $mahasiswa->setId($row["id"]);

                return [true, $mahasiswa];
            } else {
                return [false];
            }
        }
    }
}
