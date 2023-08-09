---
title: Responsive Images Plugin
---
# Responsive Images Plugin
The idea behind responsive images is simple: your site should serve the right image that best on the properties of the end user's display. This is obviously necessary because, for smaller screens you serve a smaller resolution image, and for larger ones you serve something with more detail. Properly implementing this requires having images of different resolutions that can be served for different display sizes. Setting this up could be a daunting task, however, and that's where this plugin comes in. All this plugin requires you to do is provide a high resolution version of your image, tell it the maximum width at which the image would ultimately be served, and it will generate all the intermediate low-resolution images as well as the HTML code needed to make it work.

[[block:note]]
For a more detailed explanation of how responsive images work, Mozilla has a very well written tutorial on how they are implemented at the HTML level [[here|https://developer.mozilla.org/en-US/docs/Learn/HTML/Multimedia_and_embedding/Responsive_images]]. This information may be invaluable to anyone who wants to implement responsive images with foonoo, regardless of whether you'll be using this plugin or not.
[[/block:note]]


## What does the plugin do
This plugin takes an image and renders at different resolutions using lightweight web formats, like webp and jpeg. You have the ability to set the maximum width, the number of steps, and whether HiDPI screens should be supported. To achieve the right effect, it is advisable to provide your input images at their highest quality and resolution, preferable in a lossless format like PNG.

## Usage
To enable this plugin, place the `foonoo/responsive_images` in the list of plugins in your `site.yml` file.

```yml
plugins:
    - foonoo/responsive_images
```

Once enabled, you really don't have to do much. The plugin overrides foonoo's built in image tag, automatically making any images added responsive. But, for the responsiveness to achieve the right effect, you may have to provide some information to the plugin, especially by setting `max-width` parameter. The max width parameter helps the plugin identify where to start making image breakpoints.

