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
        $action = $_POST['action'] ?? '';
        $kode_pemesanan = $_POST['kode_pemesanan'] ?? '';
        $client = $_POST['client'] ?? '';
        $project_name = $_POST['project_name'] ?? '';
        $payment_status = $_POST['payment_status'] ?? '';
        $amount = $_POST['amount'] ?? 0;
        $deadline = $_POST['deadline'] ?? null;
        $start_date = $_POST['start_date'] ?? null;
        $progress_status = $_POST['progress_status'] ?? '';

        // Validasi input
        if (empty($kode_pemesanan)) {
            echo "Error: Kode Pemesanan wajib diisi.";
            exit;
        }

        switch ($action) {
            case 'add':
                if (empty($client) || empty($project_name) || empty($payment_status) || empty($deadline)) {
                    echo "Error: Data yang diperlukan tidak lengkap.";
                    exit;
                }
                // Menyisipkan data ke tabel project_report
                $sql = "INSERT INTO project_report (kode_pemesanan, client, project_name, payment_status, amount, deadline) 
                        VALUES (:kode_pemesanan, :client, :project_name, :payment_status, :amount, :deadline)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':kode_pemesanan', $kode_pemesanan);
                $stmt->bindParam(':client', $client);
                $stmt->bindParam(':project_name', $project_name);
                $stmt->bindParam(':payment_status', $payment_status);
                $stmt->bindParam(':amount', $amount);
                $stmt->bindParam(':deadline', $deadline);
                $stmt->execute();
                echo "Data berhasil disimpan.";
                break;

            case 'edit':
                if (empty($client) || empty($project_name) || empty($payment_status) || empty($deadline)) {
                    echo "Error: Data yang diperlukan tidak lengkap.";
                    exit;
                }
                // Mengedit data di tabel project_report
                $sql = "UPDATE project_report SET client = :client, project_name = :project_name, payment_status = :payment_status, amount = :amount, deadline = :deadline 
                        WHERE kode_pemesanan = :kode_pemesanan";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':kode_pemesanan', $kode_pemesanan);
                $stmt->bindParam(':client', $client);
                $stmt->bindParam(':project_name', $project_name);
                $stmt->bindParam(':payment_status', $payment_status);
                $stmt->bindParam(':amount', $amount);
                $stmt->bindParam(':deadline', $deadline);
                $stmt->execute();
                echo "Data berhasil diperbarui.";
                break;

            case 'delete':
                // Menghapus data dari tabel project_report
                $sql = "DELETE FROM project_report WHERE kode_pemesanan = :kode_pemesanan";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':kode_pemesanan', $kode_pemesanan);
                $stmt->execute();
                echo "Data berhasil dihapus.";
                break;

            default:
                echo "Aksi tidak valid.";
        }
    }
} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    echo "Terjadi kesalahan pada server. Silakan coba lagi nanti.";
}

