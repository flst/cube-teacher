<?php
//cube_teacher
//by sunweiwei 2014/9/5 
//echo '[[{"set_f":"","exe_f":"R2 D\'","unti_set_f":""},{"set_f":"","exe_f":"","unti_set_f":""},{"set_f":"","exe_f":"R\'","unti_set_f":""},{"set_f":"","exe_f":"L2","unti_set_f":""}],[{"set_f":"y U","exe_f":"R U R\'","unti_set_f":""},{"set_f":"y2","exe_f":"U R U\' R\'","unti_set_f":""}],[{"set_f":"y","exe_f":"U\' L\' U L U F U\' F\'","unti_set_f":""},{"set_f":"y2","exe_f":"U R U\' R\' U\' F\' U F","unti_set_f":""},{"set_f":"y\' U R U\' R\' U\' F\' U F U2","exe_f":"U R U\' R\' U\' F\' U F","unti_set_f":""}],[{"set_f":"y","exe_f":"F R U R\' U\' F\'","unti_set_f":""},{"set_f":"y","exe_f":"F R U R\' U\' F\'","unti_set_f":""}],[{"set_f":"","exe_f":"R U R\' U R U2 R\'","unti_set_f":""}],[{"set_f":"U\' x\'","exe_f":"R2 D2 R\' U\' R D2 R\' U R\'","unti_set_f":"x"}],[{"set_f":"y\'","exe_f":"R U\' R U R U R U\' R\' U\' R2","unti_set_f":""}]]';
//exit;

include "cube_base_class.php";

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

class FormulaItem {
    var $_target_name;
    var $_target_type;
    var $_set_formula;
    var $_exe_formula;
    var $_unti_set_formula;
    var $_finish_png;

    function __construct($set_formula, $exe_formula, $finish_png, $target_name, $target_type, $unti_set_formula="") {
        $this->_set_formula = trim($set_formula);
        $this->_exe_formula = trim($exe_formula);
        $this->_finish_png = trim($finish_png);
        $this->_target_name = trim($target_name);
        $this->_target_type = trim($target_type);
        $this->_unti_set_formula = trim($unti_set_formula);
    }

    function gen_array() {
        $formula_array = array();
        $formula_array["set_f"] = $this->text2png($this->_set_formula);
        $formula_array["exe_f"] = $this->text2png($this->_exe_formula);
        $formula_array["png"] = $this->_finish_png;
        $formula_array["unti_set_f"] = $this->text2png($this->_unti_set_formula);
        $formula_array["t_name"] = $this->_target_name;
        $formula_array["t_type"] = $this->_target_type;
        return $formula_array;
    }

    function text2png($text) {
        if($text=="")
            return "";
        $png_xml = "";
        $formula_list = explode(" ",$text);
        foreach ($formula_list as $f) {
            //$f = str_replace("'","\'",$f);
            $width = 65;
            if(isMobile())
                $width = 40;
            $png_xml = $png_xml."<img src=\"img/formula/".$f.".png\" width=\"".$width."\">";
        }
        return $text."<br>".$png_xml;
    }

}

class FormulaRecorder {
    var $_formula;
    function __construct() {
        $this->_formula = array();
        $this->_formula[0] = array();
        $this->_formula[1] = array();
        $this->_formula[2] = array();
        $this->_formula[3] = array();
        $this->_formula[4] = array();
        $this->_formula[5] = array();
        $this->_formula[6] = array();
    }

    function recorder_formula($step, $formula_item) {
        $this->_formula[$step][] = $formula_item->gen_array();
    }

    function set_last_record_finish_png($step, $finish_png) {
        $cnt = count($this->_formula[$step]);
        $this->_formula[$step][$cnt-1]["png"] = $finish_png;
    }

    function gen_json_output() {
        return json_encode($this->_formula);
    }
}



class CubeResolver {
    var $_cube;
    var $_formula_set;
    var $_formula_unti_set;
    var $_resolver_condition;
    var $_formula_recorder;
    
