---
title: "Ei: A Platformer with a Procedural Level Generator"
---
<header id="title-block-header">
<div class="abstract">
<h1 class="abstract-title">Abstract</h1>
<p>Ei is a two-dimensional platform game created for the purpose of
studying procedural generated levels in platform games. The game
features a level editor, which incorporates the ability to generate
levels through an inbuilt code editor. The resulting levels can be
further modified by human interaction. A simple level generator was
implemented for this level editor and this report describes how that
generator works.</p>
</div>
</header>
<h1 class="unnumbered" id="introduction">Introduction</h1>
[[_TOC_]]<p>Procedural content generation has been employed in several aspects of
video game design. A wide variety of tools and techniques exist to help
designers generate content like textures <span class="citation" data-cites="textmaker"> (<a href="#ref-textmaker" role="doc-biblioref">Spiral Graphics Inc. 2012</a>) </span>, cities 
<span class="citation" data-cites="cityengine">(<a href="#ref-cityengine" role="doc-biblioref">Esri 2014</a>)</span>, trees 
<span class="citation" data-cites="speedtree">(<a href="#ref-speedtree" role="doc-biblioref">Interactive Data Visualization, Inc. 2012</a>)</span> and other natural features. In certain applications, content such as game worlds, levels and stories <span class="citation" data-cites="pierce">(<a href="#ref-pierce" role="doc-biblioref">Pierce 2010</a>)</span> are generated in real-time to give the player a unique experience anytime they play. In this report, the focus would be
entirely on procedural level generation.</p>

