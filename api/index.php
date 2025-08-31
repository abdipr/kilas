<?php
// Ambil data dari API
$api_url = 'http://kilas.vercel.app/api/detik';
$response = file_get_contents($api_url);
$data = json_decode($response, true);

// Cek apakah API berhasil mengambil data
if ($data['status'] == 200) {
    $articles = $data['result'];
} else {
    echo "Gagal mengambil data dari API.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kilas.com</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        body {
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            margin-top: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }
        .card-content {
            padding: 15px;
        }
        .card-title {
            font-size: 18px;
            margin-bottom: 10px;
        }
        .card-meta {
            font-size: 14px;
            color: #777;
            margin-bottom: 10px;
        }
        .card-link {
            display: inline-block;
            text-decoration: none;
            color: #3498db;
            font-size: 14px;
        }
        .card-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <h1>Kilas.com</h1>
    <div class="container">
        <?php foreach ($articles as $article): ?>
        <div class="card">
            <img src="<?= $article['image'] ?>" alt="Image">
            <div class="card-content">
                <div class="card-title"><?= $article['title'] ?></div>
                <div class="card-meta"><?= $article['date_ago'] ?> | <?= $article['date'] ?></div>
                <a href="<?= $article['link'] ?>" class="card-link" target="_blank">Baca Selengkapnya</a>
            </div>
        </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
