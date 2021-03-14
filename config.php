<?php
setlocale(LC_TIME, 'fr_FR'); 
setlocale(LC_ALL, 'fr_FR.utf8');

$config = [
	'db' => [
		'name' => '2021_bdd_prj_tsm_tp1',
		'user' => 'root',
		'pwd' => '',
		'host' => 'localhost',
	],
	'mail' => [
        'host' => 'smtp.gmail.com',
        'username' => 'dev.toupie360@gmail.com',
        'password' => 'unibeton360',
        'port' => '465',
        'encryption' => 'ssl',
        'from' => [
        	'name' => '{SARII-Stock}',
        	'email' => 'noreply@sarii-stock.fr',
        ],
		'admin' => [
			'name' => '{SARII-Stock} Admin',
			'email' => 'michael.convergence@gmail.com',
		],
	],
	'routes' => [
		'connexion' => [
			'layout' => false,
			'view' => 'signin',
			'auth' => false,
		],
		'404' => [
			'layout' => false,
			'view' => '404',
			'auth' => false,
		],
		'index' => [
			'layout' => true,
			'view' => 'dashboard',
			'auth' => true,
		],
		'produits' => [
			'layout' => true,
			'view' => 'products',
			'auth' => true,
		],
		'produit' => [
			'layout' => true,
			'view' => 'product',
			'auth' => true,
		],
		'historique' => [
			'layout' => false,
			'view' => 'history',
			'auth' => true,
		],
	],
];
?>