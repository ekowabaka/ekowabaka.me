<<<
title="Compiling PortMidi in Windows with Eclipse/MinGW"
tags=""
category="Ideas"
>>>
### Why I did this?
Over the past few weeks I have been working on this project which in some ways
uses MIDI. I have primarily been working in Linux  but I had plans of porting
the finished application to windows. In order to convince myself after a while
that my approach would work, I decided to try to compile the unfinished app in
Windows.<!--more-->

My toolchain basically contains Autotools & GCC under linux. I however use
Eclipse as my IDE and GDB for debugging. What I did was to set up MinGW under
windows just so I could mimic the linux environment to some detail. I was able
to get precompiled versions of most of the libraries I was using (GTKmm, SDL)
except for portaudio and portmidi. So I had to get the sources and build them
myself. Portaudio built straight out of the box without any problems but
Portmidi sucked. I am pretty sure other people might have this same problem so I
am writing just in case ...

### How do you do this?
Well I just want to assure you that we are not going to be writing any scripts
so don't worry about that. Before you start ensure that you have Eclipse and
MinGW properly installed (such that you can actually compile your C programs in
Eclipse with MinGW).

Download a copy of the PortMidi library from here http://portmedia.sourceforge.net/.
Extract the archive and **move** the porttime folder out of the
portmidi folder. We are going to compile the porttime library separately. It
would later be used as a dependency when compiling the port midi library itself.
To prep the folder for compilation delete the source files that are not needed
for the MS-Windows platform (I know this sounds harsh but that is exactly how I
did it). These files are ptlinux.c, ptmacos_cf.c and ptmacos_mach.c. Okay now
fire up the Eclipse ide. Create a new C shared library project. Call it porttime
or whatever seems right but make sure that you do not use the default location.
You should rather point it to the location of the altered porttime directory
(d:\blog\porttime in my case).

[[untitled.png|Creating the C Project|frame|align:center]]


When asked about the type of configuration on the next page, just choose
release. Your project should now be ready. But you cant start compiling yet.
There are still a few things you have to do. You now have to setup the
compilation parameters. Right-click on the project in the project explorer and
select the properties option.

[[untitled1.png|Selecting the properties options|frame|align:center]]

When the properties dialog opens, edit the **C/C++ Build >> Settings** options. 
Now this is what you do:
1. Under the Tools Settings tab select the **MinGW CLinker >> Libraries** option 
and add the **winmm** library, by clicking on the icon with the in Libraries box. 
This window should look like this after that:  
[[untitled2.png|Setting up the linker|frame|align:center]]

2. Still under the Mingw C Linker node, select the Shared Library Settings
option. Make sure the shared checkbox is active. Set the Shared object name
field to libporttime.dll, set the Import library name to libporttime.dll.a and
set the DEF file name to libporttime.def. This should also look like this:  
[[untitled3.png|Setting up the linker|frame|align:center]]

That should do it for the configuration of the porttime library. That was easy
right? You can now go ahead and compile the library by clicking on the build
icon (the one that looks like the hammer). We now have the porttime library
built.

The main goal of all these activities was to compile the PortMidi library so now
that we have porttime we can go ahead to compile the portmidi library. Its just
as easy as building the porttime library. The only thing is this time you have
to spend repeating the steps.

Hope You Liked This?

So that's all. Hope I helped someone out there. Happy Programming.

