#include <uart.hpp>
#include <isr.hpp>
#include <timer.hpp>

INITIALISE_INTERRUPT_MANAGER();

bool overflow = false;

void onTimer0Overflow()
{
	overflow = true;
	uart0::printfln("What I'm doing now?! My max value is: %d and my value is: %d", timer0::counter::max_value(), timer0::counter::value());
}

int main()
{
	uart0::init();

	uart0::change_baudrate(9600);

	//MODE COUNTER
	timer0::mode(timer0::TimerMode::MODE_COUNTER);

	timer0::set_prescaler(timer0::prescaler::PrescalerValue::PRESCALER_1);

	timer0::counter::mode(timer0::counter::CounterMode::COUNTER_NORMAL);

	timer0::counter::disable();

	timer0::counter::value(240);

	timer0::counter::enable();

	timer0::counter::overflow_interrupt::attach(onTimer0Overflow);

	timer0::counter::overflow_interrupt::enable();

	while(!overflow)
	{
		uart0::printfln("Timer 0 is: %d", timer0::counter::value());
	}

	timer0::counter::overflow_interrupt::disable();

	timer0::mode(timer0::TimerMode::MODE_PWM);

	timer0::pwm::waveform_mode(timer0::pwm::PwmMode::PWM_FAST);

	timer0::pwm::output_mode_a(timer0::pwm::OutputMode::OUTPUT_NON_INVERTING);

	timer0::pwm::output_mode_b(timer0::pwm::OutputMode::OUTPUT_DISCONNECT);

	timer0::pwm::pwm_a(50);

	uart0::printfln("Now Timer 0 is generating a PWM on his PIN A"); //TODO Tell which PIN is it

	while(true);
}
