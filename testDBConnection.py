#!/usr/bin/python

import sys
import pymysql
#the following does not work in python3
#import MySQLdb

try:
  # Create new database connection.
  db = pymysql.connect(host="192.168.1.85",user="pi_insert",password="raspberry",database="measurements")
  # prepare a cursor object using cursor() method
  cursor = db.cursor()
  # Query the version of the MySQL database.
  cursor.execute("SELECT version()")
  # Assign the query results to a local variable.
  data = cursor.fetchone()
  # Print the results.
  print ("MySQL Version: %s " % data)
except pymysql.Error as e:
  # Print the error.
  print ("ERROR %d: %s" % (e.args[0], e.args[1]))
  sys.exit(1)
finally:
  # Close the connection when it is open.
  if db:
    db.close()
