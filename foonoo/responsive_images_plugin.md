---
title: Responsive Images Plugin
---
# Responsive Images Plugin
Responsive images, when properly implemented, are always presented in a way that looks right when viewed on different devices. It wouldn't matter the screen resolution, size or pixel density. This is particularly important, especially in cases where images are to be viewed on high DPI displays. The role of foonoo's responsive images plugin is to provide a way of simplifying the process of adding responsive images to your foonoo content.  

For a more detailed explanation of how responsive images work, Mozilla has a very well written tutorial on how they are implemented at the HTML level [[here|https://developer.mozilla.org/en-US/docs/Learn/HTML/Multimedia_and_embedding/Responsive_images]]. This information may be invaluable to anyone who wants to implement responsive images with foonoo, regardless of whether you'll be using this plugin or not.


## What does the plugin do
This plugin takes an image and renders at different resolutions using lightweight web formats, like webp and jpeg. You have the ability to set the maximum width, the number of steps, and whether HiDPI screens should be supported. To achieve the right effect, it is advisable to provide your input images at their highest quality and resolution, preferable in a lossless format like PNG.

## Usage
To enable this plugin, place the `foonoo/responsive_images` in the list of plugins in your `site.yml` file.

```yml
plugins:
    - foonoo/responsive_images
```

Once enabled, you really don't have to do much. The plugin overrides foonoo's built in image tag, automatically making any images added responsive. But, for the responsiveness to achieve the right effect, you may have to provide some information to the plugin, especially by setting `max-width` parameter. The max width parameter helps the plugin identify where to start making image breakpoints.

