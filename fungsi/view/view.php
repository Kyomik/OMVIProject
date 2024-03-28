<?php
/*
* PROSES TAMPIL
*/
class view
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function toko()
    {
        $sql = "select*from toko where id_toko='1'";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function jual()
    {
        $sql = "SELECT t.*, COUNT(i.id_item) AS jumlah_item, GROUP_CONCAT(CONCAT(i.id_item, ',', i.nama, ',', i.tgl, ',', i.harga, ',', i.jumlah) SEPARATOR '|') AS all_items, c.nama AS nama_customer, a.nama AS nama_akun
                                FROM transaksi t
                                INNER JOIN item i ON t.id_transaksi = i.id_transaksi
                                INNER JOIN akun a ON t.id_akun = a.id_akun
                                INNER JOIN customer c ON t.id_customer = c.id_customer GROUP BY t.id_transaksi";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function periode_jual($bulan, $tahun, $hari)
    {
        // $bulan = ltrim($bulan, '0');
        try {
            $sql = "SELECT t.*, COUNT(i.id_item) AS jumlah_item, GROUP_CONCAT(CONCAT(i.id_item, ',', i.nama, ',', i.tgl, ',', i.harga, ',', i.jumlah) SEPARATOR '|') AS all_items, c.nama AS nama_customer, a.nama AS nama_akun
                                FROM transaksi t
                                INNER JOIN item i ON t.id_transaksi = i.id_transaksi
                                INNER JOIN akun a ON t.id_akun = a.id_akun
                                INNER JOIN customer c ON t.id_customer = c.id_customer";

            if ((!empty($bulan) || !empty($tahun)) && !empty($hari)) {
                    // Jika pengguna memberikan input bulan atau tahun dan hari
            } else {
                if(!empty($bulan) && !empty($tahun)){
                        $sql .= " WHERE MONTH(t.tgl_input) = $bulan AND YEAR(t.tgl_input) = $tahun";
                    }elseif (!empty($bulan) || !empty($tahun)) {
                        if (!empty($bulan)) {
                            $sql .= " WHERE MONTH(t.tgl_input) = $bulan";
                        }
                        if (!empty($tahun)) {
                            $sql .= " WHERE YEAR(t.tgl_input) = $tahun";
                        }
                    } elseif (!empty($hari)) {
                        $sql .= " WHERE t.tgl_input = $hari";
                    } else {
                        // Tidak ada input bulan, tahun, atau hari
                    }
                }
            $sql .= " GROUP BY t.id_transaksi";

            $row = $this-> db -> prepare($sql);
            $row -> execute();
            $hasil = $row -> fetchAll();
            return $hasil;
        } catch(PDOException $e) {
            echo "Query failed: " . $e->getMessage();
        }
    }

    public function penjualan()
    {
        $sql ="SELECT penjualan.* , barang.id_barang, barang.nama_barang, member.id_member,
                member.nm_member from penjualan 
                left join barang on barang.id_barang=penjualan.id_barang 
                left join member on member.id_member=penjualan.id_member
                ORDER BY id_penjualan";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function jumlah()
    {
        $sql ="SELECT SUM(total) as bayar FROM penjualan";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function jumlah_nota()
    {
        $sql ="SELECT SUM(total) as bayar FROM nota";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function jml()
    {
        $sql ="SELECT SUM(harga_beli*stok) as byr FROM barang";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function getMonthlyTransactionTotals($year) {
        try {
            $monthlyTotals = array();
                for ($i = 1; $i <= 12; $i++) {
                    $query = "SELECT SUM(total_harga) AS total FROM TRANSAKSI WHERE YEAR(tgl_input) = ? AND MONTH(tgl_input) = ?";
                    $statement = $this->db->prepare($query);
                    $statement->execute([$year, $i]);
                    $result = $statement->fetch(PDO::FETCH_ASSOC);
                    $monthlyTotals[] = $result['total'] ? intval($result['total']) : 0;

                    
                }
                return $monthlyTotals;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
            return array(); 
        }
            
    }
}
