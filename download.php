<?php

    header("Cache-Control: public");
    header("Content-Description: File Transfer");
	header('Content-type: text/plain');
    header('Content-Disposition: attachment; filename="network.json"');
    header('Content-Disposition: attachment; filename="network.json"');
	
	$nodes = $_POST['nodes'];
    $edges = $_POST['edges'];
   
    //$net = array("nodes"=>$nodes, "edges"=>$edges);

    echo json_encode($nodes);
?>
