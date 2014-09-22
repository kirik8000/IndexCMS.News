<?php

// Данные для mysql сервера
$dbhost = "localhost"; // Хост
$dbuser = "index"; // Имя пользователя
$dbpassword = "index"; // Пароль
$dbname = "index"; // Имя базы данных

// Подключаемся к mysql серверу
$link = mysql_connect($dbhost, $dbuser, $dbpassword);

// Выбираем нашу базу данных
mysql_select_db($dbname, $link);

// Создаём таблицу customer
// т.е. делаем sql запрос
$query = "create table rubrika (id int(2) primary key
auto_increment, rubrikaname varchar(50), img varchar(300), info varchar(100))";
mysql_query($query, $link);

// Закрываем соединение
mysql_close($link)

?>