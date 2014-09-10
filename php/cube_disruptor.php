<?php
include 'cube_base_class.php';

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

$disr = new Disruptor(15);
$disr_formula = $disr->get_formula();
//echo $disr_formula;

$magic_cube = new MagicCube();
$cube_opt = new CubeOperator($magic_cube);
$cube_opt->execute_formula_by_string($disr_formula);

//$magic_cube->print_cube();
$cube_json = $magic_cube->get_cube_by_json();
$ret_json = array("formula"=>$disr_formula, "cube_color"=>$cube_json);
echo json_encode($ret_json);

?>