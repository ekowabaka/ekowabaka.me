---
title: "How I failed to build a game console. Part II"
category: Making
tags:
   - making
   - coding
   - embedded computing
   - raspberry pi
---

In my previous post, I wrote about a failed attempt to build a game console. Since I didn’t provide any significant details on my design and why it failed, you can consider this to be a post-mortem report on the console, with suggestions for what I intend to do next. If you read this, and you have any ideas, too, you are welcome to share with me.

<!--more -->

For the first part of this post, I’ll discuss how I connected the display to the Raspberry Pi Pico. I’ll provide the code I wrote, and I’ll describe some of the modifications I made to the display board in hopes of achieving higher performance. In the second part of the post, I’ll discuss why my attempt failed, and I’ll share what my potential next step will be.

# Hooking up the Display
The ILI9341 display provides two primary channels of communication: you can go through one of its parallel interfaces (transmitting 8 through 18 bits at the same time), or you could use one of two serial interfaces (with either 3 or 4 wires). For simplicity (and maybe for my own sanity) I went with the four wire serial interface.

[[display_schematic.png|A fritzing schematic of how I connected the display to the breadboard.]]

My steps for connecting the interface came from Adafruit’s excellent documentation. Although their post  was primarily targeted at folks using their feather boards, the principles seem to translate easily. 

In my case, I connected the Pico’s internal SPI0 peripheral to the SPI pins on the ILI9341's breakout board. The chip select (CS) and clock (SCLK) pins were pretty straight forward to map out between the Pico and the display. The MOSI (Master Out Slave In) pin on the display and TX pin on the Pico were, however, a little hard to map out. Interestingly, it took me quite a long while to figure out that the MISO (Master In Slave Out) and RX pins were not necessary for my use case. Of course in addition to the SPI interface, I needed to connect lines from the Pico to power the display, and an additional line for resetting the display. 

# Sending data to the display
The ILI9341 is operated by commands sent through the SPI (or whatever chosen connection) interface. Each command is a byte long, and depending on the command, the byte could be followed by a variable number of other argument bytes. 

Commands do a lot: from displaying stuff by writing to the display's memory, to controlling the back light, or putting the display to sleep for power management. But even with this extensive coverage of capabilities, the commands only provide low level access to the memory for drawing graphics. There are no internal routines for producing primitives, like circles or other shapes, and there are equally no internal routines for manipulating bitmaps for stuff like rotation and scaling. All you got is raw access to the memory and you have to make good use of that. 

[[note]]
If you are interested in working with this display, I suggest you spend some time looking at its datasheet. It's an excellent resource and reference material as far as the commands and interfacing options are concerned.
[[/note]]

Before using the display, a series of initialization commands have to be sent. These commands tell the display to turn itself on, they also provide gamma curves for color reproduction, they tell the display the format in which data will be received, as well as how data can be accessed, and they supply several other configuration options. Since I was basing my work on stuff from Adafruit, I stole my initialization sequence from their fantastic GFX library.

After the initialization step, all you can do is to send commands to write to the display's memory. You can equally read from the memory, and even read the status of the success of your commands. But as I stated earlier, I never connected the MISO and RX pins so everything was left to fate. That said, debugging was quite easy since the display either lit up some pixels or not.

# Optimizations and the Start of My Problems
Once my display was connected and configured, I started to face my next demon&mdash;performance. It was just really slow to update the full screen. When I tried alternating the display between two colors, the display kept tearing, and I was averaging about 5 frames per second. 

Now, this is really not a big issue for most other cases in which the ILI9341 will be used. Typically, if you are using this display, you will be updating small sections of the at a time. In my case, however, since I intend to have full screen scrolling with fancy animation, this wasn't going to cut it. As such, I took two major steps to improve performance.

The first, and probably the simplest, was maxing out the SPI interface's frequency. This provided some marginal improvements to the frame-rate, but the screen tearing was still persistent.

After a little internet sleuthing, I found out that tearing probably occurred because I was writing to the display right around the time it was also being read. There was essentially no synchronization between my writing operation and the display's internal read operation. As such, the display could be reading data from the middle of the screen, while I will be writing somewhere at the beginning, causing two halves of different frames to be displayed at once, with the frames joined at the tear. 

Fortunately, the display has a special pin&mdash;aptly named the Tearing Effect (TE) pin&mdash;which signals a good period within which to write data. Whenever this pin is high, data could be written to the display with the guarantee that it's not being read simultaneously. Unfortunately for me, though, the Adafruit breakout board didn't expose this pin. I went ahead and painfully soldered one on, anyway. But that didn't help either. Although the pin was correctly doing its job, the Pico was still too slow to write within the allotted time.

It became obvious the serial interface may not be the way to go



 