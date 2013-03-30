<?php
/**
* Changelog for perForms
* @version $Id$
* @package perForms
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
* perForms is Free Software
**/

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );
?>

Check for the latest version of perForms at http://www.performs.org.au/

1. Changelog
------------
This is a non-exhaustive but informative changelog for
perForms, including alpha, beta and stable releases.
Our thanks to all those people who've contributed bug reports and
code fixes.

Legend:

* -> Security Fix
# -> Bug Fix
+ -> Addition
^ -> Change
- -> Removed
! -> Note

---------------- current ----------------

---------------- 2.5 ----------------
2007-09 _david
	+	View Submissions
2008-06 _david
	+ Xml Attachments
	# mail not sending to user
	# mail not sending to list
	# 'key not found' notices
	
---------------- 2.4 ----------------
2007-04 _David
 ^ code cleanup
 + FULL edit items while bound to table
 + Apply button in edit form, edit item
 + Preview from edit form, edit item
 + Show bound data from items page
 + Utf-8 Native
 + Added mambot installation
 # Fixed mambot
 + Auto replacement in mambot
 # Reworked Mail Algorithm
 + Added ExtensionInstaller Class
 + lib_replace (variables can be anyware)
 + catalan, hebrew, japanese
 + Added Module to installer
 # Reworked Module
 # Fixed bugs with installer
 * File Upload Protection
 # Fixed user data truncation bug
  
2007-03 _David
 # Fixed bug showing bound table for first digit of row id only
 #+^ com_securityimages 4.1 Integration
 + more complete Html2Pdf Integration
 + Added Replace Submit Button with Image
 + Added Replace Reset Button with Image
 + Added "Show Uploaded Images" in form email
 ^ Updated french translation (thanks Francois Amey)
 # Changed TABLE_NAME_EMPTY handling (friendly message)
 # Remove form items when a form is deleted
 # Form Items now added LAST
 # Fixed up/down buttons wired up wrong
 # formToTable HTML invalid (again)
 + Works with "Component" menu item

2007-02 _David
 # Fixed french translation, was missing fields
 # fixed formToTable html invalid
 + File Upload v1.0 
 + Changed textarea handling, Size1 = width Size2 = height
 + Added "Swap Size1 and Size2" button to quickly cope with new treatment
 + Added float: style for form image

2007-02-20 Jonah Braun
 + Added french translation, thanks Amey François

2007-02-08 _Dave
#^ Rewrote the installation routine
#  Changed bound column handling, now they are all ASC
+  Reverse Item Order (because existing item lists (<2.2.2) will now be backwards)
+  Much more localization

2007-02-02 _Dave
# fixed a bug with loadCalendar not loading correct language
+ added logic to cope with j1.5 loadCalendar()
^ reworked the mailto logic
+ added finnish.php (thanks Jani)
# fixed bug with accessibility script giving focus to wrong controls
# fixed bug with skins including wrong javascript filename
+ added "Send to User", "Send to Admin", "Enable Spoofing" settings

2007-01-28 _Dave
+ made it work with j1.5 in legacy mode

---------------- 2.2.1 beta -- svn 102 -- 2007-01-27 ------------------

2007-01-26 _Dave
+ added bound data pagination
# fixed a bug with binding and export buttons
+ added german.php (thanks to LUW)

---------------- 2.2.1 alpha -- svn 95 -- 2007-01-21 ------------------

2007-01-21 Jonah Braun
 # fixed UserIP column bug when upgrading

---------------- 2.2.0 alpha -- svn 91 -- 2007-01-20 ------------------

2007-01-20 Jonah Braun
 # redesigned and rewrote install and update functions
 + added class perfConfig for component configuration capabilities

2007-01 _Dave
 # various bug fixes, refinements
 # fixed checkbox, radio, select bug
 + admin info icons
 + friendly error reporting
 + perForms Accessibility
 + added "accesskey" to form elements
 + auto generated label tags
 ^ detailed debugging tabs
 + notify user of available updates
 + added "showpf, showpdf, appendtimestamp" to #__performs_items
 + updated performs.sql

 ! when upgrading from 2.1.x to current, 
   sql errors for column exists are expected but not mandatory

---------------- 2.1.3 beta -- svn 42 -- 2007-01-12 ------------------

2007-01 _Dave
 # various bug fixes
 + window control buttons in printer friendly window (print, close)

---------------- 2.1.2 beta -- svn 26 -- 2006-12-15 ------------------

2006-11 _Dave
 # various bug fixes
 ^ php5 compliance
 * session security enhancements
 + pdf feature
 + printer-friendly feature
 ^ reworked database binding behaviour
 + table view if bound to table

2006-11 Kaleb Stolee
 + upgrade and installation routines

---------------- 2.1.0 beta -- svn 299 -- 2006-08-11 ------------------

2006-08-11 Jonah Braun
 + add new install system for easy upgrades
 ^ converted hardcoded special chars to chr()
 + Dutch translation, thanks tantepoes!
 + Spanish translation, thanks Johnny!

----- perForms 1 and 2 created by Ilhami Kilic, ilhamik@gmx.at http://www.tuwitek.at -----


2. Copyright and disclaimer
---------------------------
This application is opensource software released under the GPL.  Please
see source code and http://www.gnu.org/copyleft/gpl.html
