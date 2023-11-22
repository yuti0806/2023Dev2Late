<html>

<head>
</head>

<body>
    <?php
    // require_once(__DIR__ . '/Setting.php');
    $json = filter_input(INPUT_POST, "json");

    // var_dump($json);


    $data = json_decode($json, false);
    echo $data[0]['question'];
    var_dump($data);
    $pdo = new PDO('mysql:host=mysql219.phy.lolipop.lan;dbname=LAA1563424-tetrisdb;charset=utf8', 'LAA1563424', 'A2gxAdmYNxUCDe7');

    /*
{
    question: '映画「シャイン」で、主人公のデヴィッド・ヘルフゴットは何の才能を持っていますか？',
    answers: [
        'ピアノ演奏',
        '絵画',
        '詩',
    ],
    answer: 0
}
*/
    echo $json[0]['question'];
    // var_dump($json);

    foreach ($json as $record) {
        $question =  $record['question'];
        $answers =  $record['answers'];
        $answer =  $record['answer'];

        $sql = "INSERT quiz (id, question, answers1, answers2, answers3, answer) VALUES (null, ?, ?, ?, ?, ?)";
        $ps = $pdo->prepare($sql2);
        $ps->bindValue(1, $question, PDO::PARAM_STR);
        $ps->bindValue(2, $answers[0], PDO::PARAM_STR);
        $ps->bindValue(3, $answers[1], PDO::PARAM_STR);
        $ps->bindValue(4, $answers[2], PDO::PARAM_STR);
        $ps->bindValue(6, $answer, PDO::PARAM_INT);
        $ps->execute();
    }
    /*
    class DBmng
    {


    // private $DBhost = Setting::$DBhost;
    // private $DBname = Setting::$DBname;
    // private $DBuser = Setting::$DBuser;
    // private $DBpass = Setting::$DBpass;

    // データベースに接続してPDOインスタンスを生成する関数
    public function dbConnect()
    {
    // require_once 'Setting.php';
    // テスト用
    $pdo = new PDO('mysql:host=mysql219.phy.lolipop.lan;dbname=LAA1563424-tetrisdb;charset=utf8', 'LAA1563424', 'A2gxAdmYNxUCDe7');
    return $pdo;
    }

    // 新規レコード登録
    public function insertQuiz($pdo, $question, $answers1, $answers2, $answers3, $answers4, $answer)
    {
    // $pdo = $this->dbConnect();
    // 登録する処理
    $sql2 = "INSERT quiz (id, question, answers1, answers1, answers1, answers1, answer) VALUES (null, ?, ?, ?, ?, ?, ?)";
    $ps = $pdo->prepare($sql2);
    $ps->bindValue(1, $question, PDO::PARAM_STR);
    $ps->bindValue(2, $answers1, PDO::PARAM_STR);
    $ps->bindValue(3, $answers2, PDO::PARAM_STR);
    $ps->bindValue(4, $answers3, PDO::PARAM_STR);
    $ps->bindValue(5, $answers4, PDO::PARAM_STR);
    $ps->bindValue(6, $answer, PDO::PARAM_INT);
    $ps->execute();
    return true;
    }
    }
    */
    ?>
</body>

</html>