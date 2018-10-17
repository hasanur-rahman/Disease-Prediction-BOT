<?php
	function startModel()
	{
		$my_command = escapeshellcmd('python C:\xampp\htdocs\server\BOT2\trainModel.py');
	    $command_output = shell_exec($my_command);
	    echo $command_output;
	}
	
    function prediction($symptoms)
    {
    	$parameters = "";
    	$arrlength = count($symptoms);
    	for($x = 0; $x < $arrlength; $x++) {
		    $parameters = $parameters." ".$symptoms[$x];
		}
		$parameters = 'python C:\xampp\htdocs\server\BOT2\prediction.py'.$parameters;
		$handle = fopen("sym.txt", "w");
        fwrite($handle, $parameters);
        fclose($handle);

    	$my_command = escapeshellcmd($parameters);
	    $command_output = shell_exec($my_command);
	    echo $command_output;
	    return $command_output;
    }
 ?>