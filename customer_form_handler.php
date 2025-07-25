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
    $nama = $_POST['name'];
    $alamat = $_POST['address'];
    $email = $_POST['email'];
    $data_paket = $_POST['service'];

    try {
        // Query untuk menyimpan data
        $sql = "INSERT INTO customer_form (nama, alamat, email, data_paket) 
                VALUES (:nama, :alamat, :email, :data_paket)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':data_paket', $data_paket);

        // Eksekusi query
        if ($stmt->execute()) {
            echo "<script>alert('Data berhasil disimpan'); window.location.href = 'index.html';</script>";
        } else {
            echo "<script>alert('Gagal menyimpan data.');</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>