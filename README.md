Interwiki
=========

A Moodle filter plug-in to easily add internal and external links (see, <http://en.wikipedia.org/wiki/Interwiki>)


Installation
------------
To install (on Moodle 2):

1. Un-compress the Zip/Gzip archive, and copy the folder renamed 'interwiki' to your moodle/filter/ directory.
2. Log in to Moodle as admininstrator, go to Site Administration | Plugins | Filters | Manage Filters.
3. Choose 'On' or 'Off but available' in the drop-down menu next to 'Interwiki'.
4. Go to the Filter settings page and define your prefixes and URL patterns.
5. To include the styles, visit Site Administration | Appearance | Themes | Theme selector and press the 'Clear theme caches' button.

Use these placeholders in the URL patterns:

* $1 - space (' ') is replaced by underscore (_), eg. Wikipedia.
* $2 - ' ' to '+', eg. Google.
* $3 - ' ' to '%20'
* $4 - ' ' to '-'
* $5 - ' ' to '', eg. Bitbucket, GitHub.


Usage
-----
Generally, the syntax for a link is:

    [[prefix:Page Name| Optional label]]

For example:

    [[gd:rabbit]] - A Google dictionary definition.
    [[md:Question types]] - A Moodle Docs page.
    [[tw:nfreear/status/58097660837642240| A Twitter status]]
    [[my:A page]] - Your School's pages.


Links
-----
* Moodle plugin page: <http://moodle.org/mod/data/view.php?d=13&rid=X>
* Code, Git: <https://github.com/nfreear/moodle-filter_interwiki>
* Demo: <http://freear.org.uk/moodle>

Notes
-----
* Tested in Moodle 2.0.2.
* No javascript, no database access - very simple!
* Filter syntax is case-sensitive.
* The plug-in is internationalized in Moodle 2.
* Inspired by <http://drupal.org/project/interwiki> - thanks!

Notices
-------
Interwiki, Copyright © 2011 Nicholas Freear.

* License: <http://www.gnu.org/copyleft/gpl.html> GNU GPL v2 or later.

