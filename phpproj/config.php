<?php

		$host="localhost";
		$username="root";
		$password="";
		$dbname="demo";
		$port=3305;
		
		try
		{
			$con = new PDO("mysql:host=$host;port=$port;dbname=$dbname",$username,$password);

			$con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);			
		}
		catch(PDOException $e)
		{
			echo "Connection Failed".$e->getMessage();
		}

?>