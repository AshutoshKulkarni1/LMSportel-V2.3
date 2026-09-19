<?php

$pageTitle = 'Test Analysis';

require_once __DIR__ . '/../../includes/session.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../../includes/icons.php';

startSession();
requireStudent();

$pdo = getDB();
$studentId = $_SESSION['student_id'];

// Get student info
$stmt = $pdo->prepare("
    SELECT s.*,
           b.name AS batch_name,
           c.name AS course_name,
           cl.name AS college_name,
           cl.logo AS college_logo
    FROM students s
    JOIN batches b ON b.id = s.batch_id
    JOIN courses c ON c.id = b.course_id
    JOIN colleges cl ON cl.id = c.college_id
    WHERE s.id = ?
");

$stmt->execute([$studentId]);
$student = $stmt->fetch();

// Get tests
$tests = getStudentTests($studentId);

// Statistics
$totalTests = count($tests);

$completedTests = count(array_filter(
    $tests,
    fn($t) => $t['submission_status'] === 'evaluated'
));

$pendingTests = count(array_filter(
    $tests,
    fn($t) =>
        $t['submission_status'] === 'in_progress' ||
        ($t['status'] === 'active' && !$t['submission_status'])
));

$inProgressTests = count(array_filter(
    $tests,
    fn($t) => $t['submission_status'] === 'in_progress'
));

$notStartedTests = count(array_filter(
    $tests,
    fn($t) =>
        empty($t['submission_status']) &&
        $t['status'] !== 'completed'
));

$totalQuestions = array_sum(array_map(
    fn($t) => (int)($t['total_questions'] ?? 0),
    $tests
));

$completionRate = $totalTests > 0
    ? round(($completedTests / $totalTests) * 100)
    : 0;

$currentPage = 'test-analysis';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= h($pageTitle) ?> | Test Platform</title>

    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/student.css">
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/chatbot.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet"
    >

    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

<?= iconSprite() ?>

<?php include __DIR__ . '/../../includes/student_header.php'; ?>

<main class="student-main">

    <div class="welcome-section">

        <div class="welcome-text">

            <h1 class="welcome-heading">
                Test Analysis
            </h1>

            <p class="welcome-subtitle">
                Detailed overview of your assessments
            </p>

        </div>

    </div>


    <!-- Analysis Summary -->

    <div class="stats-row">

        <div class="stat-card-gradient stat-card-total">

            <div class="stat-card-icon">
                <?= icon('doc.text.fill', 24) ?>
            </div>

            <div class="stat-card-value">
                <?= $totalTests ?>
            </div>

            <div class="stat-card-label">
                Total Tests
            </div>

        </div>


        <div class="stat-card-gradient">

            <div class="stat-card-icon">
                <?= icon('checkmark.circle.fill', 24) ?>
            </div>

            <div class="stat-card-value">
                <?= $completedTests ?>
            </div>

            <div class="stat-card-label">
                Completed
            </div>

        </div>


        <div class="stat-card-gradient">

            <div class="stat-card-icon">
                <?= icon('clock.fill', 24) ?>
            </div>

            <div class="stat-card-value">
                <?= $inProgressTests ?>
            </div>

            <div class="stat-card-label">
                In Progress
            </div>

        </div>

    </div>


    <!-- Detailed Statistics -->

    <div style="margin-top: 30px;">

        <h2>Assessment Overview</h2>

        <div style="margin-top: 20px;">

            <p>
                <strong>Pending / Active:</strong>
                <?= $pendingTests ?>
            </p>

            <p>
                <strong>Not Started:</strong>
                <?= $notStartedTests ?>
            </p>

            <p>
                <strong>Total Questions:</strong>
                <?= $totalQuestions ?>
            </p>

            <p>
                <strong>Completion Rate:</strong>
                <?= $completionRate ?>%
            </p>

        </div>

    </div>

</main>
<?php include __DIR__ . '/../../includes/student_footer.php'; ?>

<script>
function toggleTheme() {
    const html = document.documentElement;

    const isDark = html.getAttribute('data-theme') === 'dark';
    const newTheme = isDark ? 'light' : 'dark';

    html.setAttribute('data-theme', newTheme);

    localStorage.setItem('theme', newTheme);

    updateThemeUI(newTheme);
}

function updateThemeUI(theme) {

    const label = document.getElementById('themeLabel');

    if (label) {
        label.textContent =
            theme === 'dark' ? 'Light Mode' : 'Dark Mode';
    }

    document.querySelectorAll('.theme-icon').forEach(el => {
        el.textContent =
            theme === 'dark' ? 'light_mode' : 'dark_mode';
    });
}


// Restore saved theme
(function() {

    const saved = localStorage.getItem('theme');

    if (saved) {
        document.documentElement.setAttribute('data-theme', saved);
        updateThemeUI(saved);
    }

})();


// Initialize Lucide icons
lucide.createIcons();
</script>

</body>
</html>
