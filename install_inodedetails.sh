#!/bin/sh
# SCRIPT: install.sh
# PURPOSE: Install the inode details plugin into cPanel
# AUTHOR: Richard Madison <rmadison@lightspeedtech.com>
#

clear
echo "Installing inodedetails"

# Create the directory for the plugin
mkdir -p /usr/local/cpanel/base/frontend/paper_lantern/inodedetails

# Get the plugin files from Github
curl -s https://raw.githubusercontent.com/richardmadison/inodedetails/master/inodedetails_full.tar.gz > /root/inodedetails_full.tar.gz

# Uncompress the archive
cd /root/
tar xzf inodedetails_full.tar.gz

# Move files to /usr/local/cpanel/base/frontend/paper_lantern/inodedetails directory
mv /root/inodes.html /usr/local/cpanel/base/frontend/paper_lantern/inodedetails
mv /root/inodeframe.html /usr/local/cpanel/base/frontend/paper_lantern/inodedetails
mv /root/inodes.pl /usr/local/cpanel/base/frontend/paper_lantern/inodedetails
mv /root/inodedetails.php /usr/local/cpanel/base/frontend/paper_lantern/inodedetails
mv /root/inodedetails.live.php /usr/local/cpanel/base/frontend/paper_lantern/inodedetails
mv /root/inodedetails.tar.gz /usr/local/cpanel/base/frontend/paper_lantern/inodedetails

# Install the plugin (which also places the png image in the proper location)
/usr/local/cpanel/scripts/install_plugin /usr/local/cpanel/base/frontend/paper_lantern/inodedetails/inodedetails.tar.gz

echo "Installation is complete!"
