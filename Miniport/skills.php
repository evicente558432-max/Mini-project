<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mini_portfolio";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS mini_portfolio";
$conn->query($sql);

// Select the database
$conn->select_db($dbname);

// Create tables if they don't exist

$conn->query("CREATE TABLE IF NOT EXISTS skills(
    id INT AUTO_INCREMENT PRIMARY KEY,
    skill_name VARCHAR(255) NOT NULL,
    proficiency_level INT NOT NULL,
    category VARCHAR(100) NOT NULL,
    icon VARCHAR(100))");


$current_page = basename($_SERVER['PHP_SELF'], '.php');

// Fetch skills data
$result = $conn->query("SELECT * FROM skills ORDER BY category, proficiency_level DESC");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Portfolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">


            <a class="navbar-brand" href="index.php">My Portfolio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'index') ? 'active' : ''; ?>"
                            href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'about') ? 'active' : ''; ?>"
                            href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'skills') ? 'active' : ''; ?>"
                            href="skills.php">Skills</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo ($current_page == 'contact') ? 'active' : ''; ?>"
                            href="contact.php">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Skills Section -->
    <section id="skills" class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">My Skills</h2>

            <div class="row">
                <?php
                $count = 0;
                while ($row = $result->fetch_assoc()) {
                    if ($count > 0 && $count % 3 == 0)
                        echo '</div><div class="row mt-4">';
                    $count++;
                    ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow text-center">
                            <div class="card-body">
                                <h3><?php echo $row['icon']; ?></h3>
                                <h5 class="card-title"><?php echo $row['skill_name']; ?></h5>
                                <p class="card-text"><small class="text-muted"><?php echo $row['category']; ?></small></p>
                                <div class="progress" style="height: 25px;">
                                    <div class="progress-bar" role="progressbar"
                                        style="width: <?php echo $row['proficiency_level']; ?>%"
                                        aria-valuenow="<?php echo $row['proficiency_level']; ?>" aria-valuemin="0"
                                        aria-valuemax="100"><?php echo $row['proficiency_level']; ?>%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center py-3 bg-primary text-white">
        <p>&copy; 2026 My Portfolio. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>