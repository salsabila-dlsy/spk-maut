<?php
include 'koneksi.php';
/*
 * Heri Priady
 * Sample Crud MYSQLi
 * 10/07/2017 23:03
 * priadyheri@gmail.com
 * 082386376942
 * https://www.facebook.com/ciwerartikel
 * Alamat :Desa Kumain, Kec.Tandun, Kab.Rokan Hulu
 * and open the template in the editor.
 */ 
//Start Aksi Anggota
$g=$_GET['sender'];
$nama = $_POST['nama'];
    $sd = $_POST['jml_sd'];
    $smp = $_POST['jml_smp'];
    $sma = $_POST['jml_sma'];
    $usiadini = $_POST['jml_usiadini'];
    $ibuhamil = $_POST['jml_ibuhamil'];
    $lansia = $_POST['jml_lansia'];
    $disabilitas = $_POST['jml_disabilitas'];

if($g=='anggota')
{
    $sql="INSERT INTO dt_penduduk(nama,nik, alamat) VALUES('$_POST[nama]','$_POST[nik]', '$_POST[alamat]')";
    if (mysqli_query($config, $sql)){ 
        $max= mysqli_query($config, "SELECT MAX(id_penduduk) FROM dt_penduduk");
        $nilai = mysqli_fetch_array($max);
        $nilai1=$nilai[0];
        mysqli_query($config, "INSERT INTO hasil(id_penduduk) VALUES('$nilai1')");
        $menu="penduduk";
        header('location:dashboard.php?page='.$menu);
    }
    else{
        echo "Error : ".$sql.". ".mysqli_error($config);
    }
   
}

else 
    if($g=='edit')
    {
        mysqli_query($config,"UPDATE dt_penduduk SET nama='$_POST[nama]',nik='$_POST[nik]', alamat='$_POST[alamat]' WHERE id_penduduk='$_POST[id_penduduk]'");
         echo '<script LANGUAGE="JavaScript">
            alert("Anggota dengan nama :('.$_POST[nama].') Di Update")
            window.location.href="dashboard.php?page=penduduk";
            </script>';
    }
else 
    if($g=='hapus')
    {
        mysqli_query($config,"DELETE FROM dt_penduduk where id_penduduk='$_GET[id_penduduk]'");
         echo '<script LANGUAGE="JavaScript">
            alert("Anggota dengan Id : ('.$_GET[nama].') Terhapus")
            window.location.href="dashboard.php?page=penduduk";
            </script>';
    }

    // INPUT KRITERIA
    else
    if($g=='k_tambah')
    {
        if($_POST['k_bobot']>=1){
            echo "Nilai Bobot Hanya 0 Sampai 1".mysqli_error($config);
        }else{
            $sql="INSERT INTO kriteria(kode_kriteria,k_nama,k_komponen,k_bobot) VALUES('$_POST[kode_kriteria]','$_POST[k_nama]','$_POST[k_komponen]','$_POST[k_bobot]')";   
            if (mysqli_query($config, $sql)){ 
                echo '<script LANGUAGE="JavaScript">
                    alert("Kriteria baru dengan nama :('.$_POST[k_nama].') Di Tambahkan")
                    window.location.href="dashboard.php?page=kriteria";
                    </script>'; 
            }
            else{
                echo "Error : ".$sql.". ".mysqli_error($config);
            }
        }
        
    }
    else 
    if($g=='k_edit')
    {
        $sql="UPDATE kriteria SET k_nama='$_POST[k_nama]', k_komponen='$_POST[k_komponen]', k_bobot  ='$_POST[k_bobot]' WHERE kode_kriteria='$_POST[kode_kriteria]'";
        if(mysqli_query($config,$sql)){
         echo '<script LANGUAGE="JavaScript">
            alert("Kriteria dengan nama :('.$_POST[k_nama].') Di Update")
            window.location.href="dashboard.php?page=kriteria";
            </script>';
        }
    }
    else 
    if($g=='k_hapus')
    {
        mysqli_query($config,"DELETE FROM kriteria WHERE kode_kriteria='$_GET[kode_kriteria]'");
         echo '<script LANGUAGE="JavaScript">
            alert("Kriteria dengan Id : ('.$_GET[kode_kriteria].') Terhapus")
            window.location.href="dashboard.php?page=kriteria";
            </script>';
    }
    else 
    if($g=='b_tambah')
    {
        $kode_kriteria=$_POST['kode_kriteria'];
        $sql="INSERT INTO bobot_nilai(b_nama,n_bobot,kode_kriteria) VALUES('$_POST[b_nama]','$_POST[n_bobot]','$_POST[kode_kriteria]')";
        if (mysqli_query($config, $sql)){ 
            echo '<script LANGUAGE="JavaScript">
                alert("Sub Kriteria Berhasil Ditambahkan")
                window.location.href="dashboard.php?page=subkriteria&act=isi1&kode_kriteria='.$_POST[kode_kriteria].'";
                </script>';
        }
    }
    else 
    if($g=='b_edit')
    {
        $sql="UPDATE bobot_nilai SET b_nama='$_POST[b_nama]', n_bobot  ='$_POST[n_bobot]' WHERE kode_bobot='$_POST[kode_bobot]'";
        if(mysqli_query($config,$sql)){
         echo '<script LANGUAGE="JavaScript">
            alert("Sub Kriteria dengan nama :('.$_POST[b_nama].') Di Update")
            window.location.href="dashboard.php?page=subkriteria&act=isi1&kode_kriteria='.$_POST[kode_kriteria].'";
            </script>';
        }
    }
    else 
    if($g=='b_hapus')
    {
        $sql="DELETE FROM bobot_nilai WHERE kode_bobot='$_GET[kode_bobot]'";
        if (mysqli_query($config, $sql)){ 
            echo '<script LANGUAGE="JavaScript">
                alert("Sub Kriteria Terhapus")
                window.location.href="dashboard.php?page=subkriteria&act=isi1&kode_kriteria='.$_GET[kode_kriteria].'";
                </script>';
        }
    }

    else 
    if($g=='n_edit')
    {
        $edit = mysqli_query($config, "SELECT * FROM bobot_nilai WHERE kode_bobot='$_POST[kode_bobot]'");
        $r = mysqli_fetch_array($edit);
        $nilai = $r[n_bobot];
        $sql="UPDATE penilaian SET kode_bobot='$_POST[kode_bobot]', nilai='$nilai' WHERE id_nilai='$_POST[id_nilai]'";
        if (mysqli_query($config, $sql)){ 
            echo '<script LANGUAGE="JavaScript">
                window.location.href="dashboard.php?page=nilai&act=ubah&id_penduduk='.$_POST[id_penduduk].'";
                </script>';
        }else{
            echo '<script LANGUAGE="JavaScript">
                alert("Gagal Memberi Nilai")
                window.location.href="dashboard.php?page=nilai&act=ubah&id_penduduk='.$_POST[id_penduduk].'";

                </script>';
        }
        
        
    }
//End Aksi Anggota
?>
