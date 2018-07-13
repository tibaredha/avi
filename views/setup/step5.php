<div class="sheader1l"><p id="lsetup"><?php echo "";echo $this->msg; echo "";?></p></div><div class="sheader1r"><p id="lsetup"><?php html::NAV();?></p></div>
<div class="sheader2l"><p id="lsetup">6-Import SQL and create database</p></div><div class="sheader2r">sheader3</div>
<div class="contentl">

<?php 
// $servername = "localhost";
// $dbname="amranemimi1";
// $username = "root";
// $password = "";
// $conn = new mysqli($servername, $username, $password);
// if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
// } 
// $sql = "CREATE DATABASE IF NOT EXISTS  $dbname ";// DROP DATABASE IF EXISTS
// if ($conn->query($sql) === TRUE) {
    // echo "Database created successfully";
// } else {
    // echo "Error creating database: " . $conn->error;
// }
// $conn->close();
// $conn = new mysqli($servername, $username, $password, $dbname);

// if ($conn->connect_error) {
    // die("Connection failed: " . $conn->connect_error);
// } 
// $sql = "CREATE TABLE IF NOT EXISTS MyGuests (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
// firstname VARCHAR(30) NOT NULL,
// lastname VARCHAR(30) NOT NULL,
// email VARCHAR(50),
// reg_date TIMESTAMP
// )";
// if ($conn->query($sql) === TRUE) {
    // echo "Table MyGuests created successfully";
// } else {
    // echo "Error creating table: " . $conn->error;
// }
// $conn->close();
function PMA_splitSqlFile(&$ret, $sql)
{
    // do not trim, see bug #1030644
    //$sql          = trim($sql);
    $sql          = rtrim($sql, "\n\r");
    $sql_len      = strlen($sql);
    $char         = '';
    $string_start = '';
    $in_string    = FALSE;
    $nothing      = TRUE;
    $time0        = time();

    for ($i = 0; $i < $sql_len; ++$i) {
        $char = $sql[$i];

        // We are in a string, check for not escaped end of strings except for
        // backquotes that can't be escaped
        if ($in_string) {
            for (;;) {
                $i         = strpos($sql, $string_start, $i);
                // No end of string found -> add the current substring to the
                // returned array
                if (!$i) {
                    $ret[] = array('query' => $sql, 'empty' => $nothing);
                    return TRUE;
                }
                // Backquotes or no backslashes before quotes: it's indeed the
                // end of the string -> exit the loop
                else if ($string_start == '`' || $sql[$i-1] != '\\') {
                    $string_start      = '';
                    $in_string         = FALSE;
                    break;
                }
                // one or more Backslashes before the presumed end of string...
                else {
                    // ... first checks for escaped backslashes
                    $j                     = 2;
                    $escaped_backslash     = FALSE;
                    while ($i-$j > 0 && $sql[$i-$j] == '\\') {
                        $escaped_backslash = !$escaped_backslash;
                        $j++;
                    }
                    // ... if escaped backslashes: it's really the end of the
                    // string -> exit the loop
                    if ($escaped_backslash) {
                        $string_start  = '';
                        $in_string     = FALSE;
                        break;
                    }
                    // ... else loop
                    else {
                        $i++;
                    }
                } // end if...elseif...else
            } // end for
        } // end if (in string)

        // lets skip comments (/*, -- and #)
        else if (($char == '-' && $sql_len > $i + 2 && $sql[$i + 1] == '-' && $sql[$i + 2] <= ' ') || $char == '#' || ($char == '/' && $sql_len > $i + 1 && $sql[$i + 1] == '*')) {
            $i = strpos($sql, $char == '/' ? '*/' : "\n", $i);
            // didn't we hit end of string?
            if ($i === FALSE) {
                break;
            }
            if ($char == '/') $i++;
        }

        // We are not in a string, first check for delimiter...
        else if ($char == ';') {
            // if delimiter found, add the parsed part to the returned array
            $ret[]      = array('query' => substr($sql, 0, $i), 'empty' => $nothing);
            $nothing    = TRUE;
            $sql        = ltrim(substr($sql, min($i + 1, $sql_len)));
            $sql_len    = strlen($sql);
            if ($sql_len) {
                $i      = -1;
            } else {
                // The submited statement(s) end(s) here
                return TRUE;
            }
        } // end else if (is delimiter)

        // ... then check for start of a string,...
        else if (($char == '"') || ($char == '\'') || ($char == '`')) {
            $in_string    = TRUE;
            $nothing      = FALSE;
            $string_start = $char;
        } // end else if (is start of string)

        elseif ($nothing) {
            $nothing = FALSE;
        }

        // loic1: send a fake header each 30 sec. to bypass browser timeout
        $time1     = time();
        if ($time1 >= $time0 + 30) {
            $time0 = $time1;
            header('X-pmaPing: Pong');
        } // end if
    } // end for

    // add any rest to the returned array
    if (!empty($sql) && preg_match('@[^[:space:]]+@', $sql)) {
        $ret[] = array('query' => $sql, 'empty' => $nothing);
    }

    return TRUE;
} 




    $errors = array();
	$goToNextStep = false;
    // session_start();
	echo $host = $_SESSION['db_host'];   echo '</br>';
	echo $username = $_SESSION['db_user'];echo '</br>';
	echo $password = $_SESSION['db_pass'];echo '</br>';
	echo $database = $_SESSION['db_name'];echo '</br>';

	// $host = 'localhost';
	// $username = 'root';
	// $password = '';
	// $database = 'framework';

	
	
	
	// connect to db
	$con = mysql_connect($host, $username, $password);
	mysql_select_db($database, $con);
	
	// read import sql
	$import = file_get_contents(URL."views\setup\import.sql");
	
	// $queries = array();
	// $queries = PMA_splitSqlFile($queries, $import);
	
	// foreach ($queries as $query)
	// {
		// if (!mysql_query($query['query']))
		// {
			// $errors[] = "<b>".mysql_error()."</b><br>(".substr($query['query'], 0, 200)."...)";
		// }
	// }
   
	// close connection
	// mysql_close($con);




if (count($errors) > 0) { 
?>
	<div class="error">Some errors occured while importing the SQL data!</div>	
	<ul>
		<?php foreach ($errors as $error): ?>
			<li><?php echo $error; ?></li>
		<?php endforeach; ?>
	</ul>
<?php } else { ?>
	<div class="success">Data import succeeded!</div>
<?php } ?>




<?php if (count($errors) == 0) { ?>
	<form action="<?php echo URL;?>setup/step6"   method="post">
		<a href="<?php echo URL;?>setup/" id="Cancel"><img src="<?php echo URL;?>public/images/icons/cross.png" alt=""/> Cancel</a>	

		<input type="hidden" name="nextStep" value="done">
		<button id="submits" type="submit" class="button positive">
			<img src="<?php echo URL;?>public/images/icons/tick.png" alt=""/> Next
		</button>
	</form>
<?php } else { ?>
	<form action="<?php echo URL;?>setup/step5"  method="post">
		<a href="<?php echo URL;?>setup/" id="Cancel"><img src="<?php echo URL;?>public/images/icons/cross.png" alt=""/> Cancel</a>	

		<input type="hidden" name="nextStep" value="importSQL">
		<button id="submits" type="submit" class="button positive">
			<img src="<?php echo URL;?>public/images/icons/tick.png" alt=""/> Retry
		</button>
	</form>
<?php } ?>

</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/IMPSQL.jpg"></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>

	
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php echo "";echo $this->msg; echo "";?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>		