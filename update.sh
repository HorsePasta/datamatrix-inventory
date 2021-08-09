#!/bin/bash

#Update V1
#TODO Add checks to restore a failed update
#TODO Read and use current branch. Currently uses master only.
#TODO It might be better to make two scripts. One that pulls the entire github with no dependencies or pathing and one..
#...to run this script which handles moving files. If the update script updates it wont get updated in the container without a docker rebuild

echo "Starting update..."
echo "======================="

# Check if github is reachable.
if curl -Is https://github.com/HorsePasta/datamatrix-inventory | head -1 | grep "HTTP/[12] [23].."; then
     echo "Success. Github is reachable."
else
     echo "Failure, github not reachable: $?"
     exit 1
fi

# Clone the master branch.
if git clone https://github.com/HorsePasta/datamatrix-inventory.git /opt/datamatrix-inventory; then
     echo "Success. Downloaded new version."
else
     echo "Failure, Could not download new version: $?"\
     exit 1
fi

# Remove existing application
if rm -rf /var/www/html/*; then
     echo "Success. Removed previous version."
else
     echo "Failure, Could not remove previous version: $?"
     exit 1
fi

# Move the new files
if mv -f /opt/datamatrix-inventory/src/* /var/www/html/; then
     echo "Success. Moved new version to /var/www/html/"
else
     echo "Failure, Could not move new files to /var/www/html: $?"
     exit 1
fi

# Get the newest PHPMailer
if git clone --depth 1 https://github.com/PHPMailer/PHPMailer.git /var/www/html/phpmailer; then
     echo "Success. Updated phpmailer"
else
     echo "Failure, Could not update phpmailer: $?"
     exit 1
fi


# Get the newest PHPMailer
if rm -rf /opt/datamatrix-inventory; then
     echo "Success. Removed update directory."
else
     echo "Failure, Could not remove update directory: $?"
     exit 1
fi

echo "... Update finished."
echo "======================="