    function __construct($cube, $formula_recorder) {
        $this->_cube = $cube;
        $this->_formula_recorder = $formula_recorder;
        $this->_formula_set = array("F","F'","B","B'","R","R'","L","L'","U","U'","D","D'");
        $this->_formula_unti_set = array("F'","F","B'","B","R'","R","L'","L","U'","U","D'","D");
        $this->_formula_stack = array();
        $this->_resolver_condition = array();
        $this->_resolver_condition["first_cross"] = array("RNW");
        $this->_resolver_condition["secend_cross"] = array("RNW", "ONW");
        $this->_resolver_condition["third_cross"] = array("RNW", "ONW", "NGW");
        $this->_resolver_condition["fouth_cross"] = array("RNW", "ONW", "NGW", "NBW");
        $this->_resolver_condition["1st_corner"] = array("RGW", "OGW", "RBW", "OBW");
        $this->_resolver_condition["2st_side"] = array("RGN", "OGN", "RBN", "OBN");
        //$this->_resolver_formula = array();
    }

    function execute_formula($formula) {
        //print "formula :", formula
        foreach ($formula as $f) {
            //echo $f." ";
            if (strlen($f) == 2 && $f[1] == "2") {
                $this->_cube->turn($f[0]);
                $this->_cube->turn($f[0]);
            }
            else
                $this->_cube->turn($f);
        }
    }

    function execute_formula_by_string($formula_string) {
        $formula = explode(" ",$formula_string);
        $this->execute_formula($formula);
    }

    function resolver_done($step = "all") {
        foreach($this->_cube->get_block_list() as $b) {
            if ($step == "all") {
                if (!$b->is_recover()) 
                    return false;
            }
            else {
                if (in_array($b->get_name(), $this->_resolver_condition[$step]) && !$b->is_recover()) {
                    return false;
                }
            }
        }
        return true;
    }

    function can_not_move($formula, $step) {
        foreach($this->_resolver_condition[$step] as $block_name) {
            $block = $this->_cube->find_block_by_name($block_name);
            if ($block->do_trans($formula[0])) 
                return false;
        }
        return true;
    }

    function get_cube_png() {
        $cube_colors = $this->_cube->get_cube_color_array();
        $cube_printer = new CubePrinter($cube_colors,20);

        return $cube_printer->get_base64_xml();
    }

    function depth_first_search($depth, $max_depth, $step) {
        if ($this->resolver_done($step)) {
            //print "resolver done"
            return true;
        }
         
        //cut branch 1
        if ($depth + 1 > $max_depth) {
            return false;
        }

        $formula_len = count($this->_formula_set);
        for($i=0; $i<$formula_len; $i++) {
            //cut branch 1, can't move the target block
            if ($this->can_not_move($this->_formula_set[$i], $step)) 
                continue;
 
            //cut branch 2, unti turn, such as "R R' "
            if ($depth > 1 && $this->_formula_set[$i][0] == $this->_formula_stack[count($this->_formula_stack)-1][0] && strlen($this->_formula_set[$i]) != strlen($this->_formula_stack[count($this->_formula_stack)-1])) 
                //print "cut brach:", $this->_formula_stack, $this->_formula_set[i]
                continue;

            //cut branch 3, repeat same turn 3 times, such as "R R R"
            if ($depth > 2 && $this->_formula_set[$i] == $this->_formula_stack[count($this->_formula_stack)-1] && $this->_formula_set[$i] == $this->_formula_stack[count($this->_formula_stack)-2])
                //print "cut brach:", $this->_formula_stack, $this->_formula_set[i]
                continue; 

            $this->_cube->turn($this->_formula_set[$i]);
            $this->_formula_stack[] = $this->_formula_set[$i];
            
            //tmp_cube = copy.deepcopy($this->_cube)
            if ($this->depth_first_search($depth+1, $max_depth, $step)) {
                return true;
            }
            else {
                //$this->_cube = copy.deepcopy(tmp_cube)
                $this->_cube->turn($this->_formula_unti_set[$i]);
                array_pop($this->_formula_stack);
            }/**/
        }

        return false;
    }
     
