<?php
/**
 * Date.php
 * Utility functions for dates
 *
 * @author      BizLogic <hire@bizlogicdev.com>
 * @copyright   2015 BizLogic
 * @link        http://bizlogicdev.com
 * @link        http://pricelessphp.com
 *
 * @since       Friday, May 22, 2015 / 14:12 GMT+1
 * @edited      $Date$ $Author$
 * @version     $Id$
 *
 * @package     Date.php
 * @category    Core
*/

class Date
{
    /**
     * Get the start of yesterday
     *
     * @link    http://stackoverflow.com/a/16009169
     * @return  int
    */
    public function yesterday()
    {
        return date( 'm-d-Y', strtotime( '-1 days') );    
    }
    
    /**
     * Get the timestamp of 
     * year
     *
     * @param   int $year
     * @return  int
    */
    public function getStartOfYear( $year = null )
    {
        $year = ( strlen( $year ) ) ? (int)$year : date( $year ); 
        return strtotime( 'first day of January '.$year );    
    }
}
