<?php

require_once("init.php");

class Page{

	private $html_doc;
	private $url;
	private $domain;

	public function Page($url, $html_doc){


	$this->url = $url;
	$this->html_doc = $html_doc;
	//$this->domain = parse_url($url, PHP_URL_HOST);
	$this->domain = "searchengine.nalgorithm.com";

	}

	public function getHtmlDoc(){
		return $this->html_doc;
	}

	public function getURL(){
		return $this->url;
	}

	public function getDomain(){
		return $this->domain;
	}

	 public function __toString()
    {
        return $this->url . " " . $this->domain . "<br />";
        //return $this->domain;
    }
}


?>