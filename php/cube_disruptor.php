<?php
include 'cube_base_class.php';

$disr = new Disruptor(15);
$disr_formula = $disr->get_formula();
//echo $disr_formula;

$magic_cube = new MagicCube();
$cube_opt = new CubeOperator($magic_cube);
$cube_opt->execute_formula_by_string($disr_formula);

//$magic_cube->print_cube();
$cube_json = $magic_cube->get_cube_color_array();
$ret_json = array("formula"=>$disr_formula, "cube_color"=>$cube_json);
echo json_encode($ret_json);

?>