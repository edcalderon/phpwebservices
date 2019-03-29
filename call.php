<?php

function make_call($ext,$msg)
{

  	shell_exec("./script.bash -a $ext -b '$msg'");

        $text = "Llamada realizada con exito.  ";
	
	return $text;

}
