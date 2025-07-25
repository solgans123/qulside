<?php
// Konfigurasi database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qulside";

try {
    // Membuat koneksi ke database
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Cek aksi yang diminta dari formulir
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $action = $_POST['action'];

        switch ($action) {
            case 'add':
                // Menyisipkan data ke tabel project_report
                $sql = "INSERT INTO project_report (kode_pemesanan, client, project_name, payment_status, amount, deadline) 
                        VALUES (:kode_pemesanan, :client, :project_name, :payment_status, :amount, :deadline)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':kode_pemesanan', $_POST['kode_pemesanan']);
                $stmt->bindParam(':client', $_POST['client']);
                $stmt->bindParam(':project_name', $_POST['project_name']);
                $stmt->bindParam(':payment_status', $_POST['payment_status']);
                $stmt->bindParam(':amount', $_POST['amount']);
                $stmt->bindParam(':deadline', $_POST['deadline']);
                $stmt->execute();
                echo "Data berhasil disimpan.";
                break;

            case 'edit':
                // Mengedit data di tabel project_report
                $sql = "UPDATE project_report SET client = :client, project_name = :project_name, payment_status = :payment_status, amount = :amount, deadline = :deadline 
                        WHERE kode_pemesanan = :kode_pemesanan";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':kode_pemesanan', $_POST['kode_pemesanan']);
                $stmt->bindParam(':client', $_POST['client']);
                $stmt->bindParam(':project_name', $_POST['project_name']);
                $stmt->bindParam(':payment_status', $_POST['payment_status']);
                $stmt->bindParam(':amount', $_POST['amount']);
                $stmt->bindParam(':deadline', $_POST['deadline']);
                $stmt->execute();
                echo "Data berhasil diperbarui.";
                break;

            case 'delete':
                // Menghapus data dari tabel project_report
                $sql = "DELETE FROM project_report WHERE kode_pemesanan = :kode_pemesanan";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':kode_pemesanan', $_POST['kode_pemesanan']);
                $stmt->execute();
                echo "Data berhasil dihapus.";
                break;

            default:
                echo "Aksi tidak valid.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

$conn = null;
?>
