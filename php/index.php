
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="魔方，复原，还原，教程，教学，公式，图解，口诀，最强魔方教程, 魔方教程">
    <meta name="description" content="这是一款三阶魔方初学者教学软件（魔方教程），可以手把手像一位老师一样，一步一步的教你复原魔方">
    <meta name="author" content="sunweiwei">
    <meta http-equiv="Cache-Control" content="no-transform" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0" />
    <link rel="SHORTCUT ICON" href="../img/webicon.ico">

    <title>完爆所有魔方教程，30分钟手把手教你复原-魔方教学软件、最强魔方教程</title>

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
    <script type="text/javascript" name="baidu-tc-cerfication" src="http://apps.bdimg.com/cloudaapi/lightapp.js#bffe21adcbed5fa38d0395965a479af7"></script><script type="text/javascript">window.bd && bd._qdc && bd._qdc.init({app_id: '145ee1d9ef36af20f2399548'});</script>
  </head>

  <body>
<?php
function CheckSubstrs($substrs,$text){
        foreach($substrs as $substr)
            if(false!==strpos($text,$substr)){
            return true;
        }
        return false;
}

function isMobile(){
    $useragent=isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : '';
    $useragent_commentsblock=preg_match('|\(.*?\)|',$useragent,$matches)>0?$matches[0]:'';
    
    $mobile_os_list=array('Google Wireless Transcoder','Windows CE','WindowsCE','Symbian','Android','armv6l','armv5','Mobile','CentOS','mowser','AvantGo','Opera Mobi','J2ME/MIDP','Smartphone','Go.Web','Palm','iPAQ');
    $mobile_token_list=array('Profile/MIDP','Configuration/CLDC-','160×160','176×220','240×240','240×320','320×240','UP.Browser','UP.Link','SymbianOS','PalmOS','PocketPC','SonyEricsson','Nokia','BlackBerry','Vodafone','BenQ','Novarra-Vision','Iris','NetFront','HTC_','Xda_','SAMSUNG-SGH','Wapaka','DoCoMo','iPhone','iPod');
 
    $found_mobile=CheckSubstrs($mobile_os_list,$useragent_commentsblock) ||
    CheckSubstrs($mobile_token_list,$useragent);
 
    if ($found_mobile){
        return true;
    }else{
        return false;
    }
}
?>
    <div class="container">
      <div class="header" style="text-align:center;padding:10px;" id="top">

      	<ul class="nav nav-pills pull-right" role="tablist" id="restart">
          <li role="presentation" class="active"><a href="#" onclick="location.reload()">重来</a></li>
        </ul>
        <h3 class="text-muted">魔方复原助手</h3>
      </div>
		<?php 
			if(!isMobile()){
			echo '<div class="bdsharebuttonbox"><a href="#" class="bds_more" data-cmd="more">分享：</a><a href="#" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a><a href="#" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a><a href="#" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a><a href="#" class="bds_renren" data-cmd="renren" title="分享到人人网"></a><a href="#" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a></div>';
			}

		?>
		<script>window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"http://www.rubiksdiy.com/cube_teacher/img/intro.jpg","bdStyle":"0","bdSize":"16"},"share":{},"selectShare":{"bdContainerClass":null,"bdSelectMiniList":["qzone","tsina","tqq","renren","weixin"]}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];</script>


      <div id="introduce" class="jumbotron" style="text-align: left;">
        <h3>“30分钟学会层先法复原魔方，如何做到呢？”</h3>
        <hr>
        <p class="lead">1.约需用2分钟，将魔方状态输入软件<br><img src="img/input_method.png" width="100%"></p>
        <p class="lead">2.软件用层先法(7大步)解魔方，并一步一步教给您复原<br><img src="img/steps.png" width="100%"></p>
        <p class="lead">3.新手在复原过程中，在屏幕下方，可以点击“公式图例”查看公式并强化记忆，可点击“本步骤技巧”，学习当前步骤的复原技巧，以最终做到脱离该教程自己复原！<br><img src="img/tips.png" width="100%"></p>
        <p class="lead">4.按照本软件提供的方法，要做到脱离魔方教程复原，只需要记忆9个公式，而这9个公式很多做法是对称的，9个公式加起来的信息记忆量不及一首七言律诗！：）简单吧！<br></p>
        <p class="lead">5.我们的魔方教程还在努力完善功能中，有任何问题欢迎反馈到flst@qq.com，感谢支持！<br>
        <p class="lead"><b><font color="#ff0000">6.只要您有耐心，慢慢学与做，我相信该软件一定能教会您，加油！</font></b><br></p>
        <hr>

        <?php 
        if(!isset($_GET['tn']) || $_GET['tn']!='lightapp') {
	        if(isMobile()) {
	        	echo "<p style='font-size:12px;'>也可以通过电脑访问：http://www.rubiksdiy.com/cube_teacher/</p>";
	        }
	        else {
	        	echo "<p style='font-size:14px;'>微信扫一扫，可用手机访问，并分享至朋友圈<br><img src='img/qrcode.png' width='200px'></p>";
	        }
        }

        ?>
        <p><a id="getting_start" class="btn btn-default btn-success" href="#top" role="button">现在开始输入魔方</a><span class='hint'>魔方教程</span></p>
		<h3>手上没有魔方？别着急</h3>
        <p><a id="getting_start_by_disrupt_cube" class="btn btn-default btn-success" href="#top" role="button">点击随机打乱魔方</a><span class='hint'>魔方教程</span></p>
      </div>
	  
 

      <div id="set_cube" step=-1 class="jumbotron" style="padding-right:5px; padding-left:5px; padding-top:5px; padding-bottom:15px;">
      		<h3 style="margin:10px" id="set_cube_title">“请按照你手上魔方的状态，耐心输入魔方哟”</h3>
      		<p id="cube_disruptor_formula">建议使用标准配色魔方，摆放为：红前、橙后、绿右、蓝左、黄上、白下<span class='hint'>魔方教程</span></p>
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

			<div id="set_color" class="set_color">
				<p class="tips">
					<span id="white" class="white">白</span>
					<span id="red" class="red">红</span>
					<span id="green" class="green">绿</span>
					<span id="yellow" class="yellow">黄</span>
					<span id="oringe" class="oringe">橙</span>
					<span id="blue" class="blue">蓝</span>
				</p>
			</div>

			<div id="button_area">
				<a class="btn btn-default btn-primary roll_back" id="roll_back" role="button" style="width:60px;">倒退</a> 
			</div>

			<div id="cube2">
      			<ul>
					<li class="cube row1 col1 pos1">
						<a>
							<span class="empty" id="block_36"></span>
							<span class="empty" id="block_27"></span>
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
			
			<div id="set_color" class="set_color">
				<p class="tips">
					<span id="white" class="white">白</span>
					<span id="red" class="red">红</span>
					<span id="green" class="green">绿</span>
					<span id="yellow" class="yellow">黄</span>
					<span id="oringe" class="oringe">橙</span>
					<span id="blue" class="blue">蓝</span>
				</p>
			</div>

			<div id="button_area">
				<form id="cube_form" method="POST" action="cube_teacher.php">
				<input type="hidden" id="form_block_0" name="block[]" value="">
				<input type="hidden" id="form_block_1" name="block[]" value="">
				<input type="hidden" id="form_block_2" name="block[]" value="">
				<input type="hidden" id="form_block_3" name="block[]" value="">
				<input type="hidden" id="form_block_4" name="block[]" value="yellow">
				<input type="hidden" id="form_block_5" name="block[]" value="">
				<input type="hidden" id="form_block_6" name="block[]" value="">
				<input type="hidden" id="form_block_7" name="block[]" value="">
				<input type="hidden" id="form_block_8" name="block[]" value="">

				<input type="hidden" id="form_block_9" name="block[]" value="">
				<input type="hidden" id="form_block_10" name="block[]" value="">
				<input type="hidden" id="form_block_11" name="block[]" value="">
				<input type="hidden" id="form_block_12" name="block[]" value="">
				<input type="hidden" id="form_block_13" name="block[]" value="red">
				<input type="hidden" id="form_block_14" name="block[]" value="">
				<input type="hidden" id="form_block_15" name="block[]" value="">
				<input type="hidden" id="form_block_16" name="block[]" value="">
				<input type="hidden" id="form_block_17" name="block[]" value="">

				<input type="hidden" id="form_block_18" name="block[]" value="">
				<input type="hidden" id="form_block_19" name="block[]" value="">
				<input type="hidden" id="form_block_20" name="block[]" value="">
				<input type="hidden" id="form_block_21" name="block[]" value="">
				<input type="hidden" id="form_block_22" name="block[]" value="green">
				<input type="hidden" id="form_block_23" name="block[]" value="">
				<input type="hidden" id="form_block_24" name="block[]" value="">
				<input type="hidden" id="form_block_25" name="block[]" value="">
				<input type="hidden" id="form_block_26" name="block[]" value="">

				<input type="hidden" id="form_block_27" name="block[]" value="">
				<input type="hidden" id="form_block_28" name="block[]" value="">
				<input type="hidden" id="form_block_29" name="block[]" value="">
				<input type="hidden" id="form_block_30" name="block[]" value="">
				<input type="hidden" id="form_block_31" name="block[]" value="white">
				<input type="hidden" id="form_block_32" name="block[]" value="">
				<input type="hidden" id="form_block_33" name="block[]" value="">
				<input type="hidden" id="form_block_34" name="block[]" value="">
				<input type="hidden" id="form_block_35" name="block[]" value="">

				<input type="hidden" id="form_block_36" name="block[]" value="">
				<input type="hidden" id="form_block_37" name="block[]" value="">
				<input type="hidden" id="form_block_38" name="block[]" value="">
				<input type="hidden" id="form_block_39" name="block[]" value="">
				<input type="hidden" id="form_block_40" name="block[]" value="blue">
				<input type="hidden" id="form_block_41" name="block[]" value="">
				<input type="hidden" id="form_block_42" name="block[]" value="">
				<input type="hidden" id="form_block_43" name="block[]" value="">
				<input type="hidden" id="form_block_44" name="block[]" value="">

				<input type="hidden" id="form_block_45" name="block[]" value="">
				<input type="hidden" id="form_block_46" name="block[]" value="">
				<input type="hidden" id="form_block_47" name="block[]" value="">
				<input type="hidden" id="form_block_48" name="block[]" value="">
				<input type="hidden" id="form_block_49" name="block[]" value="oringe">
				<input type="hidden" id="form_block_50" name="block[]" value="">
				<input type="hidden" id="form_block_51" name="block[]" value="">
				<input type="hidden" id="form_block_52" name="block[]" value="">
				<input type="hidden" id="form_block_53" name="block[]" value="">

				<a class="btn btn-default btn-primary roll_back" id="roll_back" role="button" style="width:60px;">倒退</a> &nbsp; <a id="start_resolve" class="btn btn-default btn-success" href="#top" nextstep=0 style="width:140px;">开始学习复原</a>
				</form>
			</div>
      </div>

	  <div id="step_0" step=0 class="jumbotron" style="text-align: left;">
        <h3>“执行复原前，请认真学习下公式的基础概念”</h3>
        <p></p>
        <p class="lead"><img src="img/formula_1.jpg" width="100%"><br>
        		<img src="img/formula_2.jpg" width="100%"></p>
        <p><a id="getting_start" class="btn btn-default btn-success" href="#top" nextstep=1 role="button">开始执行复原</a></p>
      </div>

     
      <div class="modal fade" id="basic_concept" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="myModalLabel">开始设置魔方前，了解下基础概念<span class='hint'>魔方教程</span></h4>
      		</div>
      		<div class="modal-body">
        		块的概念、面的概念</b><br><img src="img/basic_concept.png" width="100%">
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">我知道了<span class='hint'>魔方教程</span></button>
      		</div>
    		</div>
  		</div>
	</div>

      <div class="modal fade" id="start_cube_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="myModalLabel">开始前请将魔方调整到如下状态<span class='hint'>魔方教程</span></h4>
      		</div>
      		<div class="modal-body">
        		<img src="img/start_cube.png" width="100%">
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">我知道了<span class='hint'>魔方教程</span></button>
      		</div>
    		</div>
  		</div>
	</div>

	<div class="modal fade" id="cube_formula_demo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="myModalLabel">魔方公式图例</h4>
      		</div>
      		<div class="modal-body">
        		<img src="img/formula_1.jpg" width="100%"><br>
        		<img src="img/formula_2.jpg" width="100%">
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      		</div>
    		</div>
  		</div>
	</div>

	<div class="modal fade" id="share_your_result" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="myModalLabel">欢迎点击屏幕右上角分享 <img src="img/share_result.png"></h4>
      		</div>
      		<div class="modal-body" id="share_your_result_content">
        		
      		</div>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">关闭<span class='hint'>魔方教程</span></button>
      		</div>
    		</div>
  		</div>
	</div>

	<div class="modal fade" id="share_your_result_by_pc" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      		<div class="modal-header bdsharebuttonbox">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">欢迎分享给微信好友</h4>
      		</div>
      		
      		<div class="modal-body" id="share_your_result_content_by_pc">
      				
      		</div>

      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">关闭<span class='hint'>魔方教程</span></button>
      		</div>
    		</div>
  		</div>
	</div>

	<div class="modal fade" id="submit_your_commends" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      		<div class="modal-header bdsharebuttonbox">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="myModalLabel">给软件作者提建议</h4>
      		</div>
      		
      		<div class="modal-body" id="submit_your_commends_content">

        		<p>昵称：<input id="nickname" type="input"></input></p>
        		<br/>
       			<p>邮箱：<input id="email" type="input"></input></p>
       			<br/>
       			<p>建议：</p>
        		<p><textarea id="feedback_text" style="width:100%" rows="3"></textarea></p>
        		<p><a id="submit_feedback" class="btn btn-default btn-success" role="button">提交建议</a></p>        
        		<p>也可以直接给我发送电子邮件：flst@qq.com ，我会尽快回复和尽力改进</p>
        			
      		</div>

      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">关闭<span class='hint'>魔方教程</span></button>
      		</div>
    		</div>
  		</div>
	</div>

	<div class="modal fade" id="donate_author" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      		<div class="modal-header bdsharebuttonbox">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="myModalLabel">打赏作者2元钱</h4>
      		</div>
      		
      		<div class="modal-body" id="donate_author_content">

        		<p>如果您在用电脑：直接用手机微信扫一扫二维码</p>
        		<p>如果您在用手机：可以长按图片并保存图片到相册，再用微信扫一扫功能，打开相册识别</p>      
        		<p><img src="img/pay2.jpg" width="300"></p>
        			
      		</div>

      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">关闭<span class='hint'>魔方教程</span></button>
      		</div>
    		</div>
  		</div>
	</div>

	<div class="modal fade" id="step_skills" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  		<div class="modal-dialog">
    		<div class="modal-content">
      		<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        		<h4 class="modal-title" id="myModalLabel">本步骤技巧（图中公式需逐步记忆）</h4>
      		</div>
      		<?php
				$content = array();
				$content[] = "第1步：底层棱块（十字）复原，暂时需自己多练习，我们会尽量找出更适合新手理解的固定解法提供给大家：）<span class='hint'>魔方教程</span>";
				$content[] = "第2步：
				<br> 1.在顶层找含有底面颜色（白色）的角块，然后通过顶层转动，将角块放在它目标位置的正上方，整个魔方沿y或y'转动，使得目标角块在F面与R面夹角。该过程，参考“调整公式”。
				<br> 2.判断白色面朝向，分别为 朝右，朝前，朝上，根据下图，做相应的“复原公式”
				<br><img src='img/step_skill_2.png' width='100%'>
				<br> 3.若有角块藏在底层，可使用公式 (1)，将其置换到顶层<span class='hint'>魔方教程</span>";
				$content[] = "第3步：
				<br> 1.在顶层找不含有顶面色（黄色）的棱块，然后通过顶层转动，将棱块放在与其侧面颜色一致的中心块位置，整个魔方沿y或y'转动，使得该中心块面向自己。该过程，参考“调整公式”。
				<br> 2.判断该棱块的目标位置是在左面，还是在右面，根据下图，做相应的“复原公式”
				<br><img src='img/step_skill_3.png' width='100%'>
				<br> 3.若有棱块藏在第二层，整个魔方沿y或y'转动，可使得目标棱块在F面与R面夹角，并使用公式 (2)，将其置换到顶层<span class='hint'>魔方教程</span>";
				$content[] = "第4步：
				<br> 1.下图为顶视图，图的正下方为前面，及朝向你的面，整个魔方沿y或y'转动，使得顶部黄色块图形与下图中其中任意一个一致。该过程，参考“调整公式”。
				<br> 2.调整后，做如下的“复原公式”
				<br><img src='img/step_skill_4.png' width='100%'><span class='hint'>魔方教程</span>";
				$content[] = "第5步：
				<br> 1.下图为顶视图，图的正下方为前面，及朝向你的面，整个魔方沿y或y'转动，使得顶部黄色块图形与下图中其中任意一个一致，图中魔方四周的黄色条，代表角块中黄色面的朝向。该过程，参考“调整公式”。
				<br> 2.调整后，做如下的“复原公式”
				<br><img src='img/step_skill_5.png' width='100%'><span class='hint'>魔方教程</span>";
				$content[] = "第6步：
				<br> 1.在顶层（第三层）的侧面（4个面），寻找一个侧面上，两个角块的颜色是一样的，找到后通过顶层转动，让该面朝向右手边。若全都不一样，则无需做该步骤。该过程，参考“调整公式”。
				<br> 2.完成第1步后，在做“复原公式”前，还需执行公式x'调整魔方，将顶面翻向自己做前面。该过程，参考“调整公式”
				<br> 3.调整后，直接做“复原公式”。
				<br> 4.做完公式后，需执行公式x恢复魔方姿态。该过程，参考“恢复调整公式”。
				<br> 5.若4个侧面角块的颜色都一样，则通过顶层转动调整角块颜色与中心块一致。完成该步骤复原过程
				<br><img src='img/step_skill_6.png' width='100%'><span class='hint'>魔方教程</span>";
				$content[] = "第7步：
				<br> 1.整个魔方沿y或y'转动，使得棱块中已复原的块背向自己（及在背面）。该过程，参考“调整公式”。
				<br> 2.调整后。直接做“复原公式”。
				<br><img src='img/step_skill_7.png' width='100%'>
				<br> 3.若没有任何棱块是复原的，则无需调整魔方，直接做“复原公式”<span class='hint'>魔方教程</span>";
				for($i=0; $i<7; $i++)
				{
					
			?>
      		<div class="modal-body step_skills" id="skill_<?php echo $i+1?>">
        		<?php echo $content[$i];?>
      		</div>
      			<?php }?>
      		<div class="modal-footer">
        		<button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
      		</div>
    		</div>
  		</div>
	</div>