    function resolver_1st_corner() {

        while( !$this->resolver_done("1st_corner") ){
            //find
            $formula_set = array("U", "U'", "U2");
            $formula_unti_set = array("U'", "U", "U2");
            
            $axis_formula_set = array("y", "y'", "y2");
            $axis_formula_unti_set = array("y'", "y", "y2");
            $find_in_3st = false;
            $block = "";
            //set
            $set_formula ="";
 
            //find at 3st layer 
            foreach($this->_cube->get_block_list() as $b) {
                if ($b->get_type() == "corner" && $b->get_z() == 1 && strstr($b->get_name(), 'W') != false) {
                    $find_in_3st = true;
                    $block = $b;
                    break;
                    //print $b->get_name(), $b->get_x(), $b->get_y(), $b->get_z(), $block->get_tx(), $block->get_ty(), $block->get_tz()
                }
            }

            if (!$find_in_3st) {
                foreach($this->_cube->get_block_list() as $b) {
                    if ($b->get_type() == "corner" && $b->get_z() == -1 && strstr($b->get_name(), 'W') != false && !$b->is_recover()) {
                        $block = $b;
                        break; 
                    }
                }
                //set axis y ori
                for ($i=0; $i<count($axis_formula_set); $i++) {
                    $this->execute_formula_by_string($axis_formula_set[$i]);
                    //print $block->get_name(), $block->get_x(), $block->get_y(), $block->get_z(), $block->get_tx(), $block->get_ty(), $block->get_tz()
                    if ($block->get_x() == 1 && $block->get_y() == 1) {
                        $set_formula = $set_formula.$axis_formula_set[$i]." ";
                        break;
                    }
                    $this->execute_formula_by_string($axis_formula_unti_set[$i]);
                }

                $set_formula = $set_formula."R U R' ";
                $this->execute_formula(array("R", "U", "R'"));   
            }
         
            //set axis y ori
            for ($i=0; $i<count($axis_formula_set); $i++) {
                $this->execute_formula_by_string($axis_formula_set[$i]);
                //print $block->get_name(), $block->get_x(), $block->get_y(), $block->get_z(), $block->get_tx(), $block->get_ty(), $block->get_tz()
                if ($block->get_tx() == 1 && $block->get_ty() == 1){
                    $set_formula = $set_formula.$axis_formula_set[$i]." ";
                    break;
                }
                $this->execute_formula_by_string($axis_formula_unti_set[$i]);
            }

            //set 3st pos
            for ($i=0; $i<count($formula_set); $i++) {
                $this->execute_formula_by_string($formula_set[$i]);
                //print $block->get_name(), $block->get_x(), $block->get_y(), $block->get_z(), $block->get_tx(), $block->get_ty(), $block->get_tz()
                if ($block->get_x() == $block->get_tx() && $block->get_y() == $block->get_ty()) {
                    $set_formula = $set_formula.$formula_set[$i]." ";
                    break;
                }
                $this->execute_formula_by_string($formula_unti_set[$i]);
            }

            //echo "在顶层找到含底面颜色（白色）的角块：".$block->get_disp_name().", 将角块通过顶层转动至要还原位置的正上方，公式为: ".$set_formula."<br>";

            //execute
            $exe_formula = array();
            $face = $block->get_face("W");
            if ($face == 1)
                $exe_formula = "U R U' R'";

            if ($face == 2)
                $exe_formula = "R U R'";

            if ($face == 3)
                $exe_formula = "R U2 R' U' R U R'";
                
            $this->execute_formula_by_string($exe_formula);
            //echo "执行公式：".$exe_formula."<br>";

            $formula_item = new FormulaItem($set_formula, $exe_formula, $this->get_cube_png(), $block->get_disp_name(), "角块");
            $this->_formula_recorder->recorder_formula(1, $formula_item);
        }
    }

