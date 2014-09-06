<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- saved from url=(0119)http://media.smashingmagazine.com/cdn_smash/wp-content/uploads/uploader/images/css3-designs/css3-rubiks-cube/index.html -->
<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>层先法教学助手（beta版），让你20分钟无成本学会魔方</title>
        <link rel="stylesheet" href="./index_files/stylesheet.css" type="text/css">
        <!--[if IE]>
            <link rel="stylesheet" href="css/ie.css" type="text/css" />
        <![endif]-->
    </head>
<body>

<?php
//cube_teacher
//by sunweiwei 2014/9/5 

class Block {
	var $_disp_name;
    var $_ic;
    var $_jc;
    var $_kc;
    var $_x;
    var $_y;
    var $_z;
    var $_tx;
    var $_ty;
    var $_tz;
    var $_i;
    var $_j;
    var $_k;
    var $_ti;
    var $_tj;
    var $_tk;

	function __construct($name, $disp_name, $ic, $jc, $kc, $x, $y, $z, $i, $j, $k) {
		$this->_name = $name;
        $this->_disp_name = $disp_name;
        $this->_ic = $ic;
        $this->_jc = $jc;
        $this->_kc = $kc;
        $this->_x = $x;
        $this->_y = $y;
        $this->_z = $z;
        $this->_tx = $x;
        $this->_ty = $y;
        $this->_tz = $z;
        $this->_i = $i;
        $this->_j = $j;
        $this->_k = $k;
        $this->_ti = $i;
        $this->_tj = $j;
        $this->_tk = $k;
        $this->_type = "corner";
        if ($x == 0 || $y == 0 || $z == 0)
            $this->_type = "side";
        if (abs($x) + abs($y) + abs($z) == 1)
            $this->_type = "centre"; 
	}

    function is_recover() {
        if ($this->_x == $this->_tx && $this->_y == $this->_ty && $this->_z == $this->_tz && 
        $this->_i == $this->_ti && $this->_j == $this->_tj && $this->_k == $this->_tk)
            return true;
        return false;
    }
        

    function get_x() {
        return $this->_x;
    }

    function get_y() {
        return $this->_y;
    }

    function get_z() {
        return $this->_z;
    }
        
    function get_tx() {
        return $this->_tx;
    }

    function get_ty() {
        return $this->_ty;
    }

    function get_tz() {
        return $this->_tz;
    }
 
    function get_i() {
        return $this->_i;
    }

    function get_j() {
        return $this->_j;
    }

    function get_k() {
        return $this->_k;
    }
        
    function get_ti() {
        return $this->_ti;
    }

    function get_tj() {
        return $this->_tj;
    }

    function get_tk() {
        return $this_tk;
    }
        
    function get_type() {
        return $this->_type;
    }

    function get_name() {
        return $this->_name;
    }

    function get_disp_name() {
        return $this->_disp_name;
    }
           
    function get_color($face) { 
        if ($this->_i == $face)
            return $this->_ic;
        if ($this->_j == $face)
            return $this->_jc;
        if ($this->_k == $face)
            return $this->_kc;
        return "N";
    }
        
    function get_iorj_color() { 
        if ($this->_ic != "N")
            return $this->_ic;
        if ($this->_jc != "N")
            return $this->_jc;
        return "N";
    }
 
        
    function get_face($color) { 
        if ($this->_ic == $color)
            return $this->_i;
        if ($this->_jc == $color)
            return $this->_j;
        if ($this->_kc == $color)
            return $this->_k;
        return "n";
    }

    function do_trans($face) {
        if ($face[0] == "A")
            return true;
        if ($face == "F" && $this->_x == 1)
            return true;
        if ($face == "B" && $this->_x == -1)
            return true;

        if ($face == "R" && $this->_y == 1)
            return true;
        if ($face == "L" && $this->_y == -1)
            return true;

        if ($face == "U" && $this->_z == 1)
            return true;
        if ($face == "D" && $this->_z == -1)
            return true;

        return false;
    }

