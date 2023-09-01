<?php
    //各クラス化されたファイルの読み込み
    require_once('select.php');
    require_once('insert.php');
    require_once('update.php');
    require_once('delete.php');

    //各変数にP_POSTで受け取ったデータを格納
    //変数 = input type="submit"
    $subBtn = filter_input(INPUT_POST, 'btnName');
    //変数 = input tipe="radio"
    $btnValue = filter_input(INPUT_POST, 'r_btn');
    //変数 = input="text"
    $namePost =  filter_input(INPUT_POST, 'name');
    //変数 = input="textarea"
    $contentPost =  filter_input(INPUT_POST, 'content');
    //変数 = input type="checkbox" 中には配列で入っているのでFILTER_REQUIRE_ARRAYを使う
    $checkPost = filter_input(INPUT_POST, 'check', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

    //条件としてsubmitが押された時に
    if (isset($subBtn)) {
        //条件として投稿という名のラジオボタンが押された時にかつ、名前と投稿内容が空白じゃない時に
            //SQL文のINSERT文を変数に格納
        if (($btnValue === 'post') && ($namePost != '' && $contentPost != '')) {
            //Insertをインスタンス化
            $ins = new Insert();
            //クラス化したInsertDateの呼び出し引数として渡す
            $ins->InsertDate($namePost, $contentPost);
        //条件として更新という名のラジオボタンが押された時にかつ、名前と投稿内容が空白じゃない時かつ、チェックされている時に
        } elseif (($btnValue === 'update') && ($namePost != '' && $contentPost != '') && isset($checkPost)) {
            //Updateをインスタンス化
            $upd = new Update();
            //クラス化したUpdateDateの呼び出し引数として渡す
            $upd->UpdateDate($namePost, $contentPost, $checkPost);
        //条件として削除という名のラジオボタンが押された時にかつ、チェックされている時に
        } elseif ($btnValue === 'delete' && isset($checkPost)) {
            //Deleteをインスタンス化
            $del = new Delete();
            //DeleteDateを呼び出し引数として渡す
            $del->DeleteDate($checkPost);
        }
    }
    //DBに保存されているデータを表示する為の処理
    //Selectをインスタンス化
    $select = new Select();
    //SelectDateを呼び出す
    $sth = $select->SelectDate();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content=text/html; cahrset=UTF-8">
        <!--Jqueryの読み込み-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    </head>
    <body>
        <form method="post" action="/testphp/sample/index.php">
            <p>
                名前:<br><input type="text" name="name" id="name_id" size="20" maxlength"50"><br>
                内容:<br><textarea name="content" id="content_id" rows="10" cols="50"></textarea>
                <button type="submit" name="btnName" id="button_id">投稿</button>
            </p>
            <p>
               <input type="radio" name="r_btn" id="post_id" value="post" checked>投稿
               <input type="radio" name="r_btn" id="update_id" value="update" >更新
               <input type="radio" name="r_btn" id="delete_id" value="delete" >削除
            </p>
<!--fetchメソッドで取り出し表示する-->
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
        <!--jsファイルの読み込み-->
        <script src="Jquery/main.js"></script>
    </body>
</html>
