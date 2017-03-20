#!/bin/bash

rootdir="${PWD}"

function _run_helper {
	local name=$1
	cd "${rootdir}/workbench/laradic/${name}";

	echo "Running helper for: ${name}"
	git remote set-url origin "github.com/${name}"
	echo -e "\n"

	cd "${rootdir}"
}


cd workbench/laradic

rootdir="${PWD}"

for dir in *; do
    cd "${rootdir}/${dir}";
	git remote set-url origin "github.com:laradic/${dir}"
	git push --all
done