# xuez-monitor

PHP script designed to monitor daemon via apache on local linux running Xuez CLI

# Requirements

- XUEZ CLI Linux Wallet https://github.com/XUEZ/xuez/releases

<pre>
wget https://github.com/XUEZ/xuez/releases/download/1.0.1.7/xuez-linux-cli-1017.tgz
tar zxvf xuez-1.0.0-linux-cli.tgz
</pre>
- Apache2 and php running :

<pre>apt-get install apache2 php</pre>

# Features
- Node status
- Balance
- Tx History
- System info
- Explorer links

# Important
- This script will use sudo to execute local commands
- Only output commands are used (getinfo, getblockcount...)
- You cannot send coins with this script
- You can only receive coins on generated address (address 0)

# Example
You can try it at : http://45.77.53.110/
Hosted on Vultr : https://www.vultr.com/?ref=7280492

# Donate
Feel free
XUEZ : XHQyJRVhfsX8Po7bbjpzEtgiVjbjdQJMcu
