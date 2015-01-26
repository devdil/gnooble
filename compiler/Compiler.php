<?php

include 'apikey.php';

class Compiler
{
	private $sourceCode;
	private $language;
	private $inputCases;
	private $apikey;
	private $outputCases;
	private $output;
	private $memory;
	private $time;
	private $apiOutput;

	public function __construct($sourceCode,$language,$inputCases,$outputCases,$apiKey = 'apiKey1')
	{
		global $apiKeys;
		$this->sourceCode = $sourceCode;
		$this->language = $language;
		$this->inputCases = $inputCases;
		$this->outputCases = $outputCases;
		$this->apikey = $apiKeys[$apiKey];

	}
	
	public function compile()
	{
		$query['source'] = urlencode($this->sourceCode);
		$query['testcases'] = urlencode(json_encode(array($this->inputCases)));
		$query['lang'] = $this->language;
		$query['api_key'] = urlencode($this->apikey);
		$url = 'http://api.hackerrank.com/checker/submission.json';
		$q = array();
		foreach ($query as $k => $v) {
			$q[] = "$k=$v";
		}
		$q = implode("&", $q);
		//open connection
		$ch = curl_init();
		
		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($query));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $q);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		
		//execute post
		$result = curl_exec($ch);
		
		//close connection
		curl_close($ch);
		
		
		
		$this->apiOutput = json_decode($result,true);
	}
	
	public function isPassed()
	{
		$compilerOutput = trim($this->apiOutput["result"]["stdout"][0]);
		$expectedOutput = trim($this->outputCases);
		if (strcmp($compilerOutput,$expectedOutput) == 0)
			return True;
		else
			return False;
			
	}
	
	public function getOutput()
	{
	   return $this->apiOutput["result"]["stdout"][0];
	}
	
	public function getError()
	{
		
		return $this->apiOutput["result"]["stderr"][0];
	}
	
	public function getMemory()
	{
		return $this->apiOutput["result"]["memory"][0];
	}
	
	public function getTime()
	{
		return $this->apiOutput["result"]["time"][0];
	}
	
	public function getApiResult()
	{
		return $this->apiOutput;
	}
	public function getCompileMessage()
	{
		if(empty($this->apiOutput["result"]["compilemessage"]))
			return "Compiled Successfully!";
		else
			return $this->apiOutput["result"]["compilemessage"];
	}
	
	

	
}
