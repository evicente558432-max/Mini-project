<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mini_portfolio";

// Create connection
$conn = new mysqli($servername, $username, $password);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->select_db($dbname);

$current_page = basename($_SERVER['PHP_SELF'], '.php');

// Get project ID from URL
$project_id = isset($_GET['id']) ? $_GET['id'] : null;
$project = null;

if ($project_id) {
    $result = $conn->query("SELECT * FROM projects WHERE id=$project_id");
    if ($result && $result->num_rows > 0) {
        $project = $result->fetch_assoc();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $project ? htmlspecialchars($project['project_name']) : 'Project'; ?> - My Portfolio</title>
    <link rel="stylesheet" href="style.css">
    
</head>

<body>

    <!-- Navigation -->
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand" href="index.php">My Portfolio</a>
            <ul class="nav-menu">
                <li><a href="index.php"
                        class="nav-link <?php echo ($current_page == 'index') ? 'active' : ''; ?>">Home</a></li>
                <li><a href="about.php"
                        class="nav-link <?php echo ($current_page == 'about') ? 'active' : ''; ?>">About</a></li>
                <li><a href="education.php"
                        class="nav-link <?php echo ($current_page == 'education') ? 'active' : ''; ?>">Education</a></li>
                <li><a href="skills.php"
                        class="nav-link <?php echo ($current_page == 'skills') ? 'active' : ''; ?>">Skills</a></li>
                <li><a href="projects.php"
                        class="nav-link <?php echo ($current_page == 'projects') ? 'active' : ''; ?>">Projects</a></li>
                <li><a href="contact.php"
                        class="nav-link <?php echo ($current_page == 'contact') ? 'active' : ''; ?>">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Project Detail Section -->
    <section id="project-detail">
        <div class="container">
            <?php if ($project): ?>
                <div class="project-detail-container">
                    <!-- Success Message -->
                    <div class="success-message">
                        ✓ Project loaded successfully!
                    </div>

                    <img src="<?php echo htmlspecialchars($project['image_url']); ?>"
                        alt="<?php echo htmlspecialchars($project['project_name']); ?>" class="project-detail-image">

                    <div class="project-detail-content">
                        <h1><?php echo htmlspecialchars($project['project_name']); ?></h1>

                        <div class="project-meta">
                            <div class="meta-item">
                                <span class="meta-label">Created</span>
                                <span
                                    class="meta-value"><?php echo date('M d, Y', strtotime($project['created_at'])); ?></span>
                            </div>
                            <div class="meta-item">
                                <span class="meta-label">Status</span>
                                <span class="meta-value">✓ Active</span>
                            </div>
                        </div>

                        <div class="project-description">
                            <?php echo htmlspecialchars($project['long_description'] ?: $project['description']); ?>
                        </div>

                        <div class="technologies-section">
                            <h3>Technologies Used</h3>
                            <div class="tech-list">
                                <?php
                                $techs = explode(',', $project['technologies']);
                                foreach ($techs as $tech):
                                    ?>
                                    <span class="tech-tag"><?php echo htmlspecialchars(trim($tech)); ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <div class="action-buttons">
                            <a href="<?php echo htmlspecialchars($project['project_url']); ?>" class="btn btn-primary"
                                target="_blank">
                                🌐 View Live Project
                            </a>
                            <a href="<?php echo htmlspecialchars($project['github_url']); ?>" class="btn btn-secondary"
                                target="_blank">
                                🔗 View on GitHub
                            </a>
                            <a href="projects.php" class="btn btn-back">← Back to Projects</a>
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <div class="project-detail-container">
                    <div class="no-project">
                        <h2>Project Not Found</h2>
                        <p>Sorry, the project you're looking for doesn't exist.</p>
                        <a href="index.php" class="btn btn-back">← Back to Projects</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2026 My Portfolio. All rights reserved.</p>
    </footer>

</body>

</html>