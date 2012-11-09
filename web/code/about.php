<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>About Bashu OnlineJudge</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="../assets/css/bootstrap.css" rel="stylesheet">
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link href="../assets/css/docs.css" rel="stylesheet">
    <!--[if IE 6]>
    <link href="ie6.min.css" rel="stylesheet">
    <![endif]-->
    <!--[if lt IE 9]>
      <script src="../assets/js/html5.js"></script>
    <![endif]-->
    <style type="text/css">
    #tab_options td:last-child{text-align: left;}
    .about-page .page-header{margin-bottom: 9px;}
    </style>
  </head>

  <body>
    <?php session_start();require('page_header.php'); ?>  
          
    <div class="container-fluid about-page">
      <div class="row-fluid">
        <div class="offset2 span8" style="font-size:16px">
          <div class="page-header">
            <h2>About</h2>
          </div>
          <p>Bashu OnlineJudge is a system designed for OI training.You can find problems in the problemset
             and submit solutions. OnlineJudge system allows you to test your solution for every problem.</p>
          <p>Bashu OnlineJudge is an open source project.</p>
          <p>&nbsp;</p>
          <p>Developers:<br>&nbsp;&nbsp;Zhang YuXiang<br>&nbsp;&nbsp;Yang Zhixuan</p>
        </div>
      </div>
      <div class="row-fluid">
        <div class="offset2 span8" style="font-size:16px">
          <div class="page-header">
            <h2>FAQ</h2>
          </div>
          <div class="page-header">
            <h3>Q: What is the compiler the judge is using and what are the compiler options?</h3>
            A: We are using GNU GCC/G++ for C/C++ compile, Free Pascal for pascal compile. The compile options are:
            <table class="table table-striped table-bordered table-condensed" id="tab_options">
              <tbody>
                <tr>
                  <td>C++</td>
                  <td>g++ -static -fno-asm -s -w -O -DONLINE_JUDGE</td>
                </tr>
                <tr>
                  <td>C</td>
                  <td>gcc -static -fno-asm -s -w -O -DONLINE_JUDGE</td>
                </tr>
                <tr>
                  <td>Pascal</td>
                  <td>fpc -Xs -Sgic -dONLINE_JUDGE</td>
                </tr>
                <tr>
                  <td>C++ 11</td>
                  <td>g++ -static --std=gnu++0x -O -DONLINE_JUDGE</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="page-header">
            <h3>Q: Where are the input and the output?</h3>
            A: Your program shall read input from stdin('Standard Input') and write output to stdout('Standard Output').For example,you can use 'scanf' in C or 'cin' in C++ to read from stdin,and use 'printf' in C or 'cout' in C++ to write to stdout.<br>User programs are not allowed to open and read from/write to files, you will get a "Runtime Error" if you try to do so.
          </div>
          <div class="page-header">
            <h3>Q: What is the meaning of the judge's replies?</h3>
            A: Here is a list of the judge's replies and their meaning:<br>
            <span class="label label-success">Accepted</span>&nbsp;OK! Your program is correct!.<br>
            <span class="label">Compile Error</span>&nbsp;The compiler could not compile your program. Of course, warning messages are not error messages.<br>
            <span class="label label-warning">Memory Exceeded</span>&nbsp;Your program tried to use more memory than the problem settings.<br>
            <span class="label label-info">Runtime Error</span>&nbsp;Your program failed during the execution (illegal file access, stack overflow, pointer reference out of range, floating point exception, divided by zero...).<br>
            <span class="label label-warning">Time Out</span>&nbsp;Your program tried to run during too much time.<br>
            <span class="label label-important">Wrong Answer</span>&nbsp;The solution has not produced the desired output.<br>
            <span class="label label-inverse">Validator Error</span>&nbsp;The checker program has exhibited abnormal behavior while validating the output produced by the solution.
          </div>
          <h5>Any questions/suggestions please post to <a href="board.php">web board</a>.</h5>
        </div>
      </div>
      <hr>
      <footer class="muted center" style="font-size:12px">
        <p>&copy; 2012 Bashu Middle School</p>
      </footer>
    </div>
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/bootstrap-modal.js"></script>
    <script src="../assets/js/bootstrap-dropdown.js"></script>
    <script src="common.js"></script>
    <script type="text/javascript"> 
      $(document).ready(function(){
        $('#ret_url').val("about.php");
        $('#nav_about').parent().addClass('active');
      });
    </script>
  </body>
</html>