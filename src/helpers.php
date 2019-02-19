<?php
/**
 * @param string $guard
 *
 * @return string|null
 */
function isLumenNot() : bool
{
    return ! preg_match('/lumen/i', app()->version());
}
