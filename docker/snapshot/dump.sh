#!/bin/sh

now=$(date +'%Y%m%d%H%I%S') &&
  mysqldump -uroot -proot wordpress >/tmp/snapshot/backup-"${now}".sql
