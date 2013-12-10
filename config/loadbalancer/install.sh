#!/bin/bash
if [ ! -f /root/block ]; then
apt-get update
apt-get install -qq nginx nfs-kernel-server
cp /vagrant/config/loadbalancer/default /etc/nginx/sites-available/
cp /vagrant/config/loadbalancer/exports /etc/
cp /vagrant/www/*.* /usr/share/nginx/www
rm /usr/share/nginx/www/index.html
chown www-data:www-data /usr/share/nginx/www/*
chmod 644 /usr/share/nginx/www/*
/etc/init.d/nfs-kernel-server start
/etc/init.d/nginx start
echo "1" > /root/block
fi
