<?php
$jsonStr = filter_input(INPUT_POST, "json");
// var_dump($jsonStr);

$data = json_decode($jsonStr, true);
// var_dump($data);
// echo $data[0]['question'];

// 環境にあわせてかえること
$db_hostname = "mysql219.phy.lolipop.lan";
$db_name = "LAA1563424-tetrisdb";
$db_user_name = "LAA1563424";
$db_password = "A2gxAdmYNxUCDe7";
$pdo = new PDO("mysql:host={$db_hostname};dbname={$db_name};charset=utf8", $db_user_name, $db_password);

/*
    JSONオブジェクトの形式は以下の複数オブジェクト例の配列になっています。
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

foreach ($data as $record) {
    $question =  $record['question'];
    $answers =  $record['answers'];
    $answer =  $record['answer'];
    echo ($question . "\n"); // 挿入時の問題文だけ、確認代わりに結果画面に表示する
    $sql = "INSERT questions (id, question, answers1, answers2, answers3, answer) VALUES (null, ?, ?, ?, ?, ?)";
    $ps = $pdo->prepare($sql);
    $ps->bindValue(1, $question, PDO::PARAM_STR);
    $ps->bindValue(2, $answers[0], PDO::PARAM_STR);
    $ps->bindValue(3, $answers[1], PDO::PARAM_STR);
    $ps->bindValue(4, $answers[2], PDO::PARAM_STR);
    $ps->bindValue(5, $answer, PDO::PARAM_INT);
    $ps->execute();
}
