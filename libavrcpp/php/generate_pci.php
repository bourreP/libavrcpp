<?php

$model = "../gpio/pci_0.hpp";

for ($i = 1; $i <= 3; $i++)
{

	$replace = [
		"PCI_0_HPP" => "PCI_{0}_HPP",
		"class PinChangeInterrupt<0>" => "class PinChangeInterrupt<{0}>",
		"PCIE0" => "PCIE{0}",
		"PCINT0_vect_num" => "PCINT{0}_vect_num",
		"class PinChangeInterrupt0" => "class PinChangeInterrupt{0}",
		"PinChangeInterrupt<0>::" => "PinChangeInterrupt<{0}>::",
		"PCMSK0" => "PCMSK{0}",
		"typedef PinChangeInterrupt<0> pci0" => "typedef PinChangeInterrupt<{0}> pci{0}",
		"PCINT0\n" => "PCINT{1}\n",
		"PCINT1\n" => "PCINT{2}\n",
		"PCINT2\n" => "PCINT{3}\n",
		"PCINT3\n" => "PCINT{4}\n",
		"PCINT4\n" => "PCINT{5}\n",
		"PCINT5\n" => "PCINT{6}\n",
		"PCINT6\n" => "PCINT{7}\n",
		"PCINT7\n" => "PCINT{8}\n",
		"PinChangeInterrupt0<PCINT0> pcint0" => "PinChangeInterrupt{0}<PCINT{1}> pcint{1}",
		"PinChangeInterrupt0<PCINT1> pcint1" => "PinChangeInterrupt{0}<PCINT{2}> pcint{2}",
		"PinChangeInterrupt0<PCINT2> pcint2" => "PinChangeInterrupt{0}<PCINT{3}> pcint{3}",
		"PinChangeInterrupt0<PCINT3> pcint3" => "PinChangeInterrupt{0}<PCINT{4}> pcint{4}",
		"PinChangeInterrupt0<PCINT4> pcint4" => "PinChangeInterrupt{0}<PCINT{5}> pcint{5}",
		"PinChangeInterrupt0<PCINT5> pcint5" => "PinChangeInterrupt{0}<PCINT{6}> pcint{6}",
		"PinChangeInterrupt0<PCINT6> pcint6" => "PinChangeInterrupt{0}<PCINT{7}> pcint{7}",
		"PinChangeInterrupt0<PCINT7> pcint7" => "PinChangeInterrupt{0}<PCINT{8}> pcint{8}",
	];

	$f = fopen($model, "r");
	$text = fread($f, filesize($model));
	$destination = "../gpio/pci_{0}.hpp";

	$x = 8 * $i;

	foreach ($replace as $word => $word_replaced)
	{
		$word_replaced = str_replace("{0}", $i, $word_replaced);
		$word_replaced = str_replace("{1}", $x, $word_replaced);
		$word_replaced = str_replace("{2}", $x+1, $word_replaced);
		$word_replaced = str_replace("{3}", $x+2, $word_replaced);
		$word_replaced = str_replace("{4}", $x+3, $word_replaced);
		$word_replaced = str_replace("{5}", $x+4, $word_replaced);
		$word_replaced = str_replace("{6}", $x+5, $word_replaced);
		$word_replaced = str_replace("{7}", $x+6, $word_replaced);
		$word_replaced = str_replace("{8}", $x+7, $word_replaced);
		$text = str_replace($word, $word_replaced, $text);
	}
	$destination = str_replace("{0}", $i, $destination);
	$port = fopen($destination, "w");
	fwrite($port, $text);
	fclose($port);
	fclose($f);
}
