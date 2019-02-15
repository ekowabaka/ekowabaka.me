---
title: "Getting FLEX-ible With GEdit"
tags: 
    - actionscript
    - adobe
    - flash
    - flex
    - gedit
    - gnome
    - Linux
    - ubuntu
category: "How To do Stuff"
---
For a long time I had always wanted to develop for the flash platform but the
huge cost of the authouring suite always put me off. I tried a couple of open
source ways to develop for the platform but none of them really worked well for
me. Earlier this year during a random escapade on the Internet I came accross
Flex. <!--more-->

I realized I had been left behind. I personally decided to get into this but I
couldn't really get a suitable editor. The Flex Builder is expensive and most of
the options out there are targeted more to Windows than to Linux. So I had to
make do with what I had and I stuck to one of my personal favorites GEdit. I
like to use GEdit a lot because for some reason the Oblivion colour scheme seems
to be very friendly to my eyes. Well, this article is intended to help you
configure GEdit so you could us it to write codes for flex or ActionScript.

**Asumptions**
1. I am assuming that you have installed a copy of the Flex SDK and it is 
accessible through your PATH.
2. I am assuming that you have some basic understanding of bash sell
scripting

**Configuring Gedit**

In GEdit locate Tools >> External Tools. On the dialog that opens select
New Tool. Give the tool a name and go ahead to give it a shortcut (Try to figure
those out). In the commands section paste the following:


    #!/bin/bash
    if (/opt/flex-3.2/bin/mxmlc &quot;$GEDIT_CURRENT_DOCUMENT_PATH&quot;)
    then
    /opt/flex-3.2/bin/flashplayer &quot;`echo $GEDIT_CURRENT_DOCUMENT_PATH | awk
    -F.mxml {'print $1'}`.swf&quot;
    fi

Be sure to replace `/opt/flex-3.2` with the correct location of your flex SDK and
you are good to go. Anytime you hit the shortcut for your external tool your
flex compiler would be invoked.

For syntax hilighting you might want to use XML for the MXML files and JAVA for
the ActionScript files.

**Update**
This post has been updated see
http://ekowabaka.me/2010/08/24/getting-flex-ible-with-gedit-ant-style.html
for the updated post