$conn = null;
?>

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
        $action = $_POST['action'] ?? '';
        $kode_pemesanan = $_POST['kode_pemesanan'] ?? '';
        $project_name = $_POST['project_name'] ?? '';
        $start_date = $_POST['start_date'] ?? null;
        $deadline = $_POST['deadline'] ?? null;
        $progress_status = $_POST['progress_status'] ?? '';

        // Validasi input
        if (empty($kode_pemesanan)) {
            echo "Error: Kode Pemesanan wajib diisi.";
            exit;
        }

        switch ($action) {
            case 'add':
                if (empty($project_name) || empty($start_date) || empty($deadline) || empty($progress_status)) {
                    echo "Error: Data yang diperlukan tidak lengkap.";
                    exit;
                }
                // Menyisipkan data ke tabel project_schedule
                $sql = "INSERT INTO project_schedule (kode_pemesanan, project_name, start_date, deadline, progress_status) 
                        VALUES (:kode_pemesanan, :project_name, :start_date, :deadline, :progress_status)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':kode_pemesanan', $kode_pemesanan);
                $stmt->bindParam(':project_name', $project_name);
                $stmt->bindParam(':start_date', $start_date);
                $stmt->bindParam(':deadline', $deadline);
                $stmt->bindParam(':progress_status', $progress_status);
                $stmt->execute();
                echo "Data berhasil disimpan ke tabel project_schedule.";
                break;

            case 'edit':
                if (empty($project_name) || empty($start_date) || empty($deadline) || empty($progress_status)) {
                    echo "Error: Data yang diperlukan tidak lengkap.";
                    exit;
                }
                // Mengedit data di tabel project_schedule
                $sql = "UPDATE project_schedule SET project_name = :project_name, start_date = :start_date, deadline = :deadline, progress_status = :progress_status 
                        WHERE kode_pemesanan = :kode_pemesanan";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':kode_pemesanan', $kode_pemesanan);
                $stmt->bindParam(':project_name', $project_name);
                $stmt->bindParam(':start_date', $start_date);
                $stmt->bindParam(':deadline', $deadline);
                $stmt->bindParam(':progress_status', $progress_status);
                $stmt->execute();
                echo "Data berhasil diperbarui.";
                break;

            case 'delete':
                // Menghapus data dari tabel project_schedule
                $sql = "DELETE FROM project_schedule WHERE kode_pemesanan = :kode_pemesanan";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':kode_pemesanan', $kode_pemesanan);
                $stmt->execute();
                echo "Data berhasil dihapus.";
                break;

            default:
                echo "Aksi tidak valid.";
        }
    }
} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    echo "Terjadi kesalahan pada server. Silakan coba lagi nanti.";
}

