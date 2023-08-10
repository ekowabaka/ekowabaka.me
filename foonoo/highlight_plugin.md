---
title: Highlight Plugin
---
# Highlight Plugin

This plugin automatically highlights source code snippets in your content. It relies on the fantastic highlight.js tool. To use this plugin, just include it in your `site.yml` and whenever you include code snippets, the will be highlighted. To get a sense of how this plugin works, take a look at all the code snippets in this documentation.

## Installing
This plugin uses the `foonoo/highlight` id, so you must place it in your plugins directory as `$PLUGINSPATH/foonoo/highlight`. To clone this from github, while respecting this restriction, you can use:

```bash
mkdir -p $PLUGINSPATH/foonoo
git clone https://github.com/foonoo/plugin-highlight $PLUGINSPATH/foonoo/highlight
```

This assumes `$PLUGINSPATH` points to a location for all your plugins.

Once this setup is complete, you can activate the plugin by adding:

```yml
plugins:
  - foonoo/highlight
```
to your `site.yml`.

## Usage
Highlight takes a single parameter, `style`, which allows users to set the style of syntax highlighting. As its name suggests, the `style` parameter explicitly selects which stylesheet highlight.js uses. For a full list of supported styles, consult the list of highlight.js styles [[here|https://highlightjs.org/demo]].

Although highlight.js automatically detects the language, sometimes it makes mistakes. To prevent your code from being mis-classified, you can explicitly specify the language in your markdown code. This can be done by annotating the backticks in your content with your preferred language. For example, to specify that the following code is in the PHP language, you could use:

```
```php
<?php

print "Hello World";

```
as the starting tag for your code snippet.