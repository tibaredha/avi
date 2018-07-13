<div class="sheader1l"><p id="lsetup"><?php echo "";echo $this->msg; echo "";?></p></div><div class="sheader1r"><p id="lsetup"><?php html::NAV();?></p></div>
<div class="sheader2l"><p id="lsetup">5-Database connection</p></div><div class="sheader2r">sheader3</div>
<div class="contentl">



<?php 

    $error = false;
	$goToNextStep = false;
	
	if (isset($_POST['database']))
	{
		$database = $_POST['database'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$host     = $_POST['host'];
		// check connection
		$connection = @mysql_connect($host, $username, $password);
		if ($connection)
		{
			$error = !mysql_select_db($database, $connection);
			@mysql_close($connestion);
			
			if (!$error)
			{
				// save settings in database config file
				// load template
				$template = file_get_contents(URL."views\setup\database_template.php");
				$template = str_replace("%%host%%", $host, $template);
				$template = str_replace("%%username%%", $username, $template);
		        $template = str_replace("%%password%%", $password, $template);
				$template = str_replace("%%database%%", $database, $template);
				
				// write config file
				// $config=array();
				// $dbFile = dirname(getenv('SCRIPT_FILENAME'))."/".$config['applicationPath'].$config['database_file'];
				// file_put_contents($dbFile, $template);
				// session_start();
				// save login in session for further use
				$_SESSION['db_host'] = $host;
				$_SESSION['db_user'] = $username;
				$_SESSION['db_pass'] = $password;
				$_SESSION['db_name'] = $database;
				
				// allow user to proceed
				$goToNextStep = true;
			}
			else $error = mysql_error();
		}
		else
			$error = mysql_error();
	}
	else
	{
		if (isset($_SESSION['db_host']))
		{
			$host = $_SESSION['db_host'];
			$username = $_SESSION['db_user'];
			$password = $_SESSION['db_pass'];
			$database = $_SESSION['db_name'];
		}
		else
		{
			$database = "framework";
			$username = "root";
			$password = "";
			$host     = "localhost";
		}
	}


?>


	
	<?php if ($goToNextStep) { ?>
		<form action="<?php echo URL;?>setup/step5" method="post">
		<div style="overflow-x:auto;">
		<table>
		<tr>
		<th>cfg</th>
		<th>cfg</th>
		</tr>
		<tr>
		<td><label>Database name </label> </td>
		<td><input id="login"  class="title" type="text" name="database" value="<?php echo $database; ?>"></td>
		</tr>
		<tr>
		<td><label>Username</label> </td> 
		<td><input id="login" class="title" type="text" name="username" value="<?php echo $username; ?>"></td>
		</tr>
		<tr>
		<td><label>Password</label> </td>
		<td><input id="login" class="title" type="password" name="password" value="<?php echo $password; ?>"></td>
		</tr>
		<tr>
		<td><label>Host</label>  </td>
		<td><input id="login" class="title" type="text" name="host" value="<?php echo $host; ?>"></td>
		</tr>
		</table>
		</div>
		<hr>	
		<div class="success">Everything is ok! Go to next step...</div>
		<a href="<?php echo URL;?>setup/" id="Cancel"><img src="<?php echo URL;?>public/images/icons/cross.png" alt=""/> Cancel </a>	
		<input type="hidden" name="nextStep" value="importSQL">
		<button id="submits" type="submit" class="button positive"><img src="<?php echo URL;?>public/images/icons/tick.png" alt=""/> Next</button>
	<?php } else { ?>
		<form action="<?php echo URL;?>setup/step4" method="post">
		<div style="overflow-x:auto;">
		<table>
		<tr>
		<th>cfg</th>
		<th>cfg</th>
		</tr>
		<tr>
		<td><label>Database name </label> </td>
		<td><input id="login"  class="title" type="text" name="database" value="<?php echo $database; ?>"></td>
		</tr>
		<tr>
		<td><label>Username</label> </td> 
		<td><input id="login" class="title" type="text" name="username" value="<?php echo $username; ?>"></td>
		</tr>
		<tr>
		<td><label>Password</label> </td>
		<td><input id="login" class="title" type="password" name="password" value="<?php echo $password; ?>"></td>
		</tr>
		<tr>
		<td><label>Host</label>  </td>
		<td><input id="login" class="title" type="text" name="host" value="<?php echo $host; ?>"></td>
		</tr>
		</table>
		</div>
				
		<?php 
		if ($error) 
		{
		?>	
		<p>Error establishing a database connection: <?php echo $error; ?></p>	
		<?php 
		}
		?>
		<a href="<?php echo URL;?>setup/" id="Cancel"><img src="<?php echo URL;?>public/images/icons/cross.png" alt=""/> Cancel </a>
		<input type="hidden" name="nextStep" value="database">
		<button id="submits" type="submit" class="button positive"><img src="<?php echo URL;?>public/images/icons/tick.png" alt=""/> Test connection</button>
	<?php } ?>
</form>



</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/DBC.jpg"></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>

	
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php echo "";echo $this->msg; echo "";?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>		