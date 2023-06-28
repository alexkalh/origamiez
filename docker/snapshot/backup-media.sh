#!/bin/sh

cd /var/www/html/wp-content &&
tar -czvf uploads.tar.gz ./uploads &&
mv ./uploads.tar.gz /tmp/snapshot
