
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>层先法教学助手（beta版），20分钟无成本学会魔方复原</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/jumbotron-narrow.css" rel="stylesheet">
    <link href="css/cube.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

	<!--[if IE]>
			<link rel="stylesheet" href="css/ie.css" type="text/css" />
		<![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="container">
      <div class="header" style="text-align:center;padding:10px;">
        <h2 class="text-muted">魔方复原助手</h2>
      </div>

      <div id="introduce" class="jumbotron" style="text-align: left;">
        <h3>“30分钟学会层先法复原魔方，如何做到呢？”</h3>
        <p></p>
        <p class="lead">1.约需用2分钟，将魔方状态输入软件</p>
        <p class="lead">2.软件用层先法解魔方，并手把手教给您复原</p>
        <p><a class="btn btn-lg btn-success" href="#" role="button">现在开始</a></p>
      </div>

      <div id="set_cube" class="jumbotron" style="padding-right:5px; padding-left:5px; padding-top:5px; padding-bottom:5px;">
      		<h3 style="margin:10px">“请耐心设置魔方哟”</h3>
      		<div id="cube1">
      			<ul>
					<li class="cube row1 col1 pos1">
						<a>
							<span class="empty" id="block_9"></span>
							<span class="fill" id="block_0">下方<br>选色</span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row1 col2 pos1">
						<a>
							<span class="empty" id="block_10"></span>
							<span class="empty" id="block_3"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row1 col3 pos1">
						<a>
							<span class="empty" id="block_11"></span>
							<span class="empty" id="block_6"></span>
							<span class="empty" id="block_18"></span>
						</a>
					</li>
					
					
					<!-- ROW 2, POS 1 -->
					
					<li class="cube row2 col1 pos1">
						<a>
							<span class="empty" id="block_12"></span>
							<span class="empty"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row2 col2 pos1">
						<a>
							<span class="red" id="block_13"></span>
							<span class="empty"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row2 col3 pos1">
						<a>
							<span class="empty" id="block_14"></span>
							<span class="empty"></span>
							<span class="empty" id="block_21"></span>
						</a>
					</li>
					
					<!-- ROW 3, POS 1 -->				
					
					<li class="cube row3 col1 pos1">
						<a>
							<span class="empty" id="block_15"></span>
							<span class="empty"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row3 col2 pos1">
						<a>
							<span class="empty" id="block_16"></span>
							<span class="empty"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row3 col3 pos1">
						<a>
							<span class="empty" id="block_17"></span>
							<span class="empty"></span>
							<span class="empty" id="block_24"></span>
						</a>
					</li>
					
					<!-- ROW 1, POS 2 -->
					
					<li class="cube row1 col1 pos2">
						<a>
							<span class="empty"></span>
							<span class="empty" id="block_1"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row1 col2 pos2">
						<a>
							<span class="empty"></span>
							<span class="yellow" id="block_4"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row1 col3 pos2">
						<a>
							<span class="empty"></span>
							<span class="empty" id="block_7"></span>
							<span class="empty" id="block_19"></span>
						</a>
					</li>
					
					<!-- ROW 2, POS 2 -->
					
					<li class="cube row2 col3 pos2">
						<a>
							<span class="empty"></span>
							<span class="empty"></span>
							<span class="green" id="block_22"></span>
						</a>
					</li>
					
					<!-- ROW 3, POS 2 -->
					
					<li class="cube row3 col3 pos2">
						<a>
							<span class="empty"></span>
							<span class="empty"></span>
							<span class="empty" id="block_25"></span>
						</a>
					</li>
					
					<!-- ROW 1, POS 3 -->
					
					<li class="cube row1 col1 pos3">
						<a>
							<span class="empty"></span>
							<span class="empty" id="block_2"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row1 col2 pos3">
						<a>
							<span class="empty"></span>
							<span class="empty" id="block_5"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row1 col3 pos3">
						<a>
							<span class="empty"></span>
							<span class="empty" id="block_8"></span>
							<span class="empty" id="block_20"></span>
						</a>
					</li>
					
					<!-- ROW 2, POS 3 -->
					
					<li class="cube row2 col3 pos3">
						<a>
							<span class="empty"></span>
							<span class="empty"></span>
							<span class="empty" id="block_23"></span>
						</a>
					</li>
					 
					
					<!-- ROW 3, POS 3 -->
					
					<li class="cube row3 col3 pos3">
						<a>
							<span class="empty"></span>
							<span class="empty"></span>
							<span class="empty" id="block_26"></span>
						</a>
					</li>
	
				</ul>
			</div>

			<div id="cube2">
      			<ul>
					<li class="cube row1 col1 pos1">
						<a>
							<span class="empty" id="block_36"></span>
							<span class="fill" id="block_27"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row1 col2 pos1">
						<a>
							<span class="empty" id="block_37"></span>
							<span class="empty" id="block_30"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row1 col3 pos1">
						<a>
							<span class="empty" id="block_38"></span>
							<span class="empty" id="block_33"></span>
							<span class="empty" id="block_45"></span>
						</a>
					</li>
					
					
					<!-- ROW 2, POS 1 -->
					
					<li class="cube row2 col1 pos1">
						<a>
							<span class="empty" id="block_39"></span>
							<span class="empty"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row2 col2 pos1">
						<a>
							<span class="blue" id="block_40"></span>
							<span class="empty"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row2 col3 pos1">
						<a>
							<span class="empty" id="block_41"></span>
							<span class="empty"></span>
							<span class="empty" id="block_48"></span>
						</a>
					</li>
					
					<!-- ROW 3, POS 1 -->				
					
					<li class="cube row3 col1 pos1">
						<a>
							<span class="empty" id="block_42"></span>
							<span class="empty"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row3 col2 pos1">
						<a>
							<span class="empty" id="block_43"></span>
							<span class="empty"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row3 col3 pos1">
						<a>
							<span class="empty" id="block_44"></span>
							<span class="empty"></span>
							<span class="empty" id="block_51"></span>
						</a>
					</li>
					
					<!-- ROW 1, POS 2 -->
					
					<li class="cube row1 col1 pos2">
						<a>
							<span class="empty"></span>
							<span class="empty" id="block_28"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row1 col2 pos2">
						<a>
							<span class="empty"></span>
							<span class="white" id="block_31"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row1 col3 pos2">
						<a>
							<span class="empty"></span>
							<span class="empty" id="block_34"></span>
							<span class="empty" id="block_46"></span>
						</a>
					</li>
					
					<!-- ROW 2, POS 2 -->
					
					<li class="cube row2 col3 pos2">
						<a>
							<span class="empty"></span>
							<span class="empty"></span>
							<span class="oringe" id="block_49"></span>
						</a>
					</li>
					
					<!-- ROW 3, POS 2 -->
					
					<li class="cube row3 col3 pos2">
						<a>
							<span class="empty"></span>
							<span class="empty"></span>
							<span class="empty" id="block_52"></span>
						</a>
					</li>
					
					<!-- ROW 1, POS 3 -->
					
					<li class="cube row1 col1 pos3">
						<a>
							<span class="empty"></span>
							<span class="empty" id="block_29"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row1 col2 pos3">
						<a>
							<span class="empty"></span>
							<span class="empty" id="block_32"></span>
							<span class="empty"></span>
						</a>
					</li>
					
					<li class="cube row1 col3 pos3">
						<a>
							<span class="empty"></span>
							<span class="empty" id="block_35"></span>
							<span class="empty" id="block_47"></span>
						</a>
					</li>
					
					<!-- ROW 2, POS 3 -->
					
					<li class="cube row2 col3 pos3">
						<a>
							<span class="empty"></span>
							<span class="empty"></span>
							<span class="empty" id="block_50"></span>
						</a>
					</li>
					 
					
					<!-- ROW 3, POS 3 -->
					
					<li class="cube row3 col3 pos3">
						<a>
							<span class="empty"></span>
							<span class="empty"></span>
							<span class="empty" id="block_53"></span>
						</a>
					</li>
	
				</ul>
			</div>
			
			<div id="set_color">
				<p class="tips">
					<span id="white" class="white">白</span>
					<span id="red" class="red">红</span>
					<span id="green" class="green">绿</span>
					<span id="yellow" class="yellow">黄</span>
					<span id="oringe" class="oringe">橙</span>
					<span id="blue" class="blue">蓝</span>
				</p>
			</div>

			<div id="next_step">
				<form id="form" method="POST" action="cube_teacher.php">
				<input type="hidden" id="form_block_0" name="block[0]" value="">
				<input type="hidden" id="form_block_1" name="block[1]" value="">
				<input type="hidden" id="form_block_2" name="block[2]" value="">
				<input type="hidden" id="form_block_3" name="block[3]" value="">
				<input type="hidden" id="form_block_4" name="block[4]" value="yellow">
				<input type="hidden" id="form_block_5" name="block[5]" value="">
				<input type="hidden" id="form_block_6" name="block[6]" value="">
				<input type="hidden" id="form_block_7" name="block[7]" value="">
				<input type="hidden" id="form_block_8" name="block[8]" value="">

				<input type="hidden" id="form_block_9" name="block[9]" value="">
				<input type="hidden" id="form_block_10" name="block[10]" value="">
				<input type="hidden" id="form_block_11" name="block[11]" value="">
				<input type="hidden" id="form_block_12" name="block[12]" value="">
				<input type="hidden" id="form_block_13" name="block[13]" value="red">
				<input type="hidden" id="form_block_14" name="block[14]" value="">
				<input type="hidden" id="form_block_15" name="block[15]" value="">
				<input type="hidden" id="form_block_16" name="block[16]" value="">
				<input type="hidden" id="form_block_17" name="block[17]" value="">

				<input type="hidden" id="form_block_18" name="block[18]" value="">
				<input type="hidden" id="form_block_19" name="block[19]" value="">
				<input type="hidden" id="form_block_20" name="block[20]" value="">
				<input type="hidden" id="form_block_21" name="block[21]" value="">
				<input type="hidden" id="form_block_22" name="block[22]" value="green">
				<input type="hidden" id="form_block_23" name="block[23]" value="">
				<input type="hidden" id="form_block_24" name="block[24]" value="">
				<input type="hidden" id="form_block_25" name="block[25]" value="">
				<input type="hidden" id="form_block_26" name="block[26]" value="">

				<input type="hidden" id="form_block_27" name="block[27]" value="">
				<input type="hidden" id="form_block_28" name="block[28]" value="">
				<input type="hidden" id="form_block_29" name="block[29]" value="">
				<input type="hidden" id="form_block_30" name="block[30]" value="">
				<input type="hidden" id="form_block_31" name="block[31]" value="white">
				<input type="hidden" id="form_block_32" name="block[32]" value="">
				<input type="hidden" id="form_block_33" name="block[33]" value="">
				<input type="hidden" id="form_block_34" name="block[34]" value="">
				<input type="hidden" id="form_block_35" name="block[35]" value="">

				<input type="hidden" id="form_block_36" name="block[36]" value="">
				<input type="hidden" id="form_block_37" name="block[37]" value="">
				<input type="hidden" id="form_block_38" name="block[38]" value="">
				<input type="hidden" id="form_block_39" name="block[39]" value="">
				<input type="hidden" id="form_block_40" name="block[40]" value="blue">
				<input type="hidden" id="form_block_41" name="block[41]" value="">
				<input type="hidden" id="form_block_42" name="block[42]" value="">
				<input type="hidden" id="form_block_43" name="block[43]" value="">
				<input type="hidden" id="form_block_44" name="block[44]" value="">

				<input type="hidden" id="form_block_45" name="block[45]" value="">
				<input type="hidden" id="form_block_46" name="block[46]" value="">
				<input type="hidden" id="form_block_47" name="block[47]" value="">
				<input type="hidden" id="form_block_48" name="block[48]" value="">
				<input type="hidden" id="form_block_49" name="block[49]" value="oringe">
				<input type="hidden" id="form_block_50" name="block[50]" value="">
				<input type="hidden" id="form_block_51" name="block[51]" value="">
				<input type="hidden" id="form_block_52" name="block[52]" value="">
				<input type="hidden" id="form_block_53" name="block[53]" value="">

				<a class="btn btn-default btn-primary" id="roll_back" role="button" style="width:60px;">倒退</a> &nbsp; <button id="start_resolve" type="submit" class="btn btn-default btn-success" style="width:140px;">开始学习复原</button>
				</form>
			</div>
      </div>

      <!--<div class="row marketing">
        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>

        <div class="col-lg-6">
          <h4>Subheading</h4>
          <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

          <h4>Subheading</h4>
          <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

          <h4>Subheading</h4>
          <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>
      </div>-->

      <div class="footer">
        <p>&copy; Company 2014</p>
      </div>

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/jquery.min.js"></script>
    <script src="js/ie-emulation-modes-warning.js"></script>
    <script src="js/cube.js"></script>
  </body>
  </html>

  