    function right_hand_process($face) {
        if ($face == "F" || $face == "B" || $face == "AF") {
            list($this->_j,$this->_k)=array($this->_k,$this->_j);
            list($this->_jc,$this->_kc)=array($this->_kc,$this->_jc);
        }
            
        if ($face == "R" || $face == "L" || $face == "AR") {
            list($this->_i,$this->_k)=array($this->_k,$this->_i);
            list($this->_ic,$this->_kc)=array($this->_kc,$this->_ic);
        }
            
        if ($face == "U" || $face == "D" || $face == "AU") {
            list($this->_i,$this->_j)=array($this->_j,$this->_i);
            list($this->_ic,$this->_jc)=array($this->_jc,$this->_ic);
        }

        if ($face[0] == "A") {
            if ($face[1] == "F")
                list($this->_tj,$this->_tk)=array($this->_tk,$this->_tj);
            if ($face[1] == "R")
                list($this->_ti,$this->_tk)=array($this->_tk,$this->_ti);
            if ($face[1] == "U")
                list($this->_ti,$this->_tj)=array($this->_tj,$this->_ti);
        }
    }

    function turn_transform($face, $trans_matrix) {
        if ($this->do_trans($face)) {
            $pos_matrix = $trans_matrix["pos"];
            $ori_matrix = $trans_matrix["ori"];
        
            //pos transform
            $x = $this->_x;
            $y = $this->_y;
            $z = $this->_z;
            
            $this->_x = $pos_matrix[0][0] * $x + $pos_matrix[0][1] * $y + $pos_matrix[0][2] * $z;
            $this->_y = $pos_matrix[1][0] * $x + $pos_matrix[1][1] * $y + $pos_matrix[1][2] * $z;
            $this->_z = $pos_matrix[2][0] * $x + $pos_matrix[2][1] * $y + $pos_matrix[2][2] * $z;

            //target pos transform
            if ($face[0] == "A") { 
                $tx = $this->_tx;
                $ty = $this->_ty;
                $tz = $this->_tz;
            
                $this->_tx = $pos_matrix[0][0] * $tx + $pos_matrix[0][1] * $ty + $pos_matrix[0][2] * $tz;
                $this->_ty = $pos_matrix[1][0] * $tx + $pos_matrix[1][1] * $ty + $pos_matrix[1][2] * $tz;
                $this->_tz = $pos_matrix[2][0] * $tx + $pos_matrix[2][1] * $ty + $pos_matrix[2][2] * $tz;
            }

            //ori transform
            $i = $this->_i;
            $j = $this->_j;
            $k = $this->_k;

            //mirror process
            $iFlag = 1;
            $jFlag = 1;
            $kFlag = 1;
            if ($i < 0 ) {
                $i = $i * -1;
                $iFlag = -1;
            }
            if ($j < 0 ) {
                $j = $j * -1;
                $jFlag = -1;
            }
            if ($k < 0 ) {
                $k = $k * -1;
                $kFlag = -1;
            }

            $this->_i = ($ori_matrix[0][0] * $i + $ori_matrix[0][1] * $j + $ori_matrix[0][2] * $k) * $iFlag;
            $this->_j = ($ori_matrix[1][0] * $i + $ori_matrix[1][1] * $j + $ori_matrix[1][2] * $k) * $jFlag;
            $this->_k = ($ori_matrix[2][0] * $i + $ori_matrix[2][1] * $j + $ori_matrix[2][2] * $k) * $kFlag;

            if ($face[0] == "A") { 
                //ori transform
                $ti = $this->_ti;
                $tj = $this->_tj;
                $tk = $this->_tk;

                //mirror process
                $tiFlag = 1;
                $tjFlag = 1;
                $tkFlag = 1;
                if ($ti < 0 ) {
                    $ti = $ti * -1;
                    $tiFlag = -1;
                }
                if ($tj < 0 ) {
                    $tj = $tj * -1;
                    $tjFlag = -1;
                }
                if ($tk < 0 ) {
                    $tk = $tk * -1;
                    $tkFlag = -1;
                }

                $this->_ti = ($ori_matrix[0][0] * $ti + $ori_matrix[0][1] * $tj + $ori_matrix[0][2] * $tk) * $tiFlag;
                $this->_tj = ($ori_matrix[1][0] * $ti + $ori_matrix[1][1] * $tj + $ori_matrix[1][2] * $tk) * $tjFlag;
                $this->_tk = ($ori_matrix[2][0] * $ti + $ori_matrix[2][1] * $tj + $ori_matrix[2][2] * $tk) * $tkFlag;
            }

            //right h&& process
            $this->right_hand_process($face);
        } 
    }
}

