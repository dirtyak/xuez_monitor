# xuez-monitor

PHP script designed to monitor XUEZ CLI daemon and masternodes

# How to install

- XUEZ CLI Linux Wallet https://github.com/XUEZ/xuez/releases
<pre>
wget https://github.com/XUEZ/xuez/releases/download/1.0.1.7/xuez-linux-cli-1017.tgz
tar zxvf xuez-linux-cli-1017.tgz
</pre>
- Install apache2 and php :
<pre>
apt-get install apache2 php php-curl
</pre>
- Download and put php files in <b>/var/www/html</b> (default apache2 path) :
<pre>
cd /var/www/html # Default apache2 server path
wget https://github.com/dirtyak/xuez_monitor/archive/master.zip
unzip master.zip
rm master.zip # We don't need that anymore
</pre>
- Fill in the configuration file with your settings
<pre>
nano /var/www/hmtl/config.php
</pre>

# Features
- Node status
- Balance
- Tx History
- System info
- Explorer links

# Important
- Fill config.php
- Xuez-monitor now uses curl to make RPC request, it can be done locally or remotely and is much safer than older method (php shell_exec)

# Example
- You can see it running : http://45.77.53.110/

# Feel free to Donate
- XUEZ : XHQyJRVhfsX8Po7bbjpzEtgiVjbjdQJMcu
- Use my Vultr referral : https://www.vultr.com/?ref=7280492
