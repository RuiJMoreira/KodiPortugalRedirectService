<?php
//Token
$url1 = "https://services.iol.pt/matrix?userId=";

$options = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"User-Agent: User-Agent=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36&Referer=https://tviplayer.iol.pt"
  )
);

$context = stream_context_create($options);
$token = file_get_contents($url1, false, $context);

//Link
$url2 = file_get_contents("https://tviplayer.iol.pt/pages/ajax/canaltk.html?canal=TVI");

preg_match_all(
     '/((?<="videoUrl":").*?m3u8)/',

    $url2,
    $posts, // will contain the article data
    PREG_SET_ORDER // formats data into an array of posts
);

foreach ($posts as $post) {
    $link = $post[1];

}

//WMS
$wms = "?wmsAuthSign=";

//SUBST
$link = str_replace("live_tvi", "live_tvi_direct", $link);

//Final
header('Location:' .$link.$wms.$token);
exit;
?>