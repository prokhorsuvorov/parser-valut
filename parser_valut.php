<?php
/**
 * Plugin Name: Parser Valut 
 * Description: Parser Valut отримує дані трьох основних валют для України з офіційних сайтів НБУ і Приватбанку.
 * Version:     1.0
 * Author URI:  prokhor.suvorov777@gmail.com
 */

// Plugin DIR:
if( !defined('PS_PARSER_VALUT_PLUGIN_DIR') ) {
    define('PS_PARSER_VALUT_PLUGIN_DIR', plugin_dir_path(__FILE__));
}

require_once(PS_PARSER_VALUT_PLUGIN_DIR.'class_ps_parser.php');
require_once(PS_PARSER_VALUT_PLUGIN_DIR.'class_ps_widget.php');

//тестові дані для віджета
//const URL_NBY_USD = "/var/www/pset7/parser/nbu_kurs_usd.json";
//const URL_NBY_EUR = "/var/www/pset7/parser/nbu_kurs_eur.json";
//const URL_NBY_RUB = "/var/www/pset7/parser/nbu_kurs_rub.json";
//const URL_PRIVATBANK = "/var/www/pset7/parser/privatbank_kurs.json";

//API Приватбанку і НБУ
const URL_NBY_USD = "https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?valcode=USD&date=20170321&json";
const URL_NBY_EUR = "https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?valcode=EUR&date=20170321&json";
const URL_NBY_RUB = "https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?valcode=RUB&date=20170321&json";
const URL_PRIVATBANK = "https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=3";
