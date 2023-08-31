<?php 
    //DBに接続する為の処理
    $dsn = 'mysql:dbname=kadais;host=localhost;charset=utf8mb4';
    $user = 'root';
    $password = 'ozi123';
    try { 
        $dbh = new PDO($dsn, $user, $password);     
        } catch(PDOException $e) {
            die('Connect Error: ' . $e->getCode()); 
    }
    $dbh->setATTribute(PDO::ATTR_EMULATE_PREPARES, false);

    //条件としてsubmitが押された時に
    if (isset($_POST['btnName'])) {
        //条件として投稿という名のラジオボタンが押された時にかつ、名前と投稿内容が空白じゃない時に
        if (($_POST['r_btn'] === 'post') && ($_POST['name'] != '' && $_POST['content'] != '')) {
            //SQL文のINSERT文を変数に格納
            $sql = 'INSERT INTO samples (name, content, datetime) VALUES (?, ?, NOW())';
            //SQL文を実行する準備
            $sth = $dbh->prepare($sql);
            //bindValue関数でデータをセット
            $sth->bindValue(1, $_POST['name'], PDO::PARAM_STR);
            $sth->bindValue(2, $_POST['content'], PDO::PARAM_STR);
            //SQLを実行
            $sth->execute();

        //条件として更新という名のラジオボタンが押された時にかつ、名前と投稿内容が空白じゃない時かつ、チェックされている時に
        } elseif (($_POST['r_btn'] === 'update') && ($_POST['name'] != '' && $_POST['content'] != '') && isset($_POST['check'])) {
            //SQL文のUPDATE文を変数に格納
            $sql = 'UPDATE samples SET name = ?, content = ? WHERE id = ?';
            //SQL文を実行する準備
            $sth = $dbh->prepare($sql);
            //foreachでチェックボックスを取り出す
            foreach ($_POST['check'] as $chk ) {
                //どのチェックボックス(id)が選択されているか
                $id = (int)$chk;
                //bindValue関数でデータをセット
                $sth->bindValue(1, $_POST['name'], PDO::PARAM_STR);
                $sth->bindValue(2, $_POST['content'], PDO::PARAM_STR);
                $sth->bindValue(3, $id, PDO::PARAM_INT);
                //SQLを実行
                $sth->execute();
            }
        //条件として削除という名のラジオボタンが押された時にかつ、チェックされている時に
        } elseif ($_POST['r_btn'] === 'delete' && isset($_POST['check'])) {
            //SQLのDELETE文を変数に格納
            $sql = 'DELETE FROM samples WHERE id = ?';
            //SQL文を実行する準備
            $sth = $dbh->prepare($sql);
            //foreachでチェックボックスを取り出す
            foreach ($_POST['check'] as $chk ) {
                //どのチェックボックス(id)が選択されているか
                $id = (int)$chk;
                //bindValue関数でデータをセット
                $sth->bindValue(1, $id, PDO::PARAM_INT);
                //SQL文を実行
                $sth->execute();
            }
        }
    }
    //データベースに保存されているデータをwhile文で表示させる為に変数に格納
    $sql = 'SELECT id, name, content, datetime FROM samples ORDER BY datetime DESC limit 3';
    //SQL文を実行する為の準備
    $sth = $dbh->prepare($sql);
    //SQL文を実行
    $sth->execute();
?>

<html>
    <head>
        <meta http-equiv="Content-Type" content=text/html; cahrset=UTF-8">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>    
    </head>
    <body>
        <form method="post" action="/testphp/q4.php">
            <p>
                名前:<br><input type="text" name="name" id="name_id" size="20" maxlength"50"><br>
                内容:<br><textarea name="content" id="content_id" rows="10" cols="50"></textarea>
                <button type="submit" name="btnName" id="button_id">投稿</button>
            </p>
            <p>
               <input type="radio" name="r_btn" id="post_id" value="post"  checked>投稿
               <input type="radio" name="r_btn" id="update_id" value="update" >更新
               <input type="radio" name="r_btn" id="delete_id" value="delete" >削除
            </p>
