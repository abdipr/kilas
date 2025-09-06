<?php
header("Content-Type: application/json");
require "/var/task/user/api/simple_html_dom.php";

$pantry_url = "https://getpantry.cloud/apiv1/pantry/fb80de92-bc75-495c-9f7c-52a273ca9061/basket/news-detik";

// Batas waktu cache (2.5 menit)
$cache_time = 150;

function fetch_from_pantry($url)
{
    $response = file_get_contents($url);
    return json_decode($response, true);
}

function save_to_pantry($url, $data)
{
    $options = [
        "http" => [
            "header" => "Content-Type: application/json\r\n",
            "method" => "POST",
            "content" => json_encode($data),
        ],
    ];
    $context = stream_context_create($options);
    file_get_contents($url, false, $context);
}

$data = fetch_from_pantry($pantry_url);
if ($data && (time() - strtotime($data["timestamp"])) < $cache_time) {
    $result = $data["content"];
} else {
    $author = "abdiputranar";
    $html = file_get_html("https://news.detik.com/indeks");

    $ret = [];
    foreach ($html->find("div[class='grid-row list-content']") as $e) {
        $result = [];
        // Loop ambil 10 berita
        for ($i = 0; $i < 20; $i++) {
            $date = $e->find("span")[($i * 2) + 1]->title;
            $date_ago = $e->find("span")[($i * 2) + 1]->plaintext;

            if ($date === $date_ago) {
                $date_ago = "1 detik yang lalu";
            }
            $result[] = [
                "title" => $e->find("h3[class='media__title']")[$i]->find("a")[0]->plaintext,
                "date" => $date,
                "date_ago" => $date_ago,
                "image" => $e->find("div[class='media__image']")[$i]->find("img")[0]->src,
                "link" => $e->find("h3[class='media__title']")[$i]->find("a")[0]->href,
            ];
        }
        $ret[] = $result;
    }

    $result = [
        "status" => "200",
        "author" => $author,
        "result" => $result,
    ];

    // Simpan data ke Pantry
    $data_to_save = [
        "timestamp" => date("c"),
        "content" => $result,
    ];
    save_to_pantry($pantry_url, $data_to_save);
}

echo str_replace("w=210&q=90", "w=300&q=80", str_replace("\\", "", json_encode($result, JSON_PRETTY_PRINT)));
?>