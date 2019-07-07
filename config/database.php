<?php
/**
 *Configurate connection with Database
 *
 *Create file log.txt in folder config,
 *and save in first line: dbname, second: host, third: user name to database, and in fourth: passwort. Like:
 *dbname
 *host
 *user
 *pass
 */
$data = file("".URL."config/log.txt");
$dsn = "mysql:dbname=".trim($data[0]).";host=".trim($data[1]).";charset=utf8";
$user = trim($data[2]);
$pass = trim($data[3]);

try {
  $pdo = new PDO($dsn, $user, $pass);
} catch (PDOException $e) {
  exit($e->getMessage());
}
