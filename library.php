<?php


// Configure all paths in single file if User needs sdk just configure this Path in his project file.


require "vendor/autoload.php";
include "src/common/constant.php";
include "src/modules/xrc20/xrc20Sdk.php";
include "src/modules/xrc721/xrc721Sdk.php";
include "vendor/PHPSDK/XDC/src/config/env.php";
include "vendor/XDC/PHP/src/Token721.php";
include "vendor/XDC/PHP/src/Token20.php";


//configure .env file for URL
use env\dotEnv;
(new dotEnv(__DIR__ . '/.env'))->load();



?>