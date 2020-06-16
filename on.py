from gpiozero import LED
from time import sleep
import sys

led_param = sys.argv[1]
duration = int(sys.argv[2])
led = LED(led_param)
led.on()
sleep(duration)
led.off()
