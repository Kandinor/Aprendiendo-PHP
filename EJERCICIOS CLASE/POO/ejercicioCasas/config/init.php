<?php
define ('DOC_ROOT',dirname(dirname(__FILE__)));

spl_autoload_register(
    function($Clase){
        require(DOC_ROOT."/src/$Clase.php");
    }
);

?>