class MagicCube {
    var $_block;
    var $_display_matrix;
    var $_trans_matrix;
    function __construct($cross_cube = false) {
        $this->_block = array();     

        //add centre
        $this->_block[] = new Block("RNN", "红", "R", "N", "N", 1, 0, 0, 1, 2, 3);
        $this->_block[] = new Block("ONN", "橙", "O", "N", "N", -1, 0, 0, -1, 2, 3);
        $this->_block[] = new Block("NGN", "绿", "N", "G", "N", 0, 1, 0, 1, 2, 3);
        $this->_block[] = new Block("NBN", "蓝", "N", "B", "N", 0, -1, 0, 1, -2, 3);
        $this->_block[] = new Block("NNY", "黄", "N", "N", "Y", 0, 0, 1, 1, 2, 3);
        $this->_block[] = new Block("NNW", "白", "N", "N", "W", 0, 0, -1, 1, 2, -3);

        //add corner
        $this->_block[] = new Block("RGY", "红绿黄", "R", "G", "Y", 1, 1, 1, 1, 2, 3);
        $this->_block[] = new Block("OGY", "橙绿黄", "O", "G", "Y", -1, 1, 1, -1, 2, 3);
        $this->_block[] = new Block("RBY", "红蓝黄", "R", "B", "Y", 1, -1, 1, 1, -2, 3);
        $this->_block[] = new Block("OBY", "橙蓝黄", "O", "B", "Y", -1, -1, 1, -1, -2, 3);
        $this->_block[] = new Block("RGW", "红绿白", "R", "G", "W", 1, 1, -1, 1, 2, -3);
        $this->_block[] = new Block("OGW", "橙绿白", "O", "G", "W", -1, 1, -1, -1, 2, -3);
        $this->_block[] = new Block("RBW", "红蓝白", "R", "B", "W", 1, -1, -1, 1, -2, -3);
        $this->_block[] = new Block("OBW", "橙蓝白", "O", "B", "W", -1, -1, -1, -1, -2, -3);
        //add side
        $this->_block[] = new Block("NGY", "绿黄", "N", "G", "Y", 0, 1, 1, 1, 2, 3);
        $this->_block[] = new Block("NBY", "蓝黄", "N", "B", "Y", 0, -1, 1, 1, -2, 3);
        $this->_block[] = new Block("NGW", "绿白", "N", "G", "W", 0, 1, -1, 1, 2, -3);
        $this->_block[] = new Block("NBW", "蓝白", "N", "B", "W", 0, -1, -1, 1, -2, -3);
        
        $this->_block[] = new Block("RNY", "红黄", "R", "N", "Y", 1, 0, 1, 1, 2, 3);
        $this->_block[] = new Block("ONY", "橙黄", "O", "N", "Y", -1, 0, 1, -1, 2, 3);
        $this->_block[] = new Block("RNW", "红白", "R", "N", "W", 1, 0, -1, 1, 2, -3);
        $this->_block[] = new Block("ONW", "橙白", "O", "N", "W", -1, 0, -1, -1, 2, -3);

        $this->_block[] = new Block("RGN", "红绿", "R", "G", "N", 1, 1, 0, 1, 2, 3);
        $this->_block[] = new Block("OGN", "橙绿", "O", "G", "N", -1, 1, 0, -1, 2, 3);
        $this->_block[] = new Block("RBN", "红蓝", "R", "B", "N", 1, -1, 0, 1, -2, 3);
        $this->_block[] = new Block("OBN", "橙蓝", "O", "B", "N", -1, -1, 0, -1, -2, 3);

        //init display matrix
        $this->_display_matrix  = array();
        $this->_display_matrix["F"] = array(array("R","R","R"),array("R","R","R"),array("R","R","R"));
        $this->_display_matrix["B"] = array(array("O","O","O"),array("O","O","O"),array("O","O","O"));
        $this->_display_matrix["R"] = array(array("G","G","G"),array("G","G","G"),array("G","G","G"));
        $this->_display_matrix["L"] = array(array("B","B","B"),array("B","B","B"),array("B","B","B"));
        $this->_display_matrix["U"] = array(array("Y","Y","Y"),array("Y","Y","Y"),array("Y","Y","Y"));
        $this->_display_matrix["D"] = array(array("W","W","W"),array("W","W","W"),array("W","W","W"));

        //init _trans_matrix
        $this->_trans_matrix = array();
        $this->_trans_matrix["x"] = array("pos"=>array(array(1,0,0),array(0,0,1),array(0,-1,0)), "ori"=>array(array(1,0,0),array(0,0,-1),array(0,1,0)));
        $this->_trans_matrix["y"] = array("pos"=>array(array(0,0,-1),array(0,1,0),array(1,0,0)), "ori"=>array(array(0,0,1),array(0,1,0),array(-1,0,0)));
        $this->_trans_matrix["z"] = array("pos"=>array(array(0,1,0),array(-1,0,0),array(0,0,1)), "ori"=>array(array(0,-1,0),array(1,0,0),array(0,0,1)));

        $this->_trans_matrix["-x"] = array("pos"=>array(array(1,0,0),array(0,0,-1),array(0,1,0)), "ori"=>array(array(1,0,0),array(0,0,1),array(0,-1,0)));
        $this->_trans_matrix["-y"] = array("pos"=>array(array(0,0,1),array(0,1,0),array(-1,0,0)), "ori"=>array(array(0,0,-1),array(0,1,0),array(1,0,0)));
        $this->_trans_matrix["-z"] = array("pos"=>array(array(0,-1,0),array(1,0,0),array(0,0,1)), "ori"=>array(array(0,1,0),array(-1,0,0),array(0,0,1)));
    }

