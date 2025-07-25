<?php
// Konfigurasi database
$host = 'localhost';
$dbname = 'qulside';
$username = 'root';
$password = '';

try {
    // Koneksi ke database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}

// Proses form saat data dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id = $_POST['email']; // Disesuaikan dengan kolom "ID" di tabel
    $sandi = $_POST['password']; // Disesuaikan dengan kolom "sandi" di tabel

    try {
        // Query untuk memeriksa ID dan sandi
        $stmt = $pdo->prepare("SELECT * FROM login_operator WHERE ID = :id AND sandi = :sandi");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':sandi', $sandi);
        $stmt->execute();

        // Periksa apakah ada hasil
        if ($stmt->rowCount() > 0) {
            // Login berhasil, alihkan ke data_operator.html
            echo "<script>alert('Login berhasil! Anda akan diarahkan ke halaman Data Operator.'); window.location.href = 'data_op.php';</script>";
        } else {
            // Login gagal
            echo "<script>alert('ID atau sandi salah. Silakan coba lagi.'); window.location.href = 'login.php';</script>";
        }
    } catch (PDOException $e) {
        die("Terjadi kesalahan: " . $e->getMessage());
    }
}
?>
