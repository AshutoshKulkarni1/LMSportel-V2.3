<?php

$pageTitle = 'My Tests';

require_once __DIR__ . '/../../includes/session.php';
require_once __DIR__ . '/../../includes/auth.php';
require_once __DIR__ . '/../../includes/helpers.php';
require_once __DIR__ . '/../../includes/icons.php';

startSession();
requireStudent();

$currentPage = 'my-tests';

?><!DOCTYPE html>
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

    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,300,0,0"
    >

    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

<?= iconSprite() ?>

<?php include __DIR__ . '/../../includes/student_header.php'; ?>


<!-- ═════════════════════════════════════════════════════════════
     MY TESTS CONTENT
═════════════════════════════════════════════════════════════ -->

<div class="dashboard-content">

    <div class="dashboard-content-inner">

        <!-- Page Header -->
        <div class="welcome-section">

            <div class="welcome-text">

                <div class="breadcrumb">
                    <a href="dashboard.php">Dashboard</a>
                    <span>/</span>
                    <span>My Tests</span>
                </div>

                <h1 class="welcome-heading">
                    My Tests
                </h1>

                <p class="welcome-subtitle">
                    View all your assigned assessments and their details.
                </p>

            </div>

        </div>


        <!-- ═════════════════════════════════════════════════════
             TEST SUMMARY
        ══════════════════════════════════════════════════════ -->

        <div class="stats-row">

            <!-- Total -->
            <div class="stat-card-gradient stat-card-total">

                <div class="stat-card-icon">
                    <?= icon('doc.text.fill', 24) ?>
                </div>

                <div class="stat-card-value">
                    6
                </div>

                <div class="stat-card-label">
                    Total Tests
                </div>

                <div class="stat-card-desc">
                    All assigned assessments
                </div>

            </div>


            <!-- Completed -->
            <div class="stat-card-gradient stat-card-completed">

                <div class="stat-card-icon">
                    <?= icon('checkmark.circle.fill', 24) ?>
                </div>

                <div class="stat-card-value">
                    3
                </div>

                <div class="stat-card-label">
                    Completed
                </div>

                <div class="stat-card-desc">
                    Evaluated submissions
                </div>

            </div>


            <!-- Pending -->
            <div class="stat-card-gradient stat-card-pending">

                <div class="stat-card-icon">
                    <?= icon('clock.badge.exclamationmark.fill', 24) ?>
                </div>

                <div class="stat-card-value">
                    3
                </div>

                <div class="stat-card-label">
                    Pending
                </div>

                <div class="stat-card-desc">
                    Upcoming or active tests
                </div>

            </div>

        </div>


        <!-- ═════════════════════════════════════════════════════
             TESTS SECTION
        ══════════════════════════════════════════════════════ -->

        <div class="tests-section">

            <div class="tests-section-header">

                <div>

                    <h2 class="tests-section-title">
                        All Tests
                    </h2>

                    <p class="info-card-text">
                        Select a test to view its complete details.
                    </p>

                </div>


                <!-- View Toggle -->

                <div class="tests-view-toggle">

                    <button
                        class="toggle-btn active"
                        data-view="table"
                        onclick="setView('table')"
                    >
                        <?= icon('list', 16) ?>
                        Table View
                    </button>

                    <button
                        class="toggle-btn"
                        data-view="card"
                        onclick="setView('card')"
                    >
                        <?= icon('grid', 16) ?>
                        Card View
                    </button>

                </div>

            </div>


            <!-- ═════════════════════════════════════════════════
                 TABLE VIEW
            ══════════════════════════════════════════════════ -->

            <div
                class="tests-table-view"
                id="tableView"
            >

                <div class="table-wrapper">

                    <table class="data-table">

                        <thead>

                            <tr>

                                <th>
                                    <div class="th-icon">
                                        <?= icon('doc.text.fill', 14) ?>
                                    </div>
                                    Assessment
                                </th>

                                <th>
                                    <div class="th-icon">
                                        <?= icon('timer', 14) ?>
                                    </div>
                                    Duration
                                </th>

                                <th>
                                    <div class="th-icon">
                                        <?= icon('circle.fill', 14) ?>
                                    </div>
                                    Status
                                </th>

                                <th>
                                    <div class="th-icon">
                                        <?= icon('progress.indicator', 14) ?>
                                    </div>
                                    Your Status
                                </th>

                                <th class="actions">
                                    <div class="th-icon">
                                        <?= icon('arrow.right.circle.fill', 14) ?>
                                    </div>
                                    Details
                                </th>

                            </tr>

                        </thead>


                        <tbody>


                            <!-- TEST 1 -->

                            <tr>

                                <td>

                                    <div class="test-name-cell">

                                        <div class="test-icon">
                                            <?= icon('doc.text.fill', 18) ?>
                                        </div>

                                        <div>

                                            <div class="test-name">
                                                Data Structures & Algorithms
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td class="duration-cell">
                                    60 min
                                </td>


                                <td>
                                    <span class="badge badge-info">
                                        Upcoming
                                    </span>
                                </td>


                                <td>
                                    <span class="badge badge-info">
                                        Not Started
                                    </span>
                                </td>


                                <td class="actions">

                                    <a
                                        href="#"
                                        class="btn btn-sm btn-ghost"
                                    >
                                        <?= icon('chevron.right', 14) ?>
                                        View Details
                                    </a>

                                </td>

                            </tr>


                            <!-- TEST 2 -->

                            <tr>

                                <td>

                                    <div class="test-name-cell">

                                        <div class="test-icon">
                                            <?= icon('doc.text.fill', 18) ?>
                                        </div>

                                        <div>

                                            <div class="test-name">
                                                Database Management Systems
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td class="duration-cell">
                                    45 min
                                </td>


                                <td>
                                    <span class="badge badge-active">
                                        Active
                                    </span>
                                </td>


                                <td>
                                    <span class="badge badge-active">
                                        In Progress
                                    </span>
                                </td>


                                <td class="actions">

                                    <a
                                        href="#"
                                        class="btn btn-sm btn-ghost"
                                    >
                                        <?= icon('chevron.right', 14) ?>
                                        View Details
                                    </a>

                                </td>

                            </tr>


                            <!-- TEST 3 -->

                            <tr>

                                <td>

                                    <div class="test-name-cell">

                                        <div class="test-icon">
                                            <?= icon('doc.text.fill', 18) ?>
                                        </div>

                                        <div>

                                            <div class="test-name">
                                                Computer Networks
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td class="duration-cell">
                                    50 min
                                </td>


                                <td>
                                    <span class="badge badge-success">
                                        Completed
                                    </span>
                                </td>


                                <td>
                                    <span class="badge badge-success">
                                        Evaluated
                                    </span>
                                </td>


                                <td class="actions">

                                    <a
                                        href="#"
                                        class="btn btn-sm btn-ghost"
                                    >
                                        <?= icon('chevron.right', 14) ?>
                                        View Details
                                    </a>

                                </td>

                            </tr>


                            <!-- TEST 4 -->

                            <tr>

                                <td>

                                    <div class="test-name-cell">

                                        <div class="test-icon">
                                            <?= icon('doc.text.fill', 18) ?>
                                        </div>

                                        <div>

                                            <div class="test-name">
                                                Machine Learning
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td class="duration-cell">
                                    60 min
                                </td>


                                <td>
                                    <span class="badge badge-success">
                                        Completed
                                    </span>
                                </td>


                                <td>
                                    <span class="badge badge-success">
                                        Evaluated
                                    </span>

                                </td>


                                <td class="actions">

                                    <a
                                        href="#"
                                        class="btn btn-sm btn-ghost"
                                    >
                                        <?= icon('chevron.right', 14) ?>
                                        View Details
                                    </a>

                                </td>

                            </tr>


                            <!-- TEST 5 -->

                            <tr>

                                <td>

                                    <div class="test-name-cell">

                                        <div class="test-icon">
                                            <?= icon('doc.text.fill', 18) ?>
                                        </div>

                                        <div>

                                            <div class="test-name">
                                                Operating Systems
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td class="duration-cell">
                                    45 min
                                </td>


                                <td>
                                    <span class="badge badge-info">
                                        Upcoming
                                    </span>
                                </td>


                                <td>
                                    <span class="badge badge-info">
                                        Not Started
                                    </span>

                                </td>


                                <td class="actions">

                                    <a
                                        href="#"
                                        class="btn btn-sm btn-ghost"
                                    >
                                        <?= icon('chevron.right', 14) ?>
                                        View Details
                                    </a>

                                </td>

                            </tr>


                            <!-- TEST 6 -->

                            <tr>

                                <td>

                                    <div class="test-name-cell">

                                        <div class="test-icon">
                                            <?= icon('doc.text.fill', 18) ?>
                                        </div>

                                        <div>

                                            <div class="test-name">
                                                Computer Organization
                                            </div>

                                        </div>

                                    </div>

                                </td>


                                <td class="duration-cell">
                                    40 min
                                </td>


                                <td>
                                    <span class="badge badge-success">
                                        Completed
                                    </span>
                                </td>


                                <td>
                                    <span class="badge badge-success">
                                        Evaluated
                                    </span>

                                </td>


                                <td class="actions">

                                    <a
                                        href="#"
                                        class="btn btn-sm btn-ghost"
                                    >
                                        <?= icon('chevron.right', 14) ?>
                                        View Details
                                    </a>

                                </td>

                            </tr>


                        </tbody>

                    </table>

                </div>

            </div>


            <!-- ═════════════════════════════════════════════════
                 CARD VIEW
            ══════════════════════════════════════════════════ -->

            <div
                class="tests-card-view hidden"
                id="cardView"
            >

                <div class="card-grid">


                    <!-- Card 1 -->

                    <div class="test-card">

                        <div class="test-card-top">

                            <div class="test-card-icon">
                                <?= icon('doc.text.fill', 24) ?>
                            </div>

                            <span class="badge badge-info">
                                Upcoming
                            </span>

                        </div>


                        <h3 class="test-card-title">
                            Data Structures & Algorithms
                        </h3>


                        <div class="test-card-meta">

                            <span>
                                <?= icon('clock', 13) ?>
                                60 min
                            </span>

                            <span>
                                <?= icon('list', 13) ?>
                                30 Questions
                            </span>

                        </div>


                        <div class="test-card-footer">

                            <span class="badge badge-info">
                                Not Started
                            </span>

                            <a
                                href="#"
                                class="btn btn-sm btn-ghost"
                            >
                                View Details
                                <?= icon('chevron.right', 14) ?>
                            </a>

                        </div>

                    </div>


                    <!-- Card 2 -->

                    <div class="test-card">

                        <div class="test-card-top">

                            <div class="test-card-icon">
                                <?= icon('doc.text.fill', 24) ?>
                            </div>

                            <span class="badge badge-active">
                                Active
                            </span>

                        </div>


                        <h3 class="test-card-title">
                            Database Management Systems
                        </h3>


                        <div class="test-card-meta">

                            <span>
                                <?= icon('clock', 13) ?>
                                45 min
                            </span>

                            <span>
                                <?= icon('list', 13) ?>
                                25 Questions
                            </span>

                        </div>


                        <div class="test-card-footer">

                            <span class="badge badge-active">
                                In Progress
                            </span>

                            <a
                                href="#"
                                class="btn btn-sm btn-ghost"
                            >
                                View Details
                                <?= icon('chevron.right', 14) ?>
                            </a>

                        </div>

                    </div>


                    <!-- Card 3 -->

                    <div class="test-card">

                        <div class="test-card-top">

                            <div class="test-card-icon">
                                <?= icon('doc.text.fill', 24) ?>
                            </div>

                            <span class="badge badge-success">
                                Completed
                            </span>

                        </div>


                        <h3 class="test-card-title">
                            Computer Networks
                        </h3>


                        <div class="test-card-meta">

                            <span>
                                <?= icon('clock', 13) ?>
                                50 min
                            </span>

                            <span>
                                <?= icon('list', 13) ?>
                                30 Questions
                            </span>

                        </div>


                        <div class="test-card-footer">

                            <span class="badge badge-success">
                                84%
                            </span>

                            <a
                                href="#"
                                class="btn btn-sm btn-ghost"
                            >
                                View Details
                                <?= icon('chevron.right', 14) ?>
                            </a>

                        </div>

                    </div>


                    <!-- Card 4 -->

                    <div class="test-card">

                        <div class="test-card-top">

                            <div class="test-card-icon">
                                <?= icon('doc.text.fill', 24) ?>
                            </div>

                            <span class="badge badge-success">
                                Completed
                            </span>

                        </div>


                        <h3 class="test-card-title">
                            Machine Learning
                        </h3>


                        <div class="test-card-meta">

                            <span>
                                <?= icon('clock', 13) ?>
                                60 min
                            </span>

                            <span>
                                <?= icon('list', 13) ?>
                                40 Questions
                            </span>

                        </div>


                        <div class="test-card-footer">

                            <span class="badge badge-success">
                                91%
                            </span>

                            <a
                                href="#"
                                class="btn btn-sm btn-ghost"
                            >
                                View Details
                                <?= icon('chevron.right', 14) ?>
                            </a>

                        </div>

                    </div>


                </div>

            </div>

        </div>


        <!-- ═════════════════════════════════════════════════════
             INFORMATION CARD
        ══════════════════════════════════════════════════════ -->

        <div class="info-card">

            <div class="info-card-icon">
                <?= icon('info', 20) ?>
            </div>

            <div class="info-card-text">

                Select any assessment to view its complete
                information, schedule, submission status,
                grades and analysis.

            </div>

        </div>


    </div>

</div>


<?php include __DIR__ . '/../../includes/student_footer.php'; ?>


<script>

/* ═════════════════════════════════════════════════════════════
   VIEW TOGGLE
═════════════════════════════════════════════════════════════ */

function setView(view) {

    document
        .querySelectorAll('.toggle-btn')
        .forEach(button => {
            button.classList.remove('active');
        });

    const activeButton =
        document.querySelector(
            `.toggle-btn[data-view="${view}"]`
        );

    if (activeButton) {
        activeButton.classList.add('active');
    }


    const tableView =
        document.getElementById('tableView');

    const cardView =
        document.getElementById('cardView');


    if (view === 'table') {

        tableView.classList.remove('hidden');
        cardView.classList.add('hidden');

    } else {

        tableView.classList.add('hidden');
        cardView.classList.remove('hidden');

    }

}


/* ═════════════════════════════════════════════════════════════
   LUCIDE ICONS
═════════════════════════════════════════════════════════════ */

if (typeof lucide !== 'undefined') {
    lucide.createIcons();
}

// Theme switcher
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
(function () {
    const saved = localStorage.getItem('theme');

    if (saved) {
        document.documentElement.setAttribute('data-theme', saved);
        updateThemeUI(saved);
    }
})();

</script>

</body>
</html>