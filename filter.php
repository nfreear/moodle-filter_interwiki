<?php
/**
 * Inter-wiki linking filter for Moodle.
 *
 * @copyright (c) 2011 Nicholas Freear {@link http://freear.org.uk}.
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v2 or later
 * @package interwiki
 */
defined('MOODLE_INTERNAL') || die();
define('INTERWIKI_LIMIT', 15);

/* Placeholder characters:
  $1 - ' ' to '_', eg. Wikipedia.
  $2 - ' ' to '+', eg. Google.
  $3 - ' ' to '%20'
  $4 - ' ' to '-'
  $5 - ' ' to '', eg. Bitbucket, GitHub.
*/

function interwiki_filter($courseid, $text) {
    global $CFG;

    if (!is_string($text) or empty($text)) {
        // non string data can not be filtered anyway
        return $text;
    }

    $newtext = $text; // we need to return the original value if regex fails!

    if (!empty($CFG->filter_interwiki_prefix_0)) {
        $search = '#\[:([a-z]+):([\w -_\/\.]+)(\|[\w -]+)?\]#ms';
        $newtext = preg_replace_callback($search, '_filter_interwiki_callback', $newtext);
    }
    return $newtext;
}

function _filter_interwiki_callback($matches) {
    $prefix= $matches[1];
    $name = $text = $matches[2];
    if (isset($matches[3])) {
        $text = trim($matches[3], '| ');
        $text = empty($text) ? $name : $text;
    }
    $interwikis = _filter_interwiki_get_settings();

    if (isset($interwikis[$prefix])) {
        $interwiki = $interwikis[$prefix];
        $base = $interwiki['uri'];

        $type = 0;
        if (preg_match('/\$(\d)/', $base, $sub)) {
          $type = $sub[1];
          $replace= array(' ', '_', '+', '%20', '-', '');
          $page = str_replace(' ', $replace[$type], $name);
        } else {
          //Error.
        }
        $uri  = str_replace("\$$type", $page, $base);
        $host = str_replace(array('www.', 'en.'), '', parse_url($uri, PHP_URL_HOST));
        $class= str_replace(array(' ','/'), array('-',' '), $name);
        $class= "interwiki p-$prefix iw-$class ".str_replace('.', '-', $host);
        $title= get_string('onhost', 'filter_interwiki', ucfirst($host));

        return "<a class='$class' title='$title' href='$uri'>$text</a>";
    }
}

function _filter_interwiki_get_settings() {
  global $CFG;
  $interwikis = array();

  for ($idx= 0; $idx < INTERWIKI_LIMIT; $idx++) {
    if (!empty($CFG->{"filter_interwiki_prefix_$idx"})) {  
      $prefix= $CFG->{"filter_interwiki_prefix_$idx"};
      $uri   = $CFG->{"filter_interwiki_uri_$idx"};
      $interwikis[$prefix] = array('uri' => $uri);
    }
  }
  return $interwikis;
}


#End.