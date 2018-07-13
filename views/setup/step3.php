<div class="sheader1l"><p id="lsetup"><?php echo "";echo $this->msg; echo "";?></p></div><div class="sheader1r"><p id="lsetup"><?php html::NAV();?></p></div>
<div class="sheader2l"><p id="lsetup">4-File permissions</p></div><div class="sheader2r">sheader3</div>
<div class="contentl">
<?php 

//utilisateur UGO
 //U= propriétaire           du fichier
 //G= groupe du propriétaire du fichier
 //O= autres utilisateurs    du fichier
 //a= tous le monde
 // position binaire
// r : droit de lecture  0  / 1

// w : droit d'écriture  0  / 1

// x : droit d'exécution 0  / 1

// 000

//valeur octal  0-7 
// x=rwx=yyyyyyyyyyy
// 0=000=aucun droit
// 1=001=executable
// 2=010=ecriture
// 3=011=ecriture/execution
// 4=100=lir
// 5=101=lir/execution
// 6=110=lir/ecreture
// 7=111=lir/ecriture/execution




$perms = fileperms('views\setup\database_template.php');


// echo substr(sprintf('%o', fileperms('views\setup\database_template.php')), -4);
// echo substr(sprintf('%o', fileperms('views\setup\database_template.php')), -4);


//$perms = fileperms('/etc/passwd');

if (($perms & 0xC000) == 0xC000) {
    // Socket
    $info = 's';
} elseif (($perms & 0xA000) == 0xA000) {
    // Lien symbolique
    $info = 'l';
} elseif (($perms & 0x8000) == 0x8000) {
    // Régulier
    $info = '-';
} elseif (($perms & 0x6000) == 0x6000) {
    // Block special
    $info = 'b';
} elseif (($perms & 0x4000) == 0x4000) {
    // Dossier
    $info = 'd';
} elseif (($perms & 0x2000) == 0x2000) {
    // Caractère spécial
    $info = 'c';
} elseif (($perms & 0x1000) == 0x1000) {
    // pipe FIFO
    $info = 'p';
} else {
    // Inconnu
    $info = 'u';
}
// Autres
$info .= (($perms & 0x0100) ? 'r' : '-');
$info .= (($perms & 0x0080) ? 'w' : '-');
$info .= (($perms & 0x0040) ?
            (($perms & 0x0800) ? 's' : 'x' ) :
            (($perms & 0x0800) ? 'S' : '-'));

// Groupe
$info .= (($perms & 0x0020) ? 'r' : '-');
$info .= (($perms & 0x0010) ? 'w' : '-');
$info .= (($perms & 0x0008) ?
            (($perms & 0x0400) ? 's' : 'x' ) :
            (($perms & 0x0400) ? 'S' : '-'));

// Tout le monde
$info .= (($perms & 0x0004) ? 'r' : '-');
$info .= (($perms & 0x0002) ? 'w' : '-');
$info .= (($perms & 0x0001) ?
            (($perms & 0x0200) ? 't' : 'x' ) :
            (($perms & 0x0200) ? 'T' : '-'));
// echo $info;

//script qui marche tres biens 
// $monfichier = fopen('views\setup\database_template.php', 'r+');
// $pages_vues = fgets($monfichier); // On lit la première ligne (nombre de pages vues)
// $pages_vues += 1;                 // On augmente de 1 ce nombre de pages vues
// fseek($monfichier, 0);            // On remet le curseur au début du fichier
// fputs($monfichier, $pages_vues);  // On écrit le nouveau nombre de pages vues
// fclose($monfichier);
// echo '<p>Cette page a été vue ' . $pages_vues . ' fois !</p>';




// include("helper.php");
//****************************
define( "_PL_OS_SEP", "/" );
define( "_CUR_OS", substr( php_uname( ), 0, 7 ) == "Windows" ? "Win" : "_Nix" );

function checkCurrentOS( $_OS )
{
    if ( strcmp( $_OS, _CUR_OS ) == 0 ) {
        return true;
    }
    return false;
}

function isRelative( $_dir )
{
    if ( checkCurrentOS( "Win" ) ) {
        return ( preg_match( "/^\w+:/", $_dir ) <= 0 );
    }
    else {
        return ( preg_match( "/^\//", $_dir ) <= 0 );
    }
}

function unifyPath( $_path )
{
    if ( checkCurrentOS( "Win" ) ) {
        return str_replace( "\\", _PL_OS_SEP, $_path );
    }
    return $_path;
}

