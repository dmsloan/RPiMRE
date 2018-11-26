#!/usr/bin/python
# -*- coding: utf-8 -*-

import os
import glob
import time
import MySQLdb as mdb
 
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
#    print(lines)
    while lines[0].strip()[-3:] != 'YES':
        time.sleep(0.2)
        lines = read_temp_raw()
    equals_pos = lines[1].find('t=')
    if equals_pos != -1:
        temp_string = lines[1][equals_pos+2:]
#     	 print (temp_string)
        temp_f = int((((float(temp_string)/1000)* (9.0/5.0)) + 32)*100)
#        print (temp_f)
	return temp_f
	
while True:
	
    try:
        pi_temp = read_temp()
        con = mdb.connect('localhost', 'pi_insert', 'raspberry', 'measurements')
        
        # # Check if connection was successful
        # if (con):
        #     # Carry out normal procedure
        #     print "Connection successful"
        # else:
        #     # Terminate
        #     print "Connection unsuccessful"
        
        cur = con.cursor()
        # print(pi_temp)
        # after hours of looking the following line had to be changed from (pi_temp) to (pi_temp,). (pi_temp)
        # worked with python 2.6 but not with 2.7. Adding the comma to change it to (pi_temp,) forced the variable
        # to be a tuple and corrected the type error 
        cur.execute("""INSERT INTO temperature(temperature) VALUES(%s)""", (pi_temp,))
        con.commit()
    
    except mdb.Error, e:
        con.rollback()
        print "Error %d: %s" % (e.args[0],e.args[1])
        sys.exit(1)
    
    finally:    
        if con:    
            con.close()
		
	# print(read_temp())	
	time.sleep(10)
