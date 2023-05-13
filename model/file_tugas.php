<?php

namespace Models {
    class FileTugas
    {
        public function __construct(
            private string $nama = "",
            private string $ukuran = "",
            private string $tipe = "",
            private string $deskripsi = "",
            private string $path = ""
        ) {
        }

        private int $id;

        public function setId(int $data)
        {
            $this->id = $data;
        }

        public function setNama(string $data)
        {
            $this->nama = $data;
        }

        public function setUkuran(int $data)
        {
            $this->ukuran = $data;
        }

        public function setTipe(string $data)
        {
            $this->tipe = $data;
        }

        public function setDeskripsi(string $data)
        {
            $this->deskripsi = $data;
        }

        public function setPath(string $data)
        {
            $this->path = $data;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getNama()
        {
            return $this->nama;
        }

        public function getUkuran()
        {
            return $this->ukuran;
        }

        public function getTipe()
        {
            return $this->tipe;
        }

        public function getDeskripsi()
        {
            return $this->deskripsi;
        }

        public function getPath()
        {
            return $this->path;
        }
    }
}
