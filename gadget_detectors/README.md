
## Introduction:

The following instructions describe how to install idMyGadget
on a PC running Ubuntu 14.04 .  My server is running Apache and
DocumentRoot is set to /var/www .

If you are using a different operating system or installing
into a different directory, you may need to adjust these
instructions accordingly.

## Requirements:

Installing and using this code requires a computer running a
LAMP (Linux, Apache, MySql, and PHP) server.  It will probably work
on a MAMP, WAMP, or XAMP server, but I have not tried it.

If you are using Windows, you will need a terminal application,
such as Cygwin, to run these commands.

## Installation and Setup:

Install (git clone) idMyGadget source:
```
cd /var/www
git clone git://github.com:tomwhartung/idMyGadget.git
cd idMyGadget
```

## Next Steps:

Before you can use idMyGadget to identify devices, you must install,
and if necessary initialize, one of the supported device detectors.

