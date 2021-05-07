<?php

function loadClass($class_name)
{
  require '/shared/httpd/compar-operator/htdocs/class/'. $class_name . '.php'; 
}

spl_autoload_register('loadClass');