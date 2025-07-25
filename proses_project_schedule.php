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
                // Menyisipkan data ke tabel project_schedule
                $sql = "INSERT INTO project_schedule (kode_pemesanan, project_name, start_date, deadline, progress_status) 
                        VALUES (:kode_pemesanan, :project_name, :start_date, :deadline, :progress_status)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':kode_pemesanan', $_POST['kode_pemesanan']);
                $stmt->bindParam(':project_name', $_POST['project_name']);
                $stmt->bindParam(':start_date', $_POST['start_date']);
                $stmt->bindParam(':deadline', $_POST['deadline']);
                $stmt->bindParam(':progress_status', $_POST['progress_status']);
                $stmt->execute();
                echo "Data berhasil disimpan ke tabel project_schedule.";
                break;

            case 'edit':
                // Mengedit data di tabel project_schedule
                $sql = "UPDATE project_schedule SET project_name = :project_name, start_date = :start_date, deadline = :deadline, progress_status = :progress_status 
                        WHERE kode_pemesanan = :kode_pemesanan";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':kode_pemesanan', $_POST['kode_pemesanan']);
                $stmt->bindParam(':project_name', $_POST['project_name']);
                $stmt->bindParam(':start_date', $_POST['start_date']);
                $stmt->bindParam(':deadline', $_POST['deadline']);
                $stmt->bindParam(':progress_status', $_POST['progress_status']);
                $stmt->execute();
                echo "Data berhasil diperbarui.";
                break;

            case 'delete':
                // Menghapus data dari tabel project_schedule
                $sql = "DELETE FROM project_schedule WHERE kode_pemesanan = :kode_pemesanan";
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
