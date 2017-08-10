<?php
/*
	Date : 09/08/2017
	Author : Fahd Allebdi
	Email : fa88hd@gmail.com
	Description : 
		a script to rename all files in a directory given by user .
	Purpose :
		make it easy to remeber when i programmed and need to include
		images and files to my code . 
		currently named as numeric system 1,2,3,4 .. etc.
*/

 
Class AutoRenameFiles{

	private $pathDirectory ;
	private $openDirectory ;
	private $renamedFilesCounter;
	
	public function __construct($pathDirectory)
	{
		$this->pathDirectory = $pathDirectory;
		$this->renamedFilesCounter = 0 ;
	}

	public function setPathDirectory($pathDirectory)
	{
			$this->pathDirectory = $pathDirectory;
	}

	public function getPathDirectory()
	{
		return $this->pathDirectory;
	}

	private function setRenamedFilesCounter($counter)
	{
		$this->renamedFilesCounter = $counter;
	}

	public function getRenamedFilesCounter()
	{
		return $this->renamedFilesCounter ;
	}


	public function doRename()
	{
			$directory = NULL;

		try
		{
			if ( !is_dir( $this->pathDirectory ) )
	  			return array('success' => false , 'msg' =>  "Can't find a path directory , please make sure from your path directory" ) ;


			$directory = opendir($this->pathDirectory);

			if (!$directory)
	  			return array('success' => false , 'msg' =>  "Error , can't open a directory" ) ;

	  		$counter = 1 ;	// start renaming from value of counter
			$oldFileName = false;
	  		
	  		// repeat over  files in a directory .
	  		while( ( $oldFileName = readdir($directory) ) && $oldFileName != FALSE )
	  		{
	  			$ext = pathinfo($oldFileName , PATHINFO_EXTENSION);
	  			
	  			if (!$ext)
	  				continue ;

	  			// add a full path to file names
	  			$newFileName  = $this->pathDirectory .  $counter .".". $ext;
	  			$oldFileName  = $this->pathDirectory . $oldFileName ;

	  			if ( rename( $oldFileName , $newFileName ) )
	  				$counter++ ;
	  			
	  		}// end while


	  		// update the counter 
			$this->setRenamedFilesCounter($counter);	

			closedir( $directory );

	  		return array("success" => true , "msg" => "Renamed Files Succeffully" , "count" => $this->renamedFilesCounter );
		
		}
		catch(Exception $e){
	  		
 	  		return array('success' => false , 'msg' =>  $e->getMessage() ) ;
			
		}
		
		
	} // end doRename func



} // end class	



