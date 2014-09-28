<?php
class Block {
	var $_disp_name;
    var $_ic;
    var $_jc;
    var $_kc;
    var $_tic;
    var $_tjc;
    var $_tkc;
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
        $this->_tic = $ic;
        $this->_tjc = $jc;
        $this->_tkc = $kc;
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
        $this->_ic == $this->_tic && $this->_jc == $this->_tjc && $this->_kc == $this->_tkc) {
            if (($this->_ic == "N" or $this->_i == $this->_ti) && ($this->_jc == "N" or $this->_j == $this->_tj) && ($this->_kc == "N" or $this->_k == $this->_tk)) {
                    return true;
            }
        }
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
        return $this->_tk;
    }

    function get_tic() {
        return $this->_tic;
    }

    function get_tjc() {
        return $this->_tjc;
    }

    function get_tkc() {
        return $this->_tkc;
    }

    function get_ic() {
        return $this->_ic;
    }

    function get_jc() {
        return $this->_jc;
    }

    function get_kc() {
        return $this->_kc;
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

    function set_target($target_block) {
        $this->_tx = $target_block->get_tx();
        $this->_ty = $target_block->get_ty();
        $this->_tz = $target_block->get_tz();

        $this->_ti = $target_block->get_ti();
        $this->_tj = $target_block->get_tj();
        $this->_tk = $target_block->get_tk();

        $this->_tic = $target_block->get_tic();
        $this->_tjc = $target_block->get_tjc();
        $this->_tkc = $target_block->get_tkc();
    }

    function gen_name() {
        #gen name
        $color_pos = array("R"=>0,"O"=>0,"G"=>1,"B"=>1,"W"=>2,"Y"=>2);
        if ($this->_ic != "N")
            $this->_name[$color_pos[$this->_ic]] = $this->_ic;
        if ($this->_jc != "N")
            $this->_name[$color_pos[$this->_jc]] = $this->_jc;
        if ($this->_kc != "N")
            $this->_name[$color_pos[$this->_kc]] = $this->_kc;

        #gen disp name
        $color_chinese = array("R"=>"红","O"=>"橙","G"=>"绿","B"=>"蓝","W"=>"白","Y"=>"黄");

        for($i=0; $i<3; $i++) {
            if ($this->_name[$i] != "N")
            $this->_disp_name = $this->_disp_name.$color_chinese[$this->_name[$i]];
        }
    }

    function set_color($face, $color) { 
        $c = strtoupper($color[0]);
        if ($this->_i == $face) {
            $this->_ic = $c;
        }
        if ($this->_j == $face) {
            $this->_jc = $c;
        }
        if ($this->_k == $face) {
            $this->_kc = $c;
        }
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
            if ($face[1] == "F") {
                list($this->_tj,$this->_tk)=array($this->_tk,$this->_tj);
                list($this->_tjc,$this->_tkc)=array($this->_tkc,$this->_tjc);
            }
            if ($face[1] == "R") {
                list($this->_ti,$this->_tk)=array($this->_tk,$this->_ti);
                list($this->_tic,$this->_tkc)=array($this->_tkc,$this->_tic);
            }
            if ($face[1] == "U") {
                list($this->_ti,$this->_tj)=array($this->_tj,$this->_ti);
                list($this->_tic,$this->_tjc)=array($this->_tjc,$this->_tic);
            }
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

    function set_cube_color($block_color) {
        $color_map = array();
        $color_map[0] = array(1, -1, 1, 3);
        $color_map[1] = array(0, -1, 1, 3);
        $color_map[2] = array(-1, -1, 1, 3);
        $color_map[3] = array(1, 0, 1, 3);
        $color_map[4] = array(0, 0, 1, 3);
        $color_map[5] = array(-1, 0, 1, 3);
        $color_map[6] = array(1, 1, 1, 3);
        $color_map[7] = array(0, 1, 1, 3);
        $color_map[8] = array(-1, 1, 1, 3);

        $color_map[9] = array(1, -1, 1, 1);
        $color_map[10] = array(1, 0, 1, 1);
        $color_map[11] = array(1, 1, 1, 1);
        $color_map[12] = array(1, -1, 0, 1);
        $color_map[13] = array(1, 0, 0, 1);
        $color_map[14] = array(1, 1, 0, 1);
        $color_map[15] = array(1, -1, -1, 1);
        $color_map[16] = array(1, 0, -1, 1);
        $color_map[17] = array(1, 1, -1, 1);

        $color_map[18] = array(1, 1, 1, 2);
        $color_map[19] = array(0, 1, 1, 2);
        $color_map[20] = array(-1, 1, 1, 2);
        $color_map[21] = array(1, 1, 0, 2);
        $color_map[22] = array(0, 1, 0, 2);
        $color_map[23] = array(-1, 1, 0, 2);
        $color_map[24] = array(1, 1, -1, 2);
        $color_map[25] = array(0, 1, -1, 2);
        $color_map[26] = array(-1, 1, -1, 2);

        $color_map[27] = array(1, -1, -1, -3);
        $color_map[28] = array(1, 0, -1, -3);
        $color_map[29] = array(1, 1, -1, -3);
        $color_map[30] = array(0, -1, -1, -3);
        $color_map[31] = array(0, 0, -1, -3);
        $color_map[32] = array(0, 1, -1,-3);
        $color_map[33] = array(-1, -1, -1, -3);
        $color_map[34] = array(-1, 0, -1, -3);
        $color_map[35] = array(-1, 1, -1, -3);

        $color_map[36] = array(1, -1, -1, -2);
        $color_map[37] = array(0, -1, -1, -2);
        $color_map[38] = array(-1, -1, -1, -2);
        $color_map[39] = array(1, -1, 0, -2);
        $color_map[40] = array(0, -1, 0, -2);
        $color_map[41] = array(-1, -1, 0, -2);
        $color_map[42] = array(1, -1, 1, -2);
        $color_map[43] = array(0, -1, 1, -2);
        $color_map[44] = array(-1, -1, 1, -2);

        $color_map[45] = array(-1, -1, -1, -1);
        $color_map[46] = array(-1, 0, -1, -1);
        $color_map[47] = array(-1, 1, -1, -1);
        $color_map[48] = array(-1, -1, 0, -1);
        $color_map[49] = array(-1, 0, 0, -1);
        $color_map[50] = array(-1, 1, 0, -1);
        $color_map[51] = array(-1, -1, 1, -1);
        $color_map[52] = array(-1, 0, 1, -1);
        $color_map[53] = array(-1, 1, 1, -1);

        //add centre
        $tmp_block = array();
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 1, 0, 0, 1, 2, 3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", -1, 0, 0, -1, 2, 3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 0, 1, 0, 1, 2, 3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 0, -1, 0, 1, -2, 3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 0, 0, 1, 1, 2, 3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 0, 0, -1, 1, 2, -3);

        //add corner
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 1, 1, 1, 1, 2, 3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", -1, 1, 1, -1, 2, 3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 1, -1, 1, 1, -2, 3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", -1, -1, 1, -1, -2, 3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 1, 1, -1, 1, 2, -3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", -1, 1, -1, -1, 2, -3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 1, -1, -1, 1, -2, -3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", -1, -1, -1, -1, -2, -3);
        //add side
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 0, 1, 1, 1, 2, 3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 0, -1, 1, 1, -2, 3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 0, 1, -1, 1, 2, -3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 0, -1, -1, 1, -2, -3);
        
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 1, 0, 1, 1, 2, 3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", -1, 0, 1, -1, 2, 3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 1, 0, -1, 1, 2, -3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", -1, 0, -1, -1, 2, -3);

        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 1, 1, 0, 1, 2, 3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", -1, 1, 0, -1, 2, 3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", 1, -1, 0, 1, -2, 3);
        $tmp_block[] = new Block("NNN", "", "N", "N", "N", -1, -1, 0, -1, -2, 3);

        #set color
        for($i=0; $i<54; $i++) {
            foreach($tmp_block as $b) {
                if ($b->get_x() == $color_map[$i][0] && 
                    $b->get_y() == $color_map[$i][1] &&
                    $b->get_z() == $color_map[$i][2]) {
                    $b->set_color($color_map[$i][3], $block_color[$i]);
                }
            }
        }

        $all_block_find = array();

        #set name, then get target position and color face
        foreach($tmp_block as $b) {
            $b->gen_name();
            if (!in_array($b->get_name(), $all_block_find)) {
                $all_block_find[] = $b->get_name();
            }
            //echo $b->get_name()."<br>";
            $tb = $this->find_block_by_name($b->get_name());
            
            $b->set_target($tb);
            //echo $b->get_tic()." ".$b->get_tjc()." ".$b->get_tkc()." ".$b->get_tx()." ".$b->get_ty()." ".$b->get_tz()." ".$b->get_ti()." ".$b->get_tj()." ".$b->get_tk()."<br>";
        }

        if (count($all_block_find) != 26)
            return false;

        $this->_block = $tmp_block;
        return true;
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
        return "";
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
                $this->_display_matrix["U"][$b->get_y()+1][1-$b->get_x()] = $b->get_color(3); 
 
        //get face D
        foreach($this->_block as $b)
            if ($b->get_z() == -1)
                $this->_display_matrix["D"][1-$b->get_x()][$b->get_y()+1] = $b->get_color(-3);
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

    function get_cube_color_array() {
        $this->gen_display_matrix();
        $cube_json = array();
        $face_set = array("U","F","R","D","L","B");

        foreach($face_set as $face) {
            foreach($this->_display_matrix[$face] as $c) {
                $cube_json[] = $c[0];
                $cube_json[] = $c[1];
                $cube_json[] = $c[2];
            }
        }
        
        return $cube_json;
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
        //echo "执行公式: ";
        
        foreach ($formula as $f) {
            //echo $f." ";
            if (strlen($f) == 2 && $f[1] == "2") {
                $this->_cube->turn($f[0]);
                $this->_cube->turn($f[0]);
            }
            else
                $this->_cube->turn($f);
        }

        //echo "<br>";
    }
 
    function execute_formula_by_string($formula_string) {
        $formula = explode(" ",$formula_string);
        $this->execute_formula($formula);
    }
}

