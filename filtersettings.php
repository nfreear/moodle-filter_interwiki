<?php
/**
 * Admin settings for the Inter-wiki linking filter.
 *
 * @copyright (c) 2011 Nicholas Freear {@link http://freear.org.uk}.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v2 or later
 * @package interwiki
 */
defined('MOODLE_INTERNAL') || die();
if (!defined('INTERWIKI_LIMIT')) {
  define('INTERWIKI_LIMIT', 15);
}

/*
http://en.wikipedia.org/wiki/Interwiki
http://drupal.org/project/interwiki

[wmc:Red Delicious]
  http://commons.wikimedia.org/wiki/File:Red_Delicious.jpg
[cc:by/2.0]
  http://creativecommons.org/licenses/by/2.0/
http://docs.moodle.org/en/Calculated_Objects_question_type
[hg:nfreear/ Simple speak]
  https://bitbucket.org/nfreear/simplespeak
*/

$interwiki_defaults = array(
  'w'  => array(
    'uri'  =>'http://en.wikipedia.org/wiki/$1',
    'label'=>'On Wikipedia [en]'),
  'wm'=> array(
    'uri'  =>'http://commons.wikimedia.org/wiki/File:$1'),
  'g'  => array(
    'uri'  =>'http://www.google.com/search?q=%22$2%22'),
  'gd' => array(
    'uri'  =>'http://www.google.com/search?q=define%3A$2'),
  'cc' => array(
    'uri'  =>'http://creativecommons.org/licenses/$4',
    'rel'  =>'license'),
  'gnu'=>array(
    'uri'  =>'http://www.gnu.org/licenses/$4.html',
    'rel'  =>'license'),
  'mfd' => array(
    'uri'  =>'http://moodle.org/mod/forum/discuss.php?d=$1'),
  'md' => array(
    'uri'  =>'http://docs.moodle.org/en/$1'),
  'mp' => array(
    'uri'  =>'http://moodle.org/mod/data/view.php?d=13&rid=$5',
    'label'=>'Moodle plugins database'),
  'git'=> array(
    'uri'  =>'https://github.com/$1'),
  'hg'=> array(
    'uri'  =>'https://bitbucket.org/$5'),
);


$items = array();
$count = 0;
foreach ($interwiki_defaults as $prefix => $wiki) {
    $uri = $wiki['uri'];
    $items[] = new admin_setting_configtext("filter_interwiki_prefix_$count",
        "$count. ".get_string('prefix', 'filter_interwiki'),
        get_string('prefhelp', 'filter_interwiki'), $prefix, PARAM_ALPHA);
    $items[] = new admin_setting_configtext("filter_interwiki_uri_$count",
        get_string('uri', 'filter_interwiki'),
        get_string('urihelp', 'filter_interwiki'), $uri, PARAM_TEXT);

    $count++;
}

// Add some empty fields at the end.
for ($idx = $count; $idx < INTERWIKI_LIMIT; $idx++) {
    $items[] = new admin_setting_configtext("filter_interwiki_prefix_$idx",
        "$idx. ".get_string('prefix', 'filter_interwiki'),
        get_string('prefhelp', 'filter_interwiki'), '', PARAM_ALPHA);
    $items[] = new admin_setting_configtext("filter_interwiki_uri_$idx",
        get_string('uri', 'filter_interwiki'),
        get_string('urihelp', 'filter_interwiki'), '', PARAM_TEXT);
}

foreach ($items as $item) {
    $settings->add($item);
}

