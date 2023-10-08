<?php

session_start();
//membuat koneksi ke database
$conn = mysqli_connect("localhost","root","","dbtoko");

//menambah barang baru
if(isset($_POST["addnewbarang"])){
    $namabarang = $_POST["namabarang"];
    $deskripsi = $_POST["deskripsi"];
    $stock = $_POST["stock"];

    $addtotable = mysqli_query($conn, "INSERT INTO stock (namabarang, deskripsi, stock) VALUES ('$namabarang','$deskripsi','$stock')");
    if($addtotable){
        header("location:index.php");
    } else {
        echo "Gagal";
        header("location:index.php");
    }
}

//menambah barang masuk
if(isset($_POST['barangmasuk'])){
    $barangnya = $_POST['barangnya'];
    $qty = $_POST['qty'];
    $penerima = $_POST['penerima'];

    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $tambahkanstocksekarangdenganquantity = $stocksekarang+$qty;

    $addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, qty, penerima) VALUES ('$barangnya','$qty', '$penerima')");
    $updatestockmasuk = mysqli_query($conn, "UPDATE stock SET stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");
    if($addtomasuk&&$updatestockmasuk){
        header("location:masuk.php");
    } else {
        echo "Gagal";
        header("location:masuk.php");
    }
}

//menambah barang keluar
if(isset($_POST['barangkeluar'])){
    $barangnya = $_POST['barangnya'];
    $qty = $_POST['qty'];
    $keterangan = $_POST['keterangan'];

    $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barangnya'");
    $ambildatanya = mysqli_fetch_array($cekstocksekarang);

    $stocksekarang = $ambildatanya['stock'];
    $kurangkanstocksekarangdenganquantity = $stocksekarang-$qty;

    $addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang, qty, keterangan) VALUES ('$barangnya','$qty', '$keterangan')");
    $updatestockkeluar = mysqli_query($conn, "UPDATE stock SET stock='$kurangkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");
    if($addtokeluar&&$updatestockkeluar){
        header("location:keluar.php");
    } else {
        echo "Gagal";
        header("location:keluar.php");
    }
}

//update info barang
if(isset($_POST['updatebarang'])){
    $idb = $_POST['idb'];
    $namabarang = $_POST['namabarang'];
    $deskripsi = $_POST['deskripsi'];

    $update = mysqli_query($conn, "UPDATE stock set namabarang='$namabarang','deskripsi='$deskripsi' WHERE idbarang ='$idb'");
    if($update){
        header("location:index.php");
    } else {
        echo "Gagal";
        header("location:index.php");
    }
}

?>