class Disruptor {
    var $_disr_formula;
    function __construct($formula_len) {
        $formula_set = array("F","F'","F2","B","B'","B2","R","R'","R2","L","L'","L2","U","U'","U2","D","D'","D2");
        $last_index = -1;
        $this->_disr_formula = "";
        for($i=0; $i<$formula_len; $i++) {
            $rand_index = rand(0,5);
            //echo $rand_index."<br>";
            while ( $rand_index/2 == $last_index ) {
                $rand_index = rand(0,5);
                //echo $rand_index."<br>";
            }
            $last_index = $rand_index/2;
            $son_index = rand(0,2);
            $this->_disr_formula = $this->_disr_formula.$formula_set[$rand_index*3+$son_index]." ";
        }

        $this->_disr_formula = trim($this->_disr_formula);
    }

    function get_formula() {
        return $this->_disr_formula;
    }
}

class CubePrinter {
    var $_side_len;
    var $_image;
    var $_cube_width;
    var $_cube_height;
    var $_colors;
    var $_rgb;
    var $_block_spacing;

    function __construct($colors, $side_len = 20) {
        $this->_colors = $colors;
        $this->_side_len = $side_len;
        $this->_block_spacing = $side_len*0.05;
        $this->_cube_width = $this->_side_len*1.6*3+$this->_block_spacing*1.6*4;
        $this->_cube_height = $this->_side_len*2*3+$this->_block_spacing*2*3;

        $this->_image = ImageCreate($this->_cube_width, $this->_cube_height);       
        //设置背景颜色
        $bgcolor = imagecolorallocate($this->_image,255,255,255);
        imagecolortransparent($this->_image,$bgcolor);
        imagefill($this->_image,0,0,$bgcolor);

        //设置颜色
        $this->_rgb = array();
        $this->_rgb["R"] = imagecolorallocate($this->_image,255,0,0);
        $this->_rgb["Y"] = imagecolorallocate($this->_image,255,255,0);
        $this->_rgb["G"] = imagecolorallocate($this->_image,0,255,0);
        $this->_rgb["O"] = imagecolorallocate($this->_image,255,108,12);
        $this->_rgb["B"] = imagecolorallocate($this->_image,0,0,255);
        $this->_rgb["W"] = imagecolorallocate($this->_image,255,255,255);
        $this->_rgb["SIDE"] = imagecolorallocate($this->_image,150,150,150);

        $this->draw_up();
        $this->draw_front();
        $this->draw_right();
    }

