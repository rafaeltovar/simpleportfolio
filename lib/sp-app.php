<?php
/**
 * This file start SimplePortfolio Enviroment. Don't touch!
 *
 * @package SimplePortfolio
 */

// Dir routes
define ('ROOT_DIR', $_SERVER['DOCUMENT_ROOT']);
define ('LIB_DIR', '/lib');
define ('CONTENT_DIR', '/content');
define ('TEMPLATE_DIR', '/templates');

// Includes
require(ROOT_DIR.LIB_DIR."/inc/magicpath.php");
require(ROOT_DIR.LIB_DIR."/sp-utils.php");
require(ROOT_DIR.LIB_DIR."/sp-functions.php");

// Other constants
define ('CONFIG_FILE', 'config.php');
define ('TEMPLATE_DEFAULT', 'basic');
define ('ROOT_URL', magicpath(2));

if(!file_exists(ROOT_DIR."/".CONFIG_FILE)):
?>
<h1>No existe el fichero de configuraci&oacute;n</h1>
<p>Falta el fichero de configuraci&oacute;n "config.php" en la raiz del sitio.</p>
<p>
	<ol>
		<li>Renombra el fichero "config-sample.php" a "config.php"</li>
		<li>Edita el fichero "config.php" con tus datos.</li>
	</ol>
</p>

<?php
	exit();
endif; // end of comprobacion config.php


$Sp = new SP();

$Sp->AddMenuElement('', "Home"); // Enlace a la home

// Default config
include(ROOT_DIR."/".CONFIG_FILE);

$Sp->Start();
?>