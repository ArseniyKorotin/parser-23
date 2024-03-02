<?php

$path = "films";
if (!is_dir($path)) {
    mkdir($path);
}

$str_b = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
    li {
        list-style-type: none;
    }
    
    a {
        text-decoration: none;
    }
    </style>
</head>
<body>';

$str_e = '</body>
</html>';

$h = fopen($path . "/films.html", "w");

$content = "<h1>Kinoafisha</h1>";
$content .= "<ul>";

$json_data = file_get_contents('films.json');
$data = json_decode($json_data, true);

foreach ($data as $film) {
    $content .= "<li><strong>Назва: </strong><a target='_blank' href='{$film['link']}'>{$film['name']}</a></li>";
}
$content .= "</ul>";

fwrite($h, $str_b . "\n");
fwrite($h, $content . "\n");
fwrite($h, $str_e);
fclose($h);