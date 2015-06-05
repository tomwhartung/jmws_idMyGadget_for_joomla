
## Introduction:

Once you have installed idMyGadget, as described in the
[gadget_detectors README.md file](https://github.com/tomwhartung/idMyGadget/blob/master/gadget_detectors/README.md)
file, follow these steps to install the Mobile-Detect PHP device detection script.

## Installation and Setup:

This option requires downloading (cloning) the Mobile-Detect code from github.

1. Access this URL: https://github.com/serbanghita/Mobile-Detect

1. If you are accustomed to using github, you probably want to clone the code, otherwise it may be easier to download the zip file.  Either way, clone or unzip the code into the `idMyGadget/gadget_detectors/mobile_detect` directory.

1. This should result in the `idMyGadget/gadget_detectors/mobile_detect/Mobile-Detect' directory containing all of the Mobile-Detect code.

## Updating the Installation 

1. Run the git pull command to update the source.

  ```
  git pull
  ```

## Running the Demos

Verify that you have set this up properly, access the following file in your web browser:
[http://example.com/idMyGadget/gadget_detectors/mobile_detect/rawDemo.php](http://example.com/idMyGadget/gadget_detectors/mobile_detect/rawDemo.php)

For example, if you are setting this up on your localhost, go to
[http://localhost/idMyGadget/gadget_detectors/mobile_detect/rawDemo.php](http://localhost/idMyGadget/gadget_detectors/mobile_detect/rawDemo.php)

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

