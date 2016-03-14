<?php

require_once("init.php");
require_once("iCrawling.php");

class WebCrawler implements iCrawling{


private $html_parser;
//private $curl;
private $current_domain;

public function WebCrawler($html_parser, $current_domain){
	$this->html_parser = $html_parser;
	//$this->curl = curl_init();
	$this->current_domain = $current_domain;
}


 
//retrieves html document for a given url
public function getPage($url){

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 

$result = curl_exec($curl);
//echo $result;
//echo "<br /> The result is: " . $result . "<br />";
 
$page = new Page($url, $result);
echo "The returned page is : " . $page . " <br />";

curl_close($curl);

return $page;

}



function crawlWebsite($url, $depth){

//find the domain of the $root_page and pass it to the recursive funciton getPageContent
echo "Main url is <br /> " . $url;

//$root_page = $this->getPage($url);
//echo $root_page->getHtmlDoc();	

$all_pages = [];

 

$this->crawl($url, $depth, $all_pages);

//curl_close($this->curl);

echo "<pre>";
print_r($all_pages);
echo "</pre>";

return $all_pages;

}

public static function printArray($extra_text, $array){
	echo "<br /> {$extra_text} <br />";
	echo "<pre>";
	print_r($array);
	echo "</pre>";
}


function crawl($current_url, $depth, $all_pages){

//check if the url of $current_page is already in $all_pages, if it is then return;

//check if the domain of the $current is the same as the paramter $domain

echo "<br/>---------------------------------------------------------------";
echo "<br/>current url is : " . $current_url . "<br />";

if($current_url == "#content"){
	return;
}

if($depth == 0){
	echo "depth is 0 so stop";
	return;
}	

$current_page = $this->getPage($current_url);
echo "<br /> current page is: " . $current_page;
//echo $current_page->getHtmlDoc();
	
//echo "HELLLLO";
if($current_page->getDomain() != $this->current_domain){
 
	echo "<br/>current domain is: " . $current_page->getDomain() . " <br />  main domain: " . $this->current_domain;
	return;
}


if(in_array($current_page, $all_pages) || $current_page->getURL() == "#content"){


	echo $current_page . " is already in all_pages";

	return;
}



if($current_page->getHtmlDoc() != false){
 
//if page content is already in array, then return it
$all_pages[] = $current_page;
self::printArray("all pages are", $all_pages);
//self::printArray("all_pages is now", $all_pages);
echo "from crawl, all pages is now <br />";

 
$links = $this->html_parser->extractLinksFromPage($current_page);

self::printArray("links are ", $links);

if(is_null($links) == false){

foreach($links as $link){
	$this->crawl($link, $depth-1, $all_pages);
}  
} else {

	echo "<br/>No links were returned";
}
}




}

}
