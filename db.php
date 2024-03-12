<!-- connect to phpmyadmin -->

<!-- method "PDO" to connect to DB -->
<?php 
$db = new PDO("mysql:host=localhost;dbname=shop;charset=utf8", "root", "");  