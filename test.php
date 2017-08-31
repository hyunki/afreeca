

	$air = curl_exec($curl);
// flag
	$regex = '#<\s*?flag\b[^>]*>(.*?)<\/flag\b[^>]*>#s';
	preg_match_all($regex, $air, $matches);
	$data['flag'] = $matches[0][0];

	