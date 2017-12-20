<?php
/*
 * PHP script to convert a text document containing letters to the Editor
 * into a HTML document that contains appropriate formating. The unique
 * element to keep in mind is that each letter is proceeded by a key phrase.
 * This script can be adapted to other uses by changing that key phrase.
 * The output document is intended to be placed inside of a text editor
 * or more complete html document.
 */

	//Defining Variables
	$OpenP = '<p>&emsp;&emsp;&emsp;&emsp;';
	$CloseP = '</p>';
	$Hopen = '<h4>';
	$Hclose = '</h4>';

	// Read File provided as argument
	$file = fopen ( $argv[1], "r" );

	// Breaking file down into array objects
	if ($file) {
		$fileArray = explode("\n", fread($file, filesize($argv[1])));
	}

	else {
		echo "oops, doesn't look like we have a file to operate on";
	}


	//Ad opening paragraph, indent, and close paragraph
	for ($i=0;$i<count($fileArray);$i++) {
		$paragraph = $fileArray[$i];

        $foo = $i+1;
		if ($foo != count($fileArray)){
            if (str_replace("Editor, Smithfield Times","",$fileArray[$foo])!= $fileArray[$foo]) {
			 $fileArray[$i] = "<h4>".$fileArray[$i]."</h4>";
		  }
            elseif(!empty($paragraph)) {
			     $fileArray[$i] = $OpenP.$paragraph.$CloseP;
            }
        }
	}

	$outFile = fopen($argv[2], "w+" ) or die("Can't open file");
	fwrite($outFile, implode("\n", $fileArray));
	fclose($file);
	fclose($outFile);
?>
