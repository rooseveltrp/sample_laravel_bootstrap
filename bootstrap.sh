echo "Updating the permissions"
chmod -R 777 /var/www/storage
chmod -R 777 /var/www/bootstrap/cache
chmod u+x /var/www/artisan

echo "Creating database"
echo "create database agora" | mysql -u root -proot