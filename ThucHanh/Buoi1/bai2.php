<?php
// Đường dẫn tới file câu hỏi
$filename = 'Quiz.txt';
$questions = [];

// HÀM PHÂN TÍCH FILE CẤU TRÚC (PARSER)
function loadQuestions($filepath) {
    if (!file_exists($filepath)) {
        return [];
    }

    $lines = file($filepath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $questions = [];
    $currentQuestion = [
        'id' => 0,
        'text' => '',
        'options' => [],
        'correct_answers' => []
    ];
    $count = 0;

    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line)) continue;

        if (strpos($line, 'ANSWER:') === 0) {
            $ansStr = trim(substr($line, 7));
            $currentQuestion['correct_answers'] = array_map('trim', explode(',', $ansStr));
            $currentQuestion['id'] = ++$count;
            $questions[] = $currentQuestion;
            $currentQuestion = [
                'id' => 0,
                'text' => '',
                'options' => [],
                'correct_answers' => []
            ];
        } elseif (preg_match('/^([A-Z])\.(.*)/', $line, $matches)) {
            $key = $matches[1];
            $content = trim($matches[2]);
            $currentQuestion['options'][$key] = $content;
        } else {
            $currentQuestion['text'] .= ($currentQuestion['text'] === '' ? '' : '<br>') . $line;
        }
    }
    return $questions;
}

$questions = loadQuestions($filename);

$isSubmitted = ($_SERVER['REQUEST_METHOD'] === 'POST');
$userAnswers = $isSubmitted ? ($_POST['q'] ?? []) : [];
$totalScore = 0;
$totalQuestions = count($questions);

if ($isSubmitted) {
    foreach ($questions as $index => $q) {
        $uAns = isset($userAnswers[$index]) ? $userAnswers[$index] : [];
        if (!is_array($uAns)) $uAns = [$uAns];
        $diff1 = array_diff($q['correct_answers'], $uAns);
        $diff2 = array_diff($uAns, $q['correct_answers']);
        if (empty($diff1) && empty($diff2)) {
            $totalScore++;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Thi Trắc Nghiệm Android</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="card shadow-lg mx-auto" style="max-width: 900px;">
        <div class="card-header bg-primary text-white text-center">
            <h2 class="mb-0">📝 Bài Thi Trắc Nghiệm Android</h2>
        </div>
        <div class="card-body">
            <?php if (empty($questions)): ?>
                <div class="alert alert-danger">
                    Không tìm thấy file <strong>Quiz.txt</strong> hoặc file rỗng. Vui lòng tạo file cùng thư mục với script này.
                </div>
            <?php else: ?>
                <?php if ($isSubmitted): ?>
                    <div class="alert alert-success text-center mb-4">
                        <h4 class="mb-2">Kết quả của bạn</h4>
                        <span class="display-5 fw-bold"><?php echo $totalScore; ?> / <?php echo $totalQuestions; ?></span>
                        <p class="mb-2">Số câu trả lời đúng</p>
                        <a href="bai2.php" class="btn btn-primary mt-2">Làm lại bài thi</a>
                    </div>
                <?php endif; ?>
                <form method="POST" action="">
                    <?php foreach ($questions as $index => $q): ?>
                        <?php 
                            $inputType = count($q['correct_answers']) > 1 ? 'checkbox' : 'radio';
                            $inputName = "q[$index]" . ($inputType == 'checkbox' ? '[]' : '');
                            $userSelected = $isSubmitted ? ($userAnswers[$index] ?? []) : [];
                            if (!is_array($userSelected)) $userSelected = [$userSelected];
                            $isCorrect = false;
                            if ($isSubmitted) {
                                $diff1 = array_diff($q['correct_answers'], $userSelected);
                                $diff2 = array_diff($userSelected, $q['correct_answers']);
                                $isCorrect = empty($diff1) && empty($diff2);
                            }
                        ?>
                        <div class="mb-4">
                            <div class="mb-2">
                                <span class="badge bg-secondary">Câu <?php echo $q['id']; ?></span>
                                <span class="fw-bold ms-2"><?php echo $q['text']; ?></span>
                                <?php if ($isSubmitted): ?>
                                    <?php if ($isCorrect): ?>
                                        <span class="badge bg-success ms-2">Đúng</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger ms-2">Sai</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </div>
                            <div class="row">
                            <?php foreach ($q['options'] as $key => $val): ?>
                                <?php 
                                    $checked = in_array($key, $userSelected) ? 'checked' : '';
                                    $optionClass = 'border rounded p-2 mb-2';
                                    if ($isSubmitted) {
                                        $isKeyCorrect = in_array($key, $q['correct_answers']);
                                        $isKeySelected = in_array($key, $userSelected);
                                        if ($isKeyCorrect && $isKeySelected) {
                                            $optionClass .= ' border-success bg-success bg-opacity-10';
                                        } elseif ($isKeySelected && !$isKeyCorrect) {
                                            $optionClass .= ' border-danger bg-danger bg-opacity-10';
                                        } elseif ($isKeyCorrect && !$isKeySelected) {
                                            $optionClass .= ' border-warning bg-warning bg-opacity-10';
                                        }
                                    }
                                ?>
                                <div class="col-12 col-md-6">
                                    <div class="<?php echo $optionClass; ?>">
                                        <div class="form-check">
                                            <input class="form-check-input" type="<?php echo $inputType; ?>" 
                                                name="<?php echo $inputName; ?>" 
                                                value="<?php echo $key; ?>" 
                                                id="q<?php echo $index; ?>_<?php echo $key; ?>"
                                                <?php echo $checked; ?>
                                                <?php echo $isSubmitted ? 'disabled' : ''; ?> 
                                            >
                                            <label class="form-check-label w-100" for="q<?php echo $index; ?>_<?php echo $key; ?>">
                                                <span class="fw-bold"><?php echo $key; ?>.</span> <?php echo $val; ?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                            </div>
                            <?php if ($isSubmitted && !$isCorrect): ?>
                                <div class="mt-2 text-success small fw-bold">
                                    Đáp án đúng: <?php echo implode(', ', $q['correct_answers']); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                    <?php if (!$isSubmitted): ?>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg px-5 shadow">Nộp Bài</button>
                        </div>
                    <?php endif; ?>
                </form>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
