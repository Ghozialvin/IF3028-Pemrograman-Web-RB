<?php
// Koneksi ke database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mahasiswa";  
// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Variabel untuk status penyimpanan
$status = "";

// Menangani input data mahasiswa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $nim = $_POST['nim'];

    // Query untuk memasukkan data ke database
    $sql = "INSERT INTO data_mahasiswa (nama, nim) VALUES ('$nama', '$nim')";

    if ($conn->query($sql) === TRUE) {
        $status = "success";
    } else {
        $status = "error";
    }
}

// Menutup koneksi database
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Input Data Mahasiswa</title>
    <link rel="stylesheet" href="form.css">
    <script>
        // Fungsi untuk menampilkan alert berdasarkan status
        function showAlert(status) {
            if (status === "success") {
                alert("Data berhasil disimpan.");
            } else if (status === "error") {
                alert("Terjadi kesalahan saat menyimpan data.");
            }
        }
    </script>
</head>
<body onload="showAlert('<?php echo $status; ?>')">
    <div class="background">
        <div class="container">
        <h1>Form Input Data Mahasiswa</h1>
            <form method="POST" action="form.php">
                <div class="form-group">
                    <label for="nama">Nama:</label>
                    <input type="text" name="nama" id="nama" required><br><br>
                    <label for="nim">NIM:</label>
                    <input type="text" name="nim" id="nim" required><br><br>
                    <button type="submit">Submit</button>
                    </div>
            </form>
            <a href="display.php">Tampilkan Data Mahasiswa</a>
        </div>
    </div>
</body>
</html>
