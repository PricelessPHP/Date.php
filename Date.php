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
     * @return  int
    */
    public static function yesterday()
    {
        return strtotime( 'yesterday' );    
    }
    
    /**
     * Get the timestamp of 
     * year
     *
     * @param   int $year
     * @return  int
    */
    public static function getStartOfYear( $year = null )
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
    public static function getStartOfWeek( $date = null )
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
    public static function getEndOfWeek( $date = null )
    {
        $date = (int)$date;
        if( $date == 0 ) {
            $date = time();
        }
        
        $year = date( 'Y', $date );
        $week = date( 'W', $date );
            
        return strtotime( date( datetime::ISO8601, strtotime( $year.'W'.$week.'7' ) ) );
    } 
    
    public static function getStartOfDay( $timestamp = null )
    {
        $timestamp = ( is_null( $timestamp ) ) ? time() : $timestamp;
        return strtotime( 'midnight', $timestamp );    
    }
    
    public static function getEndOfDay( $timestamp = null )
    {
        $timestamp  = ( is_null( $timestamp ) ) ? time() : $timestamp;
        $beginOfDay = strtotime( 'midnight', $timestamp );
        $endOfDay   = strtotime( 'tomorrow', $beginOfDay ) - 1;
    
        return $endOfDay;
    }
    
    public static function getStartOfMonth( $format = 'Y-m-01' )
    {
        return strtotime( date( $format ) );
    }
    
    public static function getLastDayOfMonth( $format = 'Y-m-t' )
    {
        return strtotime( date( $format ) );
    } 
    
    /**
     * Get the start timestamp of two 
     * weeks ago
     *
     * @return  int
    */
    public static function twoWeeksAgoStart()
    {
        return strtotime( '2 weeks ago Monday' );
    }
    
    /**
     * Get the end timestamp of two
     * weeks ago
     *
     * @return  int
    */
    public static function twoWeeksAgoEnd()
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
    public static function getTimestampByYearAndWeek( $year, $week )
    {
        return strtotime( date( datetime::ISO8601, strtotime( $year.'W'.$week ) ) );    
    } 
    
    /**
     * str_replace for dates
     *
     * @param   string  $search
     * @param   string  $replace
     * @param   string  $date
     * @return  string
    */
    public static function str_replace_date( $search, $replace, $date )
    {
        $words = str_word_count( $date, 1 );
        if( !empty( $words ) ) {
            foreach( $words AS $key => $value ) {
                $date = str_replace( $search, $replace, $date );
            }
        }
    
        return $date;
    }
    
    /**
     * Get the days between two 
     * timestamps
     *
     * @param   int     $dateStart
     * @param   int     $dateEnd
     * @param   string  $format
     * @param   boolean $includeWeekends
     * @return  array
    */
    function getDaysBetween( $dateStart, $dateEnd, $format = null, $includeWeekends = false )
    {
        $daySecs    = 86400;
        $dateStart  = (int)$dateStart;
        $dateEnd    = (int)$dateEnd;
        $dates      = array();
        $x          = $dateStart;
        $i          = 0;
        $weekend    = array('Saturday', 'Sunday');
        
        if( ( $dateEnd == 0 ) OR ( $dateEnd == $dateStart ) ) {
            return $dates;
        } elseif ( ( $dateEnd - $dateStart ) == $daySecs ) {
            if( !is_null( $format ) ) {
                return array(
                    date( $format, $dateStart )
                );
            } else {
                return array(
                    $dateStart
                );            
            }
        }
        
        $dateDiff = ( $dateEnd - $dateStart );
        $dateDiff = floor( $dateDiff / $daySecs );
    
        if( !is_null( $format ) ) {
            $dates[] = date( $format, $dateStart );
        } else {
            $dates[] = $dateStart;
        }
        
        while( $i < $dateDiff ) {
            $i++;
            
            $x = ( $x + $daySecs );
            
            if( !$includeWeekends ) {
                if( in_array( date('l', $x ), $weekend ) ) {
                    continue;
                }
            }
            
            $dates[] = ( is_null( $format ) ) ? $x : date( $format, $x );
        }
        
        return $dates;
    } 
    
    /**
     * Return a date formatted in
     * the German locale
     *
     * @param   int     $date
     * @param   string  $format
     * @return  string
    */
    public static function german_date( $date, $format = '%d.%m.%Y' )
    {
        // get the current locale
        $originalLocale = setlocale( LC_TIME, '0' );
    
        // change the locale to German
        setlocale( LC_TIME, 'de_DE.utf8' );
    
        // format
        $formattedDate = strftime( $format, $date );
    
        // reset the locale
        setlocale( LC_TIME, $originalLocale );
    
        return $formattedDate;   
    }
    
    /**
     * Return a date formatted in
     * a specific locale
     *
     * @param   int     $date
     * @param   string  $locale
     * @param   string  $format
     * @return  string
    */
    public static function localized_date( $date, $locale, $format = '%m &d %Y' )
    {
        // get the current locale
        $originalLocale = setlocale( LC_TIME, '0' );
    
        // change the locale
        setlocale( LC_TIME, $locale );
    
        // format
        $formattedDate = strftime( $format, $date );
    
        // reset the locale
        setlocale( LC_TIME, $originalLocale );
    
        return $formattedDate;   
    }    
}