    function resolver_2st_side() {
        while (!$this->resolver_done("2st_side")) {
            //find
            $formula_set = array("U", "U'", "U2");
            $formula_unti_set = array("U'", "U", "U2");
            
            $axis_formula_set = array("y", "y'", "y2");
            $axis_formula_unti_set = array("y'", "y", "y2");
            $find_in_3st = false;
            $block = "";
            //set
            $set_formula = "";
 
            //find at 3st layer 
            foreach($this->_cube->get_block_list() as $b) {
                if ($b->get_type() == "side" && $b->get_z() == 1 && strstr($b->get_name(), 'Y') == false ) {
                    $find_in_3st = true;
                    $block = $b;
                    break;
                    //print $b->get_name(), $b->get_x(), $b->get_y(), $b->get_z(), $block->get_tx(), $block->get_ty(), $block->get_tz()
                }
            }
            if (!$find_in_3st) {
                foreach($this->_cube->get_block_list() as $b) {
                    if ($b->get_type() == "side" && $b->get_z() == 0 && strstr($b->get_name(), 'Y') == false && !$b->is_recover()) {
                        $block = $b;
                        break; 
                    }
                }       
                //set axis y ori
                for ($i=0; $i<count($axis_formula_set); $i++) {
                    $this->execute_formula_by_string($axis_formula_set[$i]);
                    //print $block->get_name(), $block->get_x(), $block->get_y(), $block->get_z(), $block->get_tx(), $block->get_ty(), $block->get_tz()
                    if ($block->get_x() == 1 && $block->get_y() == 1) {
                        $set_formula = $set_formula.$axis_formula_set[$i]." ";
                        break;
                    }
                    $this->execute_formula_by_string($axis_formula_unti_set[$i]);
                }
            
                $set_formula = $set_formula."U R U' R' U' F' U F ";
                $this->execute_formula_by_string("U R U' R' U' F' U F");   
            }
         
            //set axis y ori
            $iorj_color = $block->get_iorj_color();
            $target_centre_block = $this->_cube->get_centre_block($iorj_color);
            
            for ($i=0; $i<count($axis_formula_set); $i++) {
                $this->execute_formula_by_string($axis_formula_set[$i]);
                //print $block->get_name(), $block->get_x(), $block->get_y(), $block->get_z(), $block->get_tx(), $block->get_ty(), $block->get_tz()
                if ($target_centre_block->get_x() == 1) {
                    $set_formula = $set_formula.$axis_formula_set[$i]." ";
                    break;
                }
                $this->execute_formula_by_string($axis_formula_unti_set[$i]);
            }

            //set 3st pos
            for ($i=0; $i<count($formula_set); $i++) {
                $this->execute_formula_by_string($formula_set[$i]);
                //print $block->get_name(), $block->get_x(), $block->get_y(), $block->get_z(), $block->get_tx(), $block->get_ty(), $block->get_tz()
                if ($block->get_x() == 1) {
                    $set_formula = $set_formula.$formula_set[$i]." ";
                    break;
                }
                $this->execute_formula_by_string($formula_unti_set[$i]);
            }

            //echo "在顶层找到不含顶面颜色（黄色）的棱块: ".$block->get_disp_name()."，将棱块通过顶层转动至与侧面颜色一致的中心块位置并面向自己，公式为: ".$set_formula."<br>";

            //execute
            $exe_formula = array();
            $ty = $block->get_ty();
            if ($ty == -1)
                $exe_formula = "U' L' U L U F U' F'";

            if ($ty == 1)
                $exe_formula = "U R U' R' U' F' U F";
                
            $this->execute_formula_by_string($exe_formula);
            //echo "执行公式：".$exe_formula."<br>";

            $formula_item = new FormulaItem($set_formula, $exe_formula, $this->get_cube_png(), $block->get_disp_name(), "棱块");
            $this->_formula_recorder->recorder_formula(2, $formula_item);
        }
    }

    function resolver_3st_side_color() {
        while (true) {
            $block_list = array();
            foreach($this->_cube->get_block_list() as $b) {
                if ($b->get_z() == 1 && $b->get_type() == "side" &&  $b->get_face("Y") == 3)
                    $block_list[] = $b;
            }

            $set_formula = "";

            if (count($block_list) == 4)
                break;
               
            if (count($block_list) == 2) {
                if ($block_list[0]->get_y() == 0 && $block_list[1]->get_y() == 0) {
                    //echo "调整魔方: y<br>";
                    $set_formula = "U";
                    $this->_cube->turn("U");
                }
                else if ($block_list[0]->get_x() + $block_list[0]->get_y() + $block_list[1]->get_x() + $block_list[1]->get_y() == -2) {
                    //echo "调整魔方: y2<br>";
                    $set_formula = "U2";
                    $this->_cube->turn("U");
                    $this->_cube->turn("U");
                }
                else if ($block_list[0]->get_x() + $block_list[0]->get_y() + $block_list[1]->get_x() + $block_list[1]->get_y() == 0) {
                    foreach ($block_list as $b) {
                        if ($b->get_y() == 0) {
                            if ($b->get_x() == -1) {
                                //echo "调整魔方: y<br>";
                                $set_formula = "U";
                                $this->_cube->turn("U");
                                break;
                            }
                            if ($b->get_x() == 1) {
                                //echo "调整魔方: y'<br>";
                                $set_formula = "U'";
                                $this->_cube->turn("U'");
                                break;
                            }
                        } 
                    }
                }
            }                        
            $exe_formula = "F R U R' U' F'";
            $this->execute_formula_by_string($exe_formula);
            //echo "执行公式：".$exe_formula."<br>";

            $formula_item = new FormulaItem($set_formula, $exe_formula, $this->get_cube_png(), "", "");
            $this->_formula_recorder->recorder_formula(3, $formula_item);
        }
    }
 
