<?php

/**
 * Escapes HTML for output
 *
 */

function escape($html)
{
	return htmlspecialchars($html, ENT_QUOTES, "UTF-8");
}