<?php


	$title = array();
	$title[] = "第1步：复原第一层棱块<span class='hint'>魔方教程</span>";
	$title[] = "第2步：复原第一层角块";
	$title[] = "第3步：复原第二层棱块<span class='hint'>魔方教程</span>";
	$title[] = "第4步：复原第三层棱块颜色";
	$title[] = "第5步：复原第三层角块颜色<span class='hint'>魔方教程</span>";
	$title[] = "第6步：复原第三层角块位置";
	$title[] = "第7步：复原第三层棱块位置<span class='hint'>魔方教程</span>";

	$end_title = array();
	$end_title[] = "恭喜你完成第1步，很容易吧！<span class='hint'>魔方教程</span>";
	$end_title[] = "第2步轻松完成，小试牛刀成功！<span class='hint'>魔方教程</span>";
	$end_title[] = "第3步完成，有点复杂了，但你没问题！<span class='hint'>魔方教程</span>";
	$end_title[] = "第4步也完成，这步有点简单，是不？！<span class='hint'>魔方教程</span>";
	$end_title[] = "完成第5步，胜利更近一步！<span class='hint'>魔方教程</span>";
	$end_title[] = "第6步搞定，加油！还有最后一步！<span class='hint'>魔方教程</span>";
	$end_title[] = "恭喜你学会了用层先法复原魔方！后续练习，可以慢慢牢记‘复原公式’<span class='hint'>魔方教程</span>";


	$button_title = "";
	$step_xml="";
	$img_xml="";

	for($i=0; $i<7; $i++)
	{
		
		$button_title = "开始第".($i+2)."步";
		$next_step_xml="href='#step_".($i+2)."' nextstep=".($i+2);

		if($i ==0)
		{
			$img_xml = '<img src="img/step_1_1.png"> <img src="img/step_1_2.png">';
		}
		else
			$img_xml = '<img src="img/step_'.($i+1).'.png">';
?>
	  <div id="step_<?php echo $i+1;?>" step=<?php echo $i+1;?> class="row marketing" style="text-align: left;">
        <h3>“<?php echo $title[$i];?>”</h3>
        <p>
        	<table class="table table-bordered">
        		<tr id="step_<?php echo $i+1;?>_first_child">
        			<td width="25%">该步骤复原目标</td>
        			<td><b><font color="#ff0000">注意：此图为示例，并非您手上魔方的状态哟，不要整体转动魔方</font></b><br><?php echo $img_xml;?></td>
        		</tr>
        		<!--<tr>
        			<td>当前状态</td>
        			<td>真图(待补充)</td>
        		</tr>
        		<tr>
        			<td>状态确认</td>
        			<td>真图(待补充)</td>
        		</tr>-->
        	</table>
        </p>
        <h3>“<?php echo $end_title[$i];?>”</h3>
        <p></p>
        <p>
        <?php if ($i<6){?>
        <a id="start_step_<?php echo $i+2;?>" class="btn btn-default btn-success" href="#top" role="button"<?php echo $next_step_xml;?>><?php echo $button_title;?></a>
        <?php }
        else{
        	if(isMobile()){?>
        	<a id="share_result" class="btn btn-default btn-success" role="button" data-toggle="modal" data-target="#share_your_result">微信分享</a>
        	<?php }else{?>
        	<a id="share_result_by_pc" class="btn btn-default btn-success" role="button" data-toggle="modal" data-target="#share_your_result_by_pc">微信分享</a>
			<?php }?>
        	<a id="submit_your_commends_button" class="btn btn-default btn-success" role="button" data-toggle="modal" data-target="#submit_your_commends">吐槽作者</a>
        	<a id="donate_author_button" class="btn btn-default btn-success" role="button" data-toggle="modal" data-target="#donate_author">打赏作者</a>
        	<br/>
        	<p></p>
        
		<?php }?>
        </p>
        
      </div>
<?php } ?>
   <!--   <div id="step_2" step=2 class="row marketing" style="text-align: left;">
        <h3>“第2步：复原第一层角块”</h3>
        <p>
        	<table class="table table-bordered">
        		<tr>
        			<td width="20%">复原目标</td>
        			<td>图例(待补充)</td>
        		</tr>
        		<tr id="step_2_first_child">
        			<td>当前状态</td>
        			<td>真图(待补充)</td>
        		</tr>
        		<tr>
        			<td>状态确认</td>
        			<td>真图(待补充)</td>
        		</tr>
        	</table>
        </p>
        <h3>“第2步轻松完成，小试牛刀成功！”</h3>
        <p></p>
        <p><a id="start_step_3" class="btn btn-lg btn-success" nextstep=3 role="button">开始第3步</a></p>
      </div>

      <div id="step_3" step=3 class="row marketing" style="text-align: left;">
        <h3>“第3步：复原第二层棱块”</h3>
        <p>
        	<table class="table table-bordered">
        		<tr>
        			<td width="20%">复原目标</td>
        			<td>图例(待补充)</td>
        		</tr>
        		<tr id="step_3_first_child">
        			<td>当前状态</td>
        			<td>真图(待补充)</td>
        		</tr>
        		<tr>
        			<td>状态确认</td>
        			<td>真图(待补充)</td>
        		</tr>
        	</table>
        </p>
        <h3>“第3步完成，有点复杂了，但你没问题！”</h3>
        <p></p>
        <p><a id="start_step_4" class="btn btn-lg btn-success" nextstep=4 role="button">开始第4步</a></p>
      </div>

      <div id="step_4" step=4 class="row marketing" style="text-align: left;">
        <h3>“第4步：复原第三层棱块颜色”</h3>
        <p>
        	<table class="table table-bordered">
        		<tr>
        			<td width="20%">复原目标</td>
        			<td>图例(待补充)</td>
        		</tr>
        		<tr id="step_4_first_child">
        			<td>当前状态</td>
        			<td>真图(待补充)</td>
        		</tr>
        		<tr>
        			<td>状态确认</td>
        			<td>真图(待补充)</td>
        		</tr>
        	</table>
        </p>
        <h3>“第4步也完成，这步有点简单，是不？！”</h3>
        <p></p>
        <p><a id="start_step_5" class="btn btn-lg btn-success" nextstep=5 role="button">开始第5步</a></p>
      </div>

      <div id="step_5" step=5 class="row marketing" style="text-align: left;">
        <h3>“第5步：复原第三层角块颜色”</h3>
        <p>
        	<table class="table table-bordered">
        		<tr>
        			<td width="20%">复原目标</td>
        			<td>图例(待补充)</td>
        		</tr>
        		<tr id="step_5_first_child">
        			<td>当前状态</td>
        			<td>真图(待补充)</td>
        		</tr>
        		<tr>
        			<td>状态确认</td>
        			<td>真图(待补充)</td>
        		</tr>
        	</table>
        </p>
        <h3>“完成第5步，胜利更近一步！”</h3>
        <p></p>
        <p><a id="start_step_6" class="btn btn-lg btn-success" nextstep=6 role="button">开始第6步</a></p>
      </div>

	<div id="step_6" step=6 class="row marketing" style="text-align: left;">
        <h3>“第6步：复原第三层角块位置”</h3>
        <p>
        	<table class="table table-bordered">
        		<tr>
        			<td width="20%">复原目标</td>
        			<td>图例(待补充)</td>
        		</tr>
        		<tr id="step_6_first_child">
        			<td>当前状态</td>
        			<td>真图(待补充)</td>
        		</tr>
        		<tr>
        			<td>状态确认</td>
        			<td>真图(待补充)</td>
        		</tr>
        	</table>
        </p>
        <h3>“第6步搞定，加油！还有最后一步！”</h3>
        <p></p>
        <p><a id="start_step_7" class="btn btn-lg btn-success" nextstep=7 role="button">开始第7步</a></p>
    </div>

    <div id="step_7" step=7 class="row marketing" style="text-align: left;">
        <h3>“第7步：复原第三层棱块位置”</h3>
        <p>
        	<table class="table table-bordered">
        		<tr>
        			<td width="20%">复原目标</td>
        			<td>图例(待补充)</td>
        		</tr>
        		<tr id="step_7_first_child">
        			<td>当前状态</td>
        			<td>真图(待补充)</td>
        		</tr>
        		<tr>
        			<td>状态确认</td>
        			<td>真图(待补充)</td>
        		</tr>
        	</table>
        </p>
        <h3>“恭喜你学会了用层先法复原魔方！”</h3>
        <p></p>
        <p><a id="share_result" class="btn btn-lg btn-success" role="button">分享给好友</a></p>
    </div>-->
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

<nav id="step_naver" class="navbar navbar-default navbar-fixed-bottom" role="navigation">
   <div style="text-align: center; padding-top:6px; padding-bottom:6px; height:40px;">
   		<button class="btn btn-primary btn-default" data-toggle="modal" data-target="#cube_formula_demo">公式图例</button>
   		<button class="btn btn-primary btn-default" data-toggle="modal" data-target="#step_skills">本步骤技巧</button>
   </div>
</nav>


      <div class="footer">
      	<div id="footer_content">
        <p>&copy; Copyright 风流沙驼,  Email: <a href="mailto:flst@qq.com">flst@qq.com</a>  访问主站：<a href="http://www.rubiksdiy.com/">http://www.rubiksdiy.com/</a><div>
		 <script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3Fc20edab51389fc339f0b8d2c2eca7702' type='text/javascript'%3E%3C/script%3E"));
</script>
        </p>
      	</div>
      </div> <!-- /footer_content -->

    </div> <!-- /container -->


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/ie-emulation-modes-warning.js"></script>
    <script src="js/cube.js"></script

  </body>
  </html>

  