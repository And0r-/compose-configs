# https://docs.nextcloud.com/server/latest/admin_manual/maintenance/migrating.html
# https://pve.proxmox.com/wiki/Linux_Container
# https://docs.nextcloud.com/server/latest/admin_manual/maintenance/backup.html#maintenance-mode
# https://docs.nextcloud.com/server/latest/admin_manual/maintenance/restore.html



# data disk from 133 cloudng is mounted to old nextcloud (102)
pct set 102 -mp1 data:133/vm-133-disk-0.raw,mp=/shared


# Enable maintenance mode:
su www-data -s /bin/sh
cd /var/www/nextcloud
php occ maintenance:mode --on
exit

# you should wait 10min to be sure everything is written from cache

# copy all user files
rsync -Aavx /var/www/nextcloud-data/ /share/nextcloud/


# move database
mysqldump --single-transaction --default-character-set=utf8mb4 -h localhost -u adminer -p nextcloud > nextcloud-sqlbkp_`date +"%Y%m%d"`.bak

mysql -h 192.168.55.133 -p nextcloud < nextcloud-sqlbkp_20221009.bak



# disable maintenance mode
su www-data -s /bin/sh
cd /var/www/nextcloud
php occ maintenance:mode --off
exit

