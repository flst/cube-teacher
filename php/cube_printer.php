<?php

include 'cube_base_class.php';



$disr = new Disruptor(15);
$disr_formula = $disr->get_formula();
//echo $disr_formula;

$magic_cube = new MagicCube();
$cube_opt = new CubeOperator($magic_cube);
$cube_opt->execute_formula_by_string($disr_formula);

//$magic_cube->print_cube();
$cube_colors = $magic_cube->get_cube_color_array();
$cube_printer = new CubePrinter($cube_colors,20);

echo $cube_printer->get_base64_xml();

//$ret_json = array("formula"=>$disr_formula, "cube_color"=>$cube_json);
//echo json_encode($ret_json);

?>