# Install le serveur Slave
awk -F "," '{system("ssh root@"$1" \"echo "$2" > /etc/hostname;hostname;rm -rf *;apt-get install git;git clone https://github.com/php-afiliassur/125243.git;cd 125243/slave/setup;chmod +x setup.sh;./setup.sh  \"")}' hosts
