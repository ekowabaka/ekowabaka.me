---
title: "Automating TV Broadcasting - \"SQLite saves the day!\""
tags: 
    - audio
    - audo
    - automation
    - broadcasting
    - c++
    - database
    - ffmpeg
    - ghana
    - Linux
    - mysql
    - sqlite
    - tv
    - video
category: "Ideas"
---
To graduate in my school one has to work on a graduation project. For my project I decided
to build a TV broadcast automation system. What exactly was this system supposed
to do? Well, the whole idea was to build some sort of media player which played
video's as it has been scheduled to. It was also supposed to keep a log of the
media files played. The system I came up with was quite interesting. It did all
that was required of it and even more. It had the ability to place logos on the
screen, scroll text along the bottom of the screen and also automatically give
information about the currently playing media file such as flashing a tag saying
"Now Playing" as the video is playing. Cool eh!

<!--more-->

### Architecture of the System

Well the system was very simple by design but extremely difficult to implement.
It featured a database backend which allowed the storage of the schedules and
other related data. This database was powered by either MySQL or SQLite. It also
had an FFMPEG based library (that I wrote) which allowed for the decoding of the
media files and its playback. As far as operation was concerned it had simple
user interfaces through which the user could configure the system. In order to
compose the video I used SDL and took advantage of its overlays for some
acceleration. I think using openGL would have been a better choice here but I
was way too deep in development when I realized this. I also used SDL and
PortAudio for the audio access. There was a simple DSP engine put in place just
for audio mixing. I wrote that one too. It featured a plugin system so that the
DSP engine could be expanded. Well so that is pretty much all you need to know
about the internals of the system.

### What next

For the future, I am planning to release the code as a basis for a new open
sourced project. I am just cleaning out the code and removing some shortcuts I
had to put in place just so that I would have a working system for my
presentation. Although these shortcuts work, they would be a huge hinderance to
development in future as I can forsee that they would make the code very
difficult to maintain. I must say that this release could be any moment from
now. I have a few things on my hand I want to complete then I would give this
thing full attention.

For now you can just enjoy the screen-shots and fantasize.

[[screenshot.png|Screenshot 1|frame|width:600|align:center]]

[[screenshot-1.png|Screenshot 2|frame|width:600|align:center]]

[[screenshot-2.png|Screenshot 3|frame|width:600|align:center]]

[[screenshot-scheduler-1.png|Screenshot 4|frame|width:600|align:center]]

