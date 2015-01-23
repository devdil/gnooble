<?php

$config  = array(
                        'default' => array('mysql:host=localhost; dbname=autocode', 'root', ''),
                        'customer' => array('mysql:host=localhost; dbname=l192_dev', 'root', '123456') // <-- second different database
                );


var_dump($config['default'][0]);

?>