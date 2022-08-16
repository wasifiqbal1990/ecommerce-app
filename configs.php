<?php
/**
 ** Please do not sync this file to github.
 *
 * This is like the .env file in Laravel
 * It contains all the settings we use in this project.
 *
 ** Please do not sync this file to github.
 */


 /**
 * Class register for constants used in this site
 * the name of our register class is CONFIG. In Laravel, this is called ENV
 * We will expand this class with more settings as we move on
 * */

if (!defined("DOCUMENT_ROOT")) {
    define("DOCUMENT_ROOT", $_SERVER['DOCUMENT_ROOT']);
}
require_once DOCUMENT_ROOT.'/configs_sensitive.php';


class CONFIGS
{
    public const MAINTENANCE = false;
    public const APP_VERSION = 1.0;
    public const SITE_TITLE = 'ECOMMERCE';
    public const DOMAIN = 'ecommerce.pagerepair.co';
    public const INDEX_SCRIPT = 'index.php';
    public const COMPANY_NAME = 'XYZ E-COMMERCE COMPANY';
    public const COMPANY_LOGO_ALTTEXT = 'Company Logo Here';
    public const COMPANY_LOGO = '<img src = "/favicon.svg" alt="'.self::COMPANY_LOGO_ALTTEXT.'" class="companylogo"/>';

    public const TIMEZONE = '+00:00';
    public const TIMEZONENAME = 'UTC';

    public const DB_SERVER = 'localhost';
    public const DB_USERNAME = PRODUCTION_DB_USERNAME;
    public const DB_PASSWORD = PRODUCTION_DB_PASSWORD;
    public const DB_NAME = 'ecommerce';

    public const DEFAULT_LOGIN_TIMEOUT = 2700; //* after 45 minutes the user gets logged out

    public const CAPTCHA_SECRET_ = 'uz5FbgjZo38fkCk&';
    public const CAPTCHA_SALT_ = 'WJu@gd3A*@q^E3v&iF$!on6A3EEu5f#mk';
}


/* -------------------------------------------------------------------------- */
/*                        Set Default datetime for php                        */
/* -------------------------------------------------------------------------- */
date_default_timezone_set('UTC');
