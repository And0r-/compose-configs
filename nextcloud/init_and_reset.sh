apk update
apk upgrade
apk add vim git docker docker-compose

rc-update add docker boot
service docker start

# remove docker volumes and shut down
docker-compose down -v

# Install loki driver
docker plugin install grafana/loki-docker-driver:latest --alias loki --grant-all-permissions


# /data is a mounted disk we have to use it in the container.
rm -r /data/nextcloud
mkdir /data/nextcloud
chmod 777 -R /data/nextcloud/


#setup localtime
apk add tzdata
rm -rf /etc/localtime
rm -rf /etc/timezone
ls /usr/share/zoneinfo
cp /usr/share/zoneinfo/Europe/Zurich  /etc/localtime
echo "Europe/Zurich" >  /etc/timezone
apk del tzdata
