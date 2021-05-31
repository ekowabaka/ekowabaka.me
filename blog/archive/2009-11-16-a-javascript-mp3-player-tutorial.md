---
title: "A JavaScript MP3 Player Tutorial"
tags: 
    - actionscript
    - actionscript3
    - audio
    - flash
    - html
    - javascript
    - mp3
    - web
category: "How To do Stuff"
---
Lots of things go on around me yet making the time to write them is quite
difficult. Well now I have made it a point to share some knowledge all the time
so this time I am going to do a little piece about how an MP3 player can be
implemented in JavaScript with the help of Adobe Flash, through ActionScript 3.
I noticed this trick was being used on several websites. It took me a while to
actually figure out that they were using a flash object to handle the playback
of the MP3. I thought it was cool and I am sure there are several people out
there who want to implement similar ones of their own. So in this post I am only
going to help you build a basic player so that you would at least get the Idea.
I believe that with the idea firmly understood, you could extend this to do just
about anything you would want it to. This sure promises to be fun.

<!--more-->

Okay so without any more talking, this is how we are going to do it. We are
going to use the `Sound`, `Sprite` and
`ExtenalInterface` classes from ActionScript class library to
implement a very simple flash object which has the capabilities to load MP3's
and play them. We would then use JavaScript as a medium to control the playback
from this flash object by talking to it through the
`ExternalInterface` class. In effect we are building a JavaScript
wrapper around the ActionScript Sound class. I don't really know if there are
any security issues related to this but I would investigate.

Lets start coding. I am going to give you the full code for the ActionScript
component then I would explain it later.

    package
    {
        import flash.media.Sound;
        import flash.media.SoundChannel;
        import flash.external.ExternalInterface;
        import flash.net.URLRequest;
        import flash.display.Sprite;

        public class JSMP3 extends Sprite
        {
            private var soundChannel:SoundChannel;
            private var sound:Sound;

            public function JSMP3():void
            {
                // Externalize our interface functions
                // for the load, play and stop
                ExternalInterface.addCallback("load",load);
                ExternalInterface.addCallback("play",play);
                ExternalInterface.addCallback("stop",stop);
            }

            private function load(url:String):void
            {
                // Create a new URLRequest for the mp3 file
                var urlRequest:URLRequest = new URLRequest(url);

                // Try to stop the sound channel if it already
                // playing any audio.
                try
                {
                    soundChannel.stop();
                }
                catch(e:Error) {  }

                // Create a new sound object and load the
                // URL into the object
                sound = new Sound();
                sound.load(urlRequest);
            }

            private function play():void
            {
                // Play the sound
                soundChannel = sound.play();
            }

            private function stop():void
            {
                // Try to stop the sound if it is already playing.
                try
                {
                    soundChannel.stop();
                }
                catch(e:Error)
                {

                }
            }
        }
    }

You could copy this code into a text file and save it as `JSMP3.as`.
To compile it you must have the Flex 3 SDK installed and from the command line
you could execute `mxmlc JSMP3.as`. That should produce the JSMP3.swf
file which would be used for the purpose of playing the MP3 files in your
JavaScript program. Lets try to understand the code.

Looking at the source code you see that it is a really simple one. The main
package, the imports and the class are all standard ActionScript stuff. The
JSMP3 class extends the Sprite class from the flash.display package. Although we
are not going to be using any Sprite features, this extension is still necessary
because without that our MP3 player cannot be embedded into an HTML page. The
constructor uses the ExternalInterface class to expose three methods to the
JavaScript. These are the load, play and stop methods. The implementation for
these methods are below the constructor and they expect their parameters to be
passed from the JavaScripts that are going to be calling them. Well now that we
are done with the ActionScript, lets look at the JavaScript / HTML code.


    var JSMP3Player =
    {
        player : function()
        {
            if (navigator.appName.indexOf("Microsoft") != -1)
            {
                return window["JSMP3"];
            }
            else
            {
                return document["JSMP3"];
            }
        },

        play : function(url)
        {
            this.player().load(url);
            this.player().play();
        },

        stop : function()
        {
            this.player().stop();
        }
    }

This JavaScript wraps around the flash object that would be embedded into the
HTML page. From the code you can tell that the flash object would have an id or
a name JSMP3. The function for doing this wrapping was actually taken from the
Flex 3 SDL Language Reference.

    <html>
    <head>
        <title>MP3 Player Test</title>
        <script type="text/javascript" src="JSMP3.js"></script>
    </head>
    <body>

        <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" 
            id="JSMP3" width="0" height="0"
            codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab">
            <param name="movie" value="JSMP3.swf" />
            <param name="quality" value="high" />
            <param name="bgcolor" value="#869ca7" />
            <param name="allowScriptAccess" value="sameDomain" />
            <embed src="JSMP3.swf" quality="high" bgcolor="#869ca7" 
                width="0" height="0" name="JSMP3" align="middle"
                play="true" loop="false" quality="high" allowScriptAccess="sameDomain"
                type="application/x-shockwave-flash"
                pluginspage="http://www.macromedia.com/go/getflashplayer">
            </embed>
        </object>

        <input type="button" onclick="JSMP3Player.play('obrafour_nkaseibo.mp3')" value="Play" />
        <input type="button" onClick="JSMP3Player.stop()" value="Stop" />
    </body>
    </html>

This code adds the flash object to the html page. The object is given a width
and a height of 0 so we do not see it. The two input buttons for play and stop
actually call the play and stop methods for our JavaScript wrapper which also
calls the flash object to either load and play an MP3 file or stop the playback
if any.

So there we have it. I have tried to keep it as simple as possible. Several
things could be done to extend this player. For instance you could add methods
to detect when the audio is buffering, you could add methods to enable the
controlling of the volume as well as seek through the playback of the audio. I
wish I could have given some form of demonstration. All the same I think the
picture should be clear enough if your coding skills are on point (as far as the
technologies utilized are concerned). I stand to be corrected if any errors are
detected in this post.

Happy Programming.