    function to_cross_cube() {
        $cross_block_name = array("RNW", "ONW", "NGW", "NBW"); 
        $tmp_block = array();
        foreach($this->_block as $b)
            if (in_array($b->get_name(), $cross_block_name))
                $tmp_block[] = clone $b;
        $this->_block = $tmp_block;
    }

    function find_block_by_name($name) {
        foreach($this->_block as $b)
            if ($name == $b->get_name())
                return $b;
    }

    function get_block_list() {
        return $this->_block;
    }

    function get_centre_block($color) {
        foreach($this->_block as $b)
            if ($b->get_type() == "centre" && strstr($b->get_name(), $color) != false)
                return $b;
        return null;
    }

    function gen_display_matrix() {
        //get face F
        foreach($this->_block as $b)
            if ($b->get_x() == 1)
                $this->_display_matrix["F"][1-$b->get_z()][$b->get_y()+1] = $b->get_color(1); 
 
        //get face B
        foreach($this->_block as $b)
            if ($b->get_x() == -1)
                $this->_display_matrix["B"][$b->get_z()+1][$b->get_y()+1] = $b->get_color(-1); 
            
        //get face R
        foreach($this->_block as $b)
            if ($b->get_y() == 1)
                $this->_display_matrix["R"][1-$b->get_z()][1-$b->get_x()] = $b->get_color(2); 
 
        //get face L
        foreach($this->_block as $b)
            if ($b->get_y() == -1)
                $this->_display_matrix["L"][$b->get_z()+1][1-$b->get_x()] = $b->get_color(-2); 
 
        //get face U
        foreach($this->_block as $b)
            if ($b->get_z() == 1)
                $this->_display_matrix["U"][$b->get_x()+1][$b->get_y()+1] = $b->get_color(3); 
 
        //get face D
        foreach($this->_block as $b)
            if ($b->get_z() == -1)
                $this->_display_matrix["D"][1-$b->get_y()][1-$b->get_x()] = $b->get_color(-3);
    }
 
    function print_face($face) {
        echo "face: ".$face."<br>";
        foreach($this->_display_matrix[$face] as $c)
            echo $c[0]." ".$c[1]." ".$c[2]."<br>";
        echo "<br>"; 
    }
        
