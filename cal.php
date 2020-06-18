<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>

<!-- ここにlinkタグ
ここにscriptタグを読み込む
（使いたい機能に応じてpackages内の各フォルダにある「main.css, main.js」を読み込む) -->

<!-- ブートストラップ -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<!-- css -->
    <link rel="stylesheet" href="core/main.css">  
    <link href='daygrid/main.css' rel='stylesheet' />
    <link href='timegrid/main.css' rel='stylesheet' />

<!-- Jquery -->
      <script
      src="https://code.jquery.com/jquery-3.5.1.min.js"
      integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
      crossorigin="anonymous"></script>

<!-- script -->
      <script src='core/main.js'></script>
      <script src='daygrid/main.js'></script>
      <script src='interaction/main.js'></script>
      <script src='timegrid/main.js'></script>
      <script src="core/locales-all.js"></script>
      <script>
// 基本の図形はこの記述で描画
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');

      var calendar = new FullCalendar.Calendar(calendarEl, {//ここの波括弧内にカレンダーに関するイベントや描画を記述

//このplugins内に使用するプラグインを記述する。カレンダーのクリックイベントやカレンダーに予定を描画するなど、それぞれ異なるプラグインを入れる必要がある。ここにプラグインを記述したら、対となるscriptタグの「main.cssやmain.js」を追加で読み取る必要がある。
        plugins: [ 'interaction', 'dayGrid', 'timeGrid' ],//１つの記述が終わったら「,」をつけることが必須。

//以下ではヘッダーを描画している。
//左、中央、右にどんな表示をさせるかここで指定
        header: {  //ヘッダー選択
          left:   'today ,prev,next, testbtn',
          center: 'title',
          right:   'dayGridMonth,timeGridWeek,timeGridDay'
          }, 
//以下ではカレンダーの細かい設定をしている
          locale: 'ja',//日本語選択
          businessHours:true,//土日を色付け
          eventTimeFormat: { hour: 'numeric', minute: '2-digit' },//時間の表記を12時→12:00に

//以下ではカレンダーへの日付クリックを可能にする記述
          selectable: true,//日付のクリックを可能に
          selectMirror: true,//クリック関係（詳細不明）

 //日付をクリックした時の記述
 //ここでのクリックを有効にするためにselectable:trueを設定している
          dateClick: function(info) {
            // alert('Date: ' + info.dateStr);
            $('#txtDay').val(info.dateStr);//モーダルに日付が最初から表示される
            $('#exampleModal').modal();
            },

//以下ではカレンダーに表示するイベントの記述
//eventsの配列内にオブジェクト単位でイベントを追加記入可能。
//使用可能なプロパティが決まっている様子（参照：https://fullcalendar.io/docs/event-object）
 events: [//ここに記入してイベントを作る
      {
            title:'チューター研修',
            descripcion:'php選手権について打ち合わせ',
            start:'2020-06-16',
            //ここに記述すると個別に色を設定可能
            color:'yellow',
            textColor:'gray'

            },
            {
            title:'サイト制作',
            descripcion:'選手権制作スタート〜エンド',
            start:'2020-06-17',
            end:'2020-06-23'
            },{
            title:'プレリリース 発表会',
            descripcion:'発表会',
            start:'2020-06-24T12:30:00',
            allDay:false,//ここのfalseだと終日の部分に表示されなくなる
            color:'black',
            textColor:'pink'
       }

         ],


//イベントバーにクリックした時の記述(日付をクリックした時のイベントとは別で記述が必要な点注意)
   eventClick: function(info) {
    alert('Event: ' + info.event.title);

  }




//カレンダーの描画はここまで------------------------------------------------------------

      });


//追加ボタンを押した時の記述////////////////////////////////////
let btnAdd = document.querySelector('#btnAdd');
  btnAdd.addEventListener('click',function(){
    alert('Hit');
    let newEvent = {
         title:$('#txtTitle').val(),
         descripcion:$('#txtDescription').val(),//モーダル２のテキストエリアに記載の値になる
         start:$('#txtDay').val()+""+'T'+$('#txtTime').val(),
         color:$('#txtColor').val(),
         textColor:$('#txtBColor').val(),
        //  textcolor:'#FFFFFF'
       };
    console.log(newEvent);
  

      calendar.addEvent({
        title:$('#txtTitle').val(),
        descripcion:$('#txtDescription').val(),//モーダル２のテキストエリアに記載の値になる
        start:$('#txtDay').val()+""+'T'+$('#txtTime').val() ,
        color:$('#txtColor').val(),
        textColor:$('#txtBColor').val(),
        // textcolor:'F0F0F0'
        // allDay: true
      });
      $('#exampleModal').modal('toggle');//モーダルの表示を切り替える（つまり消える）

        
  }),
//追加ボタンを押した時の記述ここまで////////////////////////////////////


      calendar.render();
    });

  </script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col"></div>
      <div class="col-7"><div id="calendar"></div></div>
      <div class="col"></div>
    </div>
  </div>

<!-- モーダル -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="titleEvent"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="calinsert.php" method='post'>
      <div class="modal-body">
        <!-- ↓ここにモーダルの説明部分が表示される -->
        <!-- ID: <input type="text" id='txtId' name='txtId'><br> -->
        日付: <input type="text" id='txtDay' name='day'><br>
        タイトル: <input type="text" id='txtTitle' name='title'><br>
        時間: <input type="text" id='txtTime' name='time' value='10:30'><br>
        詳細: <textarea name="description" id="txtDescription" rows='3' ></textarea><br>
        色: <input type="color" id='txtColor' name='color' value='#ff0000'><br>
        背景色: <input type="color" id='txtBColor' name='textColor' value='#ff0000'><br>
      </div>
      <div class="modal-footer">
        <input type="submit" value='追加'  id='btnAdd'>
        <!-- <button type="button" id='btnAdd' class="btn btn-success">追加</button> -->
        <button type="button" class="btn btn-success">修正</button>
        <button type="button" class="btn btn-danger">削除</button>
        <button type="button" class="btn btn-default" data-dismiss='modal'>キャンセル</button>
      </div>
      </form>

      </div>
    </div>
  </div>
</div>
<!-- モーダルここまで -->













<!-- ↓ブートストラップの読み込み -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>