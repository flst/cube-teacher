// JavaScript Document

var start_x = 185 + ($(window).width() - 1366)/2;
var start_y = 56;
var cur_index = 0;
var start_time;
var end_time;
var waste_time = 0;

$(document).ready(function(){
    waste_time = 0;
	$("#cube2").hide();
	$("#roll_back").attr("disabled",true);
	$("#start_resolve").attr("disabled","disabled");
	
	$("[step]").hide();
	$(".step_skills").hide();
	$("#step_naver").hide();
	$("#restart").hide();
	
	$("#getting_start").click(function(){ 
		$("#introduce").hide();
		$("#set_cube").show();
		$("#restart").show();
	});

	$("#share_result").click(function(){
        if( waste_time == 0 ){
		  var end_time = new Date();
		  waste_time = Math.round((end_time.getTime() - start_time.getTime())/1000);
        } 
		min = Math.floor(waste_time / 60);
		sec = waste_time % 60;

		$(document).attr('title','我用' + min + '分钟' + sec + '秒学会了魔方复原，你也来试试！');
		$("#share_your_result_content").html('你仅用了' + min + '分钟' + sec + '秒遍学会了复原魔方，太赞了！欢迎继续学习！记住去学习“本步骤技巧”哟，让你慢慢学会自己复原！');
	});

    $("#share_result_by_pc").click(function(){
        if( waste_time == 0 ){
          var end_time = new Date();
          waste_time = Math.round((end_time.getTime() - start_time.getTime())/1000);
        } 
        min = Math.floor(waste_time / 60);
        sec = waste_time % 60;

        $(document).attr('title','我用' + min + '分钟' + sec + '秒学会了魔方复原，你也来试试！');
        $("#share_your_result_content_by_pc").html('你仅用了' + min + '分钟' + sec + '秒遍学会了复原魔方，太赞了！欢迎继续学习！记住去学习“本步骤技巧”哟，让你慢慢学会自己复原！');
    });

	$("#getting_start_by_disrupt_cube").click(function(){ 
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
			$("#set_color").hide();
			$("#roll_back").hide();
			$("#cube2").show();
			$("#set_cube").show();
			$("#restart").show();
			$("#start_resolve").attr("disabled",false);
		});
	});

	$("[nextstep]").click(function(){ 
		next_step = $(this).attr("nextstep");
		$("[step]").hide();
		$("[step="+next_step+"]").show();
		if(next_step==1)
		{
			$('#start_cube_modal').modal('show');
			$("#step_naver").show();
		}
		$(".step_skills").hide();
		$("#skill_"+next_step).show();
	});

    $("#set_color span").click(function(){ 
    	if (cur_index == 54) 
    		return
    	if (cur_index == 53) {
    		$("#start_resolve").attr("disabled",false);
    	}
    	if (cur_index == 0)
    		$("#roll_back").attr("disabled",false);

    	$("#block_"+cur_index).attr("class", $(this).attr("id"));  
    	$("#form_block_"+cur_index).attr("value", $(this).attr("id")); 
    	$("#block_"+cur_index).html(""); 
    	cur_index++;
    	if (cur_index%9 == 4)
    		cur_index++;
    	if (cur_index == 27) {
    		$("#cube1").hide();
    		$("#cube2").show();
    	}
    	//console.log(cur_index);
    	$("#block_"+cur_index).html("下方<br>选色");
    	$("#block_"+cur_index).attr("class", "fill");  
    });

 	$("#roll_back").click(function(){ 
 		if (cur_index == 54) {
    		$("#start_resolve").attr("disabled",true);
    		
    	}
    	if (cur_index == 1)
    		$("#roll_back").attr("disabled",true);

    	$("#block_"+cur_index).attr("class", "empty");  
    	$("#block_"+cur_index).html(""); 
    	cur_index--;
    	if (cur_index%9 == 4)
    		cur_index--;
    	if (cur_index == 26) {
    		$("#cube2").hide();
    		$("#cube1").show();
    	}
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

 
 		$.post("./cube_teacher.php",{block:block_json},function(result){
			//alert(result);
			formula_recorder = eval("("+result+")");

        	step_cnt = formula_recorder.length;
        	//alert(step_cnt);
        	for(i=0; i<step_cnt; i++) {
        		html_str = "";
        		item_cnt = formula_recorder[i].length;
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
        			console.log(item_str);
        			if (item_str == "")
        				continue;

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

   
    /*$("#getting_start").click(function(){ 
    	$("#introduce").hide();
    	$("#introduce").hide();
    });*/
});