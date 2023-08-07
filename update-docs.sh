#!/bin/bash

# Clearice
git clone https://github.com/ekowabaka/clearice /tmp/clearice
echo "Copying clearice content to docs"
cp -rv /tmp/clearice/docs clearice/docs

# Foonoo Documentation
git clone https://github.com/foonoo/docs /tmp/foonoo-docs
echo "Copying fooboo content to docs"
cp -rv /tmp/foonoo-docs foonoo/docs


