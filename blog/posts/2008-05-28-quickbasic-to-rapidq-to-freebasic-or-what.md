<<<
title="QuickBasic to RapidQ to FreeBASIC? ... or what?"
tags="BASIC, compiler, computers, freebasic, ghana, programming, rapid-q, rapidq, sofware"
category="Ideas"
>>>
After several years of teaching myself to program computers using Microsoft
QuickBASIC, I got to a point somewhere in 2002 when I realized that the MS-DOS
era was over. I needed an alternative. All roads were leading to VisualBASIC but
a poor guy like me couldn't just afford it. So I searched for a free alternative
to VB. Mind you around this time the hype of .NET and Mono were not that in rage
so we had to make do with what we had.

<!--more-->

First on my list of VB compatibles was Envelope. This was supposed to be a
near-drop-in replacement for visual basic. Well I gave it a try and was very
dissapointed. My next try was RapidQ. I was so impressed by its easy learning
curve that I soon started coding in it. I wrote a couple of commercial apps
which I sold to somepeople and also a DJ software called 
[Atenteben](http://www.freewebs.com/atenteben) and an implementation of Oware which I called
Virtual Oware. I was really loving and living the RapidQ life. As a matter of fact most
of my friends who were coding in VB were in some instances considering
converting to RQ. I However had a big blow about a year later when I realized
that William Yu (the author of RapidQ) had abandoned the project and he had
sold the code to RealBASIC. It was such a big shock and it took me a while to
convince myself to move on to another language or compiler. Around this time I
was making my way into the University to study computer engineering and so I
figured that learning C++ or JAVA was going to be of help but my laziness didn't
allow me to.

In search for a faster alternative to RapidQ I found FreeBASIC another BASIC
compiler which was very similar in many ways to the classic Microsoft
QuickBASIC. It was like the answer to most of my problems. Actually, the only
problem I had with it was the fact that it was a bit difficult to work with. I
made a switch to the Linux family and FreeBASIC still had my back. After working
for a while in FreeBASIC I was introduced to C and C++ at the university so I
finally left the BASIC group for good.

A few weeks ago I made a search for RapidQ because I wanted to compile some of
my old programs and show them to a friend. I was surprised to find out that
there was still a very vibrant RapidQ community which was still working with the
old RQ compiler. Some of the developers for this platform have actually reverse
engineerd the system and they have added new features to the compiler they are
calling RQ2.

I found their step to be a very good one but it looks like the end is also
gradually coming for RapidQ whether you want to accept this fact or not. I find
it sad that such a good implementation of the BASIC language should go to waste.
So the question here is what can be done to ensure that RapidQ stays alive?
After thinking about this issue for a while, two solutions came to mind.

1. Write a new compiler from scratch or ...
2. Extend an existing compiler with some rapid Q compatibility class library.
    
Extending an existing compiler with some RapidQ compatibility class library may
help a lot if the developers of rapidQ wish to port their programs to this new
compiler. Obviously the compiler should be an object-oriented BASIC compiler.
One such compiler could be FreeBASIC. Although this may not be a very good
replacement for RQ, it would help solve a lot of problems for people who wish to
make the move from RQ but need something very similar to move to.

Writing a compiler on the other hand makes more sense but seems to be much more
tedious and time consuming. A new compiler designed with RapidQ in mind would
definitely be code compatible with much (if not all) of the RapidQ code
available. It could be redesigned to take advantage of modern hardware and
technologies. The compiler could be made faster than the existing RQ compiler.
This compiler if made open source could even go a long way to battling with some
of the huge BASIC compilers available now. Personally I find this option to be
most probable so don't be surprised if you read this blog someday and find out
that I am working on an RQ-like compiler.

