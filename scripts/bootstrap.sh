#!/usr/bin/env bash

mydir=$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )
wbdir=$mydir/../workbench

mkdir -p $wbdir/laradic
echo $wbdir/laradic


_clone(){
    git clone github.com:laradic/$1 $wbdir/laradic/$1
}

_clone assets
_clone dependency-sorter
_clone service-provider
_clone support
_clone git
_clone testing
_clone annotation-scanner
_clone icon-generator
_clone idea
_clone console
_clone filesystem
_clone themes
_clone upload