---
title: Responsive Images Plugin
---
# Responsive Images Plugin
The idea behind responsive images is simple: your site should attempt serving the right image that best fits the properties of the end user's display. This is obviously necessary since if you serve a smaller image for a smaller screen or a larger one for a larger screen, you'll have an efficient website. 

Properly implementing this requires having images of different resolutions, which can be served for the different display sizes, already prepared. Setting this up could be a daunting task, however, and that's where this plugin comes in. All this plugin requires you to do is provide a high resolution version of your image, tell it the maximum width at which the image would ultimately be served, and it will generate all the intermediate low-resolution images as well as the HTML code needed to make it work.

[[block:note]]
For a more detailed explanation of how responsive images work, Mozilla has a very good writeup on how they're implemented at the HTML level [[here|https://developer.mozilla.org/en-US/docs/Learn/HTML/Multimedia_and_embedding/Responsive_images]]. This information may be invaluable to anyone who wants to implement responsive images with foonoo, regardless of whether you'll be using this plugin or not.
[[/block:note]]


## What does the plugin do
This plugin takes an image and renders it at different resolutions using lightweight web formats, like webp and jpeg. For this to work with optimum results, however, you have to specify the maximum width the image is expected to have on final rendered pages. This width is most likely going to be determined by your site's theme. For example, images rendered through the ashes theme will never exceed 850 pixels in width. Additionally, you also have to ensure that your input image has a width larger than your chosen maximum width, and even twice the maximum width if you intend to target high DPI screens.

In addition to the width, you can specify the number of steps, and whether HiDPI screens should be supported. It is also best if you supplied your input images in a lossless format, like PNG.

## Usage
To enable this plugin, place the `foonoo/responsive_images` in the list of plugins in your `site.yml` file.

```yml
plugins:
    - foonoo/responsive_images
```

Once enabled, the plugin overrides foonoo's built in image tag to make any images added through those responsive. But, for the responsiveness to achieve the right effect, you may have to provide the only required parameter: the `max-width` parameter. This parameter can be added as arguments to the plugin's augmented foonoo image tag, as shown below:

    [[This is a responsive image| some_responsive_image.png| max-width:800]]

or if you want to use the responsive images directly in your html templates, you could use:

```html
<img fn-responsive src="some_responsive_image.png"/>
```


