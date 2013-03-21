<?php
require('inc/checklogin.php');

if(!isset($_SESSION['user'],$_SESSION['administrator'])){
  $info='<div class="center">You are not administrator.</div>';
}else{
  require('inc/database.php');
  if(isset($_POST['paswd'])){

    require_once('inc/checkpwd.php');
    if(password_right($_SESSION['user'], $_POST['paswd']))
      $_SESSION['admin_panel']=1;
  }
  $need_password=true;
  if(isset($_SESSION['admin_panel'])){
    $need_password=false;
    $res=mysql_query('select content from news where news_id=0');
    $index_text=($res && ($row=mysql_fetch_row($res))) ? str_replace('<br>', "\n", $row[0]) : '';
  }
}
$Title="Admin panel";
?>
<!DOCTYPE html>
<html>
  <?php require('head.php'); ?>
  <body>
    <?php require('page_header.php'); ?>  
          
    <div class="container-fluid" style="font-size:13px">
      <div class="row-fluid">
      <?php
      if(isset($info)) {
        echo $info;
      }else if(!$need_password) {
      ?>
        <div class="span12">
          <div class="tabbable tabs-left">
            <ul class="nav nav-tabs" id="nav_tab">
              <li class="active"><a href="#tab_A" data-toggle="tab">Main Function</a></li>
              <li class=""><a href="#tab_B" data-toggle="tab">News</a></li>
              <li class=""><a href="#tab_C" data-toggle="tab">Contest</a></li>
              <li class=""><a href="#tab_D" data-toggle="tab">Privilege</a></li>
              <li class=""><a href="#tab_E" data-toggle="tab">Users</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active" id="tab_A">
                <div class="row-fluid">
                  <div class="span3 mainbutton">
                    <h3 class="center">Operation</h3>
                    <a href="newproblem.php" class="btn btn-primary">Add Problem</a>
                    <a href="#" id="btn_rejudge" class="btn btn-info">Rejudge...</a>
                    <div class="alert hide" id="rejudge_res" style="margin-top:20px"></div>
                  </div>
                  <div class="span5">
                    <h3 class="center">Home Page</h3>
                    <form action="#" method="post" id="form_index">
                      <input type="hidden" name="op" value="update_index">
                      <textarea name="text" rows="10" class="border-box" style="width:100%"><?php echo htmlspecialchars($index_text)?></textarea>
                      <div class="alert hide" id="alert_result">Updated successfully.</div>
                      <div class="pull-right">
                        <input type="submit" class="btn btn-small btn-primary" value="Update">
                      </div>
                    </form>
                  </div>
                  <div class="span4">
                    <h3 class="center" id="meter_title">System Info</h3>
                    <div id="cpumeter" class="meter"></div>
                    <div id="memmeter" class="meter"></div>
                  </div>
                </div>
              </div>
              <div class="tab-pane" id="tab_B">
                <div style="margin-left:50px;margin-right:50px">
                  <div id="table_news">
                    <div class="row-fluid">
                      <div class="alert span4">Loading news...</div>
                    </div>
                  </div>
                  <form action="admin.php" method="post" class="form-inline" id="form_news">
                    <label for="input_news" style="display:block">Add News</label>
                    <input type="text" id="input_news" name="news" class="input-xlarge" placeholder="Entering something...">
                    <input type="submit" class="btn" value="Add">
                    <input type="hidden" name="op" value="add_news">
                  </form>
                </div>
              </div>
              <div class="tab-pane" id="tab_C">
                <p>Developing...</p>
              </div>
              <div class="tab-pane" id="tab_D">
                <div style="margin-left:50px">
                  <div id="table_priv"></div>
                  <form action="admin.php" method="post" class="form-inline" id="form_priv">
                    <label for="input_user_id" style="display:block">Add Privilege</label>
                    <input type="text" id="input_user_id" name="user_id" class="input-small" placeholder="User ID">
                    <select name="right" id="slt_right">
                      <option value="administrator">administrator</option>
                      <option value="source_browser">source_browser</option>
                    </select>
                    <input type="submit" class="btn" value="Add">
                    <input type="hidden" name="op" value="add_priv">
                  </form>
                </div>
              </div>
              <div class="tab-pane" id="tab_E">
                <div style="margin-left:50px">
                  <div id="table_usr"></div>
                  <form action="admin.php" method="post" class="form-inline" id="form_usr">
                    <label for="input_dis_usr" style="display:block">Disable a user</label>
                    <input type="text" id="input_dis_usr" name="user_id" class="input-small" placeholder="User ID">
                    <input type="submit" class="btn" value="Disable">
                    <input type="hidden" name="op" value="disable_usr">
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      <?php }else { ?>
        <div class="span5 offset5">
          <form action="admin.php" class="form-inline" method="post">
            <div><label for="input_adminpass">Please enter your password</label></div>
            <input type="password" autofoucs id="input_adminpass" name="paswd" class="input-small">
            <input type="submit" class="btn" value="Go">
          </form>
        </div>
      <?php } ?>
      </div>
      <hr>
      <footer class="muted center" style="font-size:12px;">
        <p>&copy; 2012 Bashu Middle School</p>
      </footer>

    </div>

    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="common.js"></script>
    <script src="../assets/js/highcharts.js"></script>
    <script src="../assets/js/highcharts-more.js"></script>

    <script type="text/javascript">
      $(document).ready(function(){
        $('#ret_url').val("admin.php");
        $('#btn_rejudge').click(function(){
          var obj=$('#rejudge_res').hide();
          var id=prompt("Enter problem ID","");
          if(id!=null){
            id=$.trim(id);
            if(id){
              $.get("rejudge.php?problem_id="+id,function(msg){
                if(/start/.test(msg))obj.addClass('alert-success');
                else obj.addClass('alert-error');
                obj.html(msg).slideDown();
              });
            }
          }
        });
        var getprivlist=function(){$('#table_priv').load('ajax_admin.php',{op:'list_priv'});};
        var getnewslist=function(){$('#table_news').load('ajax_admin.php',{op:'list_news'});};
        var getusrlist=function(){$('#table_usr').load('ajax_admin.php',{op:'list_usr'});};
        $('#nav_tab').click(function(E){
          var jq=$(E.target);
          if(jq.is('a')){
            if(E.target.innerHTML.search(/Privilege/i)!=-1)
              getprivlist();
            else if(E.target.innerHTML.search(/News/i)!=-1)
              getnewslist();
            else if(E.target.innerHTML.search(/User/i)!=-1)
              getusrlist();
          }
        });
        $('#table_usr').click(function(E){
          E.preventDefault();
          var jq=$(E.target);
          if(jq.is('i')){
            var jq_uid=jq.parent().parent().prev(),oper,str_id;
            if(jq.hasClass('icon-remove')){
              jq_uid=jq_uid.prev();
              str_id=jq_uid.contents().filter(function(){return this.nodeType == 3;}).text();
              if(!window.confirm("Are you sure to delete "+str_id))
                return false;
              oper='del_usr';
            }else{
              str_id=jq_uid.contents().filter(function(){return this.nodeType == 3;}).text();
              oper='en_usr';
            }
            $.ajax({
              type:"POST",
              url:"ajax_admin.php",
              data:{
                op:oper,
                user_id:str_id
              },
              success:getusrlist
            });
          }
          return false;
        });
        $('#table_priv').click(function(E){
          E.preventDefault();
          var jq=$(E.target);
          if(jq.is('i')){
            var jq_pri=jq.parent().parent().prev();
            var jq_uid=jq_pri.prev();
            $.ajax({
              type:"POST",
              url:"ajax_admin.php",
              data:{
                op:'del_priv',
                user_id:jq_uid.html(),
                right:jq_pri.html()
              },
              success:getprivlist
            });
          }
          return false;
        });
        $('#form_usr').submit(function(E){
          E.preventDefault();
          $.ajax({
            type:"POST",
            url:"ajax_admin.php",
            data:$('#form_usr').serialize(),
            success:getusrlist
          });
          return false;
        });
        $('#form_priv').submit(function(E){
          E.preventDefault();
          $.ajax({
            type:"POST",
            url:"ajax_admin.php",
            data:$('#form_priv').serialize(),
            success:getprivlist
          });
          return false;
        });
        $('#form_news').submit(function(E){
          E.preventDefault();
          $.ajax({
            type:"POST",
            url:"ajax_admin.php",
            data:$('#form_news').serialize(),
            success:getnewslist
          });
          return false;
        });
        $('#table_news').click(function(E){
          E.preventDefault();
          var jq=$(E.target);
          if(jq.is('i')){
            var jq_id=jq.parent().parent().prev().prev().prev();
            $.ajax({
              type:"POST",
              url:"ajax_admin.php",
              data:{
                op:'del_news',
                news_id:jq_id.html()
              },
              success:function(){jq_id.parent().remove();}
            });
          }
          return false;
        });
        $('#form_index').submit(function(E){
          E.preventDefault();
          $('#alert_result').hide();
          $.ajax({
            type:"POST",
            url:"ajax_admin.php",
            data:$('#form_index').serialize(),
            success:function(msg){
              if(/success/.test(msg))
                $('#alert_result').show();
            }
          });
          return false;
        });
      });

      function update_chart(){
        $.getJSON('ajax_usage.php',function(data){
          // console.log(data);
          if(data&&"number"==typeof(data.cpu)){
            if(!window.cpuChart){
              window.cpuChart = new Highcharts.Chart({
                chart: {
                  renderTo: 'cpumeter',
                },        
                yAxis: [{
                  title: {
                    text: 'CPU'
                  }
                }],
                series: [{
                  data: [0],
                  yAxis: 0
                }]
              });
              // console.log("cpuChart");
              console.log(window.cpuChart);
            }
            cpuChart.series[0].points[0].update(data.cpu,true);
          }
          if(data&&"number"==typeof(data.mem)){
            if(!window.memChart){
              window.memChart = new Highcharts.Chart({
                chart: {
                  renderTo: 'memmeter',
                },        
                yAxis: [{
                  title: {
                    text: 'Memory'
                  }
                }],
                series: [{
                  data: [0],
                  yAxis: 0
                }]
              });
              // console.log("memChart");
              console.log(window.memChart);

              $('#meter_title').show();
            }
            memChart.series[0].points[0].update(data.mem,true);
          }

          setTimeout('update_chart()',3000);
        });
      }
      $(function () {
        Highcharts.setOptions({
          chart: {
            type: 'gauge',
            plotBorderWidth: 1,
            plotBackgroundColor: {
              linearGradient: { x1: 0, y1: 0, x2: 0, y2: 1 },
              stops: [
                [0, '#FFF9D9'],
                [0.2, '#FFFFFF'],
                [1, '#FFF4C6']
              ]
            },
            plotBackgroundImage: null,
            height: 150
          },
          credits: {
            enabled: false
          },

          title: {
            text: null//'VU meter'
          },
          
          pane: [{
            startAngle: -45,
            endAngle: 45,
            background: null,
            center: ['50%', '145%'],
            size: 260
          }],                 
        
          yAxis: [{
            min: 0,
            max: 100,
            tickInterval: 25,
            minorTickPosition: 'outside',
            tickPosition: 'outside',
            labels: {
              rotation: 'auto',
              distance: 20,
              formatter: function() {
                return this.value + '%';
              }
            },
            plotBands: [{
              from: 70,
              to: 100,
              color: '#C02316',
              innerRadius: '100%',
              outerRadius: '105%'
            }],
            pane: 0,
            title: {
              // text: 'Memory',
              y: -40
            }
          }],
          plotOptions: {
            gauge: {
              animation: false,
              dataLabels: {
                enabled: false
              },
              dial: {
                radius: '100%'
              }
            }
          },
          series: [{
            data: [0],
            yAxis: 0
          }]
        });

        update_chart();
      });
    </script>
  </body>
</html>