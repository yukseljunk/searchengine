<?php
/*
UnitTesting.php

testDb is a fake class which implements StorageEngine
in the store method in TextDB you can choose to only store the url's
then you can check this in the unit test, you only care in the context of 
the unit test about the functionality of TestDb.

//Make sure the output the unit test will check is hard coded and static and not
dependent on a method call that may retrieve a different result. 
Manager manager = new Manager(new TextDb())
manager.runCrawler()
*/
?>


<?php


require_once("init.php");
require_once("HtmlParser.php");



class CrawlerTest {


 
private $test_urls;
private $domain;
private $textDB;
private $crawler;
private $manager;


public function CrawlerTest(){

$this->test_urls = ["http://searchengine.nalgorithm.com/", "http://searchengine.nalgorithm.com/sub-page-1/", 
"http://searchengine.nalgorithm.com/sub-page-2/"];

$this->domain = parse_url($this->test_urls[0], PHP_URL_HOST);

$this->textDB = new TextDB($this->domain);
$this->crawler = new WebCrawler(new HtmlParser(new simple_html_dom()), $this->domain);


$this->manager = new Manager($this->textDB, $this->crawler);

}


public function executeTest(){

$this->manager->runCrawler($this->test_urls[0], 5);



/*
echo "All pages are <br />";
echo "<pre>";
print_r($all_pages);
echo "</pre>";
*/

 

$result = $this->textDB->checkUrls($this->test_urls);

if($result){
	echo "TEST SUCCESSFULL";
	
} else {
	echo "Test FAILED";
}

$this->textDB->readAll();

}


}
 


?>