<?php
include('Afreeca.class.php');


if ( !isset($_GET["station"]) ) {

?>
	<form action="<?=$_SERVER['PHP_SELF']?>" method="GET">
		<input type="text" name="station">
		<input type="submit">
	</form>

<?php
}

if ( isset($_GET['station']) ) {
	
	$afreeca = new Afreeca;
	$afreeca->start = $_GET['station'];
	// $afreeca->start = 25265755;
	$afreeca->end = 25265757;


	echo '<img src="'. $afreeca->thumnail()[0] . '" style="width:240px"></img><br>';
	echo $afreeca->nickname()[0].'('.$afreeca->bj_id()[0].')';
	echo "<br>";
	echo $afreeca->title()[1];
	echo "<br>";
	$files = $afreeca->getfiles();
	foreach ($files as $key => $value) {
		
		echo '<a href="'.$value . '">'. $key.$value .'</a><br>';
		# code...
	}

}
