<?php
/* フォームから検索ワードを取得 */
$search = $_POST["search"];
if(empty($search)){
    $search = $_GET["search"];
    //var_dump($search);
}

//$page = $_GET["page"];
$page = empty($_GET["page"])? 1:$_GET["page"];//ページ番号
/* エラーメッセージ配列 */
$error = array();

/* データベースに接続 */
@require_once("../dbsetting/db.php");

mysql_set_charset('utf8');
//SQL文を発行
$query = "SELECT * FROM h_members WHERE h_prefecture like '%$search%'";
$result = mysql_query($query);

//データの数
$dataCount = mysql_num_rows($result);
//var_dump($dataCount);
//１ページあたりの表示数
$disp = 5;
//最大ページ数
$limit = ceil($dataCount / $disp);
//var_dump($maxPageNum);

$index = 0;
while ($row[$index] = mysql_fetch_assoc($result)) {
    $index++;
}

$start = ($page - 1) * $disp;

?>
<div id="searchcontents">
<?php

if ($dataCount == 0) {
    print('<p>検索結果無し</p>');
} else {
    print('<p>検索結果：');
    print($dataCount);
    print('件</p>');
}

for ($i = $start;$i <= $start+5-1;$i++) {
  if(empty($row[$i])){
    break;
  }

//print('<a href="./h_search_detail.php?h_id='.$row[$i]['h_id'].'" target="_self" value="h_search_detail">');

?>




<div class="anken">
<h2 class="hospitalname"><a href="./hospital/hospital.php?name=animal"><?php print($row[$i]['h_name']); ?></a></h2>
<h3 class="copy">外科手術の施術件数は年間100件あります！臨床現場の体験に最適。</h3>
    <div class="prefecture"><?php print($row[$i]['h_prefecture']); ?></div>
        <table>
            <tbody>
                <tr>
                    <td rowspan="4" width="250px"><img src="../image/hospital.jpg" width="250px" /></td>
                    <th width="140px">所在地</th>
                    <td width="250px"><?php print($row[$i]['h_prefecture'].$row[$i]['h_address']); ?></td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td><?php print($row[$i]['h_tel']); ?></td>
                </tr>
                <tr>
                    <th>e-mail</th>
                    <td><?php print($row[$i]['h_email']); ?></td>
                </tr>
                <tr>
                    <th>実習応援金</th>
                    <td>10,000円</td>
                </tr>
            </tbody>
        </table>
            
        <p class="pr">獣医師、看護師や受付、少人数で楽しく勤務しています。<br />患者は主に地域の小動物です。臨床現場を詳しく知りたい実習生を募集しています。
        </p>
        <ul class="linknavi">
            <li><a href="http://～">動物病院詳細</a></li>
            <li><a href="./detail.php?h_id=<?php echo $row[$i]['h_id']; ?>" >実習詳細</a></li>
        </ul>
            
    </div><!-- anken -->




<?php
}

?>
</div>

<div style="text-align:center; font-size: 150%;">
<?php
// エラー処理はあとでやろう

//var_dump($row);

//$page = empty($_GET["page"])? 1:$_GET["page"];//ページ番号
//if (is_null($page)) {
//  $page = 1;
//}

paging($limit, $page, $search);
//var_dump($page);
?>
</div>

<?php
function paging($limit, $page, $search, $disp=5){
    //$dispはページ番号の表示数
    $next = $page + 1;
    $prev = $page - 1;
     
    //ページ番号リンク用
    $start =  ($page-floor($disp/2) > 0) ? ($page-floor($disp/2)) : 1;//始点
    $end =  ($start > 1) ? ($page+floor($disp/2)) : $disp;//終点
    $start = ($limit < $end)? $start-($end-$limit):$start;//始点再計算
     
    if($page != 1 ) {
         print '<a href="?page='.$prev.'&search='.$search.'">&laquo; 前へ</a>';
    }

    //最初のページへのリンク
    if($start >= floor($disp/2)){
        print '<a href="?page=1&search='.$search.'">1</a>';
        if($start > floor($disp/2)) print "..."; //ドットの表示
    }
     
     
    for($i=$start; $i <= $end ; $i++){//ページリンク表示ループ
         
        $class = ($page == $i) ? ' class="current"':"";//現在地を表すCSSクラス
         
        if($i <= $limit && $i > 0 )//1以上最大ページ数以下の場合
            print '<a href="?page='.$i.'&search='.$search.'"'.$class.'>'.$i.'</a>';//ページ番号リンク表示
         
    }
    
    //最後のページへのリンク
    if($limit > $end){
        if($limit-1 > $end ) print "...";    //ドットの表示
        print '<a href="?page='.$limit.'&search='.$search.'">'.$limit.'</a>';
    }
         
    if($page < $limit){
        print '<a href="?page='.$next.'&search='.$search.'">次へ &raquo;</a>';
    }
     
    /*確認用
    print "<p>current:".$page."<br>";
    print "next:".$next."<br>";
    print "prev:".$prev."<br>";
    print "limit:".$limit."<br>";
    print "start:".$start."<br>";
    print "end:".$end."</p>";*/
}



?>
