---
title: Responsive Images Plugin
---
# Responsive Images Plugin
The idea behind responsive images is simple: your site should serve the right image that best fits the properties of the end user's display. This is obviously necessary, since if you serve a smaller image for a smaller screen, or a larger one for a larger screen, you'll have a more efficient website. 

Properly implementing this responsiveness requires having images of different resolutions, which can be served for the different display sizes, already prepared. Setting this up could be a daunting task, however, and that's where this plugin comes in. All this plugin requires you to do is provide a high resolution version of your image, and it will generate all the intermediate low-resolution images as well as the HTML code needed to make it work.

[[block:note]]
For a more detailed explanation of how responsive images work, Mozilla has a very good writeup on how they're implemented at the HTML level [[here|https://developer.mozilla.org/en-US/docs/Learn/HTML/Multimedia_and_embedding/Responsive_images]]. This information may be invaluable to anyone who wants to implement responsive images with foonoo, regardless of whether you'll be using this plugin or not.
[[/block:note]]


## What does the plugin do
This plugin takes an image and renders it at different resolutions using lightweight web formats, like webp and jpeg. To produce optimal results, however, you have to specify the maximum width an image is expected to have on final rendered pages. This width is most likely going to be determined by your site's theme, or simply the width you want your image to have on your site. For example, when considering foonoo's default ashes theme, images in the body of any piece of text will never exceed 850 pixels. Additionally, you also have to ensure that your original source image has a width larger than your chosen maximum width, and even twice the maximum width if you intend to target high DPI screens. 

## Usage
To enable this plugin, add `foonoo/responsive_images` to the list of plugins in your `site.yml` file. 


```yml
plugins:
    - foonoo/responsive_images
```

Once enabled, the plugin overrides foonoo's built in image tag to make any images added through those responsive. But to achieve the right responsiveness effect, you may have to provide the `max-width` parameter as shown below:

    [[This is a responsive image| some_responsive_image.png | max-width:800]]

or if you want to use the responsive images directly in your html templates, you could use:

```html
<img fn-responsive fn-responsive-max-width="800" src="some_responsive_image.png"/>
```

Note that parameters passed through html-tags are prefixed with `fn-responsive`. 


### Setting Parameters
Parameters for responsive images can be set in two main ways. They could either be set inline with the tag, directly in the content to locally affect a single image, or they could be set in the `site.yml` file, to globally affect all images while acting as a default value. 

Setting inline parameters has already been demonstrated above in the Usage section above. When using the `site.yml` to set your parameters, however, these are added directly to the plugin definition as shown below.
                         
```yml
plugins:
    - foonoo/responsive_images:
        max-width: 800
```

### Using Parameter Classes
In some cases, you might have different categories of images that may need responsive parameters. For instance, you could have thumbnails that are of a different width, along with banners that may be of other widths. Here, setting parameters directly on tags could be laborious and having defaults may be automatically applied to all other images. To fix this, and other issues, the responsive images plugin provides parameter classes.

Parameter classes are actually analogous to—and were inspired by—CSS classes. To use parameter classes, you define a class in your `site.yml` with a group of parameters, and apply the class to the in-content tags. For example, the following ...

```yml
plugins:
    - foonoo/responsive_images:
        num-steps: 7
        hidpi: true
        classes:
            banner:
                max-width: 650
            preview:
                max-width: 470
            full:
                max-width: 940
```
... defines three classes with different `max-width` values. To apply these to any tags, you could use ...

```
[[This is a responsive image with a class | some_responsive_image.png | class:full]]
```

... or you could also use with HTML tags ...

```html
<img fn-responsive fn-responsive-class="preview" src="some_responsive_image.png" />
```

Classes may also be useful when you want to change responsive images parameters in bulk.


## List of Parameters

 Parameter            | Default    | Description
--------------------- |------------|-------------------------------
`classes`             | None       | A list of classes and their associated parameters.
`compression_quality` | `70`       | Specifies the compression quality of the intermediate images generated. This is specified as a value between `0` and `100`.
`hidpi`               | `false`    | A boolean flag that determnies whether high DPI versions of the images are generated.
`image-path`          |            | Specifies the location in which the rendered intermediary images will be shown.
`max-width`           | Image width| Specifies the maximum width an image could possibly have on the final website.
`min-width`           | 200px      | Specifies the smallest sized image the responsive image should generate.
`num-steps`           | 7          | Specifies the number of images to be generated.