    function draw_up() {
        $up_colors = array_slice($this->_colors,0, 9);
        $start_x = 0;
        $start_y = $this->_cube_height * 0.25;
        $start_offset_x = $this->_side_len * 0.8 + $this->_block_spacing;
        $start_offset_y = $this->_side_len * 0.5 + $this->_block_spacing;
        $points_offset = array($this->_side_len * 0.8, $this->_side_len * 0.5, 
            $this->_side_len * 1.6, 0, $this->_side_len * 0.8, $this->_side_len * -1 * 0.5);

        foreach ($up_colors as $i => $color) {
            $cur_start_x = $start_x + (floor($i / 3) + $i % 3) * $start_offset_x;
            $cur_start_y = $start_y + (floor($i / 3) - ($i % 3)) * $start_offset_y;

            $cur_points = array();
            $cur_points[] = $cur_start_x;
            $cur_points[] = $cur_start_y;
            $cur_points[] = $points_offset[0] + $cur_start_x;
            $cur_points[] = $points_offset[1] + $cur_start_y;
            $cur_points[] = $points_offset[2] + $cur_start_x;
            $cur_points[] = $points_offset[3] + $cur_start_y;
            $cur_points[] = $points_offset[4] + $cur_start_x;
            $cur_points[] = $points_offset[5] + $cur_start_y;

            imagefilledpolygon($this->_image, $cur_points, 4, $this->_rgb[$color]);
            imagepolygon($this->_image, $cur_points, 4, $this->_rgb["SIDE"]);
        }
    }