    function print_cube() {
        $this->gen_display_matrix();
        $this->print_face("U");
        $this->print_face("F");
        $this->print_face("R");
        $this->print_face("D");
        $this->print_face("L");
        $this->print_face("B");
    }

    function turn($action) {
        //start = time.clock()
        $face = "";
        $axis = "";
        if ($action == "F") {
            $face = "F";
            $axis = "x";
        }
       
        if ($action == "F'") {
            $face = "F";
            $axis = "-x";
        }

        if ($action == "R") {
            $face = "R";
            $axis = "y";
        }
 
        if ($action == "R'") {
            $face = "R";
            $axis = "-y";
        }
 
        if ($action == "U") {
            $face = "U";
            $axis = "z";
        }
                
        if ($action == "U'") {
            $face = "U";
            $axis = "-z";
        }
 
        if ($action == "B'") {
            $face = "B";
            $axis = "x";
        }
       
        if ($action == "B") {
            $face = "B";
            $axis = "-x";
        }

        if ($action == "L'") {
            $face = "L";
            $axis = "y";
        }
 
        if ($action == "L") {
            $face = "L";
            $axis = "-y";
        }
                
        if ($action == "D'") {
            $face = "D";
            $axis = "z";
        }
                
        if ($action == "D") {
            $face = "D";
            $axis = "-z";
        }

        if ($action == "y") {
            $face = "AU";
            $axis = "z";
        }
       
        if ($action == "y'") {
            $face = "AU";
            $axis = "-z";
        }

        if ($action == "x") {
            $face = "AR";
            $axis = "y";
        }
       
        if ($action == "x'") {
            $face = "AR";
            $axis = "-y";
        }

        //print face, axis
        foreach($this->_block as $b) {
            $b->turn_transform($face, $this->_trans_matrix[$axis]);
        }
    }
}

class CubeOperator {
    var $_cube;
    function __construct($cube) {
        $this->_cube = $cube;
    }

    function execute_formula($formula) {
        echo "执行公式: ";
        
        foreach ($formula as $f) {
            echo $f." ";
            if (strlen($f) == 2 && $f[1] == "2") {
                $this->_cube->turn($f[0]);
                $this->_cube->turn($f[0]);
            }
            else
                $this->_cube->turn($f);
        }

        echo "<br>";
    }
 
    function execute_formula_by_string($formula_string) {
        $formula = explode(" ",$formula_string);
        $this->execute_formula($formula);
    }
}


class CubeResolver {
    var $_cube;
    var $_formula_set;
    var $_formula_unti_set;
    var $_resolver_condition;
    
