<?php 

$destination = "../isr.hpp";

$vectors = [
	"ADC_vect",
	"ANALOG_COMP_0_vect",
	"ANALOG_COMP_1_vect",
	"ANALOG_COMP_2_vect",
	"ANALOG_COMP_vect",
	"ANA_COMP_vect",
	"CANIT_vect",
	"EEPROM_READY_vect",
	"EE_RDY_vect",
	"EE_READY_vect",
	"EXT_INT0_vect",
	"INT0_vect",
	"INT1_vect",
	"INT2_vect",
	"INT3_vect",
	"INT4_vect",
	"INT5_vect",
	"INT6_vect",
	"INT7_vect",
	"IO_PINS_vect",
	"LCD_vect",
	"LOWLEVEL_IO_PINS_vect",
	"OVRIT_vect",
	"PCINT0_vect",
	"PCINT1_vect",
	"PCINT2_vect",
	"PCINT3_vect",
	"PCINT_vect",
	"PSC0_CAPT_vect",
	"PSC0_EC_vect",
	"PSC1_CAPT_vect",
	"PSC1_EC_vect",
	"PSC2_CAPT_vect",
	"PSC2_EC_vect",
	"SPI_STC_vect",
	"SPM_RDY_vect",
	"SPM_READY_vect",
	"TIM0_COMPA_vect",
	"TIM0_COMPB_vect",
	"TIM0_OVF_vect",
	"TIM1_CAPT_vect",
	"TIM1_COMPA_vect",
	"TIM1_COMPB_vect",
	"TIM1_OVF_vect",
	"TIMER0_CAPT_vect",
	"TIMER0_COMPA_vect",
	"TIMER0_COMPB_vect",
	"TIMER0_COMP_A_vect",
	"TIMER0_COMP_vect",
	"TIMER0_OVF0_vect",
	"TIMER0_OVF_vect",
	"TIMER1_CAPT1_vect",
	"TIMER1_CAPT_vect",
	"TIMER1_CMPA_vect",
	"TIMER1_CMPB_vect",
	"TIMER1_COMP1_vect",
	"TIMER1_COMPA_vect",
	"TIMER1_COMPB_vect",
	"TIMER1_COMPC_vect",
	"TIMER1_COMPD_vect",
	"TIMER1_COMP_vect",
	"TIMER1_OVF1_vect",
	"TIMER1_OVF_vect",
	"TIMER2_COMPA_vect",
	"TIMER2_COMPB_vect",
	"TIMER2_COMP_vect",
	"TIMER2_OVF_vect",
	"TIMER3_CAPT_vect",
	"TIMER3_COMPA_vect",
	"TIMER3_COMPB_vect",
	"TIMER3_COMPC_vect",
	"TIMER3_OVF_vect",
	"TIMER4_CAPT_vect",
	"TIMER4_COMPA_vect",
	"TIMER4_COMPB_vect",
	"TIMER4_COMPC_vect",
	"TIMER4_OVF_vect",
	"TIMER5_CAPT_vect",
	"TIMER5_COMPA_vect",
	"TIMER5_COMPB_vect",
	"TIMER5_COMPC_vect",
	"TIMER5_OVF_vect",
	"TWI_vect",
	"TXDONE_vect",
	"TXEMPTY_vect",
	"UART0_RX_vect",
	"UART0_TX_vect",
	"UART0_UDRE_vect",
	"UART1_RX_vect",
	"UART1_TX_vect",
	"UART1_UDRE_vect",
	"UART_RX_vect",
	"UART_TX_vect",
	"UART_UDRE_vect",
	"USART0_RXC_vect",
	"USART0_RX_vect",
	"USART0_TXC_vect",
	"USART0_TX_vect",
	"USART0_UDRE_vect",
	"USART1_RXC_vect",
	"USART1_RX_vect",
	"USART1_TXC_vect",
	"USART1_TX_vect",
	"USART1_UDRE_vect",
	"USART2_RX_vect",
	"USART2_TX_vect",
	"USART2_UDRE_vect",
	"USART3_RX_vect",
	"USART3_TX_vect",
	"USART3_UDRE_vect",
	"USART_RXC_vect",
	"USART_RX_vect",
	"USART_TXC_vect",
	"USART_TX_vect",
	"USART_UDRE_vect",
	"USI_OVERFLOW_vect",
	"USI_OVF_vect",
	"USI_START_vect",
	"USI_STRT_vect",
	"USI_STR_vect",
	"WATCHDOG_vect",
	"WDT_OVERFLOW_vect",
	"WDT_vect"
];

$f = fopen($destination, "w");

fwrite($f,"
#include <avr/interrupt.h>
#include <avr/io.h>
#include \"interrupt_manager.hpp\"
#include \"uart.hpp\"
");

foreach ($vectors as $vector)
{
	if ($vector == "USART0_RX_vect")
	{
		$line = "
#if defined(USART0_RX_vect) && !defined(IGNORE_USART0_RX_vect)
ISR(USART0_RX_vect)
{
	Uart<0>::store_char(UDR0);
}
#endif
";
	}
	elseif ($vector == "USART1_RX_vect")
	{
		$line = "
#if defined(USART1_RX_vect) && !defined(IGNORE_USART1_RX_vect)
ISR(USART1_RX_vect)
{
	Uart<1>::store_char(UDR1);
}
#endif
";
	}
	elseif ($vector == "USART2_RX_vect")
	{
		$line = "
#if defined(USART2_RX_vect) && !defined(IGNORE_USART2_RX_vect)
ISR(USART2_RX_vect)
{
	Uart<2>::store_char(UDR2);
}
#endif
";
	}
	elseif ($vector == "USART3_RX_vect")
	{
		$line = "
#if defined(USART3_RX_vect) && !defined(IGNORE_USART3_RX_vect)
ISR(USART3_RX_vect)
{
	Uart<3>::store_char(UDR3);
}
#endif
";
	}
	elseif ($vector == "USART_RX_vect")
	{
		$line = "
#if defined(USART_RX_vect) && !defined(IGNORE_USART_RX_vect)
ISR(USART_RX_vect)
{
	Uart<0>::store_char(UDR0);
}
#endif
";
	}
	else
	{
		$line = "
#if defined({0}) && !defined(IGNORE_{0})
ISR({0})
{
	InterruptManager::interrupts[{0}_num]();
}
#endif
";
	}
	$line = str_replace("{0}", $vector, $line);
	fwrite($f, $line);
}
