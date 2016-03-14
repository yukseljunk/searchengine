<?php
require_once("init.php");

class Manager{

private $storage_engine;
private $crawler;

public function Manager($storage_engine, $crawler){
	$this->storage_engine = $storage_engine;
	$this->crawler = $crawler;
}

public function runCrawler($root_url, $depth){
	//echo "The root url passed from manager is " 
	$pages = $this->crawler->crawlWebsite($root_url, $depth);

	//WebCrawler::printArray("all pages returned from crawlwebsite", $pages);

	foreach($pages as $page){

		$storage_engine->store($page);

	}

}


public function displayResults(){




}





}


?>