<p><em>Rogue</em>, a genre defining dungeon crawler, was responsible for
the earliest known level generator. The designers of Rogue wanted to
create a game that would provide a new adventure any time it was played
<span class="citation" data-cites="wichman">(<a href="#ref-wichman"
role="doc-biblioref">Wichman 1997</a>)</span>. Their technique although
simple, was rather intuitive and very revolutionary for the time; it
involved splitting the world up into dungeons, linking up the dungeons
and littering the dungeons with enemies and loot. The level generation
concepts found in Rogue have successfully been applied to newer games
such as <em>Diablo II</em> and <em>Civilization</em>.</p>
<p>Unlike role player games and dungeon crawlers, platform games provide
a different kind of challenge to level generators. Physics constraints,
placement of game objects and certain domain specific characteristics of
the game for which the levels are being generated, provide several new
dimensions that level generators need to consider when generating
content <span class="citation" data-cites="comptonma">(<a
href="#ref-comptonma" role="doc-biblioref">Compton and Mateas
2006</a>)</span>. One area concerning procedural level generators that
has experienced a lot of research interest is the evaluation of the
properties of the content generated by a given generator. Due to the
fact that platform level generators posses the ability to generate a
large number of content in a short space of time, visual analysis and
other informal approaches may prove inadequate for the purpose of
evaluating generators. To solve this problem, researchers have devised
metrics such as linearity, leniency, density, pattern density, pattern
variation and a collection of others to help in quantitatively measuring
the properties of levels generated <span class="citation"
data-cites="alessandro smithandwhitehead comparative">(<a
href="#ref-alessandro" role="doc-biblioref">Canossa and Smith 2015</a>;
<a href="#ref-smithandwhitehead" role="doc-biblioref">Gillian Smith and
Whitehead 2010</a>; <a href="#ref-comparative" role="doc-biblioref">Horn
et al. 2014</a>)</span>. It is also worth noting that whatever content
generators produce would ultimately be used by humans. Therefore, to
judge the quality of levels from the human perspective, researchers have
found ways of either incorporating human feedback into measurement
techniques <span class="citation" data-cites="marioai">(<a
href="#ref-marioai" role="doc-biblioref">N. Shaker et al.
2011</a>)</span> or artificially modeling the behaviour of human players
when analyzing generated content <span class="citation"
data-cites="hoeft">(<a href="#ref-hoeft" role="doc-biblioref">Hoeft and
Nieznańska 2014</a>)</span>. With the ability to evaluate level
generators, specific generators can be created to meet specific design
goals <span class="citation"
data-cites="smithandwhitehead evaluation">(<a
href="#ref-smithandwhitehead" role="doc-biblioref">Gillian Smith and
Whitehead 2010</a>; <a href="#ref-evaluation" role="doc-biblioref">Noor
Shaker, Smith, and Yannakakis 2015</a>)</span>.</p>
<h1 class="unnumbered" id="meet-ei">Meet Ei</h1>
<p>Ei is a two-dimensional, tile-based platform game featuring a titular
character (called Ei). Like in most platform games, Ei has the ability
to run on platforms, jump over gaps, pick up collectibles and avoid
enemies. Visually Ei features silhouette style graphics where the
characters and other game objects are completely dark and are presented
over a brightly coloured background.</p>
<figure>
<img src="images/ei.png" />
<figcaption>A screenshot from Ei</figcaption>
</figure>
<p>A level editor is incorporated into the game to make it possible for
levels to be created and played. Given that Ei was primarily built for
the purpose of experimenting with level generators, the level generator
features a code editor which makes it possible to provide logic for
level generation. It also includes a simple evaluation toolkit which is
capable of generating a large number of levels to help determine the
expressive range of a given level generator.</p>
<p>To test the level generator and its code editor, a simple level
generator was implemented. This generator uses an approach similar to
that found in the <em>Infinite Super Mario Brothers</em> game. The
levels are generated by randomly placing level sections side by side.
The rest of this report explains how this particular generator
works.</p>
<h1 class="unnumbered" id="the-random-generator">The Random
Generator</h1>
<p>The Random level generator generates levels by piecing together
pre-designed level sections from left to right. There are a total of
five such sections. These are: flat grounds, gaps, gaps with spikes,
elevated platforms, spring jumps and flat grounds with retractable
spikes. The chance of any of these sections occurring at any point
during generation is biased by a difficulty parameter. This difficulty
parameter can have an integer value ranging from one (1) to ten (10). A
higher difficulty value would increase the odds by which sections that
are expected to be difficult to play are selected.</p>
<p>Another consideration made during the generation of the levels, is
the order in which level sections are placed after each other. Placing
certain sections directly in the same place might create levels that
cannot be played. An example of such an incident would be placing a wide
gap after another gap. Obviously, this would generate a gap which cannot
be cleared by the player and effectively render the level
un-playable.</p>
<h1 class="unnumbered" id="more-on-the-sections">More on the
sections</h1>
<p>Although pre-designed, the various level sections are in certain ways
parameterized. This means that, outputs of the various sections are
variable to a certain extent. To further ensure that a generated level
is playable, extra checks are performed when rendering sections. The
basic premise of most of these checks are the constraints imposed by the
physics engine on the movement Ei. With a long press of the jump button,
Ei has the ability to jump up to 3.2 tiles high. When moving at full
velocity, Ei can jump forward over 5.2 tiles when the jump button is
pressed for a long time. Placement of enemies and collectibles are
inherently determined during the generation of individual sections.
Following are brief descriptions of each of the sections.</p>
<div class="doc-figure">
  <img src="images/flat.png" alt="image" />
  <img src="images/elevated.png" alt="image" />
  <img src="images/gap.png" alt="image" />
  <img src="images/spikes.png" alt="image" />
  <img src="images/spring.png" alt="image" />
