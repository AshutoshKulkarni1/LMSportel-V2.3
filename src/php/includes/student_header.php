<?php
/**
 * Student Dashboard Header & Sidebar Include
 *
 * Shared layout for all student pages:
 * dashboard, results, analytics, profile
 *
 * Required globals/variables:
 *   $firstName     - Student first name
 *   $student       - Student data array
 *   $currentPage   - Current page name
 */

if (!isset($currentPage)) {
    $currentPage = basename($_SERVER['PHP_SELF'], '.php');
}

/*
 * Map page file names to navigation items
 */
$pageToNavMap = [
    'dashboard' => 'dashboard',
    'results'   => 'results',
    'analytics' => 'analytics',
    'profile'   => 'profile',
    'test'      => 'dashboard',
];

$currentNav = $pageToNavMap[$currentPage] ?? $currentPage;
?>

<div class="dashboard-layout" id="app">

    <!-- =========================================
         MOBILE SIDEBAR OVERLAY
    ========================================== -->
    <div
        class="sidebar-overlay"
        id="sidebarOverlay"
        onclick="toggleSidebar()"
    ></div>


    <!-- =========================================
         LEFT SIDEBAR
    ========================================== -->
    <aside class="dashboard-sidebar" id="sidebar">

        <!-- Logo -->
        <a
            href="dashboard.php"
            class="sidebar-logo"
            style="text-decoration: none;"
        >

            <?php if (!empty($student['college_logo'])): ?>

                <div
                    class="sidebar-logo-icon"
                    style="background: rgba(255,255,255,0.05); padding: 4px;"
                >

                    <img
                        src="<?= h($student['college_logo']) ?>"
                        alt="<?= h($student['college_name']) ?>"
                        style="
                            width: 36px;
                            height: 36px;
                            object-fit: contain;
                            border-radius: 8px;
                        "
                        onerror="
                            this.style.display='none';
                            this.nextElementSibling.style.display='flex';
                        "
                    >

                    <div
                        class="sidebar-logo-icon-fallback"
                        style="display: none;"
                    >
                        <svg
                            viewBox="0 0 20 20"
                            fill="currentColor"
                        >
                            <path d="M10 2.5a.5.5 0 0 1 .28-.46l7-3.5a.5.5 0 0 1 .44 0l7 3.5a.5.5 0 0 1 .28.46v12a.5.5 0 0 1-1 0V3.2l-6.5 3.25V15.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-13z"/>
                        </svg>
                    </div>

                </div>

            <?php else: ?>

                <div class="sidebar-logo-icon">

                    <svg
                        viewBox="0 0 20 20"
                        fill="currentColor"
                    >
                        <path d="M10 2.5a.5.5 0 0 1 .28-.46l7-3.5a.5.5 0 0 1 .44 0l7 3.5a.5.5 0 0 1 .28.46v12a.5.5 0 0 1-1 0V3.2l-6.5 3.25V15.5a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-13z"/>
                    </svg>

                </div>

            <?php endif; ?>

            <span class="sidebar-logo-text">
                <?= h($student['college_name'] ?? 'Test Platform') ?>
            </span>

        </a>


        <!-- =========================================
             PRIMARY NAVIGATION
        ========================================== -->
        <nav class="sidebar-nav">

            <div class="sidebar-nav-group">

                <!-- Dashboard -->
                <a
                    href="dashboard.php"
                    class="sidebar-nav-item <?= $currentNav === 'dashboard' ? 'active' : '' ?>"
                >
                    <?= icon('dashboard', 20) ?>
                    <span>Dashboard</span>
                </a>


                <!-- My Tests -->
                <a
                    href="dashboard.php"
                    class="sidebar-nav-item"
                >
                    <?= icon('test', 20) ?>
                    <span>My Tests</span>
                </a>


                <!-- Results -->
                <a
                    href="results.php"
                    class="sidebar-nav-item <?= $currentNav === 'results' ? 'active' : '' ?>"
                >
                    <?= icon('chart', 20) ?>
                    <span>Results</span>
                </a>


                <!-- Analytics -->
                <a
                    href="analytics.php"
                    class="sidebar-nav-item <?= $currentNav === 'analytics' ? 'active' : '' ?>"
                >
                    <?= icon('graph', 20) ?>
                    <span>Analytics</span>
                </a>


                <!-- Profile -->
                <a
                    href="profile.php"
                    class="sidebar-nav-item <?= $currentNav === 'profile' ? 'active' : '' ?>"
                >
                    <?= icon('student', 20) ?>
                    <span>Profile</span>
                </a>

            </div>


            <!-- =========================================
                 THEME SWITCHER
            ========================================== -->
            <div class="sidebar-nav-group">

                <div class="sidebar-nav-label">
                    Appearance
                </div>

                <button
                    class="sidebar-nav-item theme-toggle"
                    onclick="toggleTheme()"
                    id="themeToggle"
                    type="button"
                >
                    <span class="material-symbols-outlined theme-icon">
                        dark_mode
                    </span>

                    <span id="themeLabel">
                        Dark Mode
                    </span>
                </button>

            </div>


            <!-- =========================================
                 SIGN OUT
            ========================================== -->
            <div
                class="sidebar-nav-group"
                style="margin-top: auto;"
            >

                <a
                    href="<?= BASE_URL ?>/logout.php"
                    class="sidebar-nav-item"
                >
                    <?= icon('logout', 20) ?>
                    <span>Sign Out</span>
                </a>

            </div>

        </nav>


        <!-- =========================================
             PROFILE FOOTER
        ========================================== -->
        <div class="sidebar-profile">

            <div class="sidebar-profile-avatar">

                <?= strtoupper($firstName[0] ?? '?') ?>

                <span class="online-dot"></span>

            </div>

            <div class="sidebar-profile-info">

                <div class="sidebar-profile-name">
                    <?= h($firstName ?? 'Student') ?>
                </div>

                <div class="sidebar-profile-role">
                    Student
                </div>

            </div>

        </div>

    </aside>


    <!-- =========================================
         MAIN CONTENT AREA
    ========================================== -->
    <div class="dashboard-main">


        <!-- =========================================
             TOP NAVIGATION
        ========================================== -->
        <header class="dashboard-topnav">

            <div class="topnav-left">

                <!-- Mobile hamburger -->
                <button
                    class="topnav-hamburger"
                    onclick="toggleSidebar()"
                    aria-label="Toggle sidebar"
                    type="button"
                >
                    <?= icon('menu', 20) ?>
                </button>

                <div class="topnav-brand">
                    Student Portal
                </div>

            </div>


            <div class="topnav-right">

                <!-- Theme button -->
                <button
                    class="topnav-icon-btn"
                    onclick="toggleTheme()"
                    data-tooltip="Toggle theme"
                    type="button"
                >
                    <span class="material-symbols-outlined theme-icon">
                        dark_mode
                    </span>
                </button>


                <!-- Profile -->
                <div class="topnav-profile">

                    <div class="topnav-avatar">

                        <?= strtoupper($firstName[0] ?? '?') ?>

                        <span class="online-dot"></span>

                    </div>

                    <div class="topnav-profile-info">

                        <div class="topnav-profile-name">
                            <?= h($firstName ?? 'Student') ?>
                        </div>

                        <div class="topnav-profile-role">
                            Student
                        </div>

                    </div>

                </div>

            </div>

        </header>


        <!-- =========================================
             AI STUDY ASSISTANT
        ========================================== -->
        <div class="chatbot-container">

            <!-- Floating AI button -->
            <button
                class="chatbot-toggle"
                id="chatbotToggle"
                type="button"
                aria-label="Open AI Assistant"
            >
                <span class="material-symbols-outlined">
                    smart_toy
                </span>
            </button>


            <!-- =====================================
                 CHAT WINDOW
            ====================================== -->
            <div
                class="chatbot-window"
                id="chatbotWindow"
                role="dialog"
                aria-label="AI Study Assistant"
            >

                <!-- Chat Header -->
                <div class="chatbot-header">

                    <div class="chatbot-header-info">

                        <div class="chatbot-avatar">

                            <span class="material-symbols-outlined">
                                smart_toy
                            </span>

                        </div>

                        <div>

                            <div class="chatbot-title">
                                AI Study Assistant
                            </div>

                            <div class="chatbot-status">
                                Academic help
                            </div>

                        </div>

                    </div>


                    <!-- Close -->
                    <button
                        class="chatbot-close"
                        id="chatbotClose"
                        type="button"
                        aria-label="Close AI Assistant"
                    >
                        <span class="material-symbols-outlined">
                            close
                        </span>
                    </button>

                </div>


                <!-- =====================================
                     MESSAGES
                ====================================== -->
                <div
                    class="chatbot-messages"
                    id="chatbotMessages"
                >

                    <div class="chatbot-message bot">
                        Hey! 👋 I'm your AI Study Assistant.
                        Ask me about your performance, PCI,
                        weaknesses, or what you should study next.
                    </div>

                </div>


                <!-- =====================================
                     QUICK ACTIONS
                ====================================== -->
                <div class="chatbot-actions">

                    <button
                        class="chatbot-action"
                        type="button"
                        data-message="Explain my weaknesses"
                    >
                        My Weaknesses
                    </button>


                    <button
                        class="chatbot-action"
                        type="button"
                        data-message="Explain my PCI"
                    >
                        What is my PCI?
                    </button>


                    <button
                        class="chatbot-action"
                        type="button"
                        data-message="What should I study?"
                    >
                        What should I study?
                    </button>


                    <button
                        class="chatbot-action"
                        type="button"
                        data-message="Generate my report"
                    >
                        Generate My Report
                    </button>

                </div>


                <!-- =====================================
                     INPUT AREA
                ====================================== -->
                <div class="chatbot-input-area">

                    <input
                        type="text"
                        id="chatbotInput"
                        class="chatbot-input"
                        placeholder="Ask me anything..."
                        maxlength="2000"
                        autocomplete="off"
                        aria-label="Ask the AI Study Assistant"
                    >


                    <button
                        class="chatbot-send"
                        id="chatbotSend"
                        type="button"
                        aria-label="Send message"
                    >

                        <span class="material-symbols-outlined">
                            send
                        </span>

                    </button>

                </div>

            </div>

        </div>


        <!-- =========================================
             MAIN PAGE CONTENT
        ========================================== -->
        <main class="dashboard-content">

            <div class="dashboard-content-inner">