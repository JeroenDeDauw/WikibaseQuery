#! /bin/bash

set -x

cd ..

wget https://github.com/wikimedia/mediawiki-core/archive/master.tar.gz
tar -zxf mediawiki-core-master.tar.gz
mv mediawiki-core-master phase3

cd -
cd ../phase3/extensions

mkdir WikibaseQuery

cd -
cp -r * ../phase3/extensions/WikibaseQuery

cd ../phase3

mysql -e 'create database its_a_mw;'
php maintenance/install.php --dbtype $DBTYPE --dbuser root --dbname its_a_mw --dbpath $(pwd) --pass nyan TravisWiki admin

cd extensions/WikibaseQuery
composer install

cd ../..
echo 'require_once( __DIR__ . "/extensions/WikibaseQuery/vendor/autoload.php" );' >> LocalSettings.php
echo 'require_once( __DIR__ . "/extensions/WikibaseQuery/vendor/wikibase/wikibase/repo/ExampleSettings.php" );' >> LocalSettings.php
echo 'require_once( __DIR__ . "/extensions/WikibaseQuery/WikibaseQuery.php" );' >> LocalSettings.php

echo 'error_reporting(E_ALL| E_STRICT);' >> LocalSettings.php
echo 'ini_set("display_errors", 1);' >> LocalSettings.php
echo '$wgShowExceptionDetails = true;' >> LocalSettings.php
echo '$wgDevelopmentWarnings = true;' >> LocalSettings.php
echo "putenv( 'MW_INSTALL_PATH=$(pwd)' );" >> LocalSettings.php

php maintenance/update.php --quick
