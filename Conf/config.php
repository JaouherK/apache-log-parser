<?php

$username = 'root';
$password = '';
$servername = 'localhost';
$db = 'apache_log';
$table = 'log-' . time();
$log_file = 'data/access_log';
$header = "\n------------------------------- Access Log Analyser -----------------------------------\n";
$help = "
Name

    parser - PHP Command Line to parse the access log

Synopsis

    php parser.php [ -f ] file [ -d ] database [ -t ] table

Description

    This command line can be used to execute a parser which reads the Apache access log, parses it and saves it to a
    database
    It parses a standard apache access.log file as reference
    It saves the input into a Mysql Table
    LogFormat %h %l %u %t % r %>s %b common
    Log sample line
        127.0.0.1 - frank [10/Oct/2000:13:55:36 -0700] \"GET /apache_pb.gif HTTP/1.0\" 200 2326

Options

    -f:\t(optional) Contains the url to the file
    \tdefault value: /data/access_log
    -d:\t(optional) Contains the Database name (created if not exist)
    \tdefault value: apache_log
    -t:\t(optional) Contains the table name (created if not exist)
    \tdefault value: log-(timestamp)

Examples

php parser.php'
\tThis command simply Executes the script with default values

php parser.php -f \"path_to_file\" -d \"sampleDB\" -t \"sapmleTable\"
\tThis command parses file path_to_file and saves data inside sampleTable within sampleDB\n
-----------------------------------------------------------------------------------------\n";
$footer = "For more options Type : php parser.php -h\n
------------------------------------------ Stats -------------------------------------\n";
$footer2 = "--------------------------------------------------------------------------------------\n";

