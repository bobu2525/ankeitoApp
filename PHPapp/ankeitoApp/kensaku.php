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
    $code = $_POST['kensaku'];
    $dsn = 'mysql:dbname=phpkiso;host=localhost';
    $user = 'root';
    $password = 'araiofficeDaisaku208';
    $dbh = new PDO($dsn, $user, $password);
    $dbh->query('SET NAMES utf8');

    $sql = 'SELECT * FROM anketo WHERE code=:code';
    $stmt = $dbh->prepare($sql);
    $stmt->bindParam(':code', $code, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) === 0) {
        echo 'お探しのデータは見つかりませんでした';
    } else {
        foreach ($result as $row) {
            echo 'nickname：' . $row['nickname'] . '<br>';
            echo 'email：' . $row['email'] . '<br>';
            echo 'ご意見内容：' . $row['goiken'] . '<br>';
        }
    }


    $dbh = null;
} catch (Exception $e) {
    print '節電中の為アクセス不通';
}
?>
     <br>
      <a href="kensaku.html">メニューにもどる</a><br>
  </body>
  </html>