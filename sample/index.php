<?php
    require_once('select.php');
    require_once('insert.php');
    require_once('update.php');
    require_once('delete.php');

    $subBtn = filter_input(INPUT_POST, 'btnName');                                                //変数 = input type="submit"
    $btnValue = filter_input(INPUT_POST, 'r_btn');                                                //変数 = input tipe="radio"
    $namePost =  filter_input(INPUT_POST, 'name');                                               //変数 = input="text"
    $contentPost =  filter_input(INPUT_POST, 'content');                                            //変数 = input="textarea"
    $checkPost = filter_input(INPUT_POST, 'check', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);         //変数 = input type="checkbox" エラーが起きるのでFILTER_REQUIRE_ARRAYを使う

    if (isset($subBtn)) {
        if (($btnValue === 'post') && ($namePost != '' && $contentPost != '')) {
            $ins = new Insert();
            $ins->InsertDate($namePost, $contentPost);
        } elseif (($btnValue === 'update') && ($namePost != '' && $contentPost != '') && isset($checkPost)) {
            $upd = new Update();
            $upd->UpdateDate($namePost, $contentPost, $checkPost);
        } elseif ($btnValue === 'delete' && isset($checkPost)) {
            $del = new Delete();
            $del->DeleteDate($checkPost);
        }
    }
    $select = new Select();
    $sth = $select->SelectDate();
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content=text/html; cahrset=UTF-8">
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
<?php while($row = $sth->fetch(PDO::FETCH_ASSOC)){ ?>
            <div> 
                <table border="1" width="800" >
                    <p><input type="checkbox" class="p1Chk" name="check[]" value="<?= htmlspecialchars($row['id'], ENT_QUOTES, 'UTF-8'); ?>"></p>
                    <tr>
                        <td>
                            <?= htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8'); ?>
                            <?= htmlspecialchars($row['content'], ENT_QUOTES, 'UTF-8'); ?>
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
            $(".p1Chk").css("visibility", "hidden");                   //チェックボックスを非表示(hidden)
            $('input[name="r_btn"]').bind('click', function() {        //ラジオボタンがクリックされた時に動く関数
                let value = $('input[name="r_btn"]:checked').val();    //チェックされているラジオボタンのvalueを取得
                let changeSub;                                         //submitに表示されている文字を入れるための空の変数
                let chkVisibility;                                     //表示非表示を変更するために'hidden'か'visible'を入れるための空の変数
                if (value === 'post') {                                //valueがチェックの入っているラジオボタンと等しい時
                    changeSub = '投稿';                                //変数に文字を入れる
                    chkVisibility = 'hidden';                          //変数にチェックボックスを非表示にする為hiddenを入れる
                } else if (value === 'update') {
                    changeSub = '更新';
                    chkVisibility = 'visible'
                } else if (value === 'delete') {
                    changeSub = '削除';
                    chkVisibility = 'visible';
                }
                $('#button_id').text(changeSub);                   //submitを変更する処理
                $(".p1Chk").css('visibility', chkVisibility);      //チェックボックスを表示非表示する処理
            });
            $('#button_id').bind('click', function() {                 //submitが押された時に動く関数
                let s_name = $('#name_id').val().length;              //名前の文字数を取得
                let s_naiyou = $('#content_id').val().length;           //投稿内容の文字数を取得
                let count = $('.p1Chk:checked').length;                //チェックボックスのチェックされている数を変数に入れる
                let value = $('input[name="r_btn"]:checked').val();    //チェックされているラジオボタンのvalueを取得
                let error;                                             //alertを表示するためにエラー文を入れる変数
                if ((value === 'post') || (value === 'update')) {
                    if ((s_name === 0 || s_name >= 10 ) && (s_naiyou === 0 || s_naiyou >= 300)) {     //名前と投稿内容を入力した際の文字数チェック
                        error = '名前と投稿内容に誤りがあります。';                                   //入力チェックに引っかかった場合にalertを表示する
                    } else if ((s_name === 0 ) || (s_name >= 10)) {                                   //名前文字数チェック
                        error = '名前に誤りがあります。';
                    } else if ((s_naiyou === 0) || (s_naiyou >= 300)) {                               //投稿内容文字数チェック
                        error = '投稿内容に誤りがあります。';
                    } else if ((value === 'update') && (count === 0)) {                               //ラジオボタンの更新にチェックが入ってるかつ、チェックがない場合
                        error = '更新する投稿にチェックが入っていません';
                    }
                }
                if (value === 'delete') {                                                             //削除ボタンにチェックが入っている時===trueの時
                    if (count === 0) {                                                                //チェックが入ってない時にalertを表示する
                        error = '削除する投稿にチェックが入っていません';
                    }
                }
                if (!error == '') {                                                                     //formCheckがfalseの時にalertを表示し、投稿を中止する
                    alert(error);
                    return false;
                }
            });
        </script>
    </body>
</html>
