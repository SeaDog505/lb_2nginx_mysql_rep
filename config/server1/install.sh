#!/bin/bash
if [ ! -f /root/block ]; then
apt-get update
mkdir /mnt/nfs
echo "mysql-server mysql-server/root_password password pass1" | debconf-set-selections
echo "mysql-server mysql-server/root_password_again password pass1" | debconf-set-selections
apt-get install -qq mysql-client mysql-server
apt-get install -qq nginx
apt-get install -qq php5-cgi spawn-fcgi php-pear php5 php5-common php5-mysql php5-mcrypt mcrypt
echo "192.168.10.4:/usr/share/nginx/www /mnt/nfs nfs defaults 0 0" >> /etc/fstab
cp /vagrant/config/server1/default /etc/nginx/sites-available/
cp /vagrant/config/server1/my.cnf /etc/mysql/
cp /vagrant/config/php-fastcgi /usr/bin/
cp /vagrant/config/Sphp-fastcgi /etc/init.d/php-fastcgi
update-rc.d php-fastcgi defaults
chmod +x /usr/bin/php-fastcgi
chmod +x /etc/init.d/php-fastcgi
/etc/init.d/php-fastcgi start
/etc/init.d/nginx start
/etc/init.d/mysql restart
mysql -u root --password="pass1" -e "GRANT REPLICATION SLAVE ON *.* TO 'repl'@'192.168.10.101' IDENTIFIED BY 'slavepass';FLUSH PRIVILEGES;"
mysql -u root --password="pass1" -e "CHANGE MASTER TO MASTER_HOST='192.168.10.101',MASTER_USER='repl',MASTER_PASSWORD='slavepass',MASTER_LOG_FILE='mysql-bin.000001',MASTER_LOG_POS=107;START SLAVE;"
mount -a
echo "1" > /root/block
fi
