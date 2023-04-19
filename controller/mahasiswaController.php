<?

namespace Controller {

    use Models\Mahasiswa;
    use Repository\MahasiswaRepository;

    class mahasiswaController
    {
        public function __construct(private MahasiswaRepository $mahasiswaRepo)
        {
        }

        public function createMahasiswa(
            string $nrp,
            string $nama,
            string $jenis_kelamin,
            string $kelas,
            string $jurusan,
            string $email,
            string $alamat,
            string $no_hp,
            string $asal_sma
        ) {
            $this->mahasiswaRepo->insert(new Mahasiswa(
                $nrp,
                $nama,
                $jenis_kelamin,
                $kelas,
                $jurusan,
                $email,
                $alamat,
                $no_hp,
                $asal_sma
            ));
            header("location: ../view/home.php");
        }

        public function deleteMahasiswa(int $id)
        {
            $this->mahasiswaRepo->delete($id);
            header("location: ../view/home.php");
        }

        public function updateMahasiswa(
            string $nrp,
            string $nama,
            string $jenis_kelamin,
            string $kelas,
            string $jurusan,
            string $email,
            string $alamat,
            string $no_hp,
            string $asal_sma,
            $id
        ) {
            $mahasiswa = new Mahasiswa(
                $nrp,
                $nama,
                $jenis_kelamin,
                $kelas,
                $jurusan,
                $email,
                $alamat,
                $no_hp,
                $asal_sma
            );
            $mahasiswa->setId($id);
            $this->mahasiswaRepo->update($mahasiswa);
        }

        public function showMahasiswa($id = "")
        {
            if ($id = "") {
                return $this->mahasiswaRepo->findAll();
            } else {
                return $this->mahasiswaRepo->find($id);
            }
        }
    }
}
