# inodedetails

Cheers.

Here's a nice little cPanel Plugin to allow your customers to view their Inode Usage Details.

Specifically, we show all folders with more than 100 files in them.

And even better, we have a failover script that continues to work even if the customer has reached their hard limit (through Cloud Linux) - All other Inode plugins we've seen fail once a customer hits their hard limit.

Still a few improvements required - the inode limit in the explanation to the customer is hardcoded... 

Anyhow, it's pretty easy to install.

=====

wget https://github.com/richardmadison/inodedetails/raw/master/install_inodedetails.sh

chmod +x install_inodedetails.sh

./install_inodedetails.sh

=====

That's it.

Always open to suggestions.
