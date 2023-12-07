#!/usr/bin/env python3
import sys
import random
import sympy
import mysql.connector
import math
import hashlib

def generate_large_prime():
    return sympy.randprime(10, 100)

def generate_multiplicative_group_element(n):
    group = [i for i in range(1, n) if math.gcd(i, n) == 1]
    return random.choice(group)

def calculate_d(m, lno, k, s):
    hashed_data = hashlib.sha256(lno.encode('utf-8')).hexdigest()
    numeric_l = int(hashed_data, 16)
    d = pow(m, numeric_l  * k, s)
    return d

def generate_l(username, pas):
    # Combine username and password
    combined_data = f"{username}{pas}".encode('utf-8')

    # Use a secure hash function (e.g., SHA-256) to generate a hash
    hashed_data = hashlib.sha256(combined_data).hexdigest()

    # Convert the hash to a numeric value (you might need to adapt this based on your needs)
    numeric_l = 10
    #int(hashed_data, 16)

    return numeric_l

def generate_additional_parameters():
    s = generate_large_prime()
    m = generate_multiplicative_group_element(s)
    k = random.randint(1, 1000)
    d = calculate_d(m, lno, k, s)
    l = generate_l(username, pas)
    
    dd = random.randint(1, d//2)
    ld = random.randint(1, l//2)
    kd = random.randint(1, k//2)
    return s, m, d, l, k, dd, ld, kd

def store_additional_parameters(user_id, s, m, d, l, k, dd, ld, kd):
    # Connect to the database
    conn = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="Vanet"
    )

    # Create a cursor
    cursor = conn.cursor()

    # Insert data into the 'additional_parameters' table (replace with your actual table name)
    sql = "INSERT INTO additional_parameters (user_id, s, m, d, l, k, dd, ld, kd) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)"
    values = (user_id,s, m, d, l, k, dd, ld, kd)

    cursor.execute(sql, values)

    # Commit changes and close the connection
    conn.commit()
    conn.close()

if __name__ == "__main__":
    # Command-line arguments from PHP script
    print("hello")
    user_id = sys.argv[1]
    username = sys.argv[2]
    pas = sys.argv[3]
    lno = sys.argv[4]
    vno = sys.argv[5]

    # Generate additional parameters
    s, m, d, l, k, dd, ld, kd = generate_additional_parameters()

    # Store additional parameters in the database
    store_additional_parameters(user_id, s, m, d, l, k, dd, ld, kd)
