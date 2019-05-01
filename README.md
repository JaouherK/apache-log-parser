# Apache log-parser
## About ##
![Alt text](/img/exec.png)


PHP-cli app that implements a parser which reads the Apache access log and saves its content to a database.

## Synopsis ##

    php parser.php [ -f ] file [ -d ] database [ -t ] table
## Description ##
This command line can be used to execute a parser which reads the Apache access log, parses it and saves it to a database

- It parses a standard apache access.log file as reference
- It saves the input into a Mysql Table
- LogFormat: `%h %l %u %t % r %>s %b common`.

**Log sample line:**

        127.0.0.1 - frank [10/Oct/2000:13:55:36 -0700] "GET /apache_pb.gif HTTP/1.0" 200 2326
## Options ##


- -f: (optional) Contains the url to the file `default value: /data/access_log`
- -d: (optional) Contains the Database name (created if not exist) `default value: apache_log`
- -t: (optional) Contains the table name (created if not exist) `default value: log`


## Features ##

- I included an access log sample within the folder for test purpose.
- There is no need to create the database nor the table as this scripts creates  one for each with default values. However these params can be changed directly inside the config file `/Conf/config.php` or passed directly as parameters in command line (see example of usage).
- This script also provides a time analysis for the exec time.
## Limits ##
Please change the user and  password for database directly within the config file if it is not the default root user and empty password.
## Example ##
This is an Example of usage of this script:

- ``php parser.php -h`` : This command displays the help for this script.
![Alt text](/img/help.png)
- ``php parser.php`` : This command executes the script with dafault values.
![Alt text](/img/exec.png)
- ``php parser.php -f "path_to_file" -d "sampleDB" -t "sapmleTable"``:
This command parses file path_to_file and saves data inside sapmleTable within sampleDB
