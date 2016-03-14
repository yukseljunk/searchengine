<?php

require("iStorageEngine");

class MongoDB implements iStorageEngine {

private $mongo_client;
private $current_db;
//private $current_collection;

public MongoDB($url){
	$this->connectToDB($url);
}

public MongoDB($url, $current_db){
	$this->connectToDB($url);
	$this->current_db = $current_db;
	 

	
}

public function connectToDB($url){

	$mongo_client = new MongoClient($url);

}

public function store($data){

	$current_db->insert($data);
}

public function read($url){
  
$current_db->find()

}





}

?>