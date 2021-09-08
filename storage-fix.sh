#!/bin/bash

# Navigate into your app Laravel app folder
cd /home/{SYSTEM_USER}/{DOMAIN}

# Clear the cache
php artisan cache:clear

# Set permissions to 775
chmod 775 storage/

# Navigate into the storage folder
cd storage/

# Set folder/file permissions to 775/664
find . -type d -exec chmod 775 {} \; && find . -type f -exec chmod 664 {} \;

# Navigate back
cd ..

# Clear the Cache again
php artisan cache:clear

# Print Message
 echo "👍 Folder/File permissions successfully updated!"