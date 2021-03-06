
# jmws_idMyGadget_for_joomla
This is the version of the IdMyGadget&copy; adapter API that I customizing for integration with the default joomla templates Beez3 and protostar.

## Overview

This code is middle ware, sitting between (and, when properly set up, actually containing) three device detectors and the three joomla templates that use it.

## History
This code hase been copied from https://github.com/tomwhartung/idMyGadget and changed slightly, for use with joomla.

* An isInstalled() method has been added so that joomla can display a user-friendly error message when the selected device detector is not installed
* Much of the unneeded demo stuff has been deleted, but some has been left in, mainly for diagnostic purposes

See the parent project, [IdMyGadget&copy;](https://github.com/tomwhartung/idMyGadget) for background information.

### Device Detection in Action
To see IdMyGadget&copy; in operation, see [my resume](https://github.com/tomwhartung/resume) , which is online here: http://tomwhartung.com/resume ,
For the full effect, be sure to visit http://tomwhartung.com/resume on both your phone and a desktop or tablet!

## Related Repositories

### IdMyGadget&copy;: The Parent Repo
The idea is to not make any changes to the parent project, so we can do whatever we want for joomla here, with out having to worry about messing up projects depended on IdMyGadget&copy;, such as my [resume](https://github.com/tomwhartung/resume) .

### jmws_idMyGadget_for_joomla: This Repo
The purpose of this project is: to integrate the device detection offered by the three third-party device detectors used by [IdMyGadget&copy;](https://github.com/tomwhartung/idMyGadget) into the default joomla templates Beez3 and protostar.  

### Joomla Templates That Use This Repo

The following repos depend on the device detection functionality provided by this repo:

* https://github.com/tomwhartung/jmws_beez3_idmygadget (minimal changes made to original template to take advantage of device detection)
* https://github.com/tomwhartung/jmws_protostar_idMyGadget (minimal changes made to original template to take advantage of device detection)
* https://github.com/tomwhartung/jmws_tomh_idMyGadget (like jmws_protostar_idMyGadget, but with a few extra changes made because "I felt like it")

When the device is a phone, these repos also use jQuery Mobile (as does my [resume](https://github.com/tomwhartung/resume).

## Installation
If you still want to download and use this code somehow, you will want to run the command 

```
git clone git@github.com:tomwhartung/jmws_idMyGadget_for_joomla.git
```

Note that by itself, this code does not do very much.  At a minimum, you will probably (*) want to install the device detection code, as described in the various README.md files in the IdMyGadget repo:

* https://github.com/tomwhartung/idMyGadget/tree/master/gadget_detectors/detect_mobile_browsers
* https://github.com/tomwhartung/idMyGadget/tree/master/gadget_detectors/mobile_detect
* https://github.com/tomwhartung/idMyGadget/tree/master/gadget_detectors/tera_wurfl
 
(*) detect_mobile_browsers does not require installation, but only offers a tiny subset of the functionality offered by the other two device detectors.

## Running the Device Detectors
To run the Gadget Detectors, load this file into your browser:
* gadget_detectors/gadget_detectors.php

The parent IdMyProject&copy; contains more demo code so there's really no reason to do this, but you can, if you want.

## Next Steps:

Before you can use IdMyGadget&copy; to identify devices, you should install, and if necessary initialize, one of the "real" supported device detectors, mobile_detect or tera_wurfl.  (The detect_mobile_browsers detector does not require installation, but it only identifies phones, so using one of the others is recommended.)

## Conclusion

It is essential to realize that the purpose of this repo is to **provide a bridge between:**

* one of the device detectors listed above and
* one of the joomla templates listed above

Additionally, you will want to **refer to the original IdMyGadget&copy; repo, because much of the information there is not duplicated here.**

For information about the IdMyGadget Device Detection Adapter API&copy;, see the [About-IdMyGadget.md file in this directory](https://github.com/tomwhartung/jmws_idMyGadget_for_joomla/blob/master/ABOUT-IdMyGadget.md).