</div>
<h2 class="unnumbered" id="flat-ground">Flat Ground</h2>
<p>Flat grounds extend from the base of the level to a given platform
height. The platform height value is initially determined at the start
of generation and is continually varied as sections are appended to the
level. The extent to which the platform height value is varied is also
influenced by the value of the difficulty parameter. By varying the
height value up or down in a random manner, the effect of a stepped
platform is generated.</p>
<p>Lengths of flat grounds are randomly chosen to be from three (3) to
six (6) tiles. Flat grounds can contain enemies. The chances of an enemy
appearing on a flat ground is biased such that, flat grounds for levels
with higher difficulty values have higher chances of containing enemies.
A flat ground may also contain collectibles across its length. The
chances of this occurring is 50% irrespective of the current value of
the difficulty parameter. For purposes of aesthetics, flat grounds could
either be decorated with grass bushes, lamp posts or wooden fences. The
surface of the flat ground could also be rough, covered with grass or
smooth.</p>
<h2 class="unnumbered" id="gaps">Gaps</h2>
<p>Gaps are empty spaces between the platform through which Ei can fall
and die. They can have a length which ranges from one (1) to five (5)
tiles. In order to vary their appearance and add different twists to the
level generated, gaps may have spikes at the bottom. Whereas Ei would
fall directly through an open gap, gaps with spikes on the bottom will
have Ei colliding with the spikes and bouncing off to death. Levels with
higher difficulty parameters are biased to have more. Gaps in such
sections will also be biased to have longer gaps.</p>
<h2 class="unnumbered" id="elevated-platforms">Elevated Platforms</h2>
<p>Elevated platforms are platforms which are raised three tiles above
the current platform height with a space underneath. They have a high
chance of containing collectibles. For levels generated with a higher
difficulty parameter, the chances of an enemy on the platform is high.
The flat ground found under the elevated platform is generated with the
same logic as used for plain flat grounds. Elevated platforms have their
lengths ranging from three (3) to six (6) tiles. Just like flat grounds,
the surfaces of elevated platforms could be rough, covered with grass or
smooth.</p>
<h2 class="unnumbered" id="spring-jumps">Spring Jumps</h2>
<p>Spring jumps provide a spring, which propels Ei to jump higher (up to
8.5 tiles). These jumps provide a gap which can have a length that
ranges from one (1) to four (4) tiles long. The gap is immediately
followed either by a flat ground or a raised platform which has a height
that is five (5) to eight (8) tiles higher than current platform. The
length of the higher platform ranges from five (5) to nine (9) tiles.
The gap provided by the spring jump, cannot be cleared by the player
without the assistance of the spring.</p>
<h2 class="unnumbered" id="retractable-spikes">Retractable Spikes</h2>
<p>Retractable spikes are flat grounds which contain killer spikes that
periodically retract into and poke out of the ground. The ground is
completely harmless when the spikes are underneath. Ei would however die
when he collides with the spikes. Spikes could appear in groups of one
(1) to five (5) and they alternate their state every three (3) seconds.
The player has to study the timing of the spikes while moving to avoid
getting killed.</p>
<h1 class="unnumbered" id="evaluating-the-generator">Evaluating the
Generator</h1>
<p>Evaluation of procedural generated content is key in understanding
the properties of a given generator. It also gives a good idea of how a
given generator responds to a particular set of inputs it receives. With
the ability to generate a large number of unique levels in a short space
of time, it is impossible to visually evaluate all levels generated to
ensure that the generator is performing as desired. A great way to
analyze the properties of a generator is to evaluate its expressive
range. The expressive range provides a representation of all content a
particular generator is capable of generating. It also goes ahead to
show how different inputs to a generator affect its output and how
biased a particular generator is to generating a particular kind of
content <span class="citation" data-cites="evaluation">(<a
href="#ref-evaluation" role="doc-biblioref">Noor Shaker, Smith, and
Yannakakis 2015</a>)</span>.</p>
<h2 class="unnumbered" id="expressive-range">Expressive Range</h2>
<p>In determining the expressive range of the Random Level generator,
the approach proposed by Smith and Whitehead <span class="citation"
data-cites="smithandwhitehead">(<a href="#ref-smithandwhitehead"
role="doc-biblioref">Gillian Smith and Whitehead 2010</a>)</span> was
applied. This approach involves: determining an appropriate set of
metrics, generating a large amount of content, visualizing the scores of
the metrics for the content sample space generated and analyzing the
impact of parameters on the output of the generator.</p>
<p>With respect to the selection of metrics for the purposes of
evaluating the Random Level generator, <em>linearity</em> and
<em>leniency</em> were selected. <em>Linearity</em> measures the
“profile" of generated levels, whiles <em>leniency</em> gives a measure
of how forgiving a generated level is likely to be to a player.
Linearity is more of an aesthetic metric and leniency tries to give a
portrayal of the difficulty of a given level. See <span class="citation"
data-cites="smithandwhitehead">(<a href="#ref-smithandwhitehead"
role="doc-biblioref">Gillian Smith and Whitehead 2010</a>)</span> for a
formal definition of both linearity and leniency.</p>
<p>To compute linearity, a best fit line which passes through the level
is computed, using the centre points of each platform as data points. A
normalized sum of absolute displacements of the centre points from the
best fit line is then computed and divided by the total number of center
points to get the value of the linearity. Lower values of linearity
indicate levels of a more linear “profile".</p>
<div class="figure">
<img src="images/level.png" alt="image" />
<img src="images/level_low.png" alt="image" />
</div>
<p>Leniency is computed by taking into account parts of the layout of a
level that require the user to perform some kind of action (e.g. jump
over a gap). Scores which reflect an intuitive measure of how lenient a
given action would be are assigned to each action. For the purposes of
this report, the following scores were assigned to actions Ei could
perform:</p>
<ul>
<li>1 for jumps which are not over gaps.</li>
<li>0.5 for spring jumps.</li>
<li>-0.5 for retractable spikes.</li>
<li>-1 for jumps over gaps.</li>
</ul>
<p>The normalized sum of these scores was divided by the total number of
scores to get the leniency of a given level. Higher values indicate
levels which are more lenient. See Figure <a href="#fig:level" data-reference-type="ref" data-reference="fig:level">[fig:level]</a> for
sample levels with different linearity and leniency values.</p>
<p>For the evaluation of the Random Level generator, a sample space with
a total of 20,000 levels were generated for each value of difficulty.
With each level generated, the linearity and leniency were respectively
computed. To visualize the expressive range a two dimensional histogram
as suggested by Smith and Gillian was plotted for the two selected
metrics. See Figure <a href="#fig:heatmaps" data-reference-type="ref"
data-reference="fig:heatmaps">[fig:heatmaps]</a> for the histograms
generated for difficulty values of 1, 5 and 10.</p>
<div class="doc-figure">
<img src="images/graph1.png" alt="image" />
<img src="images/graph5.png" alt="image" />
<img src="images/graph10.png" alt="image" />
</div>

