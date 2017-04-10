<?php 
// na każdej podstronie dodać na górze session_start();
// i sprawdzać czy user zalogowany (w razie potrzeby)
// można przekazywać id zalogowanego usera czystym tekstem, ale lepiej zrobić
// to hashem md5

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>CLStore Shop</title>
</head>
<body>

<h2>CLStore Shop</h2>

<img src="img/szop.jpg" alt="CLStore Szop" />

<hr/>

<a href="index.php">Strona główna</a> | <a href="basket.php">Koszyk</a> | <a href="order.php">Zamówienia</a> | <a href="register.php">Rejestracja</a> | <a href="user.php">Dane użytkownika</a> | <a href="product.php">Szczegóły produktu</a>
 
</body>
</html>