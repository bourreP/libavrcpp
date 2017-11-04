#include <gpio.hpp>
#include <util/delay.h>

int main ()
{
    //Pin 5 of port B in output mode
    B5::output();
    B6::output();
    B0::input();
    //Loop
    while(true)
    {
        // ON
        B5::high();
        _delay_ms(500);

        // OFF
        B5::low();
        _delay_ms(500);

        if (B0::read() == 1)
            B6::toggle();
    }

    return 0;
}
