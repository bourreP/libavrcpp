<?php

$model = "../gpio/int_0.hpp";

for ($i = 1; $i <= 7; $i++)
{

	$replace = [
		"INT_0_HPP" => "INT_{0}_HPP",
		"class Int<0>" => "class Int<{0}>",
		"< INT0" => "< INT{0}",
		"ISC00" => "ISC{0}0",
		"ISC01" => "ISC{0}1",
		"INT0_vect_num" => "INT{0}_vect_num",
		"Int<0> int0" => "Int<{0}> int{0}",
		"EICRA" => "EICR{1}"
	];

	$f = fopen($model, "r");
	$text = fread($f, filesize($model));
	$destination = "../gpio/int_{0}.hpp";

	if ($i <= 3)
	{
		$x = 'A';
	}
	else
	{
		$x = 'B';
	}

	foreach ($replace as $word => $word_replaced)
	{
		$word_replaced = str_replace("{0}", $i, $word_replaced);
		$word_replaced = str_replace("{1}", $x, $word_replaced);
		$text = str_replace($word, $word_replaced, $text);
	}
	$destination = str_replace("{0}", $i, $destination);
	$port = fopen($destination, "w");
	fwrite($port, $text);
	fclose($port);
	fclose($f);
}
