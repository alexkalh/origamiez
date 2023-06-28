#!/bin/sh

now=$(date +'%Y%m%d%H%I%S') &&
  mysqldump -u root -p wordpress >/tmp/snapshot/backup-"${now}".sql
