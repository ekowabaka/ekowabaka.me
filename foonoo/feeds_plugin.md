---
title: Feeds Plugin
---
# The Feeds Plugin
This plugin publishes RSS feeds for content on your site. Any content your site that is marked as serializable, such as blog posts, will automatically be placed in the feed. The feed is always written to the `feed.xml` file during site generation.

## Installing
Feeds uses `foonoo/feeds` as its id. You can enable this plugin by putting this id in your `site.yml` as shown below.

```yml
plugins:
    - foonoo/feeds
```

## Usage
Once enabled, the feeds plugin will always generate a `feed.xml` file provided there are any serializable content on the site. You don't have to perform any actions for this to work. Content can be marked serializable by site generators (for example the blog generator marks all posts as serializable).
