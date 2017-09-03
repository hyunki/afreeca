<?php
include('Afreeca.class.php');
?>

<form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
	<input type="text" name="start">
	<input type="text" name="end">
	<input type="submit">
</form>

<?php


if ( isset($_GET['start']) ) 
{
	
	for ($i=$_GET['start']; $i < $_GET['end'] +1; $i++) 
	{
		$afreeca = new Afreeca;
		$afreeca->start = $i;

		echo '<pre>';
		$afreeca->fail();
		$afreeca->nickname();
		$afreeca->getfiles();
		$afreeca->title();
		print_r($afreeca);
		echo '</pre>';

			//$afreeca->nickname().'('.$afreeca->bj_id().')';
	}	

	
		// echo '<img src="'. $afreeca->thumnail()[0] . '" style="width:240px"></img><br>';
		// echo $afreeca->nickname()[0].'('.$afreeca->bj_id()[0].')';
		// echo "<br>";
		// echo $afreeca->title()[1];
		// echo "<br>";
		// $files = $afreeca->getfiles();
		// foreach ($files as $key => $value)
		// {
		// 	echo '<a href="'.$value . '">'. $key.$value .'</a><br>';
		// }		

}

