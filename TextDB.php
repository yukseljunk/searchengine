<?php


require_once("init.php");
require_once("iStorageEngine.php");

class TextDB implements iStorageEngine{


private $urls = [];
private $domain;

public function TextDB($domain){
	//$this->urls = $urls;
	$this->domain = $domain;
} 


public function getUrls(){
	return $this->urls;
}

public function checkUrls($crawled_urls){

if(count($crawled_urls) != count($this->urls)){
	return false;
}

for($i = 0; $i < count($this->urls); $i++){

if($this->urls[$i] != $crawled_urls[$i]){
	return false;
}
return true;
}

}

public function connectToDB($url){

throw new Exception('Not implemented');

}


public function store($data){


echo "store called";
foreach($data as $value){

	echo "Value is " . $page . "<br />";
	if($value instanceof Page){
	$this->urls[] = $value->getURL();
  	} else {
  		throw new Exception('Values returned from crawler was not a page');
  	}
}

}

public function read($key){
	throw new Exception('Not implemented');
}

public function readAll(){
 
foreach($this->urls as $url){
	echo $url + "<br />";

}

}



}



