---
title: User Guide
---
# User Guide
TiCo View (also referred to as TiCo-V) provides a lightweight solution for templating and one-way data-binding in JavaScript. Built on top of ES6 proxies, TiCo-v is really just a thin layer of code that relies on ES6 proxy traps to update DOM elements when bound objects are updated. This means TiCo-v will work only on modern web browsers that have support for proxies built in—a feature that's not easy to polyfill in its current implementation, but is supported in almost every modern browser.

Installation
------------
There are no dependencies required for Tico-V and the library itself is quite easy to install. Currently, the only supported package managers are `npm` and `composer`. If you do not use any of these, you can always download the current version of the script and use it directly as you desire.

Thus, for `npm` you can use ...

    npm install tico-v

.. and for `composer` you can use ...
    
    composer require ekowabaka/tico-v

... or you might also consider direct inclusion as follows ...

````js
import {tv} from "./ticoview.js"
````


## Writing Templates
Templates for tiCo-v are written directly into the HTML markup of the page you intend to make responsive. Variables to be replaced by later bindings are written with the mustache/handlebars style variable placeholder. (That, of course, is where all similarity to mustache and handlebars end.) In fact, the feature-set of tiCo-v is so small it call be summarized with one example.

````html
<div id="profile">
    <div>
        <span id='firstname'>{{firstname}}</span>
        <span id='lastname'>{{lastname}}</span>
    </div>
    <img tv-value-src='{{avater_img?"default-avatar.png"}}' />
    <ul id="logs" tv-true="logs" tv-foreach="logs">
        <li>
            <span>{{time}}</span>
            <span>{{update}}</span>
            <span>This update is {{verified?"":"not"}} verified<span>
        </li>
    </ul>
    <div tv-not-true="updates">There are currently no updates</div>
</div>
````

### Text Substitutions
From the example, we should see that text substitutions are performed with variables specified in curly braces (e.g. ``{{variable}}``). Conditional substitution can be made with the "`?`" operator. As such, ``{{variable1 ? variable2}}`` implies that the value of `variable1` will be displayed if it is truthy instead of the value of ``variable2``, which will displayed irrespective of its value. In this configuration the `?` can be considered as a coalescing operator.

Conditional substitutions can also involve literal text such as ``{{truth ? "when true" : "when false"}}``. In this case, the text ``when true`` is substituted if the variable ``truth`` is truthy and ``when false`` is displayed when it's false. For literal substitutions, the second literal to be displayed on a false value can be omitted and it's automatically replaced with an empty string. This is much akin to the ternary operator.

### Special tv attributes
Prefixing any attribute with `tv-value-` makes the attribute's value available for parsing and text substitution. Additionally the attribute can be added back to the node with the `tv-value-` prefix removed. For example, adding the attribute `tv-value-src='{{avater_img?"default-avatar.png"}}'` to an `img` tag will cause TiCo-v to add an `src` attribute, whose value is based on the evaluation of the substitution `{{avater_img?"default-avatar.png"}}`, to the `img` tag.

You can hide and show DOM nodes using the `tv-true` and `tv-not-true` attributes. A DOM node with the `tv-true` attribute will be visible if the variable represented by the value of the attribute is truthy. Likewise, a DOM node with `tv-not-true` will be visible only when the value of the variable is false.

The `tv-foreach` attribute points to an array, and it's perhaps the most interesting of all TiCo-V's special attributes. Its job is to help with the rendering of repeated nodes when displaying data from arrays. This makes it useful for displaying items in tables and lists. Any element to which a `tv-foreach` attribute is attached becomes a wrapper, and its internal nodes become a template to be reapeated for items in the array.

## Binding Variables
To bind an object to a template such as the one in our example above, you can use:

````js
import {tv} from "./ticoview.js"

const view = tv("#profile"); // Create the binding view.
view.data = {
    firstname: "Kofi",
    lastname: "Manu",
    avatar: "09348534ea87e.png",
    logs: [
        {time: "2018-05-06 02:00:00 +005", log: "Something to talk about"},
        {time: "2018-05-06 02:10:00 +005", log: "Another thing to make noise about"},
    ]
}                             // Assign data to the binding view.
````

Here we see that the `firstname`, `lastname`, and `avatar` values are displayed in `span` and `img` elements respectively. Additionally, the `logs` value is displayed in a `ul` element, whose `li` items are repeated for each value in the `logs` element.

The `tv` function that binds dom nodes to views can take both CSS paths and dom nodes as arguments. This means the view creation can be substituted with the following without any issue.

```js
const view = tv(document.getElementById("profile"))
```

## Event handling and access to dynamic DOM nodes
Because TiCo-v modifies the DOM in place any events assigned to DOM nodes through traditional means, such as a call to `addEventListener` or even through attributes (like `onclick`,) still work. An exception, however, exists for nodes that are repeated through `tv-foreach` nodes. Because these nodes are created on the fly (as data is bound) only the events specified through attributes become active. If you intend to dynamically attach events through `addEventListener`, or if you need access to those DOM nodes for any other purpose, you need to sniff out the dom nodes as they are created and attached. You can do this by attaching an event listener to the DOM node with the `tv-foreach` attribute.

For example, considering the template from the example above, if we wanted to attach click events to the `li` items under the `logs` list, we could add an event listener as follows:

```js
document.getElementById("logs").addEventListener(
    "tv-update", 
    e => e.detail.nodes[0].addEventListener("click", clickEvent)
)
```

Notice that we first attached a `tv-update` event to the `logs` ul element. This event fires whenever items in the logs list are updated. The event object sent along has a `detail` property that stores the nodes that were in the template. In the case of our example, this will be a single `li` element. To this element you can then attach your click event or use the node object however possible.

