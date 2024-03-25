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

    public function member()
    {
        $sql = "select member.*, login.*
                from member inner join login on member.id_member = login.id_member";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function member_edit($id)
    {
        $sql = "select member.*, login.*
                from member inner join login on member.id_member = login.id_member
                where member.id_member= ?";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($id));
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function toko()
    {
        $sql = "select*from toko where id_toko='1'";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function kategori()
    {
        $sql = "select*from kategori";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function barang()
    {
        $sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
                from barang inner join kategori on barang.id_kategori = kategori.id_kategori 
                ORDER BY id DESC";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function barang_stok()
    {
        $sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
                from barang inner join kategori on barang.id_kategori = kategori.id_kategori 
                where stok <= 3 
                ORDER BY id DESC";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function barang_edit($id)
    {
        $sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
                from barang inner join kategori on barang.id_kategori = kategori.id_kategori
                where id_barang=?";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($id));
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function barang_cari($cari)
    {
        $sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori
                from barang inner join kategori on barang.id_kategori = kategori.id_kategori
                where id_barang like '%$cari%' or nama_barang like '%$cari%' or merk like '%$cari%'";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function barang_id()
    {
        $sql = 'SELECT * FROM barang ORDER BY id DESC';
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();

        $urut = substr($hasil['id_barang'], 2, 3);
        $tambah = (int) $urut + 1;
        if (strlen($tambah) == 1) {
            $format = 'BR00'.$tambah.'';
        } elseif (strlen($tambah) == 2) {
            $format = 'BR0'.$tambah.'';
        } else {
            $ex = explode('BR', $hasil['id_barang']);
            $no = (int) $ex[1] + 1;
            $format = 'BR'.$no.'';
        }
        return $format;
    }

    public function kategori_edit($id)
    {
        $sql = "select*from kategori where id_kategori=?";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($id));
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function kategori_row()
    {
        $sql = "select*from kategori";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> rowCount();
        return $hasil;
    }

    public function transaksi_row()
    {
        $sql = "select*from transaksi";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> rowCount();
        return $hasil;
    }

    public function transaksi_stok_row()
    {
        $sql ="SELECT SUM(stok) as transaksi FROM transaksi";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function barang_beli_row()
    {
        $sql ="SELECT SUM(harga_beli) as beli FROM barang";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function jual_row()
    {
        $sql ="SELECT SUM(jumlah) as stok FROM nota";
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
        $bulan = ltrim($bulan, '0');
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
}
