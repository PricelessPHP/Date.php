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
        return strtotime( '-1 days');    
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
    
    /**
     * Get the timestamp of the 
     * start of the week
     * 
     * @link    http://derickrethans.nl/calculating-start-and-end-dates-of-a-week.html 
     * @param   int $date
     * @return  int
    */
    public function getStartOfWeek( $date = null )
    {
        $date = (int)$date;
        if( $date == 0 ) {
            $date = time();
        }
        
        $year = date( 'Y', $date );
        $week = date( 'W', $date );
        
        return strtotime( date( datetime::ISO8601, strtotime( $year.'W'.$week ) ) );    
    }
    
    /**
     * Get the timestamp of the
     * end of the week
     *
     * @link    http://derickrethans.nl/calculating-start-and-end-dates-of-a-week.html
     * @param   int $date
     * @return  int
    */
    public function getEndOfWeek( $date = null )
    {
        $date = (int)$date;
        if( $date == 0 ) {
            $date = time();
        }
        
        $year = date( 'Y', $date );
        $week = date( 'W', $date );
            
        return strtotime( date( datetime::ISO8601, strtotime( $year.'W'.$week.'7' ) ) );
    } 
    
    public function getStartOfDay( $timestamp = null )
    {
        $timestamp = ( is_null( $timestamp ) ) ? time() : $timestamp;
        return strtotime( 'midnight', $timestamp );    
    }
    
    public function getEndOfDay( $timestamp = null )
    {
        $timestamp  = ( is_null( $timestamp ) ) ? time() : $timestamp;
        $beginOfDay = strtotime( 'midnight', $timestamp );
        $endOfDay   = strtotime( 'tomorrow', $beginOfDay ) - 1;
    
        return $endOfDay;
    }
    
    public function getStartOfMonth( $format = 'Y-m-01' )
    {
        return strtotime( date( $format ) );
    }
    
    public function getLastDayOfMonth( $format = 'Y-m-t' )
    {
        return strtotime( date( $format ) );
    } 
    
    /**
     * Get the start timestamp of two 
     * weeks ago
     *
     * @return  int
    */
    public function twoWeeksAgoStart()
    {
        return strtotime( '2 weeks ago Monday' );
    }
    
    /**
     * Get the end timestamp of two
     * weeks ago
     *
     * @return  int
    */
    public function twoWeeksAgoEnd()
    {
        return strtotime( 'Monday this week' );
    }  
    
    /**
     * Get the timestamp by year & week
     * 
     * @link    http://derickrethans.nl/calculating-start-and-end-dates-of-a-week.html
     * @param   int $year
     * @param   int $week
     * @return  int
    */
    public function getTimestampByYearAndWeek( $year, $week )
    {
        return strtotime( date( datetime::ISO8601, strtotime( $year.'W'.$week ) ) );    
    }    
}
