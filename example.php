<?php

require_once "./AutoRenameFiles.php";

$pathDirectory = "your directory path";

$obj = new AutoRenameFiles( $pathDirectory );


echo "Path directory is : " .$obj->getPathDirectory();
echo "<br>";

echo "Number of files renamed : ". $obj->getRenamedFilesCounter();
echo "<br>";
var_dump( $obj->doRename() );