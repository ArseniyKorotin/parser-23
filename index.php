<?php

header("Content-Type: text/html; charset=utf-8");

require 'simplehtmldom/simple_html_dom.php';

// .card__body .card__title

$foxtrot = file_get_html("https://www.foxtrot.com.ua/ru/shop/noutbuki.html");

$links = [];
$names = [];

$card_titles = count($foxtrot->find('.card__body .card__title'));

if (count($foxtrot->find('.card__body .card__title'))) {
    foreach ($foxtrot->find('.card__body .card__title') as $a) {
        $links[] = $a->href;
        $names[] = $a->innertext;
    }
}

// print_r($links);

// print_r($names);
$ul = [];
$ul[] = "<ul>";
for ($i = 0; $i < count($names); $i++) {
    $ul[] = "<li><strong>Назва: </strong><a href='https://www.foxtrot.com.ua{$links[$i]}'>{$names[$i]}</a></li>";
}
$ul[] = "</ul>";
$content = implode("\n", $ul);

$path = "foxtrot";
if (!is_dir($path)) {
    mkdir($path);
}
$str_b = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foxtrot</title>
</head>
<body>';

$str_e = '</body>
</html>';

$h = fopen($path."/foxtrot.html", "w");

fwrite($h, $str_b."\n");
fwrite($h, $content."\n");
fwrite($h, $str_e);
fclose($h);