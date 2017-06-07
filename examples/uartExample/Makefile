DEVICE = atmega328p
MCU = atmega328p
AVRDUDE_DEVICE = m328p
PORT = /dev/ttyACM0

INCLUDES = -I/usr/avr/include
CFLAGS=-g -Wall -mmcu=$(MCU) $(INCLUDES) -Os
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
	rm -f *.o *.hex *.obj *.hex

%.hex: %.obj
	$(OBJ2HEX) -R .eeprom -O ihex $< $@

%.obj: $(OBJECT_FILES)
	$(CXX) $(CXXFLAGS) $(OBJECT_FILES) $(LDFLAGS) -o $@

program: $(TARGET).hex
	$(AVRDUDE) -p $(AVRDUDE_DEVICE) -c avrisp2 -P $(PORT) -U flash:w:$(TARGET).hex
