sudo cp -rf ../app/* /var/www/html/
echo "Installing software files...        "
if [[ $? == 0 ]]
then
    echo "Successfully installed software files...		[OK]"
else
    echo "Failed to copy software files...	                [FAIL]"
fi

#echo "Installing Database schema and loading entries... "
#username=root
#cat database_init.sql | mysql -u $username -p # type mysql password when asked for it
