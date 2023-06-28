#!/bin/bash

#usage: drop-all-tables -d database -u dbuser -p dbpass

TEMP_FILE_PATH='./rollback-tmp.sql'

while getopts d:u:p: option; do
  # shellcheck disable=SC2220
  case "${option}" in

  d) DBNAME=${OPTARG} ;;
  u) DBUSER=${OPTARG} ;;
  p) DBPASS=${OPTARG} ;;
  esac
done

echo "SET FOREIGN_KEY_CHECKS = 0;" >$TEMP_FILE_PATH
(mysqldump --add-drop-table --no-data -u"$DBUSER" -p"$DBPASS" "$DBNAME" | grep 'DROP TABLE') >>$TEMP_FILE_PATH
echo "SET FOREIGN_KEY_CHECKS = 1;" >>$TEMP_FILE_PATH
mysql -u"$DBUSER" -p"$DBPASS" "$DBNAME" <$TEMP_FILE_PATH
rm -f $TEMP_FILE_PATH
