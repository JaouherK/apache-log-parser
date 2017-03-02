# Apache log-parser
## About ##
PHP based solution that implements a parser which reads the Apache access log, parses it and saves it to a database.

## Description ##
I joined here the folder containing the script of the apache parser. it parses the `LogFormat %h %l %u %t % r %>s %b common`.

**Log sample line:**
 
        127.0.0.1 - frank [10/Oct/2000:13:55:36 -0700] "GET /apache_pb.gif HTTP/1.0" 200 2326

## Features ##

- I included an access log sample within the folder for test purpose.
- There is no need to create the database nor the table as this scripts creates  one for each with default values. However these params can be changed directly inside the config file `/Conf/config.php` or passed directly as parameters in command line (see example of usage).
- This script also provides a time analysis for the exec time.
## Limits ##
Please change the user and  password for database directly within the config file if it is not the default root user and empty password.
## Example ##
This is an Example of usage of this script:

- ``php parse.php -h'`` : This command displays the help for this script
- ``php parse.php'`` : This command executes the script with dafault values
- ``php parse.php -f "path_to_file" -d "sampleDB" -t "sapmleTable"``: 
This command parses file path_to_file and saves data inside sapmleTable within sampleDB


![Alt text](/path/to/image.jpg)
