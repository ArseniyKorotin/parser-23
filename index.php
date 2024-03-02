<?php

header("Content-Type: text/html; charset=utf-8");

require 'simplehtmldom/simple_html_dom.php';

$films = file_get_html("https://kinoafisha.ua/ua/kinoafisha/");

$links = [];
$names = [];

$card_titles = $films->find('.afisha-page > .content > .content__left-column > .movie__list > .movie__block > .movie__details > .movie__title');

if (count($card_titles)) {
    foreach ($card_titles as $a) {
        $links[] = $a->href;
        $names[] = $a->plaintext;
    }
}

$data = array();

for ($i = 0; $i < count($links); $i++) {
    $film = array(
        'name' => $names[$i],
        'link' => "https://kinoafisha.ua/ua/kinoafisha/{$links[$i]}"
    );
    $data[] = $film;
}

$json_data = json_encode($data, JSON_UNESCAPED_UNICODE);

file_put_contents('films.json', $json_data);