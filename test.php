

<?php

$input = array("fsfdsfs","asddasdasd","dsfdsfdsfds");
$code = 'print 14';
$apikey = 'hackerrank|141225-76|4d86f6dc8a3db9a8ea66feeb36a44f0c1905eb61';


        $query['source'] = urlencode($code);
		$query['testcases'] = urlencode(json_encode($input));
		$query['lang'] = 5;
		$query['api_key'] = urlencode($apikey);
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


        //var_dump($result);
		$apiOutput = json_decode($result,true);


var_dump($apiOutput);
