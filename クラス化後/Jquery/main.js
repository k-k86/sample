
    //チェックボックスを非表示(hidden)
    $(".p1Chk").css("visibility", "hidden");
        //ラジオボタンがクリックされた時に動く関数
        $('input[name="r_btn"]').bind('click', function() {
            //チェックされているラジオボタンのvalueを取得
            let value = $('input[name="r_btn"]:checked').val();
            //submitに表示されている文字を入れるための空の変数
            let changeSub;
            //表示非表示を変更するために'hidden'か'visible'を入れるための空の変数
            let chkVisibislity;

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

            //submit上の表示を変更する処理
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