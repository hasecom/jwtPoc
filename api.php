<?php 
namespace jwtpoc;
require_once('./data.php');
use jwtpoc\data;

$data = new data();
if(! isset(getallheaders()['Authorization']))die;
if(! getallheaders()['Authorization'] == 'Bearertoken')die;
echo json_encode($data->output());

?>