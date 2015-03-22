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

	public function __construct($sourceCode,$language,$inputTestCases,$outputTestCases,$apiKey = 'apiKey1')
	{
		global $apiKeys;
		$this->sourceCode = $sourceCode;
		$this->language = $language;
		$this->inputCases = $inputTestCases;
		$this->outputCases = $outputTestCases;
		$this->apikey = $apiKeys[$apiKey];

	}
	
	public function compile()
	{
		$query['source'] = urlencode($this->sourceCode);
		//$query['testcases'] = urlencode(json_encode(array($this->inputCases)));
		$query['testcases'] = urlencode(json_encode($this->inputCases));
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
	public function getApiDump()
	{
		return $this->apiOutput;
	}
	
	public function isPassed()
	{
		$isPassed = array();
		for($index = 0;$index < sizeof($this->inputCases) ; $index++)
		{

			$compilerOutput = trim($this->getOutput($index));
			$expectedOutput = trim(str_replace("\r\n", "\n",$this->outputCases[$index]));

			//if the corresponding input TestCase and Output TestCase match
			if (strcmp($compilerOutput,$expectedOutput) == 0)
			{
				if (!isset($isPassed[$index]))
					$isPassed[$index] = "Passed";

			}
			else
				  $isPassed[$index] = "Failed";

		}

		return $isPassed;
			
	}
	
	public function getOutput($index)
	{
	   return $this->apiOutput["result"]["stdout"][$index];
	}
	
	public function getError($index)
	{
		
		return $this->apiOutput["result"]["stderr"][$index];
	}
	
	public function getMemory($index)
	{
		return $this->apiOutput["result"]["memory"][$index];
	}
	
	public function getTime($index)
	{
		return $this->apiOutput["result"]["time"][$index];
	}
	
	public function getApiResult()
	{
		return $this->apiOutput;
	}
	public function getCompileMessage()
	{
		if(empty($this->apiOutput["result"]["compilemessage"]))
			return true;
		else
			return $this->apiOutput["result"]["compilemessage"];
	}

	public function getOutputCase($index)
	{
		return $this->outputCases[$index];
	}

	public function getMessage($index)
	{
		return $this->apiOutput["result"]["message"][$index];
	}
	
	

	
}
