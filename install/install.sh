
if [ "`lsb_release -is`" == "Ubuntu" ] || [ "`lsb_release -is`" == "Debian" ]
then
    sudo apt-get -y install mysql-server mysql-client mysql-workbench libmysqld-dev;
    sudo apt-get install -y language-pack-en-base;
    sudo LC_ALL=en_US.UTF-8 add-apt-repository ppa:ondrej/php;
    sudo apt-get update;
    sudo apt-get -y install apache2;
    sudo apt-get -y install php7.0 libapache2-mod-php7.0 php7.0-mcrypt phpmyadmin;
    sudo apt install -y php7.0-mbstring php7.0-zip php7.0-xml
    sudo apt-get install php7.0-mysql
    sudo apt-get install php7.0-curl
    sudo chmod 777 -R /var/www/;
    sudo printf "<?php\nphpinfo();\n?>" > /var/www/html/info.php;
    sudo service apache2 restart;

elif [ "`lsb_release -is`" == "CentOS" ] || [ "`lsb_release -is`" == "RedHat" ]
then
    sudo yum -y install httpd mysql-server mysql-devel php php-mysql php-fpm;
    sudo yum -y install epel-release phpmyadmin rpm-build redhat-rpm-config;
    sudo yum -y install mysql-community-release-el7-5.noarch.rpm proj;
    sudo yum -y install tinyxml libzip mysql-workbench-community;
    sudo chmod 777 -R /var/www/;
    sudo printf "<?php\nphpinfo();\n?>" > /var/www/html/info.php;
    sudo service mysqld restart;
    sudo service httpd restart;
    sudo chkconfig httpd on;
    sudo chkconfig mysqld on;

else
    echo "Unsupported Operating System";
fi

# Export software files to /var/www/html
# Load all schemas and entries to the database
sudo cp -rf ../app/* /var/www/html/
if [[ $? == 0 ]]
then
    echo "Successfully installed software files...		[OK]"
else
    echo "Failed to copy software files...	                [FAIL]"
fi

