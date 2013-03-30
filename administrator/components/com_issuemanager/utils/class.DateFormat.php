<?php
/*
    Document   : class.DateFormat.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        File that defines the class DateFormat, which defines and stores the different formats available for a date.
*/
defined( '_JEXEC' ) or die( 'Restricted access' );

/**
 * Class which defines and stores the different formats available for a date.
 */
class DateFormat {

    /**
     *
     * @var array
     */
    private $formatsList;

    /**
     * Builds the array that in turn stores arrays for all date format types available in Issue Manager.
     * Two standard main formats are used in different places of Issue Manager: the one used in PHP and the one used in strftime() and
     * in other languages
     */
    function __construct() {
        $this->formatsList = array(
            array(
                'date' => 'l, d F Y, H:i:s',
                'strftime' => '%A, %d %B %Y, %H:%M:%S'
            ),
            array(
                'date' => 'D, d M Y, H:i:s',
                'strftime' => '%a, %d %b %Y, %H:%M:%S'
            ),
            array(
                'date' => 'D, d-m-Y, H:i:s',
                'strftime' => '%a, %d-%m-%Y, %H:%M:%S'
            ),
            array(
                'date' => 'D, m-d-Y, H:i:s',
                'strftime' => '%a, %m-%d-%Y, %H:%M:%S'
            ),
            array(
                'date' => 'd-m-Y, H:i:s',
                'strftime' => '%d-%m-%Y, %H:%M:%S'
            ),
            array(
                'date' => 'm-d-Y, H:i:s',
                'strftime' => '%m-%d-%Y, %H:%M:%S'
            ),
            array(
                'date' => 'd-m-y, H:i:s',
                'strftime' => '%d-%m-%y, %H:%M:%S'
            ),
            array(
                'date' => 'm-d-y, H:i:s',
                'strftime' => '%m-%d-%y, %H:%M:%S'
            ),
        );
    }

    /**
     * Retrieves and returns the date format corresponding to the standard specified
     *
     * @param string $key
     * @return string
     */
    function getDateFormat($key) {
        return $this->formatsList[$key];
    }
}
?>