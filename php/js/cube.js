// JavaScript Document

var start_x = 185 + ($(window).width() - 1366)/2;
var start_y = 56;
var cur_index = 0;
var block_index = {

};

$(document).ready(function(){
	$("#cube2").hide();
	$("#roll_back").attr("disabled",true);
	$("#start_resolve").attr("disabled","disabled");
	

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
});