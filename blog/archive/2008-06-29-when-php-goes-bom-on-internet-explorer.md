---
title: "When PHP goes BOM! on Internet Explorer"
tags: 
    - ANSI
    - Eclipse
    - firefox
    - Internet Explorer
    - Opera
    - PHP
    - Safari
    - UTF-8
category: "What I think"
---
I was recently working on a web content management system with a friend and we
made a very surprising discovery. We were actually using PHP to include content
from another page on our local server unto the page that was curently being
viewed. This thing worked perfectly when I was using the Eclipse editor but when
I moved to my friends office and we started using Expression studio (which
obviously doesn't seem to support PHP), the include statement started
introducing unwanted characters. Although most of the browsers on which this was
tested (Opera, Safari and FireFox) skipped these characters, IE of all browsers
displayed them and messed up our template. Well we started to panic because we
didn't know what we had done wrong and IE is one browser you don't want to mess
with because everybody uses it.

<!--more-->

So we started digging on the Internet to find out what was actually wrong with
the system. The first hint of our real problem was sensed when we saw a large
number of newsgroup posts which described problems similar to what we were
facing. Then we realized we were actually playing around with encoding problems.
We figured out that saving the files we wanted to include with ANSI encoding
saved the day.

The previous encoding format we were using was the UTF-8 format. This format is
preceeded with a Byte Order Mark (BOM). This Byte Order Mark is obviously
supposed to tell the reader of the format about the byte order of the file it is
reading. When the PHP include function was called to include this file it also
included the BOM characters which IE decided to display and mess up the
template.