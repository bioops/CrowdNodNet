<?php
   $db = new SQLite3('data/lotus_gene.sqlite');
   $val = array();
   if(!$db){
      echo $db->lastErrorMsg();
   }

   //where 'term' is the default keyword in jquery autocomplete api
   $query = $_POST['term'];
   $sql = "select * from gene where id like '%$query%' OR label LIKE '%$query%' OR title LIKE '%$query%'";
   $ret = $db->query($sql);

   while($row = $ret->fetchArray(SQLITE3_ASSOC) ){

     // if( empty( $gene_name ) ){
     //     $gene_name = $row['Entry'];
     //     $gene_label = $row['Entry'];
     // }else{
     //      $gene_label =  $gene_name . '|' . $row['Entry'];
     // }
     
      $val[] = array(
                    'id'=> $row['id'],
                    'label'=> $row['label'],
                    'title' => $row['title']
               );
   }
   //here we convert the result into JSON
   echo json_encode($val);
   $db->close();
?>
