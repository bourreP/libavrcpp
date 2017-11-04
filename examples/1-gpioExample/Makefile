DEVICE = atmega328p
MCU = atmega328p
TARGET_ARCH = -mmcu=$(MCU)
AVRDUDE_DEVICE = m328p
PORT = /dev/ttyACM0
F_CPU=16000000UL

INCLUDES = -I/usr/avr/include -I../../libavrcpp
CFLAGS=-Wall -mmcu=$(MCU) $(INCLUDES) -DF_CPU=$(F_CPU) -Os
CXXFLAGS=-fno-exceptions $(CFLAGS)
CC=avr-gcc
CXX=avr-g++

OBJ2HEX=avr-objcopy
LDFLAGS=-Wl,-gc-sections -Wl,-relax

PORT ?= /dev/ttyACM0
AVRDUDE=avrdude

TARGET=main
OBJECT_FILES=main.o


all: $(TARGET).hex

clean:
	rm -f *.o *.hex *.obj *.hex *.elf

%.hex: %.elf
	 $(OBJ2HEX) -j .text -j .data -O ihex $< $@
	 
$(TARGET).elf: $(OBJECT_FILES)
	$(CXX) $(LDFLAGS) $(TARGET_ARCH) $^ -o $@ 

program: $(TARGET).hex
	$(AVRDUDE) -p $(AVRDUDE_DEVICE) -c avrisp2 -P $(PORT) -U flash:w:$(TARGET).hex
