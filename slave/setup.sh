apt-get update
apt-get -y upgrade
apt-get -y install postfix nginx curl git php5-cli php5-fpm mailutils vim
ln -s /usr/share/nginx/www/ /www
chmod 777 /var/log
useradd contact
cp default /etc/nginx/sites-available/
cp main.cf /etc/postfix/main.cf
cp handle.php /www/handle.php
postmap /etc/postfix/transport
newaliases
/etc/init.d/postfix restart
/etc/init.d/php5-fpm restart
/etc/init.d/nginx restart
