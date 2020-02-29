<?php

	$dir_path = "C:\Users\Liam\Downloads\MateX";

	$dir = scandir($dir_path);
	$dir = array_splice($dir,2,-1);

	foreach($dir as $file) {

		$new_file = preg_replace("/Huawei-Mate-X([0-9]+)\.jpg/", "$1.jpg", $file);

		rename("$dir_path/$file", "$dir_path/$new_file");
		echo $file."<br>";
	}

?>