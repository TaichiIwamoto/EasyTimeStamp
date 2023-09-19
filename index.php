<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ポチスタ</title>
</head>

<body>
    <form action="" method="post">
        <input type="text" placeholder="検索" name="searchText">
        <input type="submit" value="検索" name="searchSubmit">
    </form>
    <?php
    require_once('./vendor/autoload.php');
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    define('API_KEY', $_ENV['YOUTUBE_API_KEY']);

    //動画検索
    if (!empty($_POST["searchSubmit"])) {
        if (!empty($_POST["searchText"])) {
            $searchWord = $_POST["searchText"];

            $api_endPoint = 'https://www.googleapis.com/youtube/v3/search';

            $params = array(
                'key' => API_KEY,
                'part' => "snippet",
                'q' => $searchWord,
                'maxResults' => 10,
            );

            $query_string = http_build_query($params);
            // echo $query_string . "<br>";
    
            $response = file_get_contents("$api_endPoint?$query_string");

            $data = json_decode($response);

            // print var_dump($data);
            foreach ($data->items as $item) {
                $videoId = $item->id->videoId;
                $videoURL = "https://www.youtube.com/embed/" . $videoId . "?autoplay=0";

                ?>
                <p>
                    <?php echo $item->snippet->title . "<br>";
                    ?>

                    <iframe title="YouTube video Player" class="youtube-player" type="text/html" width="560" height="345"
                        src="<?php echo $videoURL; ?>" frameborder="0"></iframe><br>
                    <button>この動画のタイムスタンプを作成する</button><br>
                </p>
                <?php

            }
        } else {
            echo "キーワードを入力してください";
        }
    }
    ?>

</body>

</html>