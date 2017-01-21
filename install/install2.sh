sudo cp -rf ../app/* /var/www/html/
echo "Installing software files...        "
if [[ $? == 0 ]]
then
    echo "Successfully installed software files...		[OK]"
else
    echo "Failed to copy software files...	                [FAIL]"
fi
echo "Creating log directories... "
sudo mkdir -p /var/logs/debugLogs/
if [[ $? == 0 ]]
then
echo     "Log directory successfully created at /var/logs/debugLogs/ [OK]"
fi
sudo chmod 777 /var/logs/debugLogs/
if [[ $? == 0 ]]
then
echo "Successfully changed permissions of folder : /var/logs/debugLogs/    [OK]"
fi
#echo "Installing Database schema and loading entries... "
#username=root
#cat database_init.sql | mysql -u $username -p # type mysql password when asked for it
