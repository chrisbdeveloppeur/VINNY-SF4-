#!/bin/sh

rsync -avz ./ -e "ssh -p 5022"  vinnunbp@world-349.fr.planethoster.net:~/public_html/vinny --include=public/build --include=public/bundles --include=public/.htaccess --include=vendor --exclude-from=.gitignore --exclude=".*"