$conn = null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Project Management UI with Creative Studio theme">
    <title>Project Management</title>

    <!-- Font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">

    <!-- Bootstrap and Creative Studio main styles -->
    <link rel="stylesheet" href="assets/css/creative-studio.css">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40">

    <!-- Main content -->
    <div class="container my-5">
        <h2 class="text-center text-primary mb-4">Project Management</h2>

        <!-- Project Report Form -->
        <section id="project-report">
            <h3 class="text-center text-primary mb-4">Input Project Report</h3>
            <form action="proses_project_report.php" method="POST" class="row">
                <div class="form-group col-md-6">
                    <input type="text" name="kode_pemesanan" class="form-control" placeholder="Kode Pemesanan" required>
                </div>
                <div class="form-group col-md-6">
                    <input type="text" name="client" class="form-control" placeholder="Client" required>
                </div>
                <div class="form-group col-md-6">
                    <select name="project_name" class="form-control" required>
                        <option value="company-profile">Company Profile</option>
                        <option value="brand-guideline">Brand Guideline</option>
                        <option value="social-media-design">Social Media Design</option>
                        <option value="photo-production">Photo Production</option>
                        <option value="editing-creative">Editing Creative</option>
                        <option value="video-production">Video Production</option>
                        <option value="social-media-analyst">Social Media Analyst</option>
                        <option value="web-development">Web Development</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <select name="payment_status" class="form-control" required>
                        <option value="">Payment Status</option>
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <input type="number" name="amount" class="form-control" placeholder="Amount" required>
                </div>
                <div class="form-group col-md-6">
                    <input type="date" name="deadline" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <select name="action" class="form-control" required>
                        <option value="add">Insert</option>
                        <option value="edit">Edit</option>
                        <option value="delete">Delete</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
                <!-- Notifikasi setelah submit -->
                <div id="notification" class="alert alert-success" style="display: none;">
                    Data berhasil disubmit!
                </div>                

            </form>

            <!-- Project Report Table -->
            <table class="table table-bordered mt-5">
                <thead class="thead-dark">
                    <tr>
                        <th>Kode Pemesanan</th>
                        <th>Client</th>
                        <th>Project Name</th>
                        <th>Payment Status</th>
                        <th>Amount</th>
                        <th>Deadline</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>PRJ001</td>
                        <td>John Doe</td>
                        <td>Website Redesign</td>
                        <td>Paid</td>
                        <td>$2000</td>
                        <td>2024-12-31</td>
                    </tr>
                    <tr>
                        <td>PRJ002</td>
                        <td>Jane Smith</td>
                        <td>Mobile App Development</td>
                        <td>Unpaid</td>
                        <td>$5000</td>
                        <td>2025-01-15</td>
                    </tr>
                </tbody>
            </table>
        </section>

        <!-- About Section -->
        <section class="has-bg-img py-md my-5 text-center">
            <h6 class="section-subtitle">Schedule & Report</h6>
            <h6 class="section-title mb-4">Qulside Creative</h6>
        </section>

        <!-- Project Schedule Form -->
        <section id="project-schedule">
            <h3 class="text-center text-primary mb-4">Input Project Schedule</h3>
            <form action="proses_project_schedule.php" method="POST" class="row">
                <div class="form-group col-md-6">
                    <input type="text" name="kode_pemesanan" class="form-control" placeholder="Kode Pemesanan" required>
                </div>
                <div class="form-group col-md-6">
                    <select name="project_name" class="form-control" required>
                        <option value="company-profile">Company Profile</option>
                        <option value="brand-guideline">Brand Guideline</option>
                        <option value="social-media-design">Social Media Design</option>
                        <option value="photo-production">Photo Production</option>
                        <option value="editing-creative">Editing Creative</option>
                        <option value="video-production">Video Production</option>
                        <option value="social-media-analyst">Social Media Analyst</option>
                        <option value="web-development">Web Development</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <input type="date" name="start_date" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <input type="date" name="deadline" class="form-control" required>
                </div>
                <div class="form-group col-md-12">
                    <select name="progress_status" class="form-control" required>
                        <option value="">Progress Status</option>
                        <option value="Not Started">Not Started</option>
                        <option value="In Progress">In Progress</option>
                        <option value="Completed">Completed</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <select name="action" class="form-control" required>
                        <option value="add">Insert</option>
                        <option value="edit">Edit</option>
                        <option value="delete">Delete</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
                <!-- Notifikasi setelah submit -->
                <div id="notification" class="alert alert-success" style="display: none;">
                    Data berhasil disubmit!
                </div>                
            </form>

            <!-- Project Schedule Table -->
        <!-- Project Schedule Table -->
        <table class="table table-bordered mt-5" id="project-schedule-table">
            <thead class="thead-dark">
                <tr>
                    <th>Kode Pemesanan</th>
                    <th>Project Name</th>
                    <th>Start Date</th>
                    <th>Deadline</th>
                    <th>Progress Status</th>
                </tr>
            </thead>
            <tbody>
                <!-- Data akan diisi oleh JavaScript -->
            </tbody>
        </table>

        <script>
            // Fungsi untuk mengambil data dari API
            async function fetchProjectSchedule() {
                try {
                    const response = await fetch('get_project_schedule.php');
                    const data = await response.json();

                    // Ambil elemen tbody dari tabel
                    const tableBody = document.querySelector('#project-schedule-table tbody');

                    // Hapus isi tabel lama
                    tableBody.innerHTML = '';

                    // Loop data untuk mengisi tabel
                    data.forEach((item) => {
                        const row = `
                            <tr>
                                <td>${item.kode_pemesanan}</td>
                                <td>${item.project_name}</td>
                                <td>${item.start_date}</td>
                                <td>${item.deadline}</td>
                                <td>${item.progress_status}</td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    });
                } catch (error) {
                    console.error('Error fetching project schedule:', error);
                }
            }

            // Panggil fungsi saat halaman dimuat
            document.addEventListener('DOMContentLoaded', fetchProjectSchedule);
        </script>
        </section>
    </div>
    <ul class="navbar-nav ml-auto">
        <div class="text-center mt-4">
            <a href="index.html" class="btn btn-primary" style="background: #3282B8; border: none;">Back to Home</a>
        </div>
    </ul>
    <!-- Scripts -->
    <script src="assets/vendors/jquery/jquery-3.4.1.min.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>