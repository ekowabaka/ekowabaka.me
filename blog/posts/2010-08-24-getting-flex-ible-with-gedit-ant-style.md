<<<
title="Getting FLEX-ible with GEdit (Ant Style)"
tags="actionscript, adobe, ant, build, external tools, flash, flex, gedit, gnome, mxmlc, ria"
category="Flex"
>>>
A while ago I had a [post](../2008/12/22/getting-flex-ible-with-gedit.html) 
on this blog which
described a crude way of using Gedit as an editor for Flex code. An interesting
comment on this post actually got me thinking in another direction I had previously not
thought about ... using a build system. For those of you lost on the whole build
system thing, a build system is simply a software which helps you to build
source code in an "easier" way. This particular comment actually recommended the
use of the ant build system. After a little research and some playing around
with Gedit, Ant and Flex I kind of figured out this simple way to build flex
projects in Gedit using Ant.
<!--more-->

## Setting up External Tools
If you have read my previous post you would realize that it took advantage of
the External Tools plugin which comes with GEdit. What makes this one even
interesting is the fact that the new approach is going to take an external tools
script (the build script) which ships with the GEdit External Tools plugin and
modify a few lines here and there to get it to work. The build script is written
for the make build system so we are just going to modify it to recognize the ant
build system instead.

To get started you need to:

1. Open the External Tools plugin and find the build tool.
2. Locate and copy the script of the build tool. It should look something
similar to this  
````
#!/bin/sh
EHOME=`echo $HOME | sed "s/#/\#/"`
DIR=$GEDIT_CURRENT_DOCUMENT_DIR
while test "$DIR" != "/"; do
    for m in GNUmakefile makefile Makefile; do
        if [ -f "${DIR}/${m}" ]; then
            echo "Using ${m} from ${DIR}" | sed "s#$EHOME#~#" > /dev/stderr
            make -C "${DIR}"
            exit
        fi
    done
    DIR=`dirname "${DIR}"`
done
echo "No Makefile found!" > /dev/stderr
````
3. Create a new tool and call it Ant
4. Paste the script for the build tool into the empty space provided for the
script of the Ant tool
5. Locate the line which contains:  
````
for m in GNUmakefile makefile Makefile; do
````
(this should be the 6th line) and modify this line so it looks like
````
for m in build.xml; do
````
Locate the line which says:
````
make -C "${DIR}"
````
and replace it so it says
````
ant -buildfile "${DIR}/build.xml"
````

6. Finally locate the line which says
````
echo "No Makefile found!" > /dev/stderr
````
and modify it to look like
````
echo "No build.xml file found!" > /dev/stderr
````

7.If you want a shortcut you can click on the shortcut button and select your
favorite build shortcut.

I guess that does it for the Ant shell script. The next part would deal with
incorporating the ant build system into your flex project. It is worth noting
that this method used here could be used to build just about any program in any
language which uses the ant build system.

## Building your Code
To build your code you need a <code>build.xml</code> file which would describe
how ant should build your code. This file is organized in such a way that it
represents a series of tasks. A good description of how to write a build.xml
file for a flex project could be found [here](http://livedocs.adobe.com/flex/3/html/help.html?content=anttasks_3.html) 
on the Adobe Livedocs website.
