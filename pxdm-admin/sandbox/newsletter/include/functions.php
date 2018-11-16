<?php
	
	function redirect( $location = null)
	{
		if ( $location != null )
		{
			header("Location:". $location);
			exit();
		}
	}