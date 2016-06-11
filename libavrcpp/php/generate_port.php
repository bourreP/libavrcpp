<?php

$model = "../gpio/port_a.hpp";

$letters = array("B","C","D","E","F","G","H","I","J","K","L");

foreach ($letters as $i)
{

$replace = [
	"PORT_A_HPP" => "PORT_{0}_HPP",
	"class Port<'A'>" => "class Port<'{0}'>",
	"DDRA" => "DDR{0}",
	"PORTA" => "PORT{0}",
	"class PinPortA" => "class PinPort{0}",
	"PinPortA<0> A0" => "PinPort{0}<0> {0}0",
	"PinPortA<1> A1" => "PinPort{0}<1> {0}1",
	"PinPortA<2> A2" => "PinPort{0}<2> {0}2",
	"PinPortA<3> A3" => "PinPort{0}<3> {0}3",
	"PinPortA<4> A4" => "PinPort{0}<4> {0}4",
	"PinPortA<5> A5" => "PinPort{0}<5> {0}5",
	"PinPortA<6> A6" => "PinPort{0}<6> {0}6",
	"PinPortA<7> A7" => "PinPort{0}<7> {0}7",
	"typedef Port<'A'> PortA" => "typedef Port<'{0}'> Port{0}",
	"PINA" => "PIN{0}"
];

$f = fopen($model, "r");
$text = fread($f, filesize($model));
$destination = "../gpio/port_{0}.hpp";

	foreach ($replace as $word => $word_replaced)
	{
		$word_replaced = str_replace("{0}", $i, $word_replaced);
		$text = str_replace($word, $word_replaced, $text);
	}
	$destination = str_replace("{0}", strtolower($i), $destination);
	$port = fopen($destination, "w");
	fwrite($port, $text);
	fclose($port);
	fclose($f);
}
