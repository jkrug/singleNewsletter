<?php
/**
 *    This file is part of Marmalade Newsletter Tracking for OXID eShop Community Edition.
 *
 *    This Module is free software: you can redistribute it and/or modify
 *    it under the terms of the GNU General Public License as published by
 *    the Free Software Foundation, either version 3 of the License, or
 *    (at your option) any later version.
 *
 *    This Module is distributed in the hope that it will be useful,
 *    but WITHOUT ANY WARRANTY; without even the implied warranty of
 *    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *    GNU General Public License for more details.
 *
 *    You should have received a copy of the GNU General Public License
 *    along with OXID eShop Community Edition.  If not, see <http://www.gnu.org/licenses/>.
 *
 * @package   	marm_nl_tracking
 * @copyright 	(C) Marmalade Germany 2011
 * @link	http://www.marmalade.de/
 * @version 	OXID eShop CE
 * @version   	2.0.0 2011-04-05 18:41:00 jk $
 */
class marm_singlenewsletter_oxnewsletter extends marm_singlenewsletter_oxnewsletter_parent
{

    protected $_blNlSendSuccess = null;

    protected $_sNlTrackingId = null;

    /**
     * Class constructor, parent constructor
     * (parent::oxNewsletter()).
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Calls parent::send(). Tracks the Newsletter Sending Success in Database.
     *
     * @return bool
     */
    public function send()
    {
        // check if newsletter was already send
        if($this->checkAlreadySend())
                return true;


        //call parent function
        $this->_blNlSendSuccess = parent::send();

        //generate new oxId
        $this->_sNlTrackingId =  oxUtilsObject::getInstance()->generateUID();

        //insert record if newsletter was send
        if($this->_blNlSendSuccess){
            $oDb = oxDb::getDb();
            $oDb->execute( "INSERT INTO marm_nltracking (
                    `OXID` ,
                    `MARMUSERID` ,
                    `MARMNLID` ,
                    `MARMNLSEND` )
                    VALUES(
                    ".$oDb->quote( $this->_sNlTrackingId ).",
                    ".$oDb->quote( $this->_oUser->oxuser__oxid->value ).",
                    ".$oDb->quote( $this->oxnewsletter__oxid->value ).",
                    '1');");
            return true;
        }
        return false;
    }

    /**
     * Checks if newsletter was already send.
     *
     * @return bool
     */
    public function checkAlreadySend()
    {
        $sSelect = "SELECT oxid
                    FROM marm_nltracking
                    WHERE marmuserid = '".$this->_oUser->oxuser__oxid->value."' 
                    AND marmnlid = '".$this->oxnewsletter__oxid->value."'";

        $rs = oxDb::getDb()->Execute($sSelect);

        if($rs !=false && $rs->RecordCount() > 0) {
                return true;
        }
        return false;
    }
}