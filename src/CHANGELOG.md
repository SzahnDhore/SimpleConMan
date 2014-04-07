Changelog
=========

Version numbering follows the pattern: *[major].[minor].[miniscule]*. All numbers begin at 0 and are reset whenever a preceding number is changed. Version 0.1.0 is initial project creation and 1.0.0 is the first release with a "complete" featureset.


## Current version

### 0.10.0 | 2014-04-06

+ A simple registration form is present. There is no validation tied to it yet, but it works pretty well anyway.
+ There is now a library in place for parsing Markdown, making it possible to format output without relying on HTML. WYSIWYG editor will probably not be included though.
* I've tweaked the autoloader quite a lot to make it both a bit snappier and able to load PSR-0 compliant external libraries. The only thing you have to do is make sure that the library is contained in a folder with the same name as the class you're trying to load - **not** in a folder with the vendor name.
* The `alert` class was fleshed out a bit to accommodate for persistent alerts.


## Previous versions

### 0.9.0 | 2014-04-03

+ System alerts are now working properly. I can easily set any alert I need and that alert will be shown to the user next time the page refreshes.
* I implemented the Yeti theme for bootstrap, making things look a bit nicer.


### 0.8.2 | 2014-04-01

+ The system now has a function that takes swedish names and transcribes them into correct japanese. The function will be developed over time so that the whole system can benefit from correct automatic translation of any text.


### 0.8.1 | 2014-03-31

* Page routing and displaying is once again working. Because of the way the content is fetched, it should be simple to migrate the file based approach used right now to a database driven one later on. That will open up the system to become more like a proper CMS.


### 0.8.0 | 2014-03-30

+ The smarty templating engine is now used! It's not fully implemented yet, but I'm working out the kinks with some speed and soon it will be perfect. This means that page generating is also getting a complete overhaul.
* I've cleaned up and rewritten a lot of code in a lot of places, partially because of smarty but also because there was some unneccessary granulation of the code.
* Also, the quest for proper documentation goes ever on...


### 0.7.1 | 2014-03-27

* Have been tweaking a few things around in the `Loginform` class to make the code look a bit better. I'll go on changing the code in more places.


### 0.7.0 | 2014-03-26

+ Work has begun on a proper menu parser. The menu will take on a static `array()` for now, but later on it will detect pages automagically.
+ Decided on using GPL3 for the license. The project will also be placed on GitHub later on. I might make a new projet or it might replace my current ConMan-project completely. We'll see.
* Changed some unimportant text.
* Made `about` into a public page.
* Changed things in the CSS to make the background picture of the jumbotron look nice on mobiles.


### 0.6.0 | 2014-03-25

* Basic routing parser now in place. So far it only does parsing from pretty URL to an `array()`. Is also patched into the `Page` class in a bit of an ugly way. This will need some work later on.


### 0.5.1 | 2014-03-22

+ Work has begun on a routing class. It should be made optional for the sake of those who can't or don't want to change their .htaccess (or equivalent) file.


### 0.5.0 | 2014-03-21

+ The system now has a basic dynamic content handler. It needs a lot more love before it's perfect, but it's a start at least.
+ There's also a very crude access manager for users in place.
+ Work has begun on phpDoc-compatible documentation. All comments will eventually be converted.


### 0.4.0 | 2014-03-17

+ Project now uses Twitter bootstrap for styling.


### 0.3.0 | 2014-03-16

+ Added an HTML login form. It prototypes the function response message system, which is yet to be written...
+ Begun construction on a page class that prints out the contents of the page the user is currently on.
* `Database` function `read()` was rewritten to use prepared statements correctly. Should now prevent SQL injection.


### 0.2.0 | 2014-03-15

+ Basic logic for the login system in place. Passwords are salted and hashed using Blowfish.


### 0.1.0 | 2014-03-13

+ Creation of project and basic file structure.
+ Added language support using HoL.
+ Added an autoloader that automagically includes any files I need for declared classes.
+ Added class for CRUD operations. So far it only has CR though. Uses PDO and prepared statements to prevent SQL injection.
