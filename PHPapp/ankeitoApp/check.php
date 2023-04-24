<!-- <!DOCTYPE html>は、HTML文書の最初の行に書かれる宣言文で、
     この文書がHTML5で書かれた文書であることを宣言します。 -->
     <!DOCTYPE html>
<!-- このコードはHTML文書の開始を示す要素であり、lang属性を使用して、文書の言語が日本語であることを示します。 -->
<html lang="ja">
  <!-- HTML文書のヘッダー（head）に含まれる要素を定義します。 -->
  <head>
      <!-- このコードは、HTMLドキュメントで使用する文字コードを指定するためのmetaタグの1つで、UTF-8という文字コードを指定しています。 -->
      <meta charset="UTF-8">
      <!-- 「viewport」という名前の属性に、ブラウザでのページの表示方法に関する情報を指定することができます。 -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- このコードは、HTMLドキュメントのタイトルを設定するための要素であり、ブラウザーのタブや検索結果の見出しに表示されます。 -->
      <title>php基礎</title>
 
      <!-- Google Fontsの読み込み -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP&display=swap" rel="stylesheet">
  </head>
  <body>
  <?php
try {
    $dsn = 'mysql:dbname=phpkiso;host=localhost';
    $user = 'root';
    $password = 'araiofficeDaisaku208';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');

    $nickname = $_POST['nickname'];
    $email = $_POST['email'];
    $goiken = $_POST['goiken'];

    $nickname = htmlspecialchars($nickname);
    $email = htmlspecialchars($email);
    $goiken = htmlspecialchars($goiken);

    $error_message = '';

    if ($nickname == '') {
        $error_message .= '名前が入力されていません。<br>';
    }

    if ($email == '') {
        $error_message .= 'メールアドレスが入力されていません。<br>';
    }

    if ($goiken == '') {
        $error_message .= 'ご意見が入力されていません。<br>';
    }

    if ($error_message !== '') {
        print $error_message;
        print '<form>';
        print '<input type="button" onclick="history.back()" value="戻る">';
        print '</form>';
    } else {
        $sql = 'INSERT INTO anketo (nickname,email,goiken) VALUES ("'.$nickname.'","'.$email.'","'.$goiken.'")';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $dbh = null;
        print '<p>以下の内容でアンケートに回答いただき、ありがとうございます。</p>';
        print '<p>お名前：'.$nickname.'</p>';
        print '<p>メールアドレス：'.$email.'</p>';
        print '<p>ご意見：'.$goiken.'</p>';
        print '<p><a href="index.html">トップページへ戻る</a></p>';
    }
} catch(Exception $e) {
    print '節電中の為アクセス不通';
}
?>
    
  </body>
</html>

