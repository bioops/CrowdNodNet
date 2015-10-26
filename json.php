<?php
require_once 'common.php';
read_gene_network();

header('Content-type: application/json');
echo json_encode(array(
    'data'   => $network,
    'errors' => $errors
));
?>
