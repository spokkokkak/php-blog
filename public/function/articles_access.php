<?php
session_start();
require_once './src/config/database.php';

function canReadArticle($userId, $plan, $articleId, $conn) {
    if ($plan === 'premium') {
        // Premium plan: Unlimited reading
        return true;
    }

    // Free plan: Limit to 2 articles per day
    $today = date('Y-m-d');

    // Check how many unique articles the user has read today
    $stmt = $conn->prepare("SELECT COUNT(DISTINCT article_id) FROM article_reads WHERE user_id = :user_id AND read_date = :read_date");
    $stmt->bindParam(":user_id", $userId);
    $stmt->bindParam(":read_date", $today);
    $stmt->execute();

    $uniqueReadCount = $stmt->fetchColumn();

    if ($uniqueReadCount < 2) {
        // Allow re-reading the same article without restriction
        return true;
    }

    // Check if the user is trying to re-read the same article today
    $stmt = $conn->prepare("SELECT COUNT(*) FROM article_reads WHERE user_id = :user_id AND article_id = :article_id AND read_date = :read_date");
    $stmt->bindParam(":user_id", $userId);
    $stmt->bindParam(":article_id", $articleId);
    $stmt->bindParam(":read_date", $today);
    $stmt->execute();

    $alreadyRead = $stmt->fetchColumn();

    return $alreadyRead > 0;
}

function logArticleRead($userId, $articleId, $conn) {
    $stmt = $conn->prepare("INSERT INTO article_reads (user_id, article_id, read_date) VALUES (:user_id, :article_id, :read_date)");
    $stmt->bindParam(":user_id", $userId);
    $stmt->bindParam(":article_id", $articleId);
    $stmt->bindValue(":read_date", date('Y-m-d'));
    $stmt->execute();
}

if (!isset($_SESSION['user_id'])) {

    echo "<p style='text-align: center;'> Please log in to view articles. ";
    echo ' | <a href="/">Home</a>';
    echo '</p>';
    exit;
}

$userId = $_SESSION['user_id'];
$plan = $_SESSION['plan']; // Assume user's plan is stored in the session
$articleId = $_GET['article_id']; // Assume article_id is passed as a query parameter

if (canReadArticle($userId, $plan, $articleId, $conn)) {
    // Fetch the article from the database
    $stmt = $conn->prepare("SELECT * FROM articles WHERE id = :article_id");
    $stmt->bindParam(":article_id", $articleId);
    $stmt->execute();
    $article = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($article) {
        logArticleRead($userId, $articleId, $conn);
    } else {
        echo "Article not found.";
    }
} else {
    echo "<p style='text-align: center;'> You have reached your daily article limit for the free plan. ";
    echo ' | <a href="/">Home</a>';
    echo '</p>';
    exit;
}
?>