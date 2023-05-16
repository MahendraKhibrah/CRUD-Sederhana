<?php

namespace Controller {

    use Models\FileTugass;
    use Models\Matkul;
    use Models\Tugass;
    use Repository\FileTugasRepository;

    class FileTugasController
    {
        public function __construct(private FileTugasRepository $repository)
        {
        }

        // DETAIL TUGAS
        public function uploadFile($tmpnama, $nama, $ukuran, $tipe, $deskripsi, $namaUser, $idTugas)
        {
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/praktikum_5/storage/file_tugas/";
            $path = $uploadDir . $nama;

            $result = move_uploaded_file($tmpnama, $path);

            if ($result) {
                $this->repository->insert(new FileTugass($nama, $ukuran, $tipe, $deskripsi, $path, $namaUser, $idTugas));
                header("location: /praktikum_5/view/fileManagement/materi.php");
            }
        }

        public function showFile(int $id = 0, string $nama = "")
        {
            if ($id == 0) {
                return $this->repository->findAll();
            } else {
                return $this->repository->find($id, $nama);
            }
        }

        public function downloadFile(int $id)
        {
            $file = $this->repository->find(0, "", $id);

            $nama = $file->getNama();
            $ukuran = $file->getUkuran();
            $tipe = $file->getTipe();

            header("Content-Disposition: attachment; filename=$nama");
            header("Content-length: $ukuran");
            header("Content-type: $tipe");

            readfile($file->getPath());
        }

        public function updateNilai($nilai, $id)
        {
            $this->repository->update($nilai, $id);
        }

        // MATKUL
        public function createMatkul(string $matkul, string $username)
        {
            $this->repository->insertMatkul(new Matkul($matkul, $username));
            header("location: ../../view/fileManagement/materi.php");
        }

        public function getMatkul($namaDosen)
        {
            return $this->repository->findMatkul($namaDosen);
        }

        public function getAllMatkul()
        {
            return $this->repository->findMatkul();
        }

        // TUGAS
        public function createTugas(string $nama, string $deskripsi, string $idMatkul, string $namaMatkul)
        {
            $this->repository->insertTugas(new Tugass($nama, $deskripsi, $idMatkul));
            header("location: ../../view/fileManagement/tugas.php?b=" . $idMatkul . "&a=" . $namaMatkul);
        }

        public function getTugas(int $id = 0, int $idTugas = 0)
        {
            if ($idTugas != 0) {
                return $this->repository->findTugas(0, $idTugas);
            }
            return $this->repository->findTugas($id, 0);
        }
    }
}
