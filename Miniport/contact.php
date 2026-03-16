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

// Create tables if they don't exis

$conn->query("CREATE TABLE IF NOT EXISTS contact(
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    message LONGTEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)");

$current_page = basename($_SERVER['PHP_SELF'], '.php');

$success_message = '';
$error_message = '';

if(isset($_POST['add'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];
    
    if($conn->query("INSERT INTO contact VALUES(NULL,'$name','$email','$message',NOW())")){
        $success_message = "Thanks $name! Your message has been sent successfully.";
    } else {
        $error_message = "Error: " . $conn->error;
    }
}
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
<!-- Navigation -->
<nav class="navbar">
  <div class="container">
    <a class="navbar-brand" href="index.php">My Portfolio</a>
    <ul class="nav-menu">
      <li><a href="index.php" class="nav-link <?php echo ($current_page == 'index') ? 'active' : ''; ?>">Home</a></li>
      <li><a href="about.php" class="nav-link <?php echo ($current_page == 'about') ? 'active' : ''; ?>">About</a></li>
      <li><a href="skills.php" class="nav-link <?php echo ($current_page == 'skills') ? 'active' : ''; ?>">Skills</a></li>
      <li><a href="contact.php" class="nav-link <?php echo ($current_page == 'contact') ? 'active' : ''; ?>">Contact</a></li>
    </ul>
  </div>
</nav>

<!-- Contact Section -->
<section class="contact-section">
  <div class="container">
    <h2>Get In Touch</h2>

    <div class="contact-container">
      <!-- Success/Error Messages -->
      <?php if ($success_message): ?>
        <div class="alert alert-success">
          <?php echo $success_message; ?>
          <button class="alert-close" onclick="this.parentElement.style.display='none';">×</button>
        </div>
      <?php endif; ?>

      <?php if ($error_message): ?>
        <div class="alert alert-danger">
          <?php echo $error_message; ?>
          <button class="alert-close" onclick="this.parentElement.style.display='none';">×</button>
        </div>
      <?php endif; ?>

      <!-- Contact Form -->
      <div class="contact-form-card">
        <h3 style="margin-top: 0; color: var(--primary-color); border: none;">Contact Form</h3>
        <form method="POST">
          <div class="form-group">
            <label for="name">Your Name *</label>
            <input type="text" id="name" name="name" required placeholder="Enter your full name">
          </div>

          <div class="form-group">
            <label for="email">Email Address *</label>
            <input type="email" id="email" name="email" required placeholder="your.email@example.com">
          </div>

          <div class="form-group">
            <label for="message">Message *</label>
            <textarea id="message" name="message" rows="5" required placeholder="Write your message here..."></textarea>
          </div>

          <button type="submit" name="add" class="form-submit">Send Message</button>
        </form>
      </div>

      <!-- Contact Info Card -->
      <div class="contact-info">
        <h3>Or Connect With Me</h3>
        <p>You can also reach me on social media and GitHub</p>
        <a href="https://github.com/marcanero024-cpu" class="contact-btn" target="_blank">
          🔗 Visit my GitHub
        </a>
      </div>

      <!-- Messages Display (Optional - Admin View) -->
      <?php if (count($messages) > 0): ?>
        <div class="messages-section">
          <h3>📬 Recent Messages</h3>
          <?php foreach ($messages as $msg): ?>
            <div class="message-item">
              <div class="message-from">📧 <?php echo htmlspecialchars($msg['name']); ?></div>
              <div class="message-email"><?php echo htmlspecialchars($msg['email']); ?></div>
              <div class="message-date">📅 <?php echo date('M d, Y - H:i', strtotime($msg['created_at'])); ?></div>
              <div class="message-text"><?php echo htmlspecialchars($msg['message']); ?></div>
            </div>
          <?php endforeach; ?>
        </div>
      <?php else: ?>
        <div class="messages-section">
          <div class="no-messages">No messages yet. Be the first to contact!</div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- Footer -->
<footer>
  <p>&copy; 2026 My Portfolio. All rights reserved.</p>
</footer>

</body>
</html>