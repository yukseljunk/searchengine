<?php
include("simple_html_dom.php")
?>

<p>Other text </p>



<?php

//Connect to database "testdb"
$m = new MongoClient();
$db = $m->testdb;
//create a collection for that database
$collection =  $db->createCollection("mycol");

//instantiate cURL handler
$curl = curl_init();

//get html from a given page and store it 
$page = getPageHtml("http://searchengine.nalgorithm.com", $curl);
$pages = [];

//array which will contains the html docs of all pages and subpages
$pages[] = $page;

//html dom parser
$html = new simple_html_dom();

//gets all 
$link_texts =  extractLinksFromPage($html, $page);

foreach($link_texts as $lt){

$pages[] = getPageHtml($lt, $curl);

}
 
//insert main page and sub-pages into the database

$page_doc = [

"title" => "main page",
"content" => $pages[0]
];

$sub1_doc = [

"title" => "main page",
"content" => $pages[4]
];

$sub2_doc = [

"title" => "main page",
"content" => $pages[5]
]; 

$collection->insert($page_doc);
$collection->insert($sub1_doc);
$collection->insert($sub2_doc);



//echo $pages[0]; //subpage are on index 4 and 5


 

?>

 


<?php

//Parameters: instance of simple_html_dom  parser and a cURL handler
//Return: html for the specified url or false
function getPageHtml($url, $curl){

//$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
 

$result = curl_exec($curl);

return $result;
}


//Parameters: instance of simple_html_dom  parser and the html result for a web page 
//Return: array of the href value for all anchor tags or null
function extractLinksFromPage($html, $page){

$links = [];

$html->load($page);
$anchors = $html->find('a');

if($anchors == null){
	return null;
}

foreach($anchors as $a) {

$links[] = $a->href;
 
}

return $links;

}








/*

*Incomplete, needs debugging

function getContent($root_page, $depth){

$curl = curl_init();

$all_pages = [];
$html = new simple_html_dom();

getPageContent($html, $curl, $root_page, $depth, $all_pages);

curl_close($curl);

return $all_pages;

}

function getPageContent($html, $curl, $current_page, $depth, $all_pages){

echo $depth;
if($depth == 0){
	return null;
}

$page_content = getPageHtml($current_page, $curl);

if($page_content != false){

$all_pages[] = $page_content;


$html->load($page_content);
$links = extractLinksFromPage($html, $page_content);

if(is_null($links) == false){

foreach($links as $link){
	getPageContent($html, $curl, $link, $depth-1, $all_pages);
}
}
}




}
*/


?>