    function __construct($cube) {
        $this->_cube = $cube;
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

                $set_formula = $set_formula."R U R'";
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

            echo "在顶层找到含底面颜色（白色）的角块：".$block->get_disp_name().", 将角块通过顶层转动至要还原位置的正上方，公式为: ".$set_formula."<br>";

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
            echo "执行公式：".$exe_formula."<br>";
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

            echo "在顶层找到不含顶面颜色（黄色）的棱块: ".$block->get_disp_name()."，将棱块通过顶层转动至与侧面颜色一致的中心块位置并面向自己，公式为: ".$set_formula."<br>";

            //execute
            $exe_formula = array();
            $ty = $block->get_ty();
            if ($ty == -1)
                $exe_formula = "U' L' U L U F U' F'";

            if ($ty == 1)
                $exe_formula = "U R U' R' U' F' U F";
                
            $this->execute_formula_by_string($exe_formula);
            echo "执行公式：".$exe_formula."<br>";

        }
    }

    function resolver_3st_side_color() {
        while (true) {
            $block_list = array();
            foreach($this->_cube->get_block_list() as $b) {
                if ($b->get_z() == 1 && $b->get_type() == "side" &&  $b->get_face("Y") == 3)
                    $block_list[] = $b;
            }

            if (count($block_list) == 4)
                break;
               
            if (count($block_list) == 2) {
                if ($block_list[0]->get_y() == 0 && $block_list[0]->get_y() == 0) {
                    echo "调整魔方: y<br>";
                    $this->_cube->turn("y");
                }
                if ($block_list[0]->get_x() + $block_list[0]->get_y() + $block_list[1]->get_x() + $block_list[1]->get_y() == -2) {
                    echo "s调整魔方: y2<br>";
                    $this->_cube->turn("y");
                    $this->_cube->turn("y");
                }
                if ($block_list[0]->get_x() + $block_list[0]->get_y() + $block_list[1]->get_x() + $block_list[1]->get_y() == 0) {
                    foreach ($block_list as $b) {
                        if ($b->get_y() == 0) {
                            if ($b->get_x() == -1) {
                                echo "调整魔方: y<br>";
                                $this->_cube->turn("y");
                            }
                            if ($b->get_x() == 1) {
                                echo "调整魔方: y'<br>";
                                $this->_cube->turn("y'");
                            }
                        } 
                    }
                }
            }                        
            $exe_formula = "F R U R' U' F'";
            $this->execute_formula_by_string($exe_formula);
            echo "执行公式：".$exe_formula."<br>";
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
                for ($i=0; $i<count($axis_formula_set); $i++) {
                    $this->execute_formula_by_string($axis_formula_set[$i]);
                    if ($ok_block_list[0]->get_x() == 1 && $ok_block_list[0]->get_y() == -1) {
                        $set_formula = $set_formula.$axis_formula_set[$i]." ";
                        break;
                    }
                    $this->execute_formula_by_string($axis_formula_unti_set[$i]);
                }

            if (count($ok_block_list) == 2) {
                if ($not_ok_block_list[0]->get_face("Y") == $not_ok_block_list[1]->get_face("Y")) {
                    //set axis y ori
                    for ($i=0; $i<count($axis_formula_set); $i++) {
                        $this->execute_formula_by_string($axis_formula_set[$i]);
                        if ($not_ok_block_list[0]->get_face("Y") == 1) {
                            $set_formula = $set_formula.$axis_formula_set[$i]." ";
                            break;
                        }
                        $this->execute_formula_by_string($axis_formula_unti_set[$i]);
                    }
                }

                if ($not_ok_block_list[0]->get_face("Y") == -1 * $not_ok_block_list[1]->get_face("Y")) {
                    //set axis y ori
                    for ($i=0; $i<count($axis_formula_set); $i++) {
                        $this->execute_formula_by_string($axis_formula_set[$i]);
                        if (abs($not_ok_block_list[0]->get_face("Y")) == 1 && $not_ok_block_list[0]->get_y() == -1) {
                            $set_formula = $set_formula.$axis_formula_set[$i]." ";
                            break;
                        }
                        $this->execute_formula_by_string($axis_formula_unti_set[$i]);
                    }
                }

                if (abs($not_ok_block_list[0]->get_face("Y")) != abs($not_ok_block_list[1]->get_face("Y"))) {
                    //set axis y ori
                    for ($i=0; $i<count($axis_formula_set); $i++) {
                        $this->execute_formula_by_string($axis_formula_set[$i]);
                        if ($not_ok_block_list[0]->get_face("Y") + $not_ok_block_list[1]->get_face("Y") == 3) {
                            $set_formula = $set_formula.$axis_formula_set[$i]." ";
                            break;
                        }
                        $this->execute_formula_by_string($axis_formula_unti_set[i]);
                    }
                }
            }

            if (count($ok_block_list) == 0) {
                $tmp_var = $not_ok_block_list[0]->get_face("Y") + $not_ok_block_list[1]->get_face("Y") + 
                $not_ok_block_list[2]->get_face("Y") + $not_ok_block_list[3]->get_face("Y");
                
                if ($tmp_var == 0) {
                    if (abs($not_ok_block_list[0]->get_face("Y")) == 1) {
                        $this->execute_formula_by_string("y");
                        $set_formula = $set_formula."y ";
                    }
                }
                else {
                    //get two same face block
                    $cur_face = $tmp_var / 2 ;
                    if ($cur_face == 1) {
                        $this->execute_formula_by_string("y");
                        $set_formula = $set_formula."y ";
                    }
                    
                    if ($cur_face == 2) {
                        $this->execute_formula_by_string("y2");
                        $set_formula = $set_formula."y2 ";
                    }
                
                    if ($cur_face == -1) {
                        $this->execute_formula_by_string("y'");
                        $set_formula = $set_formula."y' ";
                    }
                }
            }

            echo "调整魔方: ".$set_formula."<br>";

            $exe_formula = "R U R' U R U2 R'";
            $this->execute_formula_by_string($exe_formula);
            echo "执行公式：".$exe_formula."<br>";
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
                        echo "顶层角块复原完毕，现调整到最终位置，公式为: ".$formula_set[$i]."<br>";
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
            echo "将顶层已还原好的角块（同一面两个顶层角块颜色一致）朝向右手边，同时将魔方顶面翻向自己做前面，公式为: ".$set_formula."<br>";

            //execute
            $exe_formula = "R2 D2 R' U' R D2 R' U R'";
            $this->execute_formula_by_string($exe_formula);
            echo "执行公式：".$exe_formula."<br>";
 
            //unti-set
            $this->execute_formula_by_string("x");
            echo "做完公式恢复原始魔方姿态，公式为: x <br>";
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

            echo "已还原好的棱块背向自己，调整魔方，公式为: ".$set_formula."<br>";

            //execute 
            $exe_formula = "R U' R U R U R U' R' U' R2";
            $this->execute_formula_by_string($exe_formula);
            echo "执行公式：".$exe_formula."<br>";
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

        $this->_formula_stack = array();

        for($max_depth = 1; $max_depth<8; $max_depth++) 
            //print "max_depth: ", max_depth
            if ($this->depth_first_search(0, $max_depth, $step)) 
                break;
   
        //print "turn time: ", $this->_cube->turn_time
        return $this->_formula_stack;
    }
}

