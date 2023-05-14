<?php

namespace Models {
    class Matkul
    {
        public function __construct(
            private string $nama = "",
            private string $namaDosen = ""
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

        public function setNamaDosen(string $data)
        {
            $this->namaDosen = $data;
        }

        public function getId()
        {
            return $this->id;
        }

        public function getNama()
        {
            return $this->nama;
        }

        public function getNamaDosen()
        {
            return $this->namaDosen;
        }
    }
}
