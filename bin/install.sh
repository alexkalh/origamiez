#!/bin/sh

# password: root
sudo chmod 777 -R ./docker &&
docker exec -it org_db /tmp/snapshot/restore.sh &&
docker exec -it org_wp /tmp/snapshot/install.sh