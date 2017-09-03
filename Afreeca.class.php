<?php 

class Afreeca
{
	public $start = null;
	public $end = null;
	public $nTitleNo = null;
	public $air = null;
	public $fail = null;
	public $bj_id = null;
	public $thumnail = null;
	public $nickname = null;
	public $files = [];
		// $start 	= 23521328;
		// $end 	= 23521335;

	function __construct()
	{

	}

	public function setStation()
	{
		$url = "http://afbbs.afreecatv.com:8080/api/video/get_video_info.php?nTitleNo=".$this->start;
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$nTitleNo = curl_exec($curl);

	}

	public function fail()
	{
		
		$regex = '#<flag>(.*?)</flag>#';
		preg_match_all($regex, $this->nTitleNo, $matches);
        $this->fail = $matches;
        return $this->fail;
	}

	public function bj_id()
	{
		// bj_id
		$regex = '#<\s*?bj_id\b[^>]*>(.*?)<\/bj_id\b[^>]*>#s';
		preg_match_all($regex, $this->$nTitleNo, $matches);
        $data['bj_id'] = $matches;
        $data['bj_id'] = str_replace('<bj_id>', '', $data['bj_id']);
        $data['bj_id'] = str_replace('</bj_id>', '', $data['bj_id']);

        return $data['bj_id'];
	}


	// Thumnail
	public function thumnail()
	{
		$regex = '#<\s*?titleImage\b[^>]*>(.*?)<\/titleImage\b[^>]*>#s';
		preg_match_all($regex, $this->air, $matches);
		$data['thumnail'] = $matches;
		$data['thumnail'] = str_replace('<titleImage>', '', $data['thumnail']);
		$data['thumnail'] = str_replace('</titleImage>', '', $data['thumnail']);
		$this->thumnail = $data['thumnail'];
		// return $data['thumnail'];	
		return $this->thumnail;
	}


	public function nickname()
	{
		// Nickname & title
		$regex = '(\[CDATA(.|\n)*?>)';
		preg_match_all($regex, $this->air, $matches);
		$data['nickname'] = $matches[0];
		$data['nickname'] = str_replace('[CDATA[', '', $data['nickname']);
		$data['nickname'] = str_replace(']]>', '', $data['nickname']);
		$this->nickname = $data['nickname'];
		return $data['nickname'];
	}

	public function title()
	{
		// Title
		$regex = '(\[CDATA(.|\n)*?>)';
		preg_match_all($regex, $this->air, $matches);
		$data['title'] = $matches[0];
		$data['title'] = str_replace('[CDATA[', '', $data['title']);
		$data['title'] = str_replace(']]>', '', $data['title']);
		$this->title = $data['title'];
		return $this->title;
	}

	// file	
	public function getfiles()
	{
		$regex = '#<\s*?file\b[^>]*>(.*?)<\/file\b[^>]*>#s';

		preg_match_all($regex, $this->air, $matches);
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