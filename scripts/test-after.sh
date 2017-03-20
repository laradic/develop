#!/bin/bash
set -e

mydir=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )

first(){
    cd $mydir
    rm -rf blade-extensions >> /dev/null
    git clone --branch feature/travis-automerge https://github.com/robinradic/blade-extensions
    cd blade-extensions
    git checkout -qf a232e4f4f6bf9c466062d0e2e5b9e5e8d6888cc7


    php-cs-fixer fix src --config-file .php_cs || true
    git add -A src
    git commit -m "Apply style fixes [skip ci]"
    HASH=$(cat .git/HEAD)
    git checkout feature/travis-automerge
    git cherry-pick $HASH


}


url(){
    done="0"
    while [ $done -lt 1 ]; do
        curl -s -X GET \
        -o "$mydir/.curl-output" \
        -H "Content-Type: application/json" \
        -H "User-Agent: MyClient/1.0.0" \
        -H "Accept: application/vnd.travis-ci.2+json" \
         https://api.travis-ci.org/builds/212710581

        output=$(php $mydir/test-after-curl.php)
        if [ $output == "1" ]; then
            echo "build failed"
            exit 1
        elif [ $output == "0" ]; then
            done=1
        elif [ $output == "2" ]; then
            echo "Checking again in 10 sec"
        elif [ $output == "3" ]; then
            echo "error with curl output"
            exit 1
        fi
        sleep 15
    done
}


auth(){
#    -H "Authorization: token J0ZJs0rWiZy-NAeVUUIJiQ" \
    curl -X POST \
    -o "$mydir/.curl-output" \
    -H "Content-Type: application/json" \
    -H "User-Agent: MyClient/1.0.0" \
    -H "Accept: application/vnd.travis-ci.2+json" \
     https://api.travis-ci.org/builds/212710581

    php $mydir/test-after-curl.php
}


$*