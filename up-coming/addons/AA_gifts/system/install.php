<?php
if(!defined('BOOM')){
	die();
}
if(boomAllow(10)){
	$ad = array(
	'name' => 'AA_gifts',
	'access'=> 2,
	);
}
$mysqli->query("CREATE TABLE IF NOT EXISTS `boom_gifts` (
  `gift_id` int(11) NOT NULL,
  `gift_name` varchar(50) NOT NULL,
  `gift_photo` varchar(50) NOT NULL,
  `gift_coins` int(11) NOT NULL
)");
$mysqli->query("INSERT INTO `boom_gifts` (`gift_id`, `gift_name`, `gift_photo`, `gift_coins`) VALUES
(1, 'checkola', 'chocolate.png', 1000),
(2, 'cegarette', 'cegarette.png', 100),
(3, 'cake', 'big-cake.png', 200),
(4, 'box', 'box.png', 200),
(5, 'banana', 'banana.png', 150),
(6, 'rose', 'redrose.png', 150),
(7, 'ice cream', 'teddy-bear.png', 100),
(8, 'big heart', 'ice-cream.png', 50),
(9, 'wine', 'wine.png', 200),
(10, 'milk', 'babymilk.png', 150),
(11, 'please !!', 'pray.png', 50),
(12, 'kill you', 'cutoo.gif', 50)");
?>