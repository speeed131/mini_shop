<?php

require_once('../common/common.php');


// エラーメッセージの初期化
$errorMessage = "";



// ログインボタンが押された場合

    // 1. ユーザIDの入力チェック
    if (empty($_POST["username"])) {  // emptyは値が空のとき
       echo  $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
       echo  $errorMessage = 'パスワードが未入力です。';
    }


    if (!empty($_POST["username"]) && !empty($_POST["password"])) {
        // 入力したユーザIDを格納
        $username = $_POST["username"];

        // 2. ユーザIDとパスワードが入力されていたら認証する

        // 3. エラー処理
        try {
            $dbh = connectDB();


            $stmt = $dbh->prepare('SELECT * FROM user WHERE user_name = ?');
            $stmt->execute(array($username));

            $password = $_POST["password"];

             $row = $stmt->fetch(PDO::FETCH_ASSOC);
            var_dump($row['password']);

                if ($password == $row['password']) {
                    echo "ok";
                    session_start();
                    session_regenerate_id(true);

                    // 入力したusernameのユーザー名を取得

                    $_SESSION["NAME"] = $row['username'];
                    header("Location: ../product/pro_list.php");  // メイン画面へ遷移
                    exit();  // 処理終了
                } else {
                    // 認証失敗
                   echo  $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
           
                }
        } catch (PDOException $e) {
            $errorMessage = 'データベースエラー';
            //$errorMessage = $sql;
            // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
            // echo $e->getMessage();
        }
    }
?>

