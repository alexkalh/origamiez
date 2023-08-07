#!/bin/sh

tar -czvf uploads.tar.gz /var/www/html/wp-content/uploads &&
mv /var/www/html/wp-content/uploads.tar.gz /tmp/snapshot
