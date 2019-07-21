<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
   <div id="name"></div> 
   <div id="user_id"></div> 
   <div id="frend"></div> 
<?php


?>

<script>
  
let path = 'http://127.0.0.1/jwtPoc/api.php';
let api_data = JSON.parse(ajax_connect(path));

Object.keys(api_data).forEach(function(val){
    if(!$('#' + val).length) return false; 
    if(typeof(api_data[val]) == 'object'){
       Object.keys(api_data[val]).forEach(function(object_val){
        $('#' + val).append('<p>'+object_val+api_data[val][object_val]+'</p>');
       });
    }else{
    $('#'+ val).text(api_data[val]);
    }
});

 function ajax_connect(path){
    let datas;
        $.ajax({
            url:path,
            type:'json',
            async: false,
            beforeSend: function( xhr, settings ) { xhr.setRequestHeader( 'Authorization','Bearer'+ 'token' ); }
        })
        .done( (data) => {
            datas =  data;
        });
    return datas;
}    
    </script>
</body>
</html>