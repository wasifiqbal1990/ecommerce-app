<?php

# File created using Visual Studio Code: https://code.visualstudio.com/
# Created by Naisend. Telegram contact: https://t.me/elipheleh




/**
 * MariaDB does not support cast(? as json) hence this function
 * This Function is a Helper to form the prepared input for MariaDB cast(? as JSON) alternative.
 * The countepart that replaces cast(? as json) looks like this - JSON_EXTRACT( JSON_MERGE_PRESERVE(?,JSON_OBJECT()) , '$[0]') )
 * @param mixed $array
 * @return string
 */
function mariaDBJsonCASTHelper($array) : string
{
    $obj = '';
    foreach ($array as $key => $value) {
        $obj .= '"' . $key . '":"' . $value . '",';
    }
    return '{' . trim($obj, ',') . '}';
}



 /**
 * Class register for sql queries used in this site
 * the name of our register class is DBQUERY.
 * We will expand this class with more queries as we move on
 * */
class DBQUERY
{
    /* ---------------------- Queries affecting users table --------------------- */

    public const SELECT_FROM_USERS_BY_USERNAME = "SELECT * from `users` where `username` = ?";
    public const SELECT_FROM_USERS_BY_USERID = "SELECT * from `users` where `userid`=?";
    public const INSERT_NEW_USER = "INSERT INTO `users` (`username`, `password`, `country`) VALUES(?,?,?)";
    public const DELETE_USERS_BY_USERNAME = "DELETE from `users` where `username`=?";

    public const UPDATE_COUNTRYNAME = "UPDATE `users` SET `country`=? where `userid`=?";

    

    /* --------------------- Queries affecting session table -------------------- */

    public const DELETE_SESSIONS_BY_OLDEXPIRED = "DELETE from `sessions` where UNIX_TIMESTAMP(NOW()) > `access` and (`Session_Data` IS NULL OR `Session_Data` = ' ')";
    public const UPDATE_SESSION_DATA = "UPDATE `sessions` set `Session_Data` = ? where `ownerid` = ? and `id`= ?";
    public const DELETE_IDLETIMEOUT_SESSIONS_BYID = "DELETE from `sessions` where `id` in (?)";
    public const DELETE_IDLETIMEOUT_SESSIONS = "DELETE from `sessions` where `id` in (select `id` from `sessions` where unix_timestamp() > REGEXP_REPLACE(`Session_Data`,'(.*?timestamp\\\\|i:)([0-9]+);(.*)','\\\\2') + COALESCE(NULLIF(REGEXP_REPLACE(`Session_Data`,'(.*?;idletimeout\\\\|s:[0-9]:\\\\\")([0-9]+)\\\\\"?;?(.*)|(.*?;)([default]?)*(.*)','\\\\2'),''), ?))";
    public const SELECT_EXPIRED_IDLETIMEOUT_SESSIONS_WITH_GRACEPERIOD = "SELECT `id` as `session_id`, REGEXP_REPLACE(`Session_Data`,'(?s)(.*?;?userid\\\\|i:)([0-9]+)(;.*)','\\\\2') as `user_id` from `sessions` where unix_timestamp() > REGEXP_REPLACE(`Session_Data`,'(?s)(.*?timestamp\\\\|i:)([0-9]+);(.*)','\\\\2') + ? + COALESCE(NULLIF(REGEXP_REPLACE(`Session_Data`,'(?s)(.*?;idletimeout\\\\|s:[0-9]:\\\\\")([0-9]+)\\\\\"?;?(.*)|(.*?;)([default]?)*(.*)','\\\\2'),''), ?)";
}
