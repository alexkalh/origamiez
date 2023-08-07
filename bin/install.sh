#!/bin/sh

# password: root
docker exec -it med_db /tmp/snapshot/restore.sh &&
docker exec -it med_wp /tmp/snapshot/install.sh