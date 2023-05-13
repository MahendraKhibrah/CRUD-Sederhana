<?php

namespace Models {
    class FileTugas
    {
        public function __construct(
            private string $nama = "",
            private string $deskripsi = "",
            private string $idMatkul = ""
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


        public function setDeskripsi(string $data)
        {
            $this->deskripsi = $data;
        }

        public function setIdMatkul(int $data)
        {
            $this->idMatkul = $data;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getNama()
        {
            return $this->nama;
        }

        public function getDeskripsi()
        {
            return $this->deskripsi;
        }

        public function getIdMatkul()
        {
            return $this->idMatkul;
        }
    }
}