$disr_formula = "D R' F2 D' L U R' D";
if (isset($_POST["formula"]))
    $disr_formula = trim($_POST["formula"]);

?>
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

$magic_cube = new MagicCube();
$cube_opt = new CubeOperator($magic_cube);
echo "开始打乱魔方：";
$cube_opt->execute_formula_by_string($disr_formula);
echo "<br>";
echo "<br>开始还原魔方，共7大步，请耐心还原，第一次预计20分钟完成复原<br>";

//create a cube who has bottom side block only
$magic_cube_cross = clone $magic_cube;
$magic_cube_cross->to_cross_cube();

//step 1, 1st layer side
echo "<br>=====第一步，还原底层（十字）棱块=====<br>";
$cube_rsl = new CubeResolver($magic_cube_cross);
//start = time.clock()
$cube_opt->execute_formula($cube_rsl->resolver_step("first_cross"));
$cube_opt->execute_formula($cube_rsl->resolver_step("secend_cross"));
$cube_opt->execute_formula($cube_rsl->resolver_step("third_cross"));
$cube_opt->execute_formula($cube_rsl->resolver_step("fouth_cross"));

$cube_rsl = new CubeResolver($magic_cube);
//step 2, 1st layer corner
echo "<br>=====第二步, 还原底层角块=====<br>";
$cube_rsl->resolver_step("1st_corner");

//step 3, 2st layer side
echo "<br>=====第三步, 还原第二层棱块=====<br>";
$cube_rsl->resolver_step("2st_side");

//step 4, 3st layer side color
echo "<br>=====第四步, 还原顶层（十字）棱块颜色=====<br>";
$cube_rsl->resolver_step("3st_side_color");

//step 5, 3st layer corner color
echo "<br>=====第五步, 还原顶层角块颜色=====<br>";
$cube_rsl->resolver_step("3st_corner_color");

//step 6, 3st layer corner pos
echo "<br>=====第六步, 还原顶层角块位置=====<br>";
$cube_rsl->resolver_step("3st_corner_pos");

//step 7, 3st layer side pos
echo "<br>=====第七步，还原顶层棱块位置=====<br>";
$cube_rsl->resolver_step("3st_side_pos");

//elapsed = (time.clock() - start)
//$magic_cube->print_cube();

?>

</body></html>