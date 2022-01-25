cd /home/ca9admin/cms/static-site/hugo

rm -rf public/*

git add .

git commit -am "Module Commit"

git pull --no-edit origin main

git push --force -u origin main
