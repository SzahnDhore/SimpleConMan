Simple ConMan
=================================================
**Simple ConMan: The simple convention manager.**

-------------------------------------------------

A tool written in PHP to help organizing a convention. Primarily written for a gaming convention in Sweden, but should (eventually) be able to work for any kind of similar event.

The idea is to build a basic system for managing visitors at an RPG convention. Previous attempts became colossal beasts in my head so this is a much more stripped down version. Hopefully, it will subsequently grow into something more powerful so that all systems needed for the convention are grouped into a single system, but for now I just need it to manage the visitors.


## Features

* Secure login using salted Blowfish hashing for passwords.
* Pretty URLs when using `mod_rewrite` (or similar).


## ToDo

* Write the functions `update()` and `delete()`.
* Add support for other databases than MySQL.
* Make the `database` class work when only provided with a table.