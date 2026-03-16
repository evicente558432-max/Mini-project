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

$conn->query("CREATE TABLE IF NOT EXISTS education(
    id INT AUTO_INCREMENT PRIMARY KEY,
    school_name VARCHAR(255) NOT NULL,
    degree VARCHAR(255) NOT NULL,
    field_of_study VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    description LONGTEXT)");

$conn->query("CREATE TABLE IF NOT EXISTS skills(
    id INT AUTO_INCREMENT PRIMARY KEY,
    skill_name VARCHAR(255) NOT NULL,
    proficiency_level INT NOT NULL,
    category VARCHAR(100) NOT NULL,
    icon VARCHAR(100))");

$conn->query("CREATE TABLE IF NOT EXISTS projects(
    id INT AUTO_INCREMENT PRIMARY KEY,
    project_name VARCHAR(255) NOT NULL,
    description LONGTEXT NOT NULL,
    technologies VARCHAR(255) NOT NULL,
    image_url VARCHAR(255),
    project_url VARCHAR(255))");

$conn->query("CREATE TABLE IF NOT EXISTS contact(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message LONGTEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");

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

  <!-- Home Section -->
  <section id="home" class="text-center py-5" style="background: linear-gradient(135deg, #67b26f, #4ca2cd); color: white;">
    <div class="container">
          <img src="Mar2.jpg" alt="Profile" >
      <h1>Hi, I'm <span style="color: #fff;">Mar</span></h1>
      <p class="lead">IT  Student & Aspiring Developer</p>
      <p>Welcome to my portfolio! I'm passionate about building innovative web applications and solving complex problems through code.</p>
      <div class="d-flex justify-content-center gap-3">
        <?php if($about): ?>
          <a href="<?php echo $about['github_url']; ?>" target="_blank" class="btn btn-dark">GitHub</a>
        <?php endif; ?>
        <a href="about.php" class="btn btn-light">Learn More</a>
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