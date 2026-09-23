<?php

class Karyawan {
    protected $nama;
    protected $nik;
    protected $gajiPokok;
 
    public function __construct($nama, $nik, $gajiPokok) {
        $this->nama = $nama;
        $this->nik = $nik;
        $this->gajiPokok = $gajiPokok;
    }
 
    public function hitungGaji() {
        return $this->gajiPokok;
    }
 
    public function getInfo() {
        return "Nama: $this->nama, NIK: $this->nik, Gaji Pokok: Rp " .
               number_format($this->gajiPokok, 0, ',', '.');
    }
}
 
class KaryawanTetap extends Karyawan {
    private $tunjangan;
 
    public function __construct($nama, $nik, $gajiPokok, $tunjangan) {
        parent::__construct($nama, $nik, $gajiPokok);
        $this->tunjangan = $tunjangan;
    }
 
    public function hitungGaji() {
        return parent::hitungGaji() + $this->tunjangan;
    }
 
    public function getInfo() {
        return parent::getInfo() .
               ", Tunjangan: Rp " . number_format($this->tunjangan, 0, ',', '.') .
               ", Total Gaji: Rp " . number_format($this->hitungGaji(), 0, ',', '.');
    }
}
 
class KaryawanKontrak extends Karyawan {
    private $insentif;
 
    public function __construct($nama, $nik, $gajiPokok, $insentif) {
        parent::__construct($nama, $nik, $gajiPokok);
        $this->insentif = $insentif;
    }
 
    public function hitungGaji() {
        return parent::hitungGaji() + $this->insentif;
    }
 
    public function getInfo() {
        return parent::getInfo() .
               ", Insentif: Rp " . number_format($this->insentif, 0, ',', '.') .
               ", Total Gaji: Rp " . number_format($this->hitungGaji(), 0, ',', '.');
    }
}
 
echo "== Studi Kasus 1: Inheritance (Karyawan) ==<br>";
$tetap = new KaryawanTetap("Budi", "K001", 5000000, 1500000);
$kontrak = new KaryawanKontrak("Ani", "K002", 4000000, 500000);
echo $tetap->getInfo() . "<br>";
echo $kontrak->getInfo() . "<br><br>";
 
trait Logger {
    public function log($pesan) {
        echo "[LOG] " . $pesan . "<br>";
    }
}
 
class User {
    use Logger;
    private $nama;
    public function __construct($nama) {
        $this->nama = $nama;
        $this->log("User '$nama' berhasil dibuat");
    }
}
 
class Produk {
    use Logger;
    private $nama;
    public function __construct($nama) {
        $this->nama = $nama;
        $this->log("Produk '$nama' ditambahkan ke katalog");
    }
}
 
class Transaksi {
    use Logger;
    private $id;
    public function __construct($id) {
        $this->id = $id;
        $this->log("Transaksi #$id berhasil dicatat");
    }
}
 
echo "== Studi Kasus 2: Trait (Logger) ==<br>";
$user = new User("Awa");
$produk = new Produk("Keyboard Mekanik");
$transaksi = new Transaksi("TRX001");
?>