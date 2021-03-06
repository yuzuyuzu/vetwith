<?php
//*****************************************************
//
//問い合わせやサイトマップなんかに使う共通部分。だよー。
//
//*****************************************************

//このファイルまでのパス
$path = "http://localhost/php/vet/";

//debug_backtraceは連想配列で結果を返すよ。注意。
$require_from = debug_backtrace();


/* ヘッダーで読み込むファイル。このファイルからの相対パスで記述 */
$header_file_tag = '<link href="./css/common.css" rel="stylesheet" type="text/css" />
<link href="./css/form.css" rel="stylesheet" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>';

//タイトル
if($mode == "s_login"){
	$page_title = "ログイン";
}elseif($mode == "resend" || $mode == "reissue"){
	$page_title = "パスワード再発行";
}else{
	$page_title ="学生登録";
}
?>

<html>
<head>
<title>
<?php
	echo $page_title." | VetWith!";
?>
</title>
<?php echo $header_file_tag; ?>
<script>
//スムーズスクロール
$(function(){
   // #で始まるアンカーをクリックした場合に処理
   $('a[href^=#]').click(function() {
      // スクロールの速度
      var speed = 500; // ミリ秒
      // アンカーの値取得。// クリックしたリンク先を保存
      var href= $(this).attr("href");
      // 移動先を取得  // クリックしたリンク先が#または空のときは
      var target = $(href == "#" || href == "" ? 'html' : href);
      // 移動先を数値で取得// トップへ移動する
      var position = target.offset().top;
      // スムーススクロール
      $('body,html').animate({scrollTop:position}, speed, 'easeInSine');
      return false;
   });
});
</script>
</head>
<body>
<noscript>
	<div>サイトを快適に利用するためには、JavaScriptを有効にしてください。</div>
</noscript>
<div id="outest">

<div id="topNavi">
	<div id="within">
		<a href="./index.php">
			<img src="../image/logo.png" height="50px" alt="VetWith!" style="float: left;" />
		</a>
		<ul>
			<li class="a"><a href="#top"><span style="text-shadow:1px 1px 0 rgba(255,255,255,1);">マイページ</span></a></li>
			<li class="b"><a href="#thislink"><span style="text-shadow:1px 1px 0 rgba(255,255,255,1);">こんなことも</span></a></li>
			<li class="c"><a href="#thatimage"><span style="text-shadow:1px 1px 0 rgba(255,255,255,1);">あんなことも</span><a></li>
			<li class="d"><a href="#sitemap"><span style="text-shadow:1px 1px 0 rgba(255,255,255,1);">ほげほげ</span></a></li>
			<li class="e"><a href="#setting"><span style="text-shadow:1px 1px 0 rgba(255,255,255,1);">設定</span></a></li>
		</ul>
	</div><!-- within -->
	
</div><!-- topNavi -->
<div id="wrapper">
	<div id="pan"><a href="./index.php">VetWithホーム</a>　> <?php echo $page_title; ?></div>
	<div id="main">
	<h1><?php echo $page_title; ?></h1>
	
		<div class="regi_form">
		
		
		
		
		
		
		
		</div><!-- regi_form -->
</div><!-- main -->
</div><!-- wrapper -->

<div id="footer">
(C) Copyright VetWith All Right Reserved.
</div><!-- footer -->

</div><!-- outest -->



</body>
</html>