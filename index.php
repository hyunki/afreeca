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

	$afreeca = new Afreeca;
	if ($afreeca->fail !== 'SUCCEED') {
		print_r($afreeca->fail);
	}else
	{
		for ($i=$_GET['start']; $i < $_GET['end'] +1; $i++) 
		{

			$afreeca->start = $i;
			
			echo $afreeca->thumnail();
			echo '<br>';
			echo $afreeca->nickname();
			echo '<br>';
			echo $afreeca->bj_id();
			echo '<br>';
			echo $afreeca->title();
			// print_r($afreeca->getfiles());
			foreach ($afreeca->getfiles() as $value) {
				echo $value;
				echo '<br>';
			}
			echo '<br>';
		}	
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