    function resolver_3st_corner_color() {
        while (true) {
            $ok_block_list = array();
            $not_ok_block_list = array();
            foreach($this->_cube->get_block_list() as $b) {
                if ($b->get_z() == 1 && $b->get_type() == "corner")
                    if ($b->get_face("Y") == 3)
                        $ok_block_list[] = $b;
                    else
                        $not_ok_block_list[] = $b;
            }

            if (count($ok_block_list) == 4)
                break;
            
            //find
            $formula_set = array("U", "U'", "U2");
            $formula_unti_set = array("U'", "U", "U2");
            
            $axis_formula_set = array("y", "y'", "y2");
            $axis_formula_unti_set = array("y'", "y", "y2");

            $set_formula = "";
               
            if (count($ok_block_list) == 1)
                //set axis y ori
                for ($i=0; $i<count($formula_set); $i++) {
                    $this->execute_formula_by_string($formula_set[$i]);
                    if ($ok_block_list[0]->get_x() == 1 && $ok_block_list[0]->get_y() == -1) {
                        $set_formula = $set_formula.$formula_set[$i]." ";
                        break;
                    }
                    $this->execute_formula_by_string($formula_unti_set[$i]);
                }

            if (count($ok_block_list) == 2) {
                if ($not_ok_block_list[0]->get_face("Y") == $not_ok_block_list[1]->get_face("Y")) {
                    //set axis y ori
                    for ($i=0; $i<count($formula_set); $i++) {
                        $this->execute_formula_by_string($formula_set[$i]);
                        if ($not_ok_block_list[0]->get_face("Y") == 1) {
                            $set_formula = $set_formula.$formula_set[$i]." ";
                            break;
                        }
                        $this->execute_formula_by_string($formula_unti_set[$i]);
                    }
                }

                if ($not_ok_block_list[0]->get_face("Y") == -1 * $not_ok_block_list[1]->get_face("Y")) {
                    //set axis y ori
                    for ($i=0; $i<count($formula_set); $i++) {
                        $this->execute_formula_by_string($formula_set[$i]);
                        if (abs($not_ok_block_list[0]->get_face("Y")) == 1 && $not_ok_block_list[0]->get_y() == -1) {
                            $set_formula = $set_formula.$formula_set[$i]." ";
                            break;
                        }
                        $this->execute_formula_by_string($formula_unti_set[$i]);
                    }
                }

                if (abs($not_ok_block_list[0]->get_face("Y")) != abs($not_ok_block_list[1]->get_face("Y"))) {
                    //set axis y ori
                    for ($i=0; $i<count($formula_set); $i++) {
                        $this->execute_formula_by_string($formula_set[$i]);
                        if ($not_ok_block_list[0]->get_face("Y") + $not_ok_block_list[1]->get_face("Y") == 3) {
                            $set_formula = $set_formula.$formula_set[$i]." ";
                            break;
                        }
                        $this->execute_formula_by_string($formula_unti_set[$i]);
                    }
                }
            }

            if (count($ok_block_list) == 0) {
                $tmp_var = $not_ok_block_list[0]->get_face("Y") + $not_ok_block_list[1]->get_face("Y") + 
                $not_ok_block_list[2]->get_face("Y") + $not_ok_block_list[3]->get_face("Y");
                
                if ($tmp_var == 0) {
                    if (abs($not_ok_block_list[0]->get_face("Y")) == 1) {
                        $this->execute_formula_by_string("U");
                        $set_formula = $set_formula."U ";
                    }
                }
                else {
                    //get two same face block
                    $cur_face = $tmp_var / 2 ;
                    if ($cur_face == 1) {
                        $this->execute_formula_by_string("U");
                        $set_formula = $set_formula."U ";
                    }
                    
                    if ($cur_face == 2) {
                        $this->execute_formula_by_string("U2");
                        $set_formula = $set_formula."U2 ";
                    }
                
                    if ($cur_face == -1) {
                        $this->execute_formula_by_string("U'");
                        $set_formula = $set_formula."U' ";
                    }
                }
            }

            //echo "调整魔方: ".$set_formula."<br>";

            $exe_formula = "R U R' U R U2 R'";
            $this->execute_formula_by_string($exe_formula);
            //echo "执行公式：".$exe_formula."<br>";

            $formula_item = new FormulaItem($set_formula, $exe_formula, $this->get_cube_png(), "", "");
            $this->_formula_recorder->recorder_formula(4, $formula_item);
        }
    }

