<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css" type="text/css">
    <title>ポチスタ</title>
</head>

<body>
    <form action="" method="post" id="searchBar">
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
                'maxResults' => 5,
            );

            $query_string = http_build_query($params);
            // echo $query_string . "<br>";
    
            try {
                $response = file_get_contents("$api_endPoint?$query_string");
                if ($response == false) {
                    throw new Exception('Failed to fetch data from the URL.');
                }
            } catch (Exception $e) {
                ?>
                <h2 id="error-h1">
                    <?php echo 'クエリ上限に達しました...' . $e->getMessage(); ?>
                </h2>
                <?php
            }

            $data = json_decode($response);
            // print var_dump($data);
            ?>
            <div class="iframe-parent">
                <?php
                foreach ($data->items as $item) {
                    $videoId = $item->id->videoId;
                    $videoURL = "https://www.youtube.com/embed/" . $videoId . "?autoplay=0";

                    ?>
                    <div class="iframe-child">
                        <iframe title="YouTube video Player" class="youtube-player" type="text/html" width="560" height="345"
                            src="<?php echo $videoURL; ?>" frameborder="0"></iframe><br>
                        <?php echo $item->snippet->title . "<br>"; ?>
                        <button>この動画のタイムスタンプを作成する</button><br>
                    </div>

                    <?php
                }
                ?>
            </div>
            <?php
        } else {
            echo "キーワードを入力してください";
        }
    }
    ?>

</body>

</html>