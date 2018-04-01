#!/usr/bin/python
# -*- coding: utf-8 -*-

#this file outputs the one wire temperature sensor value converted to F to the command line

import os
import glob
import time
 
os.system('/sbin/modprobe w1-gpio')
os.system('/sbin/modprobe w1-therm')
 
base_dir = '/sys/bus/w1/devices/'
device_folder = glob.glob(base_dir + '28*')[0]
device_file = device_folder + '/w1_slave'
 
def read_temp_raw():
    f = open(device_file, 'r')
    lines = f.readlines()
    f.close()
    return lines
 
def read_temp():
    lines = read_temp_raw()
    while lines[0].strip()[-3:] != 'YES':
        time.sleep(0.2)
        lines = read_temp_raw()
    equals_pos = lines[1].find('t=')
    if equals_pos != -1:
        temp_string = lines[1][equals_pos+2:]
        temp_c = float(temp_string) / 1000.0
        return temp_c
	
while True:

    pi_temp = read_temp()
    pi_tempraw = read_temp_raw()
    print("In degrees C")
    print (pi_temp)
    print ('\n')
    print("In degrees F")
    print ((pi_temp*(9.0/5))+32) #must be 9.0 or python will not calculate properly
    print ('\n')
    print("this is the raw data ")
    print(pi_tempraw)
    print ('\n')

time.sleep(60)
