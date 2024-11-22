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

// Pagination
$perPage = 4;  // Menampilkan 4 data per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;  // Halaman yang diminta dari URL
$offset = ($page - 1) * $perPage;  // Menghitung offset untuk query

// Query untuk menghitung jumlah total data
$sqlCount = "SELECT COUNT(*) AS total FROM data_mahasiswa";
$resultCount = $conn->query($sqlCount);
$rowCount = $resultCount->fetch_assoc();
$totalData = $rowCount['total'];  // Total jumlah data
$totalPages = ceil($totalData / $perPage);  // Menghitung total halaman

// Query untuk mengambil data mahasiswa sesuai halaman
$sql = "SELECT * FROM data_mahasiswa LIMIT $perPage OFFSET $offset";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Mahasiswa</title>
    <link rel="stylesheet" href="display.css">
</head>
<body>
    <div class="background">
        <div class="container">
            <h1>Daftar Mahasiswa</h1>
            <?php
            // Menampilkan data mahasiswa dalam tabel
            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Nama</th><th>NIM</th></tr>";
                while ($data = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($data['Nama']) . "</td>";
                    echo "<td>" . htmlspecialchars($data['Nim']) . "</td>";
                    echo "</tr>";
                }
                echo "</table>";
            } else {
                echo "<p>Data tidak ditemukan.</p>";
            }
            ?>
            <!-- Pagination -->
            <div class="pagination">
                <?php
                if ($page > 1) {
                    echo "<a href='display.php?page=" . ($page - 1) . "'>Prev</a> | ";
                } else {
                    echo "Prev | ";
                }
                if ($page < $totalPages) {
                    echo "<a href='display.php?page=" . ($page + 1) . "'>Next</a>";
                } else {
                    echo "Next";
                }
                ?>
            </div>
            <a href="form.php">Kembali ke Form Input Data Mahasiswa</a>
        </div>
    </div>
</body>
</html>

<?php
// Menutup koneksi database
$conn->close();
?>
