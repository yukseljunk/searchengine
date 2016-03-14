<?php

require_once("init.php");
require_once("iHtmlParse.php");


class HtmlParser implements iHtmlParse{

private $html;

public function HtmlParser($html){
	$this->html = $html;
}

public function find($key){

return $this->html->find($key);

}

function extractLinksFromPage($page){

$links = [];

$this->html->load($page->getHtmlDoc());
$anchors = $this->find('a');

if($anchors == null){
	return null;
}

foreach($anchors as $a) {

if($a != "#content"){

$links[] = $a->href;
}
 
}

return $links;

}



}


?>