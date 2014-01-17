<?php 
require('inc/result_type.php');
require('inc/lang_conf.php');
if(!isset($_GET['solution_id']))
    die('Wrong argument.');
$sol_id=intval($_GET['solution_id']);

require('inc/checklogin.php');
require('inc/database.php');
require 'inc/problem_flags.php';
$result=mysql_query("select user_id,time,memory,result,language,code_length,problem_id,public_code from solution where solution_id=$sol_id");
$row=mysql_fetch_row($result);
if(!$row)
  die('No such solution.');

$allowed=FALSE;
if(isset($_SESSION['user'])){
  if(strcmp($row[0],$_SESSION['user'])==0)
    $allowed=TRUE;
  else if(isset($_SESSION['source_browser']))
    $allowed=TRUE;
  else if($row[7]){
    $prob_id=$row[6];
    $prob=mysql_query("select has_tex from problem where problem_id=$prob_id");
    if( ($tmp=mysql_fetch_row($prob)) && !($tmp[0]&PROB_DISABLE_OPENSOURCE) )
        $allowed=TRUE;
  }
}
if(!$allowed)
  $info = 'You cannot view this code.';
else{
  $result=mysql_query("select source from source_code where solution_id=$sol_id");
  if($tmp=mysql_fetch_row($result))
    $source=$tmp[0];
  else
    $info = 'Source code is not available!';
}
if(isset($_GET['raw'])){
  if(isset($info)){
    echo $info;
  }else{
    header("Content-Type: text/plain; charset=UTF-8");
    echo $source;
  }
  exit(0);
}

$Title="Source $sol_id";
?>
<!DOCTYPE html>
<html>
  <?php require('head.php'); ?>

  <body onload="prettyPrint()">
    <?php require('page_header.php'); ?>  
          
    <div class="container-fluid" style="font-size:13px">
      <?php
      if(isset($info))
        echo '<div class="row-fluid center">',$info,'</div>';
      else{
      ?>
        <div class="row-fluid center">
            User:<?php echo $row[0];?>
        </div>
        <div class="row-fluid center">
            Problem:<?php echo $row[6];?>&nbsp;&nbsp;
            Result:<?php echo $RESULT_TYPE[$row[3]];?>
        </div>
        <div class="row-fluid center">
            Length:<?php echo $row[5];?>&nbsp;&nbsp;
            Language:<?php echo $LANG_NAME[$row[4]];?>
        </div>
        <div class="row-fluid center">
            Time:<?php echo $row[1];?>&nbsp;ms&nbsp;
            Memory:<?php echo $row[2];?>&nbsp;KB
        </div>
        <div class="row-fluid">
          <div class="span10 offset1">
            <a href="sourcecode.php?raw=1&amp;solution_id=<?php echo $sol_id?>" onclick="return show_raw();">Raw</a>
            <!--[if IE]>&nbsp;&nbsp;<a href="#" onclick="return copy_ie();">Copy</a> <![endif]-->
          </div>
        </div>
        <div class="row-fluid">
          <div class="span10 offset1" id="div_code">
              <pre class="prettyprint linenums"><?php echo htmlspecialchars($source);?></pre>
          </div>
        </div>
      <?php } ?>
      <hr>
      <footer>
        <p>&copy; 2012 Bashu Middle School</p>
      </footer>

    </div>

    <script src="../assets/js/google-code-prettify/prettify.js"></script>
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="common.js"></script>
    <script type="text/javascript"> 
      var solution_id=<?php echo $sol_id?>;
      $(document).ready(function(){
        $('#ret_url').val("sourcecode.php?solution_id="+solution_id);
      });
      function doajax(fun){
        $.ajax({type:"GET",url:("sourcecode.php?raw=1&solution_id="+solution_id),success:fun});
      }
      function copy_ie(){
        doajax(function(msg){
            if(window.clipboardData){
              window.clipboardData.clearData();
              window.clipboardData.setData("text", msg);
            }
        });
        return false;
      }
      function show_raw(){
        return true; /*****************************/
        doajax(function(msg){
          $('#div_code').html('<pre>'+htmlEncode(msg)+'</pre>');
        });
        return false;
      }
    </script>
  </body>
</html>