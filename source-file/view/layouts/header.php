<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="index.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Gentium+Plus&display=swap" rel="stylesheet">
    <script src="index.js" type="application/javascript"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <title>Document</title>
</head>
<body>
<?php
$config = require ('config/config.php');
$content = $config['shareMessage']['message'];
$url = urlencode((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . explode('?', $_SERVER['REQUEST_URI'], 2)[0]);
$title = urlencode($content);

$shareData = [
    'twitter' => [
        'title' => 'Twitter',
        'class' => 'fa fa-twitter',
        'href' => 'https://twitter.com/intent/tweet?text=' . $title . '&url=' . $url,
        'onclick' => 'window.open(this.href, \'Twitter\', \'width=800,height=300,resizable=yes,toolbar=0,status=0\'); return false'
    ],
    'fb' => [
        'title' => 'Facebook',
        'class' => 'fa fa-facebook',
        'href' => 'https://www.facebook.com/sharer/sharer.php?u=' . $url,
        'onclick' => 'window.open(this.href, \'Facebook\', \'width=640,height=436,toolbar=0,status=0\'); return false'
    ],
];
$anchorList = [];
foreach ($shareData as $key => $value) {
    $anchorList[] = '<a class="' . $value['class'] . '" href="' . $value['href'] . '"  onclick="' . $value['onclick'] . '"></a>';
}
$anchors = implode($anchorList);
?>