function getRealpath( $_path )
{
    /*
     * This is the starting point of the system root.
     * Left empty for UNIX based and Mac.
     * For Windows this is drive letter and semicolon.
     */
    $__path = $_path;
    if ( isRelative( $_path ) ) {
        $__curdir = unifyPath( realpath( "." ) . _PL_OS_SEP );
        $__path = $__curdir . $__path;
    }
    $__startPoint = "";
    if ( checkCurrentOS( "Win" ) ) {
        list( $__startPoint, $__path ) = explode( ":", $__path, 2 );
        $__startPoint .= ":";
    }
    # From now processing is the same for WIndows and Unix, and hopefully for others.
    $__realparts = array( );
    $__parts = explode( _PL_OS_SEP, $__path );
    for ( $i = 0; $i < count( $__parts ); $i++ ) {
        if ( strlen( $__parts[ $i ] ) == 0 || $__parts[ $i ] == "." ) {
            continue;
        }
        if ( $__parts[ $i ] == ".." ) {
            if ( count( $__realparts ) > 0 ) {
                array_pop( $__realparts );
            }
        }
        else {
            array_push( $__realparts, $__parts[ $i ] );
        }
    }
    return $__startPoint . _PL_OS_SEP . implode( _PL_OS_SEP, $__realparts );
}


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

//****************************
	$goToNextStep = true;
	clearstatcache();
	$showPermissions = array();
	$filePermissions = array();
	$filePermissions["mvc/views/setup/database.php"] = "rw";
	$filePermissions["mvc/views/setup/tmp/x.php"] = "rw";
	// echo '<pre>';
	// print_r ($filePermissions);
	// echo '</pre>';
	foreach ($filePermissions as $key => $value)
	{
		$error = "";
		$config['applicationPath'] = "../../../";
		$values = str_split($value);
		$file = getRealpath(dirname(getenv('SCRIPT_FILENAME'))."/".$config['applicationPath'].$key);
		// echo $file;
		if (file_exists($file))
		{
			foreach ($values as $char)
			{
				switch ($char)
				{
					case "r": if (!is_readable($file)) $error = "Not readable"; break;
					case "w": if (!is_writable($file)) $error = "Not writeable"; break;
					//funzt bei manchen servern nicht richtig...
					case "x": if (!is_executable($file)) $error = "Not executeable"; break;
				}
			}
		}
		else
			$error = "File doesnt exist!";
		// combine string for user easy reading
		$showRequired = array();
		foreach ($values as $char)
		{
			switch ($char)
			{
				case "r": $showRequired[] = "Read"; break;
				case "w": $showRequired[] = "Write"; break;
				case "x": $showRequired[] = "Execute"; break; 
			}
		}
		$showPermissions[$key] = array("required" => $value, "error" => $error, "showRequired" => implode(", ", $showRequired), "realpath" => $file);	
		if ($error != "") $goToNextStep = false;
	}	
?>
<h3>File permissions</h3>

<?php if (!$goToNextStep) { ?>
	<div class="error">The Installer has insufficient file permissions on this server! Please check your chmod permissions or contact support to get this issue resolved.</div>
<?php } ?>

<table  width='65%' >
	<thead>
		<tr>
			<th>Name</th>
			<th>Real Path</th>
			<th>Required</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($showPermissions as $filename => $permissions): ?>
		<tr bgcolor="white">
			<td><?php echo $filename; ?></td>
			<td><?php echo $permissions['realpath']; ?></td>
			<td><?php echo $permissions['showRequired']; ?></td>
			<td><?php if ($permissions['error'] == "") { ?><img src="<?php echo URL;?>public/images/accept.png"> OK <?php } else { ?><img src="<?php echo URL;?>public/images/cancel.png"><?php echo $permissions['error']; ?> <?php } ?></td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>


<?php if ($goToNextStep) { ?>
<form action="<?php echo URL;?>setup/step4" method="post">
	<a href="<?php echo URL;?>setup/" id="Cancel"><img src="<?php echo URL;?>public/images/icons/cross.png" alt=""/> Cancel </a>
	<input type="hidden" name="nextStep" value="database">
	<button  id="submits" type="submit" class="button positive">
		<img src="<?php echo URL;?>public/images/icons/tick.png" alt=""/> Next
	</button>
</form>
<?php } else { ?>
	<form action="<?php echo URL;?>setup/step3" method="post">
		<a href="<?php echo URL;?>setup/" id="Cancel"><img src="<?php echo URL;?>public/images/icons/cross.png" alt=""/> Cancel </a>
		<input type="hidden" name="nextStep" value="filePermissions">
		<button  id="submits" type="submit" class="button positive">
			<img src="<?php echo URL;?>public/images/icons/tick.png" alt=""/> Retry
		</button>
	</form>
<?php } ?>


</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/FP.PNG"></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>

	
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php echo "";echo $this->msg; echo "";?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>		