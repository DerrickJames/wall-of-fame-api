#!/bin/bash

# generate api documentation
apidoc -i ./app/Http/Controllers/ -o ./docs/

# OSX command to open the docs on Google Chrome
# open -a "Google Chrome" "./docs/index.html"

OS="`uname`"
case $OS in
    'Darwin')
        echo -e "\033[32mOS-info\033[0m: OSX"
        open -a "Google Chrome" "./docs/index.html"
        ;;
    'WindowsNT')
        echo "Windows"
        cmd /c start "./docs/index.html"
        ;;
    'Linux')
        echo "\033[0;32mOS-info\0330m: Linux"
        xdg-open "./docs/index.html"
        ;;
esac
