<?php
$db['sp'] = array(
	'dsn'   => "pgsql:host=". PG_HOST .";port=". PG_PORT .";dbname=". PG_DB, 
	'hostname' => '',
	'username' => PG_USER,
	'password' => db_decryptRJ256(PG_PASS),
	// 'password' => 'Dunhill399',
	'database' => '',
	'dbdriver' => 'pdo',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);