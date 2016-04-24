<?php
error_reporting(E_ALL & ~E_NOTICE);
require('lib/simple_html_dom.php');

$dataset    = 'default';
$dataset_qs = '';

# 1 read the config file
function read_config() {

    global $config, $wikiurl, $allpage;

    
    # parse json config file
    $config = json_decode(file_get_contents("config.json" ), true);
    $config['jsonUrl'] = "json.php$dataset_qs";
    
    # retrieve the url of mediawiki
    $wikiurl = $config['wiki'];
    
    # all page determin whether a gene's doc exist
    $wikiallpage = "$wikiurl/Special:AllPages";
    $allpage = file_get_contents($wikiallpage);
}

# 2 read the gene network info (nodes and edges)
function read_gene_network() {

    global $config, $network, $errors, $wikiurl;

    if (!$config) read_config();

    $network= array();
    $errors = array();

    # retrieve mediawiki pages for nodes and edges
    $wikinodes = file_get_html("$wikiurl/Nodes");
    $wikiedges = file_get_html("$wikiurl/Edges");

    # parse nodes info (parse table-related html)
    foreach($wikinodes->find('tr') as $row) {
        $node = $row->find('td',0)->plaintext;
        if(is_null($node)){continue;}
        
        # remove all spaces. Spaces exists in the ends and middle.
        # I can use regular expression to remove spaces in the ends and replace spaces in the middle with '_',
        # so that the format can be consistent with mediawiki.
        # but I am too lazy to do that, and it requires more computing resources.
        # This is why the node name cannot contain any spaces.
        $node = str_replace(' ', '', $node);
        $type = str_replace(' ', '', $row->find('td',1)->plaintext);
        $network[$node] = array("name"=>$node, "type"=>$type, "upstream"=>array(),"downstream"=>array());
    }
    unset($row);

    # parse edges info (parse table-related html)
    foreach($wikiedges->find('tr') as $row) {
        $source =  $row->find('td',0)->plaintext;
        if(is_null($source)){continue;}
        $source = str_replace(' ', '',$source);
        $target = str_replace(' ', '', $row->find('td',1)->plaintext);
        
        # check whether the node exists in the node mediawik page
        # if not, report errors
        if(isset($network[$target]) and isset($network[$source])){
            $network[$target]["upstream"][] = $source;
            $network[$source]["downstream"][] = $target;
        }else{
          $errors[] = "Unrecognized edges: '$source' targets '$target'.\n";
        }
        
    }
    unset($row);
 
}

/*# 3 read the doc for one gene
function read_one_gene_doc($gene){
    global $wikiurl, $network;

    $obj =$network[$gene];
    $name=$obj['name'];
    $type=$obj['type'];

    $doc  = "<h1 class=\"title\">$name</h1>\n";
    $doc .= "<div>$type</div>\n";

    # check whether the gene's doc exist
    # if not exist, report 'create annotation' info
    # if exist, parse the doc
    if(strpos($allpage, ">$name</a>")== false){
        $doc .="<div class=\"alert alert-warning\"><a href=\"$wikiurl/$name?action=edit\" target=\"_blank\" data-name=\"$name\">Create annotation</a></div>";   
    }else{
        $doc .="<h1 class=\"section\">Annotation</h1>\n";
        $doc .="<a href=\"$wikiurl/$name\" target=\"_blank\" data-name=\"$name\">edit</a>\n";
        $filename = "$wikiurl/$name?action=render";
        $doc .= file_get_contents($filename);
    }
    
    
    $doc .= "\n";
    $doc .= get_neighbor('Upstream',   $obj['upstream']);
    $doc .= get_neighbor('Downstream', $obj['downstream']);

    return $doc;
}

function get_neighbor($neighbor, $neighbors){
    global $wikiurl;
    $doc_neighbor = "<h1 class=\"section\">$neighbor</h1>";
    if (count($neighbors)) {
        $doc_neighbor .="<ul>";
        foreach ($neighbors as $nei) {
            $doc_neighbor .= "<li><a href=\"$wikiurl/$nei\" target=\"_blank\" data-name=\"$nei\">$nei</a></li>\n";
        }
        $doc_neighbor .="</ul>";
    } else {
        $doc_neighbor .= "<div>None</div>";
    }
    return $doc_neighbor;
}
*/

?>
