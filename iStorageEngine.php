<?php

interface iStorageEngine{

	public function connectToDB($url);
	public function store($data);
	public function read($key);
	public function readAll();
}


?>
