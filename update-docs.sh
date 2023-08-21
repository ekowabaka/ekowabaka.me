#!/bin/bash

# Clearice
git clone https://github.com/ekowabaka/clearice /tmp/clearice
echo "Copying clearice content to docs"
cp -rv /tmp/clearice/docs clearice/docs
chmod a-w -R clearice/docs/*
chmod u+w -R clearice/docs/_foonoo

# Foonoo Documentation
git clone https://github.com/foonoo/docs /tmp/foonoo-docs
echo "Copying fooboo content to docs"
cp -rv /tmp/foonoo-docs foonoo/docs
chmod a-w -R foonoo/docs/*
chmod u+w -R foonoo/docs/_foonoo

