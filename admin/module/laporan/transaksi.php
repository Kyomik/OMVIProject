<?php
if ($_SESSION['akun']['hak_access'] == 1) {
    $id_nota = $_POST['id_nota'];
    $id_transaksi = $_POST['id_transaksi'];

    // Data transaksi
    $data_transaksi = array(
        'id_nota' => $id_nota,
        'id_transaksi' => $id_transaksi,
    );

    // Data items
    $data_items = array();
    for ($i = 0; $i < count($_POST['nama']); $i++) {
        $item = array(
            'tgl' => $_POST['tgl'][$i],
            'unit' => $_POST['unit'][$i],
            'nama' => $_POST['nama'][$i],
            'harga' => $_POST['harga'][$i],
            'jumlah' => $_POST['jumlah'][$i]
            // Atur nilai-nilai lainnya di sini
        );
        $data_items[] = $item;
    }

} else {
    echo "Anda tidak memiliki izin untuk melakukan tindakan ini.";
}

foreach ($data_items as $item) {
    $id_item = $item['id_item'];
    $tgl = $item['tgl'];
    $unit = $item['unit'];
    $nama = $item['nama'];
    $harga = $item['harga'];
    $jumlah = $item['jumlah'];

    // echo "Tanggal: $tgl, Unit: $unit, Nama: $nama, Harga: $harga, Jumlah: $jumlah <br>";

    $sql = "UPDATE item SET 
                tgl = :tgl, 
                unit = :unit, 
                nama = :nama, 
                harga = :harga, 
                jumlah = :jumlah 
            WHERE id_item = :id_item";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':tgl', $tgl);
    $stmt->bindParam(':unit', $unit);
    $stmt->bindParam(':nama', $nama);
    $stmt->bindParam(':harga', $harga);
    $stmt->bindParam(':jumlah', $jumlah);
    $stmt->bindParam(':id_item', $id_item);

    $stmt->execute();

}

foreach ($data_transaksi as $transaksi) {
    $id_transaksi = $transaksi['id_transaksi'];
    $tgl_input = $transaksi['tgl_input'];
    $tgl_priode = $transaksi['tgl_priode'];
    $nama_akun = $transaksi['nama_akun'];
    $total_harga = $transaksi['total_harga'];

    $sql = "UPDATE transaksi SET 
                tgl_input = :tgl_input, 
                tgl_priode = :tgl_priode, 
                nama_akun = :nama_akun, 
                total_harga = :total_harga
            WHERE id_transaksi = :id_transaksi";

    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':tgl_input', $tgl_input);
    $stmt->bindParam(':tgl_priode', $tgl_priode);
    $stmt->bindParam(':nama_akun', $nama_akun);
    $stmt->bindParam(':total_harga', $total_harga);
    $stmt->bindParam(':id_transaksi', $id_transaksi);

    $stmt->execute();
}

?>