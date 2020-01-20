<?php
    /**
     * formats an 11 digit phone number to the format X (XXX) XXX-XXXX
     *
     * @param string (11 characters) $phone_number
     * @return string 
     */
    function format_phone($phone_number)
    {
        return sprintf("%s (%s) %s-%s", substr($phone_number, 0, 1), substr($phone_number, 1, 3), substr($phone_number, 4, 3), substr($phone_number, 7, 4));
    }

?>