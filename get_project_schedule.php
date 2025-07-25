<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Report Table</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container my-5">
        <h2 class="text-center text-primary mb-4">Project Report Table</h2>

        <!-- Table to Display Project Report Data -->
        <table class="table table-bordered">
            <thead class="table-dark">
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
                // Konfigurasi database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "qulside";

                try {
                    // Membuat koneksi ke database
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                    // Query untuk mengambil data project_report
                    $sql = "SELECT * FROM project_report";
                    $stmt = $conn->prepare($sql);
                    $stmt->execute();

                    // Fetch semua data sebagai array asosiatif
                    $projectReports = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    // Loop untuk menampilkan setiap baris data
                    foreach ($projectReports as $row) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row['kode_pemesanan']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['client']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['project_name']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['payment_status']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['amount']) . "</td>";
                        echo "<td>" . htmlspecialchars($row['deadline']) . "</td>";
                        echo "</tr>";
                    }
                } catch (PDOException $e) {
                    echo "<tr><td colspan='6' class='text-danger text-center'>Error: " . $e->getMessage() . "</td></tr>";
                }

                // Tutup koneksi
                $conn = null;
                ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