<!--SELECT文で取得したデータを表示する為の処理-->
<?php while($row = $sth->fetch(PDO::FETCH_ASSOC)){ ?>
            <div> 
                <table border="1" width="800" >
                    <p><input type="checkbox" class="p1Chk" name="check[]" value="<?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>"></p>
                    <tr>
                        <td>
                            <?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?>
                            <?= htmlspecialchars($row['datetime'], ENT_QUOTES, 'UTF-8'); ?>
                        </td>
                    </tr>
                </table>
                <table border="2" width="800" height="200">
                    <td>
                        <?= htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8'); ?>
                    </td>
                </table>
            </div>
<?php } ?>
<?php  $dbh = null; ?>
        </form>
        <script>
            //チェックボックスを非表示(hidden)
            $(".p1Chk").css("visibility", "hidden");
            //ラジオボタンがクリックされた時に動く関数
            $('input[name="r_btn"]').bind('click', function() {
                //チェックされているラジオボタンのvalueを取得
                let value = $('input[name="r_btn"]:checked').val();
                //submitに表示されている文字を入れるための空の変数
                let changeSub;
                //表示非表示を変更するために'hidden'か'visible'を入れるための空の変数
                let chkVisibility;

                //valueがチェックの入っているラジオボタンと等しい時
                if (value === 'post') {
                    //submit上の表示を変更する為の文字を変数に格納
                    changeSub = '投稿';
                    //変数にチェックボックスを非表示にする為hiddenを入れる
                    chkVisibility = 'hidden';

                //valueがチェックの入っているラジオボタンと等しい時
                } else if (value === 'update') {
                    //submit上の表示を変更する為の文字を変数に格納
                    changeSub = '更新';
                    //変数にチェックボックスを表示する為visibleを入れる
                    chkVisibility = 'visible'

                //valueがチェックの入っているラジオボタンと等しい時
                } else if (value === 'delete') {
                    //submit上の表示を変更する為の文字を変数に格納
                    changeSub = '削除';
                    //変数にチェックボックスを表示する為visibleを入れる
                    chkVisibility = 'visible';
                }
                //submitを変更する処理
                $('#button_id').text(changeSub);
                //チェックボックスを表示非表示する処理
                $(".p1Chk").css('visibility', chkVisibility);
            });

            //submitが押された時に動く関数
            $('#button_id').bind('click', function() {
                //名前の文字数を取得
                let js_name = $('#name_id').val().length;
                //投稿内容の文字数を取得
                let js_content = $('#content_id').val().length;
                //チェックボックスのチェックされている数を変数に入れる
                let count = $('.p1Chk:checked').length;
                //チェックされているラジオボタンのvalueを取得
                let value = $('input[name="r_btn"]:checked').val();
                //alertを表示するためにエラー文を入れる変数
                let error;

                //チェックされているラジオボタンが投稿または、更新の場合
                if ((value === 'post') || (value === 'update')) {
                    //名前と投稿内容を入力した際の文字数チェック
                    if ((js_name === 0 || js_name >= 10 ) && (js_content === 0 || js_content >= 300)) {
                        //入力チェックに引っかかった場合にalertで表示する文を変数に格納
                        error = '名前と投稿内容に誤りがあります。';
                    //名前文字数チェック
                    } else if ((js_name === 0 ) || (js_name >= 10)) {
                        error = '名前に誤りがあります。';
                    //投稿内容文字数チェック
                    } else if ((js_content === 0) || (js_content >= 300)) {
                        error = '投稿内容に誤りがあります。';
                    //ラジオボタンの更新が選択されているかつ、チェックがない場合
                    } else if ((value === 'update') && (count === 0)) {
                        //alertで表示する文を変数に格納
                        error = '更新する投稿にチェックが入っていません';
                    }
                }

                //ラジオボタンの削除が選択されている場合
                if (value === 'delete') {
                    //条件としてチェックボックスがチェックされていない時
                    if (count === 0) {
                        //alertで表示する分を変数に格納
                        error = '削除する投稿にチェックが入っていません';
                    }
                }

                //errorが空白じゃない時に
                if (!error == '') {
                    //errorには条件によって、表示する文が異なる
                    alert(error);
                    //戻り値としてfalseを返して投稿を中止する
                    return false;
                }
            });
        </script>
    </body>
</html>
