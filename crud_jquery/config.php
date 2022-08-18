<?php
// PHP Grid database connection settings
define("PHPGRID_DBTYPE","Mysql"); // or mysqli
define("PHPGRID_DBHOST","localhost");
define("PHPGRID_DBUSER","hspb_tool");
define("PHPGRID_DBPASS","s4nt1k4-bintar0");
define("PHPGRID_DBNAME","hspb_tool");
 
// Automatically make db connection inside lib
define("PHPGRID_AUTOCONNECT",0);
 
// Basepath for lib
define("PHPGRID_LIBPATH",dirname(__FILE__).DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR);