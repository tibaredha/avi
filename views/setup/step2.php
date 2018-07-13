<div class="sheader1l"><p id="lsetup"><?php echo "";echo $this->msg; echo "";?></p></div><div class="sheader1r"><p id="lsetup"><?php html::NAV();?></p></div>
<div class="sheader2l"><p id="lsetup">3-Server requirements</p></div><div class="sheader2r">sheader3</div>
<div class="contentl">

<?php 
$goToNextStep = true;
if (!$goToNextStep) 
{
?>
<div class="error">Contact your webserver support (hosting service) to get the necessary PHP settings fixed and refresh this site!</div>
<?php 
}
$phpVersion='5.3.0';
$currentPhpVersion = phpversion();
$phpVersionOk = version_compare($currentPhpVersion, 5) >= 0;
$loadedExtensions = get_loaded_extensions();
foreach ($loadedExtensions as $key => $ext) $loadedExtensions[$key] = strtolower($ext); 
$showExtensions = array();
$extensions = array("mysql", "pcre","zip");

foreach ($extensions as $ext)
	{
		$isLoaded = in_array($ext, $loadedExtensions);
		$showExtensions[$ext] =  $isLoaded;
		if (!$isLoaded) $goToNextStep = false;
	}
?>
<h4>PHP Version</h4>

<table  width='65%' >
	<thead>
		<tr>
			<th>Name</th>
			<th>Version</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<tr bgcolor="white">
			<td>Required</td>
			<td><?php echo $phpVersion; ?></td>
			<td><img src="<?php echo URL;?>public/images/accept.png"> OK</td>
		</tr>
		<tr bgcolor="white">
			<td>You have</td>
			<td><?php echo $currentPhpVersion; ?></td>
			<td>
			<?php 
			if ($phpVersionOk) { 
			?> 
			<img src="<?php echo URL;?>public/images/accept.png"> OK 
			<?php 
			} else { 
			?> 
			<img src="<?php echo URL;?>public/images/cancel.png"> Below requirement! Please update your PHP installation.
			<?php
			}
			?>
			</td>
		</tr>
	</tbody>
</table>

<h4>PHP Extensions</h4>

<table width='65%'  >
	<thead>
		<tr>
			<th>Name</th>
			<th>Status</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($showExtensions as $extension => $status): ?>
		<tr bgcolor="white">
			<td><?php echo $extension; ?></td>
			<td><?php if ($status) { ?> <img src="<?php echo URL;?>public/images/accept.png"> OK <?php } else { ?> <img src="<?php echo URL;?>public/images/cancel.png"> Not installed!<?php } ?> </td>
		</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<?php if ($goToNextStep) { ?>
	<form action="<?php echo URL;?>setup/step3" method="post">
		<a href="<?php echo URL;?>setup/" id="Cancel"><img src="<?php echo URL;?>public/images/icons/cross.png" alt=""/> Cancel </a>
		<input type="hidden" name="nextStep" value="filePermissions">
		<button id="submits" type="submit" class="button positive">
			<img src="<?php echo URL;?>public/images/icons/tick.png" alt=""/> Next
		</button>
	</form>
<?php } else { ?>
	<form action="<?php echo URL;?>setup/step2" method="post">
		<a href="<?php echo URL;?>setup/" id="Cancel"><img src="<?php echo URL;?>public/images/icons/cross.png" alt=""/> Cancel </a>
		<input type="hidden" name="nextStep" value="requirements">
		<button id="submits" type="submit" class="button positive">
			<img src="<?php echo URL;?>public/images/icons/tick.png" alt=""/> Retry
		</button>
	</form>
<?php } ?>



</div>	
<div class="content"><img id="image" src="<?php echo URL;?>public/images/SR.PNG"></div>
<div class="contentr"><img id="image" src="<?php echo URL;?>public/images/<?php echo logod;?>"></div>

	
<div class="scontentl2"><?php echo "";echo $this->msg; echo "";?></div>		
<div class="scontentl3"><?php echo "";echo $this->msg; echo "";?></div>
<div class="scontentr1"><?php echo "";echo dsp; echo "";?></div>		