<?php

# File created using Visual Studio Code: https://code.visualstudio.com/




function lrtrim($string)
{
    return stripslashes(ltrim(rtrim($string)));
}

function lrtrimLower($string)
{
    return strtolower(stripslashes(ltrim(rtrim($string))));
}
