#!/usr/bin/env bash

rm -rf phpdoc


#phpdoc -t phpdoc \
#    -d vendor/laravel/framework/src \
#    --template=xml


php5.6 /usr/local/bin/phpdoc -t phpdoc \
    -d workbench/laradic/service-provider/src \
    -d workbench/laradic/support/src \
    --template=xml

cp phpdoc/structure.xml workbench/laradic/service-provider/docs/structure.xml -f

rm -rf phpdoc