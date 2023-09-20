<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EditTimeStamp</title>
</head>

<body>
    <h1>タイムスタンプ編集</h1>
    <form action="" method="post" id="videoDuration">
        <input type="text" value="00:00" readonly>
    </form>


    <?php
    $videoId = $_GET['v'];
    // echo $videoId;
    
    $videoURL = "https://www.youtube.com/embed/" . $videoId;
    ?>
    <iframe id="videoIframe" title="YouTube video Player" width="1280" height="720" type="text/html"
        src="<?php echo $videoURL . "?start=1"; ?>" frameborder="0"></iframe>

    <button id="timeStampButton">タイムスタンプ記入</button>

    <script>

        function setTime() {
            var videoDuration = document.getElementById("videoDuration");
            var videoIframe = document.getElementById("videoIframe");
            var videoTime = videoIframe.src.replace("<?php echo $videoURL . "?start=" ?>", "");
            console.log(videoIframe.src);
            console.log(videoTime);
            console.log(videoDuration[0].value);
        }

        var timeStampButton = document.getElementById("timeStampButton");
        timeStampButton.addEventListener('click', function () {
            alert("test");
        })

    </script>
</body>


</html>