<?php 

class Afreeca
{
	public $start;
	public $nTitleNo;
	public $afreeca = [];
	public $fail = [];
	public $bj_id = [];
	public $title = [];
	public $files = [];

	function __construct()
	{
		$this->setStation();
	}

	public function setStation()
	{
		$url = "http://afbbs.afreecatv.com:8080/api/video/get_video_info.php?nTitleNo=".$this->start;
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$this->nTitleNo = curl_exec($curl);
		return $this->nTitleNo;
	}

	public function fail()
	{
		$regex = '<flag>(SUCCEED)</flag>';
		preg_match_all($regex, $this->setStation(), $this->fail);
        // $this->fail = str_replace('<flag>', '',$this->fail );
        // $this->fail = str_replace('</flag>', '',$this->fail );

        return $this->fail;
	}

	public function bj_id()
	{
		// bj_id
		$regex = '#<\s*?bj_id\b[^>]*>(.*?)<\/bj_id\b[^>]*>#s';
		preg_match_all($regex, $this->setStation(), $this->bj_id);
        $this->bj_id = str_replace('<bj_id>', '', $this->bj_id);
        $this->bj_id = str_replace('</bj_id>', '', $this->bj_id);
        $this->bj_id = $this->bj_id[1][0];
        return $this->bj_id;
	}


	// Thumnail
	public function thumnail()
	{
		$regex = '#<\s*?titleImage\b[^>]*>(.*?)<\/titleImage\b[^>]*>#s';
		preg_match_all($regex, $this->setStation(), $matches);
		$this->thumnail = $matches;
		$this->thumnail = str_replace('<titleImage>', '', $this->thumnail);
		$this->thumnail = str_replace('</titleImage>', '', $this->thumnail);
		$this->thumnail = $this->thumnail[1][0];
		return $this->thumnail;
	}


	public function nickname()
	{
		// Nickname & title
		$regex = '(\[CDATA(.|\n)*?>)';
		preg_match_all($regex, $this->setStation(), $matches);
		$this->nickname = $matches[0];
		$this->nickname = str_replace('[CDATA[', '', $this->nickname);
		$this->nickname = str_replace(']]>', '', $this->nickname);
		$this->nickname = $this->nickname[0];
		return $this->nickname;
	}

	public function title()
	{
		// Nickname & title
		$regex = '(\[CDATA(.|\n)*?>)';
		preg_match_all($regex, $this->setStation(), $matches);
		$this->title = $matches[0];
		$this->title = str_replace('[CDATA[', '', $this->title);
		$this->title = str_replace(']]>', '', $this->title);
		$this->title = $this->title[1];
		return $this->title;
	}




	// file	
	public function getfiles()
	{
		$regex = '#<\s*?file\b[^>]*>(.*?)<\/file\b[^>]*>#s';

		preg_match_all($regex, $this->setStation(), $this->files);
			foreach ($this->files as $key => $value)
			{
				$this->files[$key] = $value;
			}
		
	return $this->files[1];
	}



}