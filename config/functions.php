<?php
function isValidDate($date) {
    $valid = false;
    if(preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $date, $matches))
    {
        if(checkdate($matches[2], $matches[3], $matches[1]))
        {
            $valid = true;
        }
    }
    return $valid;
}