    function draw_front() {
        $front_colors = array_slice($this->_colors,9, 9);
        $start_x = 0;
        $start_y = $this->_cube_height * 0.25;
        $start_offset_x = $this->_side_len * 0.8 + $this->_block_spacing;
        $start_offset_y = $this->_side_len * 1 + $this->_block_spacing;
        $points_offset = array(0, $this->_side_len, $this->_side_len * 0.8, $this->_side_len*1.5, 
            $this->_side_len * 0.8, $this->_side_len*0.5);

        foreach ($front_colors as $i => $color) {
            $cur_start_x = $start_x + ($i % 3) * $start_offset_x;
            $cur_start_y = $start_y + (floor($i / 3) + ($i % 3)*0.5) * $start_offset_y;

            $cur_points = array();
            $cur_points[] = $cur_start_x;
            $cur_points[] = $cur_start_y;
            $cur_points[] = $points_offset[0] + $cur_start_x;
            $cur_points[] = $points_offset[1] + $cur_start_y;
            $cur_points[] = $points_offset[2] + $cur_start_x;
            $cur_points[] = $points_offset[3] + $cur_start_y;
            $cur_points[] = $points_offset[4] + $cur_start_x;
            $cur_points[] = $points_offset[5] + $cur_start_y;

            imagefilledpolygon($this->_image, $cur_points, 4, $this->_rgb[$color]);
            imagepolygon($this->_image, $cur_points, 4, $this->_rgb["SIDE"]);
        }
    }

    function draw_right() {
        $right_colors = array_slice($this->_colors,18, 9);
        $start_x = $this->_cube_width * 0.5;
        $start_y = $this->_cube_height * 0.5;
        $start_offset_x = $this->_side_len * 0.8 + $this->_block_spacing;
        $start_offset_y = $this->_side_len * 1 + $this->_block_spacing;
        $points_offset = array(0, $this->_side_len, $this->_side_len * 0.8, $this->_side_len*0.5, 
            $this->_side_len * 0.8, -1 * $this->_side_len * 0.5);

        foreach ($right_colors as $i => $color) {
            $cur_start_x = $start_x + ($i % 3) * $start_offset_x;
            $cur_start_y = $start_y + (floor($i / 3) - ($i % 3)*0.5) * $start_offset_y;

            $cur_points = array();
            $cur_points[] = $cur_start_x;
            $cur_points[] = $cur_start_y;
            $cur_points[] = $points_offset[0] + $cur_start_x;
            $cur_points[] = $points_offset[1] + $cur_start_y;
            $cur_points[] = $points_offset[2] + $cur_start_x;
            $cur_points[] = $points_offset[3] + $cur_start_y;
            $cur_points[] = $points_offset[4] + $cur_start_x;
            $cur_points[] = $points_offset[5] + $cur_start_y;

            imagefilledpolygon($this->_image, $cur_points, 4, $this->_rgb[$color]);
            imagepolygon($this->_image, $cur_points, 4, $this->_rgb["SIDE"]);
        }
    }

    function get_base64_xml() {
        //把字符串写在图像左上角               
        ob_start();
        imagepng($this->_image);
        $data =ob_get_contents();
        ob_end_clean();
        return '<img src="data:image/png;base64,'.base64_encode($data).'">';
    }
}


?>