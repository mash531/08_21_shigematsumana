<!-- 入力画面 -->
<!DOCTYPE html>
<html lang="ja">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <style>
        a1 {
            display: flex;
        }

        header {
            padding: 10px;
            font-size: 16px;
        }
    </style>
</head>


<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">Chat</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">入力</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="select.php">Chat履歴</a>
                    </li> -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- <form method="post" action="insert.php"> -->
    <!-- <div class="form-group">
            <label for="name">name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
        </div> -->

    <!-- 名前選択 -->
    <form method="post" action="insert.php">
        <div class="form-group">
            <label for="name">name</label>
            <div class="select">
                <select name="name">
                    <option value="ふっちー">ふっちー</option>
                    <option value="みやもん">みやもん</option>
                    <option value="CK">CK</option>
                    <option value="みっすー">みっすー</option>
                    <option value="しみー">しみー</option>
                    <option value="まっつん">まっつん</option>
                    <option value="ポケマス">ポケマス</option>
                    <option value="まささん">まささん</option>
                    <option value="おきまり">おきまり</option>
                    <option value="みなと">みなと</option>
                    <option value="さっちゃん">さっちゃん</option>
                    <option value="りゅうちぇる">りゅうちぇる</option>
                    <option value="しょうちゃん">しょうちゃん</option>
                    <option value="まなてぃ">まなてぃ</option>
                    <option value="ごってぃ">ごってぃ</option>
            </div>
            <?php // optionタグを出力
            echo $name_data; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="message">message</label>
            <textarea class="form-control" id="message" name="message" rows="3"></textarea>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary" id="submit">Submit</button>
        </div>
    </form>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
         $('#submit').on('click', function(
            var selectname = $('.select').val();
            if (selectname == まなてぃ) {
                alert('まなてぃ');
            }
        )); -->
    <!-- </script> -->
    <!-- チャット一覧 -->
    <?php
    include('functions.php');
    $pdo = connectToDb();

    //データ表示SQL作成
    $sql = 'SELECT * FROM message ORDER BY time DESC';
    $stmt = $pdo->prepare($sql);
    $status = $stmt->execute();

    //データ表示
    $view = '';
    if ($status == false) {
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit('sqlError:' . $error[2]);
    } else {
        //Selectデータの数だけ自動でループしてくれる
        //http://php.net/manual/ja/pdostatement.fetch.php
        while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $view .= '<li class="list-group-item">';
            $view .= '<p>' . $result['time'] . $result['name'] . '-' . $result['message'] . '</p>';
            $view .= '<a href="detail.php?id=' . $result['id'] . '" class="badge badge-primary">Edit</a>';
            $view .= '<a href="delete.php?id=' . $result['id'] . '" class="badge badge-danger">Delete</a>';
            $view .= '</li>';
        }
    }
    ?>


    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Chat</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <style>
            div {
                padding: 10px;
                font-size: 16px;
            }
        </style>
    </head>

    <body>
        <!-- <header>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Chat</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">入力</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="select.php">Chat履歴</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header> -->

        <div>
            <ul class="list-group">
                <?= $view ?>
            </ul>
        </div>

    </body>

</html>
</body>