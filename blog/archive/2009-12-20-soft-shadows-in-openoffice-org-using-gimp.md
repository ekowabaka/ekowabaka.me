---
title: "Soft Shadows in OpenOffice.org using Gimp"
tags: 
    - diagram
    - document
    - draw
    - drawing
    - gimp
    - graphics
    - office
    - open
    - openoffice
    - openoffice.org
    - shadows
category: "Ideas"
---
There is no doubt about the fact that soft shadows make any piece of graphics stand
out. It adds that extra touch of professionalism to any illustration and it
makes the illustrations look and feel just right in any document or presentation
(if properly used). I have been using Open Office for a while and after several
hours of combing Google just to find a way to create soft shadows in OpenOffice,
I only came up with this (http://www.openoffice.org/issues/show_bug.cgi?id=64343), 
which happens to be a page on the OpenOffice.org issue
tracker requesting the same feature. This means that it is still a work in
progress (and you can vote for it to give it a higher priority). In the mean
time, while we wait for the guys at OOo to code this feature for us, we can
actually play around with GIMP and open office to produce some rudimentary soft
shadows which also look good.

<!--more-->

Let's start with this simple diagram drawn up in OpenOffice.org's Draw package.

[[diagram1.png|Initial Diagram|frame|align:center]]

Assuming soft shadows are to be added to each of the rounded rectangles, fire up
GIMP and draw a rounded rectangle (not necessarily up to the scale and size of
what you have in your OOo drawing).

[[diagram2.png|Gimp Rounded Rect|frame|align:center]]

After the rectangle is drawn, add a little bit of Gaussian blur to it. This is
what would actually give the soft shadow effect.

[[diagram3.png|Gimp soft shadows|frame|align:center]]

Next insert the shadow you created from GIMP into your drawing.

[[diagram4.png|Soft shadows inserted into draw|frame|align:center]]

Send the shadow to the back of the drawing ...

[[diagram5.png|Sending soft shadows to the back of the drawing|frame|align:center]]

... and align it properly (as you like). And there you would have a beautiful
soft shadow. You can use OOo to adjust the transparency of the shadow till you
think its nice enough.

[[diagram6.png|Shadow aligned|frame|align:center]]

To make your diagram even nicer you can consider filling your rounded rectangle
with a gradient.

[[diagram7.png|A nice little gradient|frame|align:center]]

You can also extend the effect to all the other elements in your diagram.

[[diagram8.png|Gradients extended|frame|align:center]]

So there we have it. A few things you could do to this would be to:
1. Group all the elements so that when you resize or scale the group, the
shadows and all their corresponding diagrams would also be resized.

2. Have a folder which contains already made shadows for the common drawing
primitives that you use (e.g. circles, rectangles e.t.c). In the cases where
your diagrams seem to be a bit more complicated, you can then go into gimp and
create a specific shadow for your diagram.

Hope you enjoyed this one.

Happy Drawing.
