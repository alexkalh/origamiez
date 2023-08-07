#!/bin/sh

mysql -uroot -proot wordpress < /tmp/snapshot/schema.sql
