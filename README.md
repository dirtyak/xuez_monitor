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
apt-get install apache2 php php-curl
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