    function resolver_3st_corner_pos() {
        while (true) {
            $block_list = array();

            $is_recover_count = 0;
            $is_recover_b = "";
            $is_recover_color = "";
            //find
            //corner ["RGY", "RBY", "OGY", "OBY"]
            if ($this->_cube->find_block_by_name("RGY")->get_face("R") == $this->_cube->find_block_by_name("RBY")->get_face("R")) {
                $is_recover_count = $is_recover_count + 1;
                $is_recover_b = $this->_cube->find_block_by_name("RGY");
                $is_recover_color = "R";
            }

            if ($this->_cube->find_block_by_name("RGY")->get_face("G") == $this->_cube->find_block_by_name("OGY")->get_face("G")) {
                $is_recover_count = $is_recover_count + 1;
                $is_recover_b = $this->_cube->find_block_by_name("RGY");
                $is_recover_color = "G";
            }
 
            if ($this->_cube->find_block_by_name("RBY")->get_face("B") == $this->_cube->find_block_by_name("OBY")->get_face("B")) {
                $is_recover_count = $is_recover_count + 1;
                $is_recover_b = $this->_cube->find_block_by_name("RBY");
                $is_recover_color = "B";
            }
 
            if ($this->_cube->find_block_by_name("OGY")->get_face("O") == $this->_cube->find_block_by_name("OBY")->get_face("O")) {
                $is_recover_count = $is_recover_count + 1;
                $is_recover_b = $this->_cube->find_block_by_name("OGY");
                $is_recover_color = "O";
            }
 
            $formula_set = array("U", "U'", "U2");
            $formula_unti_set = array("U'", "U", "U2");
            
            $axis_formula_set = array("y", "y'", "y2");
            $axis_formula_unti_set = array("y'", "y", "y2");

            $set_formula = "";
 
            //adjust
            if ($is_recover_count == 4) {
                for ($i=0; $i<count($formula_set); $i++) {
                    $this->execute_formula_by_string($formula_set[$i]);
                    //print $block->get_name(), $block->get_x(), $block->get_y(), $block->get_z(), $block->get_tx(), $block->get_ty(), $block->get_tz()
                    if ($this->_cube->find_block_by_name("RGY")->is_recover()) {
                        //echo "顶层角块复原完毕，现调整到最终位置，公式为: ".$formula_set[$i]."<br>";
                        $formula_item = new FormulaItem($formula_set[$i], "", $this->get_cube_png(), "", "");
                        $this->_formula_recorder->recorder_formula(5, $formula_item);
                        break;
                    }
                    $this->execute_formula_by_string($formula_unti_set[$i]);
                }
                break; 
            }

            //set 
            if ($is_recover_count == 1) {
                for ($i=0; $i<count($formula_set); $i++) {
                    $this->execute_formula_by_string($formula_set[$i]);
                    if ($is_recover_b->get_face($is_recover_color) == 2) {
                        $set_formula = $set_formula.$formula_set[$i]." ";
                        break;
                    }
                    $this->execute_formula_by_string($formula_unti_set[$i]);
                }
            }

            //set 
            $this->execute_formula_by_string("x'");
            $set_formula = $set_formula."x' ";
            //echo "将顶层已还原好的角块（同一面两个顶层角块颜色一致）朝向右手边，同时将魔方顶面翻向自己做前面，公式为: ".$set_formula."<br>";

            //execute
            $exe_formula = "R2 D2 R' U' R D2 R' U R'";
            $this->execute_formula_by_string($exe_formula);
            //echo "执行公式：".$exe_formula."<br>";
 
            //unti-set
            $this->execute_formula_by_string("x");
            //echo "做完公式恢复原始魔方姿态，公式为: x <br>";

            $formula_item = new FormulaItem($set_formula, $exe_formula, $this->get_cube_png(), "", "", "x");
            $this->_formula_recorder->recorder_formula(5, $formula_item);
        }
    }

