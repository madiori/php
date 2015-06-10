<?php

namespace Model;

use PDO;

class Config{
	const DATASOURCE = 'mysql';
	const HOST = '127.0.0.1';
	const PORT = '3306';
	const DB = 'tppdo';
	const LOGIN = 'root';
	const PWD = '';

	public static function getPDO(){
		$pdo = null;
		try{
			$dsn = self::DATASOURCE . ':host=' . self::HOST . ';port=' . self::PORT . ';dbname=' . self::DB;
			$pdo = new PDO($dsn, self::LOGIN, self::PWD);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch(PDOException $e){
			echo "Une erreur s'est produite :" .  $e->getMessage();
		}

		return $pdo;
	}


}