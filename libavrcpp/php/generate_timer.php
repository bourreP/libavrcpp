<?php 

$model = "../timer/timer_0.hpp";

for ($i = 1; $i <= 5; $i++)
{

	$replace = [
		"TIMER_0_HPP" => "TIMER_{0}_HPP",
		"TimerRegisters<0, TimerSize>" => "TimerRegisters<{0}, TimerSize>",
		"TCNT0" =>  "TCNT{0}",
		"TIMSK0" => "TIMSK{0}",
		"TOIE0" => "TOIE{0}",
		"OCIE0A" => "OCIE{0}A",
		"OCIE0B" => "OCIE{0}B",
		"OCR0A" => "OCR{0}A",
		"OCR0B" => "OCR{0}B",
		"TCCR0A" => "TCCR{0}A",
		"TCCR0B" => "TCCR{0}B",
		"COM0A0" => "COM{0}A0",
		"COM0A1" => "COM{0}A1",
		"COM0B0" => "COM{0}B0",
		"COM0B1" => "COM{0}B1",
		"WGM00" => "WGM{0}0",
		"WGM01" => "WGM{0}1",
		"WGM02" => "WGM{0}2",
		"TimerPrescaler<0>" => "TimerPrescaler<{0}>",
		"TIMER0_OVF_vect_num" => "TIMER{0}_OVF_vect_num",
		"TIMER0_COMPA_vect_num" => "TIMER{0}_COMPA_vect_num",
		"TIMER0_COMPB_vect_num" => "TIMER{0}_COMPB_vect_num",
		"typedef Timer<0, uint16_t> timer0;"=> "typedef Timer<{0}, uint16_t> timer{0};",
		"typedef Timer<0, uint8_t> timer0;" => "typedef Timer<{0}, uint8_t> timer{0};"
	];

	$replace_timer_2 = [
		"PRESCALER_64" => "PRESCALER_32",
		"PRESCALER_256" => "PRESCALER_64",
		"PRESCALER_1024" => "PRESCALER_128",
		"EXTERNAL_FALLING" => "PRESCALER_256",
		"EXTERNAL_RISING" => "PRESCALER_1024"
	];

	$f = fopen($model, "r");
	$text = fread($f, filesize($model));
	$destination = "../timer/timer_{0}.hpp";
	foreach ($replace as $word => $word_replaced)
	{

		$word_replaced = str_replace("{0}", $i, $word_replaced);
		$text = str_replace($word, $word_replaced, $text);
	}
	if ($i == 2)
	{
		foreach ($replace_timer_2 as $word => $word_replaced)
		{
			$text = str_replace($word, $word_replaced, $text);
		}
	}

	$destination = str_replace("{0}", $i, $destination);
	$port = fopen($destination, "w");
	fwrite($port, $text);
	fclose($port);
	fclose($f);
}
