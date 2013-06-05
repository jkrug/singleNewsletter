<?php
/**
 * marmalade GmbH
 * OXID module send a newsletter just once.
 *
 * PHP version 5
 *
 * @author   Joscha Krug <support@marmalade.de>
 * @license  GNU General Public License http://www.gnu.org/licenses/
 * @version  2.0
 * @link     https://github.com/jkrug/singleNewsletter/
 */

/**
 * Metadata version
 */
$sMetadataVersion = '1.1';

$aModule = array(
    'id'          => 'marm/singlenewsletter',
    'title'       => 'marmalade :: Single Newsletter',
    'description' => array(
        'de'    => 'Senden Sie Ihre Newsletter nur einmal.',
        'en'    => 'Send out your newsletters just once.',
    ),
    'email'         => 'support@marmalade.de',
    'url'           => 'http://www.marmalade.de',
    'thumbnail'     => 'marmalade.jpg',
    'version'       => '2.0',
    'author'        => 'marmalade GmbH :: Joscha Krug',
    'extend'    => array(
        'oxnewsletter'    => 'marm/singlenewsletter/models/marm_singlenewsletter_oxnewsletter',
    )
);