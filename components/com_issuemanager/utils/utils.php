<?php
/*
    Document   : utils.php
    Created on : 30-dic-2009, 19:30:05
    Author     : Luis Martín
    Description:
        File for class UtilsIm, which contains utilities
*/

class UtilsIM {

    /**
     * Given a number when invoked, it returns its corresponding alphanumeric character
     *
     * @param int $num
     * @return string
     */
    function get_alphanumeric_value($num) {
        $value = '';
        switch ($num) {
            case 0:
                $value = 'A';
                break;
            case 1:
                $value = 'B';
                break;
            case 2:
                $value = 'C';
                break;
            case 3:
                $value = 'D';
                break;
            case 4:
                $value = 'E';
                break;
            case 5:
                $value = 'F';
                break;
            case 6:
                $value = 'G';
                break;
            case 7:
                $value = 'H';
                break;
            case 8:
                $value = 'I';
                break;
            case 9:
                $value = 'J';
                break;
            case 10:
                $value = 'K';
                break;
            case 11:
                $value = 'L';
                break;
            case 12:
                $value = 'M';
                break;
            case 13:
                $value = 'N';
                break;
            case 14:
                $value = 'O';
                break;
            case 15:
                $value = 'P';
                break;
            case 16:
                $value = 'Q';
                break;
            case 17:
                $value = 'R';
                break;
            case 18:
                $value = 'S';
                break;
            case 19:
                $value = 'T';
                break;
            case 20:
                $value = 'U';
                break;
            case 21:
                $value = 'V';
                break;
            case 22:
                $value = 'W';
                break;
            case 23:
                $value = 'X';
                break;
            case 24:
                $value = 'Y';
                break;
            case 25:
                $value = 'Z';
                break;
            case 26:
                $value = '0';
                break;
            case 27:
                $value = '1';
                break;
            case 28:
                $value = '2';
                break;
            case 29:
                $value = '3';
                break;
            case 30:
                $value = '4';
                break;
            case 31:
                $value = '5';
                break;
            case 32:
                $value = '6';
                break;
            case 33:
                $value = '7';
                break;
            case 34:
                $value = '8';
                break;
            case 35:
                $value = '9';
                break;
        }
        return $value;
    }

    /**
     * Given a specified length (x), this method generated x random numbers from 0 to 35 and returns the resulting string from
     * their corresponding alphanumeric characters.
     * It's used to generate a random ticket (alphanumeric) number
     *
     * @param int $length
     * @return string
     */
    function generate_random_string($length) {
        $rstring = '';
        for ($i = 0; $i < $length; $i++) {
           mt_srand((double)microtime() * 1000000);
           $rstring .= UtilsIM::get_alphanumeric_value(mt_rand(0,35));
        }
        return $rstring;
    }
}
?>
