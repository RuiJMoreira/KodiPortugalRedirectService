<?php

$html = file_get_contents("https://pt.euronews.com/api/watchlive.json");
preg_match_all(
     "/(euronews.*?hls)/",
    $html,
    $posts, // will contain the article data
    PREG_SET_ORDER // formats data into an array of posts
);

foreach ($posts as $post) {
    $info = $post[1];
$info = str_replace("\/", "/", $info);
$finalinfo = ("http://".$info);
	}
$htmlsec = file_get_contents($finalinfo);
preg_match_all(
     "/(http.*?ewnsabrptpri_por.*?m3u8)/",
    $htmlsec,
    $postssec, // will contain the article data
    PREG_SET_ORDER // formats data into an array of posts
);
	
foreach ($postssec as $postsec) {
    $stream = $postsec[1];
$stream = str_replace("\/", "/", $stream);
	}

header('Location:' .$stream);
exit;

?>