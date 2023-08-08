---
title: Welcome
layout: project_home
---

<div class="larger-text">
Foonoo is yet another tool for converting regular text files into simple websites. It's inspired by well established projects like Jekyll, and similar to these other projects, foonoo produces outputs that can be hosted on virtually anything that can serve HTML files. You do not need any server side scripting to run the sites generated by foonoo.
</div>

# How it works!
By design, foonoo is an empty shell through which specific site builders work. As such, foonoo itself doesn't provide any site building features: the site builders that work through foonoo, however, do. Site builders determine how content directories should be structured, and they rely on these structures and their own internal rules to generate the markup that forms the final output site. This doesn't mean foonoo just sits idle while this process proceeds. Foonoo coordinates the operations of these generators by providing:
 
   - A common interface through which site builders can access content for their site. 
   - An ecosystem for shared plugins that extend the sites.
   - A transparent and extensible markup conversion system, which provides conversions for different text formats. (Markdown, reStructured, etc.), 
   - A common theming and templating infrastructure. 
   - An assets and media management system. 
   - And most importantly, a user interface through which end users can interact with the site builders. 

With its structure of separated site builders, foonoo makes it possible to  manage a complicated site that contains different sections—in a somewhat simplified manner—from a single project directory. Although this may seem overkill, this specific use case was the primary motivation for foonoo.