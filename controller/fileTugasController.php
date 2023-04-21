<?php

namespace Controller {

    use Models\FileTugas;
    use Repository\FileTugasRepository;

    class FileTugasController
    {
        public function __construct(private FileTugasRepository $repository)
        {
        }

        public function uploadFile($tmpnama, $nama, $ukuran, $tipe, $deskripsi)
        {
            $uploadDir = $_SERVER['DOCUMENT_ROOT'] . "/praktikum_5/storage/file_tugas/";
            $path = $uploadDir . $nama;

            $result = move_uploaded_file($tmpnama, $path);

            if ($result) {
                $this->repository->insert(new FileTugas($nama, $ukuran, $tipe, $deskripsi, $path));
                header("location: /praktikum_5/view/fileManagement/mahasiswa.php");
            }
        }

        public function showFile()
        {
            return $this->repository->findAll();
        }

        public function downloadFile(int $id)
        {
            $file = $this->repository->find($id);

            $nama = $file->getNama();
            $ukuran = $file->getUkuran();
            $tipe = $file->getTipe();

            header("Content-Disposition: attachment; filename=$nama");
            header("Content-length: $ukuran");
            header("Content-type: $tipe");

            readfile($file->getPath());
        }
    }
}
