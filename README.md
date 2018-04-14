# xuez-monitor

PHP script designed to monitor XUEZ CLI daemon on local linux

# Requirements

- XUEZ CLI Linux Wallet https://github.com/XUEZ/xuez/releases
<pre>
wget https://github.com/XUEZ/xuez/releases/download/1.0.1.7/xuez-linux-cli-1017.tgz
tar zxvf xuez-1.0.0-linux-cli.tgz
</pre>
- Apache2 and php running :
<pre>
apt-get install apache2 php
</pre>

# Features
- Node status
- Balance
- Tx History
- System info
- Explorer links

# Important
- This script will use sudo to execute local commands
Add this line <pre>www-data ALL=(ALL) NOPASSWD:ALL</pre> Under <pre># User privilege specification</pre>
 in /etc/sudoers
- Only output commands are used (getinfo, getblockcount...)

# Example
- You can see it running : http://45.77.53.110/

# Feel free to Donate
- XUEZ : XHQyJRVhfsX8Po7bbjpzEtgiVjbjdQJMcu
- Use my Vultr referral : https://www.vultr.com/?ref=7280492