<p>Looking at the generated graphs it is clear how the difficulty
parameter significantly affects the value of leniency. Levels tend to
have less leniency with higher values of the difficulty parameter.
Linearity on the other hand remains quite constant with a slight
increase as the difficulty parameter increases.</p>
<h1 class="unnumbered" id="conclusion">Conclusion</h1>
<p>This report described a random level generator that was implemented
for a simple platform game called Ei. Ei’s random level generator is
very simple, as far as level generators for two dimensional platform
games are concerned. Its output lacks variation and gets repetitive for
very long levels. The research community around level generators for
platform games have developed a number of level generators which use a
variety of techniques to generate levels to meet different design goals.
Some level generators use evolutionary algorithms to evolve levels to
meet certain fitness criteria <span class="citation"
data-cites="raey">(<a href="#ref-raey" role="doc-biblioref">Dahlskog and
Togelius 2014</a>)</span>, and others also exploit rhythms to engage
players<span class="citation" data-cites="smithetal">(<a
href="#ref-smithetal" role="doc-biblioref">G. Smith et al.
2011</a>)</span>. There are even level generators that are built to
adapt to the individual playing styles of players.</p>

<h1>References</h1>
<ul>
<li id="ref-alessandro" class="csl-entry" role="listitem"><p>
Canossa, Alessandro, and Gillian Smith. 2015. <span>“Towards a
Procedural Evaluation Technique: Metrics for Level Design.”</span> In.
</p></li>
<li id="ref-comptonma" class="csl-entry" role="listitem"><p>
Compton, Kate, and Michael Mateas. 2006. <span>“Procedural Level Design
for Platform Games.”</span> In <em>AIIDE</em>, edited by John E. Laird
and Jonathan Schaeffer, 109–11. The AAAI Press.
</p></li>
<li id="ref-raey" class="csl-entry" role="listitem"><p>
Dahlskog, Steve, and Julian Togelius. 2014. <span>“Procedural Content
Generation Using Patterns as Objectives.”</span> In <em>Applications of
Evolutionary Computation</em>, edited by Anna I. Esparcia-Alcázar and
Antonio M. Mora, 8602:325–36. Lecture Notes in Computer Science.
Springer Berlin Heidelberg.
</p></li>
<li id="ref-cityengine" class="csl-entry" role="listitem"><p>
Esri. 2014. <span>“<span>CityEngine</span>.”</span> <a
href="http://www.esri.com/software/cityengine">http://www.esri.com/software/cityengine</a>.
</p></li>
<li id="ref-hoeft" class="csl-entry" role="listitem"><p>
Hoeft, Robert, and Agnieszka Nieznańska. 2014. <span>“Empirical
Evaluation of Procedural Level Generators for 2D Platform Games.”</span>
Master’s thesis, SE-371 79 Karlskrona Sweden: Blekinge Institute of
Technology.
</p></li>
<li id="ref-comparative" class="csl-entry" role="listitem"><p>
Horn, Britton, Steve Dahlskog, Noor Shaker, Gillian Smith, and Julian
Togelius. 2014. <span>“A Comparative Evaluation of Procedural Level
Generators in the Mario AI Framework.”</span>
</p></li>
<li id="ref-speedtree" class="csl-entry" role="listitem"><p>
Interactive Data Visualization, Inc. 2012.
<span>“<span>SpeedTree</span>.”</span> <a
href="http://www.speedtree.com">http://www.speedtree.com</a>.
</p></li>
<li id="ref-pierce" class="csl-entry" role="listitem"><p>
Pierce, Shay. 2010. <span>“<span>Story-Generating Games</span>.”</span>
2010.
</p></li>
<li id="ref-evaluation" class="csl-entry" role="listitem"><p>
Shaker, Noor, Gillian Smith, and Georgios N. Yannakakis. 2015.
<span>“Evaluating Content Generators.”</span> In <em>Procedural Content
Generation in Games: A Textbook and an Overview of Current
Research</em>, edited by Noor Shaker, Julian Togelius, and Mark J.
Nelson. Springer.
</p></li>
<li id="ref-marioai" class="csl-entry" role="listitem"><p>
Shaker, N., J. Togelius, G. N. Yannakakis, B. Weber, T. Shimizu, T.
Hashiyama, N. Sorenson, et al. 2011. <span>“The 2010 Mario AI
Championship: Level Generation Track.”</span> <em>Computational
Intelligence and AI in Games, IEEE Transactions on</em> 3 (4): 332–47.
</p></li>
<li id="ref-smithandwhitehead" class="csl-entry" role="listitem"><p>
Smith, Gillian, and Jim Whitehead. 2010. <span>“Analyzing the Expressive
Range of a Level Generator.”</span> In <em>Proceedings of the 2010
Workshop on Procedural Content Generation in Games</em>, 4:1–7. PCGames
’10. New York, NY, USA: ACM.
</p></li>
<li id="ref-smithetal" class="csl-entry" role="listitem"><p>
Smith, G., J. Whitehead, M. Mateas, M. Treanor, J. March, and Mee Cha.
2011. <span>“Launchpad: A Rhythm-Based Level Generator for 2-d
Platformers.”</span> <em>Computational Intelligence and AI in Games,
IEEE Transactions on</em> 3 (1): 1–16.
</p></li>
<li id="ref-textmaker" class="csl-entry" role="listitem"><p>
Spiral Graphics Inc. 2012. <span>“<span>Genetica</span>.”</span> <a
href="http://www.spiralgraphics.biz/genetica.htm">http://www.spiralgraphics.biz/genetica.htm</a>.
</p></li>
<li id="ref-wichman" class="csl-entry" role="listitem"><p>
Wichman, Glenn R. 1997. <span>“<span class="nocase">A Brief History of
“Rogue"</span>.”</span> 1997. <a
href="http://www.wichman.org/roguehistory.html">http://www.wichman.org/roguehistory.html</a>.
</p></li>
</ul>
