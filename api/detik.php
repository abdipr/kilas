<?php
header("Content-Type: application/json");
require "../simple_html_dom.php";

$pantry_url = "https://getpantry.cloud/apiv1/pantry/fb80de92-bc75-495c-9f7c-52a273ca9061/basket/news-detik";

// Batas waktu cache (dalam detik) - 5 menit
$cache_time = 300;

function fetch_from_pantry($url) {
    $response = file_get_contents($url);
    return json_decode($response, true);
}

function save_to_pantry($url, $data) {
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
    $html = file_get_html(
        "https://news.detik.com/indeks"
    );

    $ret = [];
    foreach ($html->find("div[class='grid-row list-content']") as $e) {
        $t = $e->find("h3[class='media__title']");
        $i = $e->find("div[class='media__image']");
      
        $title[0] = $e->find("h3[class='media__title']")[0]->find("a")[0]->plaintext;
        $date[0] = $e->find("span")[1]->title;
        $ago[0] = $e->find("span")[1]->plaintext;
        $image[0] = $e->find("div[class='media__image']")[0]->find("img")[0]->src;
        $link[0] = $e->find("h3[class='media__title']")[0]->find("a")[0]->href;
        
        $title[1] = $e->find("h3[class='media__title']")[1]->find("a")[0]->plaintext;
        $date[1] = $e->find("span")[3]->title;
        $ago[1] = $e->find("span")[3]->plaintext;
        $image[1] = $e->find("div[class='media__image']")[1]->find("img")[0]->src;
        $link[1] = $e->find("h3[class='media__title']")[1]->find("a")[0]->href;

        $title[2] = $e->find("h3[class='media__title']")[2]->find("a")[0]->plaintext;
        $date[2] = $e->find("span")[5]->title;
        $ago[2] = $e->find("span")[5]->plaintext;
        $image[2] = $e->find("div[class='media__image']")[2]->find("img")[0]->src;
        $link[2] = $e->find("h3[class='media__title']")[2]->find("a")[0]->href;
      
        $title[3] = $e->find("h3[class='media__title']")[3]->find("a")[0]->plaintext;
        $date[3] = $e->find("span")[7]->title;
        $ago[3] = $e->find("span")[7]->plaintext;
        $image[3] = $e->find("div[class='media__image']")[3]->find("img")[0]->src;
        $link[3] = $e->find("h3[class='media__title']")[3]->find("a")[0]->href;
        
        $title[4] = $e->find("h3[class='media__title']")[4]->find("a")[0]->plaintext;
        $date[4] = $e->find("span")[9]->title;
        $ago[4] = $e->find("span")[9]->plaintext;
        $image[4] = $e->find("div[class='media__image']")[4]->find("img")[0]->src;
        $link[4] = $e->find("h3[class='media__title']")[4]->find("a")[0]->href;

        $title[5] = $e->find("h3[class='media__title']")[5]->find("a")[0]->plaintext;
        $date[5] = $e->find("span")[11]->title;
        $ago[5] = $e->find("span")[11]->plaintext;
        $image[5] = $e->find("div[class='media__image']")[5]->find("img")[0]->src;
        $link[5] = $e->find("h3[class='media__title']")[5]->find("a")[0]->href;

        $title[6] = $e->find("h3[class='media__title']")[6]->find("a")[0]->plaintext;
        $date[6] = $e->find("span")[13]->title;
        $ago[6] = $e->find("span")[13]->plaintext;
        $image[6] = $e->find("div[class='media__image']")[6]->find("img")[0]->src;
        $link[6] = $e->find("h3[class='media__title']")[6]->find("a")[0]->href;

        $title[7] = $e->find("h3[class='media__title']")[7]->find("a")[0]->plaintext;
        $date[7] = $e->find("span")[15]->title;
        $ago[7] = $e->find("span")[15]->plaintext;
        $image[7] = $e->find("div[class='media__image']")[7]->find("img")[0]->src;
        $link[7] = $e->find("h3[class='media__title']")[7]->find("a")[0]->href;

        $title[8] = $e->find("h3[class='media__title']")[8]->find("a")[0]->plaintext;
        $date[8] = $e->find("span")[17]->title;
        $ago[8] = $e->find("span")[17]->plaintext;
        $image[8] = $e->find("div[class='media__image']")[8]->find("img")[0]->src;
        $link[8] = $e->find("h3[class='media__title']")[8]->find("a")[0]->href;
      
        $title[9] = $e->find("h3[class='media__title']")[9]->find("a")[0]->plaintext;
        $date[9] = $e->find("span")[19]->title;
        $ago[9] = $e->find("span")[19]->plaintext;
        $image[9] = $e->find("div[class='media__image']")[9]->find("img")[0]->src;
        $link[9] = $e->find("h3[class='media__title']")[9]->find("a")[0]->href;
    $result = [
        "status" => "200",
        "author" => "$author",
        "result" => [[
            "title" => "$title[0]",
            "date" => "$date[0]",
            "date_ago" => "$ago[0]",
            "image" => "$image[0]",
            "link" => "$link[0]",
        ], [
            "title" => "$title[1]",
            "date" => "$date[1]",
            "date_ago" => "$ago[1]",
            "image" => "$image[1]",
            "link" => "$link[1]",
        ], [
            "title" => "$title[2]",
            "date" => "$date[2]",
            "date_ago" => "$ago[2]",
            "image" => "$image[2]",
            "link" => "$link[2]",
        ], [
            "title" => "$title[3]",
            "date" => "$date[3]",
            "date_ago" => "$ago[3]",
            "image" => "$image[3]",
            "link" => "$link[3]",
        ], [
            "title" => "$title[4]",
            "date" => "$date[4]",
            "date_ago" => "$ago[4]",
            "image" => "$image[4]",
            "link" => "$link[4]",
        ], [
            "title" => "$title[5]",
            "date" => "$date[5]",
            "date_ago" => "$ago[5]",
            "image" => "$image[5]",
            "link" => "$link[5]",
        ], [
            "title" => "$title[6]",
            "date" => "$date[6]",
            "date_ago" => "$ago[6]",
            "image" => "$image[6]",
            "link" => "$link[6]",
        ], [
            "title" => "$title[7]",
            "date" => "$date[7]",
            "date_ago" => "$ago[7]",
            "image" => "$image[7]",
            "link" => "$link[7]",
        ], [
            "title" => "$title[8]",
            "date" => "$date[8]",
            "date_ago" => "$ago[8]",
            "image" => "$image[8]",
            "link" => "$link[8]",
        ], [
            "title" => "$title[9]",
            "date" => "$date[9]",
            "date_ago" => "$ago[9]",
            "image" => "$image[9]",
            "link" => "$link[9]",
        ]],
    ];
      $ret[] = $result;
    }

    $result = [
        "status" => "200",
        "author" => $author,
        "result" => $ret,
    ];

    // Simpan data ke Pantry
    $data_to_save = [
        "timestamp" => date("c"),
        "content" => $result,
    ];
    save_to_pantry($pantry_url, $data_to_save);
}

echo str_replace("w=210&q=90", "w=700&q=90", str_replace("\\", "", json_encode($result, JSON_PRETTY_PRINT)));
?>
