<?php
require_once 'app.php';
?>

<!DOCTYPE html>
<html lang="ja">

<?php include 'components/head.php'; ?>

<body>
    <!-- カメラ映像 -->
    <video id="webcam" autoplay playsinline
        style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; pointer-events: none;"></video>

    <!-- Pose Detection結果を描画するCanvas -->
    <canvas id="outputCanvas"
        style="position: absolute; left: 0; top: 0; width: 100%; height: 100%; pointer-events: none;"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs-core"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs-converter"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs-backend-webgl"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tensorflow-models/pose-detection"></script>
    <script type="module" src="js/pose.js"></script>
</body>

</html>