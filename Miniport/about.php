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
$conn->query("CREATE TABLE IF NOT EXISTS about(
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    bio LONGTEXT NOT NULL,
    profile_image VARCHAR(255),
    github_url VARCHAR(255))");
$current_page = basename($_SERVER['PHP_SELF'], '.php');

// Fetch about data
$result = $conn->query("SELECT * FROM about LIMIT 1");
$about = $result->fetch_assoc();
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
          <a class="nav-link <?php echo ($current_page == 'index') ? 'active' : ''; ?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page == 'about') ? 'active' : ''; ?>" href="about.php">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page == 'skills') ? 'active' : ''; ?>" href="skills.php">Skills</a>
        </li>
        <li class="nav-item">
          <a class="nav-link <?php echo ($current_page == 'contact') ? 'active' : ''; ?>" href="contact.php">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

  <!-- About Section -->
  <section id="about" class="py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 text-center">
          <?php if($about): ?>
            <img src="<?php echo $about['profile_image']; ?>" alt="Profile picture" width="250" height="250" class="rounded-circle shadow">
          <?php endif; ?>
        </div>
        <div class="col-md-6">
          <?php if($about): ?>
            <h2><?php echo $about['title']; ?></h2>
            <p><?php echo $about['bio']; ?></p>
          <?php endif; ?>
        </div>
      </div>

      <h3 class="text-center mt-5 mb-4">My Focus Areas</h3>
      <div class="row text-center">
        <div class="col-md-4">
          <div class="card h-100 shadow">
            <div class="card-body">
              <h5 class="card-title">💻 Web Development</h5>
              <p class="card-text">Building responsive and interactive web applications using modern frameworks.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 shadow">
            <div class="card-body">
              <h5 class="card-title">⚙️ Software Engineering</h5>
              <p class="card-text">Creating efficient, scalable solutions to real-world problems.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card h-100 shadow">
            <div class="card-body">
              <h5 class="card-title">🔗 Open Source</h5>
              <p class="card-text">Contributing to open-source projects and learning from the community.</p>
            </div>
          </div>
        </div>
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