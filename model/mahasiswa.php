<?php

namespace Models {

    class Mahasiswa
    {
        public function __construct(
            private string $nrp = "",
            private string $nama = "",
            private string $jenis_kelamin = "",
            private string $kelas = "",
            private string $jurusan = "",
            private string $email = "",
            private string $alamat = "",
            private string $no_hp = "",
            private string $asal_sma = ""
        ) {
        }

        private int $id;

        public function setId(int $data)
        {
            $this->id = $data;
        }
        public function setNrp(string $data)
        {
            $this->nrp = $data;
        }
        public function setNama(string $data)
        {
            $this->nama = $data;
        }
        public function setJenisKelamin(string $data)
        {
            $this->jenis_kelamin = $data;
        }
        public function setKelas(string $data)
        {
            $this->kelas = $data;
        }
        public function setJurusan(string $data)
        {
            $this->jurusan = $data;
        }
        public function setEmail(string $data)
        {
            $this->email = $data;
        }
        public function setAlamat(string $data)
        {
            $this->alamat = $data;
        }
        public function setNoHp(string $data)
        {
            $this->no_hp = $data;
        }
        public function setAsalSMA(string $data)
        {
            $this->asal_sma = $data;
        }

        public function getNrp()
        {
            return $this->nrp;
        }
        public function getNama()
        {
            return $this->nama;
        }
        public function getJenisKelamin()
        {
            return $this->jenis_kelamin;
        }
        public function getKelas()
        {
            return $this->kelas;
        }
        public function getJurusan()
        {
            return $this->jurusan;
        }
        public function getEmail()
        {
            return $this->email;
        }
        public function getAlamat()
        {
            return $this->alamat;
        }
        public function getNoHp()
        {
            return $this->no_hp;
        }
        public function getAsalSMA()
        {
            return $this->asal_sma;
        }
        public function getId()
        {
            return $this->id;
        }
    }
}
