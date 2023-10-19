<?php
    session_start();

    //membuat koneksi ke database
    $conn = mysqli_connect("localhost","root","","dbtoko");


    //menambah barang baru
    if(isset($_POST["addnewbarang"])){
        $namabarang = $_POST['namabarang'];
        $merk = $_POST['merk'];
        $deskripsi = $_POST['deskripsi'];
        $stock = $_POST['stock'];

        $addtotable = mysqli_query($conn, "INSERT INTO stock (namabarang, merk, deskripsi, stock) VALUES ('$namabarang','$merk','$deskripsi','$stock')");
        if($addtotable){
            header("location:stock.php");
        } else {
            echo 'Gagal';
            header('location:stock.php');
        }
    };


    //menambah barang masuk
    if(isset($_POST['barangmasuk'])){
        $barangnya = $_POST['barangnya'];
        $penerima = $_POST['penerima'];
        $qty = $_POST['qty'];
        $suppliernya = $_POST['suppliernya'];

        $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barangnya'");
        $ambildatanya = mysqli_fetch_array($cekstocksekarang);

        $ceksuppliersekarang = mysqli_query($conn, "SELECT * FROM supplier WHERE idsupplier='$suppliernya'");
        $ambilsuppliernya = mysqli_fetch_array($ceksuppliersekarang);

        $stocksekarang = $ambildatanya['stock'];
        $tambahkanstocksekarangdenganquantity = $stocksekarang + $qty;

        $addtomasuk = mysqli_query($conn, "INSERT INTO masuk (idbarang, penerima, qty, idsupplier) VALUES ('$barangnya','$penerima', '$qty', '$suppliernya')");
        $updatestockmasuk = mysqli_query($conn, "UPDATE stock SET stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");
        if($addtomasuk&&$updatestockmasuk){
            header("location:masuk.php");
        } else {
            echo 'Gagal';
            header('location:masuk.php');
        }
    }

    //menambah barang keluar
    if(isset($_POST['barangkeluar'])){
        //kalau barangnya cukup
        $barangnya = $_POST['barangnya'];
        $keterangan = $_POST['keterangan'];
        $qty = $_POST['qty'];

        $cekstocksekarang = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$barangnya'");
        $ambildatanya = mysqli_fetch_array($cekstocksekarang);

        $stocksekarang = $ambildatanya['stock'];

        if($stocksekarang >= $qty){
            $tambahkanstocksekarangdenganquantity = $stocksekarang-$qty;

        $addtokeluar = mysqli_query($conn, "INSERT INTO keluar (idbarang, keterangan, qty) VALUES ('$barangnya','$keterangan', '$qty')");
        $updatestockmasuk = mysqli_query($conn, "UPDATE stock SET stock='$tambahkanstocksekarangdenganquantity' WHERE idbarang='$barangnya'");
        if($addtokeluar&&$updatestockmasuk){
            header('location:keluar.php');
        } else {
            echo 'Gagal';
            header('location:keluar.php');
        }
        } else {
        //kalau barangnya kurang
        echo '
        <script>
            alert("Stock Kurang");
            window.location.href="keluar.php";
        </script>
        ';
        }
    }

    // update Barang
    if(isset($_POST['updatebarang'])){
        $idb = $_POST['idb'];
        $namabarang = $_POST['namabarang'];
        $merk = $_POST['merk'];
        $deskripsi = $_POST['deskripsi'];

        $update = mysqli_query($conn, "UPDATE stock SET namabarang='$namabarang', merk ='$merk', deskripsi='$deskripsi' WHERE idbarang = '$idb'");
        if($update){
            header('location:stock.php');
        } else {
            echo 'Gagal';
            header('location:stock.php');
        }
    }

    // menghapus barang dari stock
    if(isset($_POST['hapusbarang'])){
        $idb = $_POST['idb'];

        $hapus = mysqli_query($conn, "DELETE FROM stock WHERE idbarang = '$idb'");
        if($hapus){
            header("location:stock.php");
        } else {
            echo "Gagal";
            header("location:stock.php");
        }
        
    };

    // mengubah data barang masuk
    if(isset($_POST['updatebarangmasuk'])){
        $idb = $_POST['idb'];
        $idm = $_POST['idm'];
        $ids = $_POST['ids'];
        $deskripsi = $_POST['penerima'];
        $suppliernya = $_POST['suppliernya'];
        $qty = $_POST['qty'];

        $lihatstock = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$idb'");
        $stocknya = mysqli_fetch_array($lihatstock);
        $stockskrg = $stocknya['stock'];

        $qtyskrg = mysqli_query($conn, "SELECT * FROM masuk WHERE idmasuk='$idm'");
        $qtynya = mysqli_fetch_array($qtyskrg);
        $qtyskrg = $qtynya ['qty'];

        // $ceksuppliersekarang = mysqli_query($conn, "SELECT * FROM supplier WHERE idsupplier='$suppliernya'");
        // $ambilsuppliernya = mysqli_fetch_array($ceksuppliersekarang);

        $lihatsupplier = mysqli_query($conn,"SELECT * FROM supplier WHERE idsupplier='$ids'");
        $supplierbarunya = mysqli_fetch_array($lihatsupplier);
        $supplierskrg = $supplierbarunya['supplier'];

        if($qty>$qtyskrg){
            $selisih = $qty - $qtyskrg;
            $kurangin = $stockskrg + $selisih;
            $kurangistocknya = mysqli_query($conn, "UPDATE stock SET stock='$kurangin' WHERE idbarang='$idb'");
            $updatenya = mysqli_query($conn,"UPDATE masuk SET qty='$qty', penerima='$deskripsi', suppliernya='$suppliernya' WHERE idmasuk='$idm'");
                if($kurangistocknya&&$updatenya){
                header('location:masuk.php');
                } else {
                    echo 'Gagal';
                    header('location:masuk.php');
                }
        } else {
                $selisih = $qtyskrg - $qty;
                $kurangin = $stockskrg - $selisih;
                $kurangistocknya = mysqli_query($conn, "UPDATE stock SET stock='$kurangin' WHERE idbarang='$idb'");
                $updatenya = mysqli_query($conn, "UPDATE masuk SET qty='$qty', penerima='$deskripsi', suppliernya='$suppliernya' WHERE idmasuk='$idm'");
                    if($kurangistocknya&&$updatenya){
                        header('location:masuk.php');
                    } else {
                        echo 'Gagal';
                        header('location:masuk.php');
                }
        }
    }


    // Menghapus barang masuk
    if(isset($_POST['hapusbarangmasuk'])){
        $idb = $_POST['idb'];
        $qty = $_POST['kty'];
        $idm = $_POST['idm'];

        $getdatastock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$id'");
        $data = mysqli_fetch_array($getdatastock);
        $stok = $data['stock'];

        $selisih = $stok - $qty;

        $update = mysqli_query($conn, "UPDATE stock SET stock='$selisih' WHERE idbarang='$idb'");
        $hapusdata = mysqli_query($conn, "DELETE FROM masuk WHERE idmasuk='$idm'");

        if($update&&$hapusdata){
            header('location:masuk.php');
        } else {
            header('location:masuk.php');
        }
    }

    // mengubah data barang keluar
    if(isset($_POST['updatebarangkeluar'])){
        $idb = $_POST['idb'];
        $idk = $_POST['idk'];
        $keterangan = $_POST['keterangan'];
        $qty = $_POST['qty'];

        $lihatstock = mysqli_query($conn,"SELECT * FROM stock WHERE idbarang='$idb'");
        $stocknya = mysqli_fetch_array($lihatstock);
        $stockskrg = $stocknya['stock'];

        $qtyskrg = mysqli_query($conn, "SELECT * FROM keluar WHERE idkeluar='$idk'");
        $qtynya = mysqli_fetch_array($qtyskrg);
        $qtyskrg = $qtynya ['qty'];

        if($qty>$qtyskrg){
            $selisih = $qty - $qtyskrg;
            $kurangin = $stockskrg - $selisih;
            $kurangistocknya = mysqli_query($conn, "UPDATE stock SET stock='$kurangin' WHERE idbarang='$idb'");
            $updatenya = mysqli_query($conn,"UPDATE keluar SET qty='$qty', keterangan='$keterangan' WHERE idkeluar='$idk'");
                if($kurangistocknya&&$updatenya){
                header('location:keluar.php');
                } else {
                    echo 'Gagal';
                    header('location:keluar.php');
                }
        } else {
                $selisih = $qtyskrg - $qty;
                $kurangin = $stockskrg + $selisih;
                $kurangistocknya = mysqli_query($conn, "UPDATE stock SET stock='$kurangin' WHERE idbarang='$idb'");
                $updatenya = mysqli_query($conn, "UPDATE keluar SET qty='$qty', keterangan='$keterangan' WHERE idkeluar='$idk'");
                    if($kurangistocknya&&$updatenya){
                        header('location:keluar.php');
                    } else {
                        echo 'Gagal';
                        header('location:keluar.php');
                }
        }
    }


    // Menghapus barang keluar
    if(isset($_POST['hapusbarangkeluar'])){
        $idb = $_POST['idb'];
        $qty = $_POST['kty'];
        $idk = $_POST['idk'];

        $getdatastock = mysqli_query($conn, "SELECT * FROM stock WHERE idbarang='$id'");
        $data = mysqli_fetch_array($getdatastock);
        $stok = $data['stock'];

        $selisih = $stok + $qty;

        $update = mysqli_query($conn, "UPDATE stock SET stock='$selisih' WHERE idbarang='$idb'");
        $hapusdata = mysqli_query($conn, "DELETE FROM keluar WHERE idkeluar='$idk'");

        if($update&&$hapusdata){
            header('location:keluar.php');
        } else {
            header('location:keluar.php');
        }
    }

    // menambah admin baru
    if(isset($_POST['addadmin'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $queryinsert = mysqli_query($conn, "INSERT INTO login (email,password) VALUES ('$email','$password')");

        if($queryinsert) {
            // if berhasil
            header('Location:admin.php');

        } else {
            // kalau gagal insert ke db
            header('Location:admin.php');
        }
    }

    // edit data admin
    if(isset($_POST['updateadmin'])) {
        $emailbaru = $_POST['emailadmin'];
        $passwordbaru = $_POST['passwordbaru'];
        $idnya = $_POST['id'];

        $queryupdate = mysqli_query($conn, "UPDATE login SET email='$emailbaru', password='$passwordbaru' WHERE iduser='$idnya'");

        if($queryupdate){
            header('Location:admin.php');
        
        } else {
            header('Location:admin.php');    
        
        }
    }

    // hapus admin
    if(isset($_POST['hapusadmin'])) {
        $id = $_POST['id'];

        $querydelete = mysqli_query($conn, "DELETE FROM login WHERE iduser='$id'");
    
        if($querydelete){
            header('Location:admin.php');
        
        } else {
            header('Location:admin.php');    
        
        }
    }

    //menambah supplier baru
    if(isset($_POST["addnewsupplier"])){
        $namasupplier = $_POST['namasupplier'];
        $alamat = $_POST['alamat'];
        $notelpon = $_POST['notelpon'];
       
        $addtosupplier = mysqli_query($conn, "INSERT INTO supplier (namasupplier, alamat, notelpon) VALUES ('$namasupplier','$alamat','$notelpon')");
        if($addtotable){
            header("location:supplier.php");
        } else {
            echo 'Gagal';
            header('location:supplier.php');
        }
    }

    // edit data supplier
    if(isset($_POST['updatesupplier'])){
        $ids = $_POST['ids'];
        $namasupplier = $_POST['namasupplier'];
        $alamat = $_POST['alamat'];
        $notelpon = $_POST['notelpon'];

        $update = mysqli_query($conn, "UPDATE supplier SET namasupplier='$namasupplier', alamat ='$alamat', notelpon='$notelpon' WHERE idsupplier = '$ids'");
        if($update){
            header('location:supplier.php');
        } else {
            echo 'Gagal';
            header('location:supplier.php');
        }
    }

    // menghapus supplier
    if(isset($_POST['hapussupplier'])){
        $ids = $_POST['ids'];

        $hapus = mysqli_query($conn, "DELETE FROM supplier WHERE idsupplier = '$ids'");
        if($hapus){
            header("location:supplier.php");
        } else {
            echo "Gagal";
            header("location:supplier.php");
        }
        
    }

?>