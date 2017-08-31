<?php 

class Afreeca
{
	public $start;
	public $end;
	public $nTitleNo;
	public $air;
		// $start 	= 23521328;
		// $end 	= 23521335;

	function __construct()
	{
		$this->setStation();
	}

	public function setStation()
	{

		$url = "http://afbbs.afreecatv.com:8080/api/video/get_video_info.php?nTitleNo=".
			$this->start;
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$air = curl_exec($curl);
		return $air;
		
	}

	public function bj_id()
	{
		$air = $this->setStation();
		// bj_id
		$regex = '#<\s*?bj_id\b[^>]*>(.*?)<\/bj_id\b[^>]*>#s';
		preg_match_all($regex, $air, $matches);
        $data['bj_id'] = $matches[0];
        $data['bj_id'] = str_replace('<bj_id>', '', $data['bj_id']);
        $data['bj_id'] = str_replace('</bj_id>', '', $data['bj_id']);

        return $data['bj_id'];
	}


	// Thumnail
	public function thumnail()
	{
		$regex = '#<\s*?titleImage\b[^>]*>(.*?)<\/titleImage\b[^>]*>#s';
		preg_match_all($regex, $this->setStation(), $matches);
		$data['thumnail'] = $matches[0];
		$data['thumnail'] = str_replace('<titleImage>', '', $data['thumnail']);
		$data['thumnail'] = str_replace('</titleImage>', '', $data['thumnail']);

		return $data['thumnail'];	
	}


	public function nickname()
	{
		// Nickname & title
		$regex = '(\[CDATA(.|\n)*?>)';
		preg_match_all($regex, $this->setStation(), $matches);
		$data['nickname'] = $matches[0];
		$data['nickname'] = str_replace('[CDATA[', '', $data['nickname']);
		$data['nickname'] = str_replace(']]>', '', $data['nickname']);

		return $data['nickname'];
	}

	public function title()
	{
		// Title
		$regex = '(\[CDATA(.|\n)*?>)';
		preg_match_all($regex, $this->setStation(), $matches);
		$data['title'] = $matches[0];
		$data['title'] = str_replace('[CDATA[', '', $data['title']);
		$data['title'] = str_replace(']]>', '', $data['title']);

		return $data['title'];
	}

	// file	
	public function getfiles()
	{
		$regex = '#<\s*?file\b[^>]*>(.*?)<\/file\b[^>]*>#s';

		preg_match_all($regex, $this->setStation(), $matches);
		$files = $matches[0];
			foreach ($files as $key => $value)
			{
				$files[$key] = explode('>', str_replace('</file', '', $value));
			}
			for ($i=0; $i < count($files) ; $i++) {
				$files[$i] = $files[$i][1];
				
			}
			return $files;
	}



}