<?php

class Produk {
    protected $merek;
    protected $harga;
 
    public function __construct($merek, $harga) {
        if ($harga <= 0) {
            throw new Exception("Harga produk harus lebih besar dari nol.");
        }
        $this->merek = $merek;
        $this->harga = $harga;
    }
 
    public function getInfo() {
        return "Merek: " . $this->merek .
               "<br>Harga: Rp " . number_format($this->harga, 0, ',', '.');
    }
}
 
class Makanan extends Produk {
    private $namaProduk;
    private $tanggalKadaluarsa;
 
    public function __construct($namaProduk, $merek, $harga, $tanggalKadaluarsa) {
        parent::__construct($merek, $harga);
        $this->namaProduk = $namaProduk;
        $this->tanggalKadaluarsa = $tanggalKadaluarsa;
    }
 
    private function cekStatus() {
        $hariIni = date('Y-m-d');
        return (strtotime($this->tanggalKadaluarsa) < strtotime($hariIni))
            ? "Kadaluarsa" : "Segar";
    }
 
    public function getInfo() {
        return "Produk: Makanan - " . $this->namaProduk . "<br>" .
               parent::getInfo() . "<br>" .
               "Tanggal Kadaluarsa: " . $this->tanggalKadaluarsa . "<br>" .
               "Status: " . $this->cekStatus();
    }
}
 
class Elektronik extends Produk {
    private $namaProduk;
    private $garansi;
 
    public function __construct($namaProduk, $merek, $harga, $garansi) {
        parent::__construct($merek, $harga);
        $this->namaProduk = $namaProduk;
        $this->garansi = $garansi;
    }
 
    public function getInfo() {
        return "Produk: Elektronik - " . $this->namaProduk . "<br>" .
               parent::getInfo() . "<br>" .
               "Garansi: " . $this->garansi . " bulan";
    }
}
 
$mieInstan = new Makanan("Mie Instan", "Indomie", 3500, "2025-06-30");
echo $mieInstan->getInfo();
 
echo "<br><br>";
 
$smartTv = new Elektronik("Smart TV", "Samsung", 5000000, 12);
echo $smartTv->getInfo();
?>