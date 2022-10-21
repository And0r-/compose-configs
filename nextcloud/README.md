Used Nextcloud tutorial with elasticsearch

https://goneuland.de/nextcloud-server-mit-elasticsearch-collabora-office-docker-compose-und-traefik-installieren/


1   create new container and mount data disk to /data.
2   apk add git vim
3   git clone this repo
4   cd compose_config/nextcloud
5   cp default.env .env # and edit
6   sh init_and_reset.sh
7   open nextcloud and install all 4 "Full text search" apps
8   sh init_fulltext_search_after_config_nextcloud.sh
9   add dns entry on pfsense so the document server can find the cloud.

to use it behind a proxy we have to edit the config:
docker-compose stop
vim /var/lib/docker/volumes/nextcloud_nextcloud_app/_data/config/config.php
  'trusted_domains' =>
  array (
    0 => 'localhost',
    1 => 'cloud3.iot-schweiz.ch',
    2 => '192.168.55.134',
  ),
  'trusted_proxies' =>
  array (
    0 => '192.168.55.3/24',
  ),
  'overwrite.cli.url' => 'https://cloud3.iot-schweiz.ch',
  'overwriteprotocol' => 'https',
  'overwritehost' => 'cloud3.iot-schweiz.ch',

  docker-compose up -d

### Fulltext Search ###
enable fulltext search (4 apps)
set es address: 192.168.55.117:9200
# initial index
docker exec --user www-data nextcloud-app php occ fulltextsearch:index


#enable live indexing
docker exec --user www-data nextcloud-app php occ fulltextsearch:live

# when needet
docker exec -it --user www-data nextcloud-app php occ db:convert-filecache-bigint



### add cron ###
crontab -e
*/5 * * * * docker exec --user www-data nextcloud-app php -f /var/www/html/cron.php