    function resolver_3st_side_pos() {
        while (true) {
            $block_list = array();

            $is_recover_count = 0;
            $is_recover_b = "";

            //find
            foreach($this->_cube->get_block_list() as $b) {
                if ($b->get_z() == 1 && $b->get_type() == "side" && $b->is_recover()) {
                    $is_recover_count = $is_recover_count + 1;
                    $is_recover_b = $b;
                }
            }

            $set_formula = "";

            //set
            if ($is_recover_count == 4)
                break;

            if ($is_recover_count == 1) {
                if ($is_recover_b->get_x() == 1) {
                    $this->execute_formula_by_string("y2");
                    $set_formula = $set_formula."y2";
                }
                    
                if ($is_recover_b->get_x() == 0 && $is_recover_b->get_y() == -1) {
                    $this->execute_formula_by_string("y");
                    $set_formula = $set_formula."y";
                }
                    
                if ($is_recover_b->get_x() == 0 && $is_recover_b->get_y() == 1) {
                    $this->execute_formula_by_string("y'");
                    $set_formula = $set_formula."y' ";
                }
            }

            //echo "已还原好的棱块背向自己，调整魔方，公式为: ".$set_formula."<br>";

            //execute 
            $exe_formula = "R U' R U R U R U' R' U' R2";
            $this->execute_formula_by_string($exe_formula);
            //echo "执行公式：".$exe_formula."<br>";

            $formula_item = new FormulaItem($set_formula, $exe_formula, $this->get_cube_png(), "", "");
            $this->_formula_recorder->recorder_formula(6, $formula_item);
        }
    }
 
 
    function resolver_step($step) {
        if ($step == "1st_corner") {
            $this->resolver_1st_corner();
            return;
        }
        
        if ($step == "2st_side") {
            $this->resolver_2st_side();
            return;
        }

        if ($step == "3st_side_color") {
            $this->resolver_3st_side_color();
            return;
        }

        if ($step == "3st_corner_color") {
            $this->resolver_3st_corner_color();
            return;
        }
            
        if ($step == "3st_corner_pos") {
            $this->resolver_3st_corner_pos();
            return;
        }

        if ($step == "3st_side_pos") {
            $this->resolver_3st_side_pos();
            return;
        }

        //first layer side block
        $this->_formula_stack = array();

        for($max_depth = 1; $max_depth<8; $max_depth++) 
            //print "max_depth: ", max_depth
            if ($this->depth_first_search(0, $max_depth, $step)) 
                break;
        if (count($this->_formula_stack) == 0)
            return $this->_formula_stack;

        //merge formula
        $tmp_formula_stack = array();
        foreach ($this->_formula_stack as $b) {
            $tmp_len = count($tmp_formula_stack);
            if($tmp_len>0 && $b == $tmp_formula_stack[$tmp_len-1])
                $tmp_formula_stack[$tmp_len-1] = $b[0]."2";
            else
                $tmp_formula_stack[] = $b;
        }
        $this->_formula_stack = $tmp_formula_stack;
        
        if(count($this->_formula_stack) == 0)
            return $this->_formula_stack;

        //record formula
        $formula_stack_str = "";
        foreach ($this->_formula_stack as $b) {
            $formula_stack_str = $formula_stack_str.$b." ";
        }
        $tmp_len = count($this->_resolver_condition[$step]);
        $tmp_name = $this->_resolver_condition[$step][$tmp_len-1];
        $block = $this->_cube->find_block_by_name($tmp_name);
        $formula_item = new FormulaItem("", $formula_stack_str, "", $block->get_disp_name(), "棱块");
        $this->_formula_recorder->recorder_formula(0, $formula_item);

        //print "turn time: ", $this->_cube->turn_time
        return $this->_formula_stack;
    }
}

