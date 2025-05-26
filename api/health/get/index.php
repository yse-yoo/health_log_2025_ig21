<?php
require_once '../../../app.php';

// データベース接続
$pdo = Database::getInstance();
// health_records から最新30件取得
$sql = "SELECT * FROM health_records ORDER BY recorded_at ASC LIMIT 30";
// プリペアドステートメントを作成
$stmt = $pdo->prepare($sql);
// SQLを実行
$stmt->execute();
// 結果を取得
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

// レスポンスヘッダーを設定
header('Content-Type: application/json');
// TODO: JSON形式で出力