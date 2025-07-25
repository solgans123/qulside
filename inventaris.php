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
                // Menyisipkan data ke tabel inventaris
                $sql = "INSERT INTO inventaris (name, gear_name, start_date, jumlah) 
                        VALUES (:name, :gear_name, :start_date, :jumlah)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':name', $_POST['name']);
                $stmt->bindParam(':gear_name', $_POST['gear_name']);
                $stmt->bindParam(':start_date', $_POST['start_date']);
                $stmt->bindParam(':jumlah', $_POST['jumlah']);
                $stmt->execute();
                echo "Data berhasil disimpan ke tabel inventaris.";
                break;

            case 'edit':
                // Mengedit data di tabel inventaris
                $sql = "UPDATE inventaris SET gear_name = :gear_name, start_date = :start_date, jumlah = :jumlah 
                        WHERE name = :name";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':name', $_POST['name']);
                $stmt->bindParam(':gear_name', $_POST['gear_name']);
                $stmt->bindParam(':start_date', $_POST['start_date']);
                $stmt->bindParam(':jumlah', $_POST['jumlah']);
                $stmt->execute();
                echo "Data berhasil diperbarui di tabel inventaris.";
                break;

            case 'delete':
                // Menghapus data dari tabel inventaris
                $sql = "DELETE FROM inventaris WHERE name = :name";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':name', $_POST['name']);
                $stmt->execute();
                echo "Data berhasil dihapus dari tabel inventaris.";
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
