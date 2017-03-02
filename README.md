# apache-log-parser
PHP based solution that implements a parser which reads the Apache access log, parses it and saves it to a database.

I joined here the folder containing the script of the apache parser. it parses the LogFormat %h %l %u %t % r %>s %b common.
    Log sample line
        127.0.0.1 - frank [10/Oct/2000:13:55:36 -0700] "GET /apache_pb.gif HTTP/1.0" 200 2326
I included an access log sample within the folder for test purpose.


There is no need to create the databse nor the table as this scripts creates  one for each with default values. However these params can be changed directly inside the config file /Conf/config.php or passed directly as parameters in command line (see example of usage). However please change the user and  password for database directly within the config file if it is not the default root user and empty password.

This is an Example of usage of this script:
``php parse.php -h'``
This command simply displays the help for this script
``php parse.php'``
This command simply Executes the script with dafault values
``php parse.php -f "path_to_file" -d "sampleDB" -t "sapmleTable"``
This command parses file path_to_file and saves data inside sapmleTable within sampleDB

This script also provides a time analysis for the script to be executed.

![Alt text](/path/to/image.jpg)
