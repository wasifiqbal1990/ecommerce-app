<?php

# File created using Visual Studio Code: https://code.visualstudio.com/
# Created by Naisend. Telegram contact: https://t.me/elipheleh




function lrtrim($string)
{
    return stripslashes(ltrim(rtrim($string)));
}

function lrtrimLower($string)
{
    return strtolower(stripslashes(ltrim(rtrim($string))));
}
