#!/usr/bin/env python3

"""This script seeds the DynamoDB table with data"""

import sys
from time import sleep

import boto3
from botocore.exceptions import ClientError

table_name = ""


def wait_for_table_active():
    client = boto3.client("dynamodb")
    print(f"Waiting for table {table_name} to finish creating...")
    waiter = client.get_waiter("table_exists")
    waiter.wait(TableName=table_name)
    active = False
    while not active:
        table_description = client.describe_table(TableName=table_name)
        print(f"Waiting for DynamoDB table {table_name} to become active...")
        current_status = table_description["Table"]["TableStatus"]
        active = current_status == "ACTIVE"
        sleep(1)


def seed_data():
    print(f"Seeding {table_name} table...")
    table = boto3.resource("dynamodb").Table(table_name)
    try:
        with table.batch_writer() as batch:
            batch.put_item(Item={"username": "anshu", "password": "a123456"})
             batch.put_item(Item={"username": "tony", "password": "1123456"})
            batch.put_item(Item={"username": "smith", "password": "s123456"})
            batch.put_item(Item={"username": "bob", "password": "b123456"})
           
        print(table.scan()["Items"])
    except ClientError as e:
        print(e)


if __name__ == "__main__":
    if len(sys.argv) != 2:
        print("Usage: dynamodb.py <table name>")
        exit(1)
    table_name = sys.argv[1]
    wait_for_table_active()
    seed_data()
    print("Done.")
