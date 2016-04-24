<?php
   $db = new SQLite3('temp/lotus_net.sqlite');
   if(!$db){
      echo $db->lastErrorMsg();
   }

   $nodes = $_POST['nodes'];
   $edges = $_POST['edges'];
   

   echo json_encode($nodes);
   echo json_encode($edges);
   
   // create table node (id text, label text, desc text);
   // create table edge (fromnode text, tonode text, arrow text, dash int); 
   $db->exec('delete from node'); 
   foreach ($nodes as $node) {
      $id = $node["id"];
      $label = $node["label"];
      if(array_key_exists("title", $node)){
          $title = $node["title"];
      }else{$title="";} 
       $sql= "INSERT OR REPLACE INTO node VALUES ('$id', '$label', '$title')";
       $db->exec($sql); 
    }
    
    $db->exec('delete from edge'); 
    foreach ($edges as $edge) {
       $from = $edge["from"];
       $to = $edge["to"];
       if(array_key_exists("arrows", $edge)){
           $arrows = $edge["arrows"];
       }else{$arrows="";}
       if(array_key_exists("dashes", $edge)){
           $dashes = $edge["dashes"];
       }else{$dashes=false;}
       $sql= "INSERT INTO edge VALUES ('$from', '$to', '$arrows', '$dashes')";
       $db->exec($sql);
    }
  
    $db->close();
?>
