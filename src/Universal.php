<?php

namespace beingnikhilesh\universal;

/*
 * Library to perform session related fuctions
 * V0.0.2
 * 
 * Revision History
 *  v0.0.2 - 2021.07.04
 *      Verified and checked for any Dependencies, Import Names, Namespaces and Aliases
 *      Corrected all the ErrorLib Library calls
 */

class Universal
{
    /*
     * Global Variables
     */

    private static $variables;
    //Global Variable to decide if to echo an error
    private static $error = FALSE;

    /*
     * Construct Function
     */

    function __construct($params = []) {}

    public static function errors($mute = TRUE)
    {
        if (! in_array($mute, [TRUE, FALSE])) {
            \beingnikhilesh\error\Error::set_error('Unable to Mute the Errors');
            return;
        }

        self::$error = $mute;
        return;
    }

    /*
     *  Function to set the details and call the functions for verification       
     */

    static function set($variable, $value = '')
    {
        if (! is_string($variable) || $variable == '') {
            if (self::$error)
                \beingnikhilesh\error\Error::set_error('Invalid Variable Name Set');
            return;
        }

        self::_set($variable, $value);
    }

    /*
     * Static Function to actually Set the variable Data
     */

    static private function _set($variable, $value)
    {
        self::$variables[$variable] = $value;
    }

    /*
     * Function to get the value of a variable
     */

    static function get($variable)
    {
        if (! is_string($variable) || $variable == '') {
            if (self::$error)
                \beingnikhilesh\error\Error::set_error('Invalid Variable Name Set');
            return;
        }

        if (! isset(self::$variables[$variable])) {
            if (self::$error)
                \beingnikhilesh\error\Error::set_error('Variable Requested is not Set');
            return;
        }

        return self::$variables[$variable];
    }

    static function get_all()
    {
        if ($_SERVER['CI_ENVIRONMENT'] == 'development')
            return self::$variables;
    }
}
