// 04_ソースコード/public/test2/event.js
// DBへアクセスして点数を更新するPHPを呼び出す処理

// id="updatePointBtn" のボタンを押したときに実行される関数
export function updatePoint(user_id) {
    // ここに処理を追加してください
    // 例：id="point" のテキストを変更する
    let scoreDom = document.getElementById("userScore");
    // 現在のスコアを取得
    let newScore = scoreDom.value;
    // 更新後のスコア表示覧
    let updatedScoreDom = document.getElementById("updatedScore");

    // FormDataオブジェクトを作成
    var formData = new FormData();

    // データを追加
    formData.append("user_id", user_id);
    formData.append("newscore", newScore);
    // formData.append("key2", "value2");

    // Fetch APIを使用してPOSTリクエストを送信
    fetch('https://team4.nikita.jp/backend/updatePoint.php', {
        method: 'POST',  // メソッドを指定
        body: formData  // ボディにFormDataを設定
    })
        // レスポンスを画面にセット
        .then(response => {
            //PromiseResult:Response
            let text = response.text();
            // console.log(text);
            text.then(response2 => {
                //PromiseResult:戻り値
                console.log(response2);
                // JSON形式の文字列が戻り値なので、オブジェクトに変換
                let obj = JSON.parse(response2);
                updatedScoreDom.innerHTML = obj.nowScore;
            });
        }).catch(error => {
            console.log(error);
        });


    // alert(newScore);
}
// id="updatePointBtn"にクリックイベントを追加
document.getElementById("updatePointBtn").addEventListener("click", updatePoint);

// alert("read done");
