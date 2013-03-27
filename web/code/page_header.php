<!--[if lt IE 9]>
  <script>window.fix_ie_pre=true;</script>
<![endif]-->
<!--[if IE 6]>
  <script>var LETSKILLIE6_DELAY=1;</script>
  <script src="http://letskillie6.googlecode.com/svn/trunk/2/zh_CN.js"></script>
<![endif]-->
<?php
require_once 'inc/preferences.php';
if(isset($_SESSION['pref']))
  $pref=unserialize($_SESSION['pref']);
else
  $pref=new preferences();

if($pref->hidelogo=='off'){ ?>
<header>
  <a href="index.php"><img src="../assets/img/logo.jpg" alt="Logo" class="img-rounded"></a>
</header>
<div class="navbar hide" id="navbar_pseude">
  <div class="navbar-inner" style="padding:0"></div>
</div>
<div class="navbar" id="navbar_top">
<?php }else{?>
<div class="navbar" id="navbar_pseude">
  <div class="navbar-inner" style="padding:0"></div>
</div>
<div class="navbar navbar-fixed-top" id="navbar_top">
<?php }?>
  <div class="navbar-inner" style="padding:0">
    <div class="container-fluid navbar-padding-fix">
      <a class="brand" href="index.php"><i class="icon-home"></i> Bashu OnlineJudge</a>
      <div class="btn-group pull-right">

<?php if(isset($_SESSION['user'])){?>
        <a class="btn dropdown-toggle" data-toggle="dropdown" style="white-space:nowrap" href="#">
          <i class="icon-user"></i>
          <?php
          echo $_SESSION['user'],'<strong id="notifier"></strong>';
          ?>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="mail.php" id="nav_mail"><i class="icon-envelope"></i> mailbox</a></li>
          <li><a href="profile.php"><i class="icon-github"></i> profile</a></li>
          <li><a href="control.php"><i class="icon-cogs"></i> preference</a></li>
<?php   if(isset($_SESSION['administrator']))
          echo '<li class="divider"></li><li><a href="admin.php"><i class="icon-bolt"></i>admin</a></li>'; 
?>
          <li class="divider"></li>
          <li><a id='logoff_btn' href="#"><i class="icon-signout"></i> sign out</a></li>
        </ul>
<?php }else{?>
        <a id="login_btn" title="Alt+L" data-toggle="modal" href="#LoginModal" class="btn">Login</a>
        <a href="reg.php" class="btn">Sign Up</a>
<?php }?>
      </div>
        <ul class="nav">
          <li><a id="nav_bbs" title="Alt+B" href="board.php"><i class="icon-bullhorn"></i> Board</a></li>
          <li><a id="nav_set" href="problemset.php"><i class="icon-th-list"></i> Problemset</a></li>
          <li><a id="nav_prob" title="Alt+P" href="problempage.php"><i class="icon-play-circle"></i> Problem</a></li>
          <li><a id="nav_record" title="Alt+R" href="record.php"><i class="icon-camera"></i> Record</a></li>
          <li><a id="nav_rank" href="ranklist.php"><i class="icon-thumbs-up"></i> Ranklist</a></li>
          <li><a id="nav_about" href="about.php"><i class="icon-phone"></i> About</a></li>
        </ul>
        <form class="navbar-search pull-left" id="search_form" action="search.php" method="get">
          <input type="text" name="q" title="Alt+I" id="search_input" class="search-query input-medium" style="margin-bottom:0px;width:auto;" autocomplete="off" placeholder="Problem ID,Title,Source">
        </form>
    </div>
  </div>
</div>    
<div class="modal hide" id="LoginModal">
  <form id="form_login" style="margin:0px" action="login.php" method="post">
    <div class="modal-header">
      <a class="close" data-dismiss="modal">×</a>
      <h4>Login Window</h4>
    </div>
    <div class="modal-body">
      <div id="uid_ctl" class="control-group">
        <label class="control-label" for="uid">Name:</label>
        <div class="controls">
          <input type="text" id="uid" name="uid" placeholder="Username">
        </div>
      </div>
      <div id="pwd_ctl" class="control-group">
          <label class="control-label" for="pwd">Password:</label>
          <div class="controls">
            <input id="pwd" name="pwd" type="password" placeholder="Password">
          </div> </div>
      <div class="control-group">
        <div class="controls">
          <label class="checkbox">
            <input type="checkbox" name="remember">&nbsp;Remember me
          </label>
        </div>
      </div>
      <input id="ret_url" name="url" type="hidden"><!--value=""-->
    </div>
    <div class="modal-footer">
      <input id="signin" type="submit" value="Sign in" class="btn btn-primary">
      <a href="#" class="btn" data-dismiss="modal">Cancel</a>
    </div>
  </form>
</div>
    
