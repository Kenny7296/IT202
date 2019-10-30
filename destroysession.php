<?php

sessionstart();

session_unset();
session_destroy();
echo "It's all gone!";
echo var_export($_SESSION, true);

?>
