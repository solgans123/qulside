<?php
$host = 'localhost'; // or your database server
$user = 'root'; // your database username
$password = ''; // your database password
$database = 'qulside'; // your database name

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Project Management UI with Creative Studio theme">
            <!-- About Section -->
    <section class="has-bg-img py-md my-5 text-center">
        <h6 class="section-title mb-4">Project Management</h6>
        <h6 class="section-subtitle">QulsideCreative</h6>
    </section>
    <!-- Font icons -->
    <link rel="stylesheet" href="assets/vendors/themify-icons/css/themify-icons.css">

    <!-- Bootstrap and Creative Studio main styles -->
    <link rel="stylesheet" href="assets/css/creative-studio.css">
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="40">

    <!-- Main content -->
    <div class="container my-5">
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
            <?php
            // Fetch data from database
            $sql = "SELECT * FROM project_report";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['kode_pemesanan']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['client']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['project_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['payment_status']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['deadline']) . "</td>";
                }
            } else {
                echo "<tr><td colspan='9'>Belum ada data pesanan.</td></tr>";
            }
            ?>
            </table>

        <!-- About Section -->
        <section class="has-bg-img py-md my-5 text-center">
            <h6 class="section-subtitle">Schedule, Report & Inventaris</h6>
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
            <h1>Data Pesanan</h1>
            <table class="table table-bordered mt-5">
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
            <?php
            // Fetch data from database
            $sql = "SELECT * FROM project_schedule";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['kode_pemesanan']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['project_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['start_date']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['deadline']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['progress_status']) . "</td>";
                }
            } else {
                echo "<tr><td colspan='9'>Belum ada data pesanan.</td></tr>";
            }
            ?>
            </table>
        </section>
        <!-- About Section -->
        <section class="has-bg-img py-md my-5 text-center">
            <h6 class="section-subtitle">Schedule, Report & Inventaris</h6>
            <h6 class="section-title mb-4">Qulside Creative</h6>
        </section>

        <!-- Inventaris Form -->
        <section id="data-inventaris">
            <h3 class="text-center text-primary mb-4">Data Inventaris</h3>
            <form action="inventaris.php" method="POST" class="row">
                <!-- Input Name -->
                <div class="form-group col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Atas Nama" required>
                </div>
                
                <!-- Gear Name Selection -->
                <div class="form-group col-md-6">
                    <select name="gear_name" class="form-control" required>
                        <option value="">Pilih Nama Gear</option>
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

                <!-- Start Date -->
                <div class="form-group col-md-6">
                    <input type="date" name="start_date" class="form-control" required>
                </div>

                <!-- Jumlah -->
                <div class="form-group col-md-6">
                    <input type="number" name="jumlah" class="form-control" placeholder="Jumlah" required>
                </div>

                <!-- Action Selection -->
                <div class="form-group col-md-6">
                    <select name="action" class="form-control" required>
                        <option value="add">Insert</option>
                        <option value="edit">Edit</option>
                        <option value="delete">Delete</option>
                    </select>
                </div>

                <!-- Submit Button -->
                <div class="form-group col-md-6">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

                <!-- Notifikasi setelah submit -->
                <div id="notification" class="alert alert-success" style="display: none;">
                    Data berhasil disubmit!
                </div>
            </form>

            <!-- Inventaris Table -->
            <h3 class="mt-5">Data Inventaris</h3>
            <table class="table table-bordered mt-3">
                <thead class="thead-dark">
                    <tr>
                        <th>Nama</th>
                        <th>Nama Gear</th>
                        <th>Tanggal Mulai</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Koneksi database
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "qulside";

                    try {
                        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Ambil data dari tabel inventaris
                        $sql = "SELECT * FROM inventaris";
                        $stmt = $conn->query($sql);

                        if ($stmt->rowCount() > 0) {
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['gear_name']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['start_date']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['jumlah']) . "</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>Belum ada data inventaris.</td></tr>";
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }

                    $conn = null;
                    ?>
                </tbody>
            </table>
        </section>
        <ul class="navbar-nav ml-auto">
        <div class="text-center mt-4">
            <a href="index.html" class="btn btn-primary" style="background: #3282B8; border: none;">Back to Home</a>
        </div>
        </ul>
    </div>
    <!-- Scripts -->
    <script src="assets/vendors/jquery/jquery-3.4.1.min.js"></script>
    <script src="assets/vendors/bootstrap/bootstrap.bundle.min.js"></script>
</body>
</html>