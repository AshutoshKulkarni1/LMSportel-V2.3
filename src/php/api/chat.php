<?php

require_once __DIR__ . '/../includes/auth.php';
startSession();

header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);
$message = trim($input['message'] ?? '');

if (!isStudent()) {
    echo json_encode([
        'success' => false,
        'message' => 'Student session not found.',
        'session' => $_SESSION
    ]);
    exit;
}

$studentId = $_SESSION['student_id'];

$db = getDB();

$stmt = $db->prepare("
    SELECT id, name, email, college_name, branch,
           roll_number, year_of_joining, course_name, batch_id
    FROM students
    WHERE id = ?
");

$stmt->execute([$studentId]);

$student = $stmt->fetch();

if (!$student) {
    echo json_encode([
        'success' => false,
        'message' => 'Student record not found.'
    ]);
    exit;
}

// Get student's test performance
$stmt = $db->prepare("
    SELECT
        s.id AS submission_id,
        s.test_id,
        t.title AS test_title,
        s.status,
        s.evaluation_status,
        s.total_marks_obtained,
        s.total_marks,
        s.auto_score,
        s.manual_score,
        s.total_score,
        s.submitted_at
    FROM submissions s
    JOIN tests t ON t.id = s.test_id
    WHERE s.student_id = ?
    ORDER BY s.submitted_at DESC
");

$stmt->execute([$studentId]);
$submissions = $stmt->fetchAll();


// Get student's PCI performance
$stmt = $db->prepare("
    SELECT
        pr.test_id,
        t.title AS test_title,
        pr.pci_score,
        pr.mcq_score,
        pr.coding_score,
        pr.explanation_score,
        pr.mcq_weight,
        pr.coding_weight,
        pr.explanation_weight,
        pr.generated_at
    FROM pci_records pr
    JOIN tests t ON t.id = pr.test_id
    WHERE pr.student_id = ?
    ORDER BY pr.generated_at DESC
");

$stmt->execute([$studentId]);
$pciRecords = $stmt->fetchAll();


// Send everything to Flask
$pythonPayload = [
    'message' => $message,
    'student' => $student,
    'submissions' => $submissions,
    'pci_records' => $pciRecords
];

$pythonResponse = pythonApiRequest(
    '/api/chat',
    $pythonPayload,
    'POST',
    360
);

$aiMessage = '';
if (!empty($pythonResponse['ok']) && !empty($pythonResponse['data']['message'])) {
    $aiMessage = $pythonResponse['data']['message'];
} elseif (!empty($pythonResponse['data']['error'])) {
    $aiMessage = $pythonResponse['data']['error'];
}

echo json_encode([
    'success' => !empty($pythonResponse['ok']),
    'message' => $aiMessage ?: ($pythonResponse['error'] ?? 'Sorry, the AI service is currently unavailable.'),
    'python_response' => $pythonResponse
]);