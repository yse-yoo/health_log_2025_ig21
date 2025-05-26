<?php
require_once '../../../env.php';
require_once '../../../services/GeminiService.php';
require_once '../../../lib/Database.php';

// JSONレスポンスを設定
header('Content-Type: application/json; charset=utf-8');

// 1. データ取得（最新30件）
$pdo = Database::getInstance();
$sql = "SELECT * FROM health_records ORDER BY recorded_at ASC LIMIT 30";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// 2. AI診断
$service = new GeminiService();
// TODO: AI診断の実行

// 3. レスポンス整形
$output = [
    'status' => $advice !== null ? 'ok' : 'error',
    'advice' => $advice ?? '診断の取得に失敗しました。',
];

echo json_encode($output, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);