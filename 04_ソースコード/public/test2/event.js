// 04_ソースコード/public/test2/event.js
// DBへアクセスして点数を更新するPHPを呼び出す処理

// id="updatePointBtn" のボタンを押したときに実行される関数
function updatePoint() {
    // ここに処理を追加してください
    // 例：id="point" のテキストを変更する
    document.getElementById("point").innerText = 100;
    alert("OK");
}
// id="updatePointBtn"にクリックイベントを追加
document.getElementById("updatePointBtn").addEventListener("click", updatePoint);


