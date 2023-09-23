<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="search.css" type="text/css">
    <title>ポチスタ</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>

<body>
    <?php
    session_start();
    $_SESSION['test'] = "100";
    if (($_SESSION['selectedMode']) == NULL) {
        echo "null<br>";
        $_SESSION['selectedMode'] = "titleName";
    }
    echo var_dump($_SESSION['selectedMode']);
    session_write_close();


    ?>

    <form action="" method="post" id="searchBar">
        <input type="<?php if ($_SESSION['selectedMode'] == "titleName") {
            echo 'text';
        } else {
            echo 'url';
        } ?>" placeholder="検索" name="searchText">
        <input type="submit" value="検索" name="searchSubmit">
        <select name="searchMode" id="searchModeSelect">
            <option value="titleName" <?php if ($_SESSION['selectedMode'] == "titleName")
                echo 'selected' ?>>タイトル検索
                </option>
                <option value="titleURL" <?php if ($_SESSION['selectedMode'] == "titleURL")
                echo 'selected' ?>>URL検索</option>
            </select>
            検索方法
        </form>

        <script>
            var searchModeSelect = document.getElementById("searchModeSelect");
            var searchBar = document.getElementById("searchBar");
            // console.log(searchBar[0].type);

            searchModeSelect.addEventListener("change", function () {//プルダウンの項目が変更されたら実行
                var selectedMode = searchModeSelect.value;
                console.log(selectedMode);

                if (selectedMode == "titleName") {
                    searchBar[0].type = "text";
                } else {
                    searchBar[0].type = "url";
                }
                console.log(searchBar[0].type);

                $.ajax({
                    type: "post",
                    url: "index.php",
                    data: { searchMode: selectedMode },
                    success: function (data, dataType) {
                        console.log(data);
                    }
                })
            })
        </script>
        <?php
            require_once('./vendor/autoload.php');
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
            $dotenv->load();
            define('API_KEY', $_ENV['YOUTUBE_API_KEY']);

            $selectedMode = isset($_POST['searchMode']) ? $_POST['searchMode'] : 'titleName'; // POSTされたselectedModeを取得    
            echo $selectedMode;


            $_SESSION['selectedMode'] = "titleURL";

            //動画検索
            if (!empty($_POST["searchSubmit"])) {
                if ($selectedMode == "titleName") {
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
                            <a href="./editer.php?v=<?php echo $videoId; ?>">
                                <button>この動画のタイムスタンプを作成する</button>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
                    } else { //searchTextがNullかどうか
                        echo "キーワードを入力してください";
                    }
                } else { //ModeがURL
                    if (!empty($_POST["searchText"])) {
                        $videoId = str_replace("https://www.youtube.com/watch?v=", "", $_POST['searchText']);
                        $videoURL = "https://www.youtube.com/embed/" . $videoId;

                        ?>
                <iframe id="videoIframe" title="YouTube video Player" width="1280" height="720" type="text/html"
                    src="<?php echo $videoURL . "?start=1"; ?>" frameborder="0"></iframe><br>
                <a href="./editer.php?v=<?php echo $videoId; ?>">
                    <button>この動画でタイムスタンプを作成する</button>
                </a>
                <?php
                    } else {
                        echo "URLを入力してください<br>";
                    }
                }
            }



            ?>

</body>

</html>