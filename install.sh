#!/usr/bin/env bash

echo "--- Good morning, master. Let's get to work. Installing now. ---"

echo "--- Updating packages list ---"
sudo apt-get update

echo "--- MySQL time ---"
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'

echo "--- Installing base packages ---"
sudo apt-get install -y vim curl python-software-properties

#echo "--- We want the bleeding edge of PHP, right master? ---"
#sudo add-apt-repository -y ppa:ondrej/php5
#echo "--- Updating packages list ---"
#sudo apt-get update

echo "--- Installing PHP-specific packages ---"
sudo apt-get install -y php5 apache2 libapache2-mod-php5 php5-curl php5-gd php5-mcrypt mysql-server-5.5 php5-mysql git-core

echo "--- Installing and configuring Xdebug ---"
sudo apt-get install -y php5-xdebug

cat << EOF | sudo tee /etc/php5/mods-available/xdebug.ini
zend_extension=xdebug.so

xdebug.cli_color=1
xdebug.show_local_vars=1
xdebug.remote_enable=true
xdebug.remote_connect_back=1
xdebug.remote_port="9000"
xdebug.idekey=phpstorm
xdebug.scream = 0

xdebug.profiler_enable = 0
xdebug.profiler_enable_trigger = 0
xdebug.profiler_output_dir = /vagrant/temp
xdebug.profiler_output_name = cachegrind.out
EOF

echo "--- Enabling mcrypt in all environments ---"
sudo php5enmod -s ALL mcrypt

echo "--- Enabling mod-rewrite ---"
sudo a2enmod rewrite


# Create a new vhost for the project...
echo "--- Enabling dev.riffal.com vhost ---"
cat << EOF | sudo tee /etc/apache2/sites-available/dev-site.conf
<VirtualHost *:80>
    ServerName dev.riffal.com
    ServerAdmin webmaster@localhost
    DocumentRoot /vagrant/public

    ErrorLog \${APACHE_LOG_DIR}/vagrant-error.log
    CustomLog \${APACHE_LOG_DIR}/vagrant-access.log combined

    <Directory /vagrant>
        Options Indexes FollowSymLinks Includes ExecCGI
        AllowOverride All
        Require all granted
    </Directory>

</VirtualHost>
EOF

sudo a2dissite 000-default.conf
sudo a2ensite dev-site.conf

echo "--- What developer codes without errors turned on? Not you, master. ---"
sed -i "s/error_reporting = .*/error_reporting = E_ALL/" /etc/php5/apache2/php.ini
sed -i "s/display_errors = .*/display_errors = On/" /etc/php5/apache2/php.ini

sed -i 's/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

echo "--- Restarting Apache ---"
sudo service apache2 restart

echo "--- Composer is the future. But you knew that, did you master? Nice job. ---"
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Laravel stuff here, if you want
composer install -d /vagrant

echo "--- All set to go! Would you like to play a game? ---"
