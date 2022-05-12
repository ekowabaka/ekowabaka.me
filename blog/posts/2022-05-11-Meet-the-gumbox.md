---
title: "Progress Report: On Raspberry Pis — Meet the gumbox"
category: Making
tags:
    - making
    - coding
    - embedded computing
    - raspberry pi
---
Late last year I made a resolution to find uses for all the single board computers in my collection (see [[On Raspberry Pis]]).  This decision was influenced by my wasteful addiction to single board computers. I say wasteful because I keep buying these devices, and I really never use them for anything. This, of course, is a huge waste, and to curb this waste, I have actively prevented myself from buying any new boards until I’ve made meaningful use of those in my collection. 

<!--more -->

Since making this resolution, I must admit, my journey to the goal has been a knee deep walk through mud. I’m making progress, but I seem to find myself in this weird learning curve. Most times it feels like I'm trying to hone my embedded development skills, at the same time as unteaching myself almost everything I’ve known about programming till date.

So far, my mainstay single board computer has been the Raspberry Pi pico. As usual, I have a couple of projects going on with these, and I’m honestly having a blast learning while working on these projects. 

## My Dev Setup

My development setup with the pico has me writing code with Visual Studio code, and handling my builds through the pico’s wonderful CMake build system (which is gracefully supplied with the official SDK). To debug my code, I have a dedicated RPi pico device which runs a special firmware known as picoprobe. Picoprobe allows me to flash firmware onto other picos and debug the code running on the pico–complete with line stepping, custom breakpoints, and variable watches.

If you are an embedded systems veteran who finds all that I’m describing normal, please pardon my excitement. I’m from a different world where all the heavy lifting has already been done. My excitement may also appear pronounced since my only experience with embedded programming involved looking up Z80 opcodes and manually writing the hex machine codes to a CPU through a numpad only monitor device. Given this experience, my current setup appears to a complete shift.

## Annoying aesthetic quirks

Even with all this new found efficiency, one thing about my setup kept nagging at me: the bare PCBs that were spread out on my desk. I know bare PCBs look cool and scream I’m hacking, but I just wanted the picoprobe pico enclosed. In some ways, I consider it as a stand alone device, a special appliance that’s performing a particular task and therefore needs to be treated well. I also needed an excuse to use my 3D printer which has practically been idling after printing a few benchies, so I went ahead to design and print an enclosure.The coolest thing about this experience was that I got to use freecad for the first time. 

## The Gumbox Enclosure
After hours of tinkering and figuring out Freecad, I eventually came up with an enclosure that looked like a box of gum. I aptly named it the “gum box”. It’s design is by no mistake, though. I deliberately made it very tiny so it could snugly hold the pico inside. 
To ensure the tiny design, I didn’t provide a lip for the enclosure (something I actually found a little hard to do). As such a flat lid is glued in place after the pico is installed—making whatever pico held inside a permanent debugger. To allow for firmware updates, and to make the LED visible (since its always on and blinks whenever the debugger is flashing firmware) I made two tiny holes on the top. The first, larger hole provides enough clearance for a tiny pin to push the BOOT button whenever the pico’s firmware needs to be updated, and the other smaller hole provides a window for the LED to shine through.

[[gumbox.webp|A profile of the gumbox in action|frame=figure]]

If you are interested in printing one of these for your own use, you can download the STL and cad files from my github. If you also want to have your workflow setup like mine, I will recommend checking out this tutorial from DigiKey: it’s basically what I used. I’m happy with my progress so far, and I’m hoping to share updates on some of my projects soon. 
