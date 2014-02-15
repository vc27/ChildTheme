<?php
/* Last updated with phpFlickr 1.3.2
 *
 * This example file shows you how to call the 100 most recent public
 * photos.  It parses through them and prints out a link to each of them
 * along with the owner's name.
 *
 * Most of the processing time in this file comes from the 100 calls to
 * flickr.people.getInfo.  Enabling caching will help a whole lot with
 * this as there are many people who post multiple photos at once.
 *
 * Obviously, you'll want to replace the "<api key>" with one provided 
 * by Flickr: http://www.flickr.com/services/api/key.gne
 */

require_once("phpFlickr.php");
// $f = new phpFlickr("e04973f4fb18f2162f401494d2e7e6af");
// $recent = $f->photos_getRecent();

/*
foreach ($recent['photo'] as $photo) {
    $owner = $f->people_getInfo($photo['owner']);
    echo "<a href='http://www.flickr.com/photos/" . $photo['owner'] . "/" . $photo['id'] . "/'>";
    echo $photo['title'];
    echo "</a> Owner: ";
    echo "<a href='http://www.flickr.com/people/" . $photo['owner'] . "/'>";
    echo $owner['username'];
    echo "</a><br>";
}
*/


$flickr = new phpFlickr("e04973f4fb18f2162f401494d2e7e6af");

$images = $flickr->call('flickr.photosets.getPhotos', array(
	'photoset_id' => '72157632696613743',
	'media' => 'photos', 
	// 'extras' => $extras, // A comma-delimited list of extra information to fetch for each returned record.
) );



print_r($images);