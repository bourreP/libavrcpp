// 8MHz oscillator
#define	F_CPU 8000000UL

#include "../../libavrcpp/uart.hpp"
#include "../../libavrcpp/isr.hpp" //Require for the macro: INITIALISE_INTERRUPT_MANAGER
#include <stdint.h>

INITIALISE_INTERRUPT_MANAGER(); //Need to initialise the interrupt manager to use the uart

int main()
{
    //Init the uart0
    uart0::init();

    //Set the baudrate to 9600
    uart0::change_baudrate(9600);

    while(true)
    {
        //Store buffer
        char string[8];

        //Read
        uart0::read(string);

        //Execute order
        if (strcmp(string, "?") == 0)
        {
           uart0::printfln("hello world");
        }
    }

    return 0;
}