$magic_cube = new MagicCube();
$cube_opt = new CubeOperator($magic_cube);

$disr_formula = "D R' F2 D' L U R' D";
if (isset($_POST["formula"])) {
    $disr_formula = str_replace("\\","",trim($_POST["formula"]));
}

$is_ajax_post = false;

if (isset($_POST["block"])) {
    $block_color = $_POST["block"];
    //print_r($block_color);
    $is_ajax_post = true;
    if(!$magic_cube->set_cube_color($block_color)) {
        $err_json = array("error"=>"input error");
        echo json_encode($err_json);
        exit;
    }
}
else{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- saved from url=(0119)http://media.smashingmagazine.com/cdn_smash/wp-content/uploads/uploader/images/css3-designs/css3-rubiks-cube/index.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>层先法教学助手（beta版），20分钟无成本学会魔方复原</title>
        <link rel="stylesheet" href="./index_files/stylesheet.css" type="text/css">
        <!--[if IE]>
            <link rel="stylesheet" href="css/ie.css" type="text/css" />
        <![endif]-->
    </head>
<body>

魔方教学助手beta版<br><br>
该工具用途是超低成本的让初学者学会使用层先法复原魔方，当前beta版还会升级，后续升级会有：<br>
1）将公式字母都变成直观的图片示例，类似互动游戏教学那样。<br>
2）可以拍照输入手上魔方状态，可以手动在页面上填写魔方的颜色。<br><br>
欢迎专业玩家试用反馈，问题欢迎反馈至 flst@qq.com <br>
<br>
<form method="POST" action="./cube_teacher.php">
自定义打乱公式（黄上红前）：<input type="text" name="formula" value="<?php echo $disr_formula?>"> 
<input type="submit" value="求解">
</form>
<hr>

<?php
echo "开始打乱魔方：".$disr_formula;
$cube_opt->execute_formula_by_string($disr_formula);
echo "<br>";
}
//echo "<br>";
//$magic_cube->print_cube();
//echo "<br>开始还原魔方，共7大步，请耐心还原，第一次预计20分钟完成复原<br>";

//create a cube who has bottom side block only
$magic_cube_cross = clone $magic_cube;
$magic_cube_cross->to_cross_cube();

$formula_recorder = new FormulaRecorder();
//step 1, 1st layer side
//echo "<br>=====第一步，还原底层（十字）棱块=====<br>";
$cube_rsl = new CubeResolver($magic_cube_cross, $formula_recorder);
//start = time.clock()

foreach (array('first_cross', 'secend_cross', 'third_cross', 'fouth_cross') as $step) {
    $formula = $cube_rsl->resolver_step($step);
    if (count($formula)!=0) {
        $cube_opt->execute_formula($formula);
        $cube_colors = $magic_cube->get_cube_color_array();
        $cube_printer = new CubePrinter($cube_colors,20);
        $formula_recorder->set_last_record_finish_png(0, $cube_printer->get_base64_xml());
    }
}

$cube_rsl = new CubeResolver($magic_cube, $formula_recorder);
//step 2, 1st layer corner
//echo "<br>=====第二步, 还原底层角块=====<br>";
$cube_rsl->resolver_step("1st_corner");

//step 3, 2st layer side
//echo "<br>=====第三步, 还原第二层棱块=====<br>";
$cube_rsl->resolver_step("2st_side");

//step 4, 3st layer side color
//echo "<br>=====第四步, 还原顶层（十字）棱块颜色=====<br>";
$cube_rsl->resolver_step("3st_side_color");

//step 5, 3st layer corner color
//echo "<br>=====第五步, 还原顶层角块颜色=====<br>";
$cube_rsl->resolver_step("3st_corner_color");

//step 6, 3st layer corner pos
//echo "<br>=====第六步, 还原顶层角块位置=====<br>";
$cube_rsl->resolver_step("3st_corner_pos");

//step 7, 3st layer side pos
//echo "<br>=====第七步，还原顶层棱块位置=====<br>";
$cube_rsl->resolver_step("3st_side_pos");

echo $formula_recorder->gen_json_output();
//elapsed = (time.clock() - start)
//$magic_cube->print_cube();/**/

?>
<?php if(!$is_ajax_post){?>
</body></html>
<?php }?>