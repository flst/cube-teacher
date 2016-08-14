// JavaScript Document

var start_x = 185 + ($(window).width() - 1366)/2;
var start_y = 56;
var cur_index = 0;
var start_time;
var end_time;
var waste_time = 0;
var disrupt_mode = false;

document.addEventListener('dblclick', function(e){
        e.preventDefault();
});

$(document).ready(function(){
    waste_time = 0;
	//$("#cube2").hide();
	$(".roll_back").attr("disabled",true);
	$("#start_resolve").attr("disabled","disabled");
	
	$("[step]").hide();
	$(".step_skills").hide();
	$("#step_naver").hide();
	$("#restart").hide();
    //$("#step_7").show();


	$("#getting_start").click(function(){ 
        disrupt_mode = false;
		$("#introduce").hide();
		$("#set_cube").show();
		$("#restart").show();
        $('#basic_concept').modal('show');
	});

	$("#share_result").click(function(){
        if( waste_time == 0 ){
		  var end_time = new Date();
		  waste_time = Math.round((end_time.getTime() - start_time.getTime())/1000);
        } 
		min = Math.floor(waste_time / 60);
		sec = waste_time % 60;

		$(document).attr('title','我用' + min + '分钟' + sec + '秒亲手复原了魔方，你也来试试！');
		$("#share_your_result_content").html('你仅用了' + min + '分钟' + sec + '秒遍学会了复原魔方，太赞了！欢迎继续学习！记住去学习“本步骤技巧”哟，让你慢慢学会自己复原！');
	});

    $("#share_result_by_pc").click(function(){
        if( waste_time == 0 ){
          var end_time = new Date();
          waste_time = Math.round((end_time.getTime() - start_time.getTime())/1000);
        } 
        min = Math.floor(waste_time / 60);
        sec = waste_time % 60;

        $(document).attr('title','我用' + min + '分钟' + sec + '秒亲手复原了魔方，你也来试试！');
        $("#share_your_result_content_by_pc").html('你仅用了' + min + '分钟' + sec + '秒遍学会了复原魔方，太赞了！欢迎继续学习！记住去学习“本步骤技巧”哟，让你慢慢学会自己复原！微信扫一扫，可用手机访问，并分享至朋友圈<br><img src="img/qrcode.png" width="200px">');
    });

	$("#getting_start_by_disrupt_cube").click(function(){ 
        disrupt_mode = true;
        $('#basic_concept').modal('show');
		$.post("./cube_disruptor.php",function(result){
			//alert(result);
			formula_color = eval("("+result+")");
			$("#set_cube_title").html("“打乱的魔方状态如下”");
			$("#cube_disruptor_formula").html("（高手参考）打乱公式："+formula_color["formula"]);
			cube_color = formula_color["cube_color"];
			color_cnt = cube_color.length;
			var color_map = {"R":"red","O":"oringe","G":"green","B":"blue","W":"white","Y":"yellow"};

			for(i=0; i<color_cnt; i++){
				console.log(color_map[cube_color[i]]);
				$("#block_"+i).attr("class", color_map[cube_color[i]]);
				$("#form_block_"+i).attr("value", color_map[cube_color[i]]);
			}
			$("#block_0").html("");

			$("#introduce").hide();
			$(".set_color").hide();
			$(".roll_back").hide();
			$("#cube2").show();
			$("#set_cube").show();
			$("#restart").show();
			$("#start_resolve").attr("disabled",false);
		});
	});

	$("[nextstep]").click(function(){ 
		next_step = $(this).attr("nextstep");
        if(next_step==0)
            return
		$("[step]").hide();
		$("[step="+next_step+"]").show();
		if(next_step==1)
		{
			$('#start_cube_modal').modal('show');
			$("#step_naver").show();
            $("#footer_content").hide();
		}
		$(".step_skills").hide();
		$("#skill_"+next_step).show();
	});

    $("#set_color span").click(function(){

    	if (cur_index == 54) 
    		return;
    	if (cur_index == 53) {
    		$("#start_resolve").attr("disabled",false);
    	}
    	if (cur_index == 0)
    		$(".roll_back").attr("disabled",false);

    	$("#block_"+cur_index).attr("class", $(this).attr("id"));  
    	$("#form_block_"+cur_index).attr("value", $(this).attr("id")); 
    	$("#block_"+cur_index).html(""); 
        if (!judge_input()) {
            $("#block_"+cur_index).attr("class", "fill");  
            $("#form_block_"+cur_index).attr("value", ""); 
            $("#block_"+cur_index).html("下方<br>选色"); 
            return;
        }

    	cur_index = 0;
    	do {
            cur_index++;
        	if (cur_index == 27) {
                 $("html, body").animate({
                scrollTop: $("#cube2").offset().top + "px"
                }, {
                    duration: 500,
                    easing: "swing"
                });
                
        		/*$("#cube1").hide();
        		$("#cube2").show();*/
        	}
        }
        while( cur_index!=54 && $("#block_"+cur_index).attr('class') != "empty" && $("#block_"+cur_index).attr('class') != "fill")

    	//console.log(cur_index);
    	$("#block_"+cur_index).html("下方<br>选色");
    	$("#block_"+cur_index).attr("class", "fill");  
    });

    $("span[id^='block_']").click(function(){
        if (disrupt_mode)
            return; 
        
        if($(this).attr('class') != "fill") {
            index = $(this).attr('id').split('_')[1];
            //alert(index);
            if(index % 9 != 4) {
                if (cur_index == 54) {
                    $("#start_resolve").attr("disabled",true);
                }
                if (cur_index == 1)
                    $(".roll_back").attr("disabled",true);

                $("#block_"+cur_index).attr("class", "empty");  
                $("#block_"+cur_index).html(""); 
                $("#form_block_"+cur_index).attr("value", ""); 
                cur_index = index;
               
                //console.log(cur_index);
                $("#block_"+cur_index).html("下方<br>选色");
                $("#block_"+cur_index).attr("class", "fill");  
            }
        }/**/
        
    });

 	$(".roll_back").click(function(){ 
 		if (cur_index == 54) {
    		$("#start_resolve").attr("disabled",true);
    		
    	}
    	if (cur_index == 1)
    		$(".roll_back").attr("disabled",true);

    	$("#block_"+cur_index).attr("class", "empty");  
    	$("#block_"+cur_index).html(""); 
        $("#form_block_"+cur_index).attr("value", ""); 
    	cur_index--;
    	if (cur_index%9 == 4)
    		cur_index--;


        if (cur_index == 26) {
            $("html, body").animate({
            scrollTop: $("#cube1").offset().top + "px"
            }, {
                duration: 500,
                easing: "swing"
            });
        }
    	/*if (cur_index == 26) {
    		$("#cube2").hide();
    		$("#cube1").show();
    	}*/
    	//console.log(cur_index);
    	$("#block_"+cur_index).html("下方<br>选色");
    	$("#block_"+cur_index).attr("class", "fill");  
    });

 	$("#start_resolve").click(function(){
 		var block_json = new Array();
 		$("[name='block[]']").each(function(){
 			color = $(this).attr("value");
 			if(color != "")
 				block_json.push(color);
 		});

 		start_time = new Date();
        $("#start_resolve").attr("disabled",true);
        $("#getting_start").attr("disabled",true);
        $("[step]").hide();
        $("[step=0]").show();
 
 		$.post("./cube_teacher.php",{block:block_json},function(result){
			//alert(result);
			formula_recorder = eval("("+result+")");
            //console.log(formula_recorder);
        	
            //alert(step_cnt);
            //console.log(formula_recorder);
            if (formula_recorder["error"] == "input error") {
                alert("魔方输入有误，请重新输入");
                $("[step]").hide();
                $("[step=-1]").show();
                $("#start_resolve").attr("disabled",false);
                $("#getting_start").attr("disabled",false);
                return;
            }
            $("#getting_start").attr("disabled",false);

            step_cnt = formula_recorder.length;

        	//alert(step_cnt);
        	for(i=0; i<step_cnt; i++) {
        		html_str = "";
        		item_cnt = formula_recorder[i].length;
                //console.log(item_cnt);
        		if(item_cnt==0) {
        			html_str = "<tr class='formula_tr'><td>复原</td><td>很幸运，本步骤跳过</td></tr>";
        			$("#step_"+(i+1)+"_first_child").after(html_str);
        			continue;
        		}
        		for(j=0; j<item_cnt; j++) {
        			formula_item = formula_recorder[i][j];
        			item_str = "";
        			if (formula_item["set_f"] != "") {
        				item_str = item_str + "调整公式：<br><formula>" + formula_item["set_f"] + "</formula><br>";
        			}

        			if (formula_item["exe_f"] != "") {
        				item_str = item_str + "复原公式：<br><formula>" + formula_item["exe_f"] + "</formula><br>";
        			}

        			if (formula_item["unti_set_f"] != "") {
        				item_str = item_str + "恢复调整公式：<br><formula>" + formula_item["unti_set_f"] + "</formula><br>";
        			}
        			//console.log(item_str);
        			if (item_str == "")
        				continue;

                    if (formula_item["png"] != "")
                        item_str = item_str + "完成状态：<br>" + formula_item["png"] + "<br>";

        			target_str = "";
        			if (i<3) {
        				target_str = "<br><a class=target_block>"+formula_item["t_name"]+"["+formula_item["t_type"]+"]</a>";
        			}
        			html_str = html_str+"<tr class='formula_tr'><td>复原"+target_str+"</td><td>"+item_str+"</td></tr>";
            	}
            	$("#step_"+(i+1)+"_first_child").after(html_str);
        	}

            
		});
 		//$("#step_1_first_child").after("<tr class='formula_tr'><td>复原<br><a class=target_block>红绿蓝[角块]</a></td><td>调整公式：<br>F U D U F U R<br>复原公式：<br>F U D U F U R</td></tr><tr class='formula_tr'><td>复原<br><a class=target_block>红绿蓝[角块]</a></td><td>调整公式：<br>F U D U F U R<br>复原公式：<br>F U D U F U R</td></tr><tr class='formula_tr'><td>复原<br><a class=target_block>红绿蓝[角块]</a></td><td>调整公式：<br>F U D U F U R<br>复原公式：<br>F U D U F U R</td></tr>");
    });

    function judge_input(){
        var block_json = new Array();
        $("[name='block[]']").each(function(){
            color = $(this).attr("value");
            if(color != "")
                block_json.push(color);
        });

        cnt = block_json.length;
        var color_cnt = {"yellow":0,"red":0,"green":0,"white":0,"oringe":0,"blue":0};
        var color_name = {"yellow":"黄","red":"红","green":"绿","white":"白","oringe":"橙","blue":"蓝"};

        for(i=0;i<cnt;i++) {
            color_cnt[block_json[i]]++;
            if(color_cnt[block_json[i]] == 10) {
                alert(color_name[block_json[i]]+"色块的数量超过了9个，请重新选色");
                return false;
            }
        }
        return true;
    }
    /*$("#getting_start").click(function(){ 
    	$("#introduce").hide();
    	$("#introduce").hide();
    });*/

    $("#submit_feedback").click(function(){
        //console.log($("#feedback_text").attr("value"));
        var text = $("#feedback_text").attr("value");
        var nickname = $("#nickname").attr("value");
        var email = $("#email").attr("value");
        if(text != ""){
             $.post("./feedback_submit.php",{nickname:nickname,email:email,feedback_text:text},function(result){
                //alert(result);
                //ret = eval("("+result+")");
                //console.log(result); 
                $("#feedback_text").attr("value",""); 
                alert("提交成功！");
            });   
        } 
    });
});