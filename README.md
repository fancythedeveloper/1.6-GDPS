# 1.6 GDPS
Basically a Geometry Dash Server Emulator but for 1.6

Supported version of Geometry Dash: 1.0-1.6 (I assume :P)

Required version of PHP: 5.4+ (tested up to 7.3.11 by Cvolton)

### Why isn't this a fork?
I already made too many changes to want to fork the files. I don't like it either

### Setup
1) Upload the files on a webserver
2) Import database.sql into a MySQL/MariaDB database
3) Edit the links in config/connection.php
4) Edit the links in libgame.so for armeabi, armeabi-v7, and x86

### Credits
Using this for XOR encryption - https://github.com/sathoro/php-xor-cipher - (incl/lib/XORCipher.php)

Using this for cloud save encryption - https://github.com/defuse/php-encryption - (incl/lib/defuse-crypto.phar)

Most of the stuff in generateHash.php has been figured out by pavlukivan and Italian APK Downloader, so credits to them

Cvolton for making this server software in the first place, fuckin epic dude

Top Week ingame made possible by Absolute
