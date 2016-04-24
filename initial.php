<?php
   $db = new SQLite3('temp/lotus_net.sqlite');
   if(!$db){
      echo $db->lastErrorMsg();
   }
   // create table node (id text, label text, desc text);
   // create table edge (fromnode text, tonode text, arrow text, dash int); 
   
   $nodes=array();
   $edges=array();
   
   
   $sql = "select * from node";
   $ret = $db->query($sql);
   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
	  $nodes[]=$row;
   }
   
   $sql = "select * from edge";
   $ret = $db->query($sql);

   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){
	  $edges[]=$row;
   }
   
   //here we convert the result into JSON
   $data=array('nodes' => $nodes, 'edges' => $edges);
   echo json_encode($data);
   $db->close();
?>
