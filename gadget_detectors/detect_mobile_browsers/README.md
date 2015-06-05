
## Introduction:

Once you have installed idMyGadget, as described in the
[gadget_detectors README.md file](https://github.com/tomwhartung/idMyGadget/blob/master/gadget_detectors/README.md),
file, follow these steps to install the PHP device detection script from [detectmobilebrowsers.com].

## Installation and Setup:

This option requires only one small php file named  `detectmobilebrowser.php` .

IdMyGadget includes this file, so no installation or setup is required.

## Updating the Installation 

1. Visit http://detectmobilebrowsers.com and click on the PHP button to download the latest version of the detectmobilebrowsers script.
  * This file is named `detectmobilebrowser.php.txt`.

1. Copy this file into the `idMyGadget/gadget_detectors/detect_mobile_browsers/php` directory.

1. Rename this file from `detectmobilebrowser.php.txt` to `detectmobilebrowser.php`.

1. Edit this file, replacing the following line:
  ```php
  header('Location: http://detectmobilebrowser.com/mobile');
  ```
  with this one:
  ```php
  $usingMobilePhone = TRUE;
  ```

## Running the Demos

Verify that you have set this up properly, access the following file in your web browser:
[http://example.com/idMyGadget/gadget_detectors/detect_mobile_browsers/rawDemo.php](http://example.com/idMyGadget/gadget_detectors/detect_mobile_browsers/rawDemo.php)

For example, if you are setting this up on your localhost, go to
[http://localhost/idMyGadget/gadget_detectors/detect_mobile_browsers/rawDemo.php](http://localhost/idMyGadget/gadget_detectors/detect_mobile_browsers/rawDemo.php)

There is a link to this file in the index.php file in this directory.

Run the demos to see:

* Whether the device is a phone

## Troubleshooting:

If you get a blank screen, it is probably because you did not rename the detectmobilebrowser.php.txt file to detectmobilebrowser.php .  To be sure, check your web server's log file.

If you are redirected to the detectmobilebrowsers.com site, it is because you did not edit the detectmobilebrowser.php as described in the Updating the Installation section.


## Conclusion:


## References:

If you have any questions about idMyGadget, please contact me
at https://github.com/tomwhartung or tomwhartung.com .

