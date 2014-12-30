<<<
title="Building a Mini Banking App With The WYF PHP Framework (Part 1)"
tags="banking, database, Linux, PHP, postgresql, programming, ubuntu"
category="PHP"
>>>
I'm pretty sure you are wondering what this WYF (pronounced waif) framework is?
Well its a little toy I started writing a while ago when I was teaching myself
to code in PHP. Don't ask me what the name means because its really not that
important for now. 

<!--more-->
## What's The WYF PHP Framework?
Do you remember this article I wrote a while ago 
([PHP/HTML Forms Made Easy](http://ekowabaka.me/2009/03/05/phphtml-forms-made-easy.html))? 
Those were the beginings. Ever since I started coding PHP
I wanted to write my own framework. Not that the frameworks available weren't
working for me ... no! It was just that I wanted the experience (I like to do
things the hard way). Also, although there are many different frameworks out
there most of which work better and have cleaner code than the WYF framework, I
don't think another framework would hurt the world. In the past few weeks I have
been spending time polishing WYF (by putting together documentations, test
suites and other stuff like that). In some ways I feel its ready for the world
because some colleagues have shown a lot of interest and I also think there is
some potential here for it. I am releasing it to the public under the MIT
license and I hope to see what becomes of it.

So what can this framework actually do? Well, for starters its not a one size
fits all framework. It was built with enterprisey data-entry-analysis-reporting
kind of applications in mind. Although I believe you can still hack it and use
it to build other kind of apps with a little effort. Sometimes I think of it as
a half-baked application waiting for someone to plug-in the extra functional
modules. Functionally the WYF framework, ...

- tries to exhibit some kind of MVC characteristics although the distinction
between the view and the controllers can sometimes be hard to define.
Controllers and views are mostly crammed together.
- has a rudimetary ORM which currently supports only the PostgreSQL database
(don't ask why?) and support for MySQL is seriously in the works (hopefully
someday)
- has an engine to help in the rendering of forms and views for items in the
database.
- has an engine for generating simple reports in different formats.

A few things worth noting are the facts that this framework has only been tested on
Ubuntu and the Apache web server. I really don't know how it would work on other
platforms (OS/HTTP Servers) but I hope to get some work done on that since its
now going into the public domain.

The main aim of this article is to show you how you can build apps with the WYF
framework. As I have already said, don't really expect much from this framework
because its not as fanciful as the others that exist out there. I however think
it can also hold its own in its own small way. The app we are developing is
going to be a very tiny banking back office application for a very tiny savings
company. Through this application I hope to expose much of what the framework
can do so you can have a fair idea of what its actual capabilities are. To
re-emphasize an earlier point **Please don't expect much!**.

So what would our tiny app do?
- Our app would allow us to register customers for our bank
- Our app would allow us to perform banking transactions on the clients
accounts (take deposits, withdrawals, check balances, and whatever we find to
be fanciful)
- Our app would allow us to generate simple reports so we can actually see
how well our bank is doing

That seems like a tall order so I hope to break this article into several
different parts. In the meantime let's hit the ground running.

## Getting WYF up and running
The WYF framework is hosted on github https://github.com/ekowabaka/wyf. Without
wasting much time open your terminal and lets get busy. First thing is to find a
place to setup our application. In most cases you would want your application to
exist in the document root of your web server. For the case of this tutorial I
am working on an Ubuntu 12.04 system with the default apache web server and php.
My web server has been configured to use mod rewrite and also it has been
configured to support `.htaccess` files. If you are working on a
similar system, then to enable mod_rewrite on ubuntu you can execute:

    sudo a2enmod rewrite

Also enable support for `.htaccess` files you can edit the
`/etc/apache2/sites-available/default` file and ensure that the value
for the AllowOveride is changed from None to All under the `<Directory />`
and `<Directory /var/www/>` configurations.

I don't really know how secure this would be but we'll create a directory in our
home directory for the application code and we would create a symbolic to that
directory from our apache document root (which is /var/www on ubuntu). The
following commands should accomplish that.

    cd ~
    mkdir wyfbank
    cd /var/www
    sudo ln -sv ~/wyfbank
    cd ~/wyfbank
    git clone git://github.com/ekowabaka/wyf.git lib

These commands would basically create a directory in your home directory called
wyfbank, create a symlink in the document root of apache and then it goes ahead
to clone a copy of the framework into a lib directory in the wyfbank directory.
Note that it is very important that the framework exists in the lib directory
because the framework code has some inherent hard-coding to that directory
(lib).

The next phase would be to setup our database. We'll call our database wyfbank.
If you have postgresql installed you can execute the following command to
achieve that.

    sudo -u postgres createdb wyfbank
    
We would now go ahead to setup the WYF framework itself. The truth is I hope to
convert this setup phase into a web driven installation process in the future
but for now, lets get it to work through the terminal. So whiles we are still in
the ~/wyfbank directory, lets execute

    php lib/setup/setup.php
    
You should be greeted with this message

    Welcome to the WYF Framework
    ============================
    This setup guide would help you get up and running with the WYF framework
    as fast as possible.
    What is the name of your application []:

Now go ahead and follow the wizard. You can in most cases accept the default
parameters the wizard gives (those enclosed in square brackets). Basically you
would be required to provide a name for the application, the username and
password for the database and an email address for the super user account. The
other questions are either not required or have defaults guessed by the wizard.
Once you are done running the wizard you should have an output similar to this

    Welcome to the WYF Framework
    ============================
    This setup guide would help you get up and running with the WYF framework
    as fast as possible.
    What is the name of your application []: WYF BANK
    Where is your application residing [/home/ekow/wyfbank]: 
    What is the prefix of your application (Enter 'no prefix' if you do not want a
    prefix) [wyfbank]: 
    Where is your application's database hosted [localhost]: 
    What is the port of this database [5432]: 
    What is the database username []: postgres
    What is the password for the database []: hello
    What is the name of your application's database (please ensure that the database
    exists) []: wyfbank

    Testing your database connection ... OK
    Setting up the configuration files ...
    Creating directory /home/ekow/wyfbank/app
    Creating directory /home/ekow/wyfbank/app/cache
    Creating directory /home/ekow/wyfbank/app/cache/code
    Creating directory /home/ekow/wyfbank/app/cache/menus
    Creating directory /home/ekow/wyfbank/app/cache/template_compile
    Creating directory /home/ekow/wyfbank/app/logs
    Creating directory /home/ekow/wyfbank/app/modules
    Creating directory /home/ekow/wyfbank/app/modules/system
    Creating directory /home/ekow/wyfbank/app/temp
    Creating directory /home/ekow/wyfbank/app/themes
    Creating directory /home/ekow/wyfbank/app/uploads
    Creating directory /home/ekow/wyfbank//app/cache
    Directory /home/ekow/wyfbank//app/cache already exists. I will skip creating it
    ...
    Creating directory /home/ekow/wyfbank//app/cache/menus
    Directory /home/ekow/wyfbank//app/cache/menus already exists. I will skip
    creating it ...
    Creating directory /home/ekow/wyfbank//app/modules
    Directory /home/ekow/wyfbank//app/modules already exists. I will skip creating
    it ...
    Creating directory /home/ekow/wyfbank//app/modules/dashboard
    Creating directory /home/ekow/wyfbank//app/themes
    Directory /home/ekow/wyfbank//app/themes already exists. I will skip creating it
    ...
    Creating directory /home/ekow/wyfbank//app/themes/default
    Creating directory /home/ekow/wyfbank//app/themes/default/css
    Creating directory /home/ekow/wyfbank//app/themes/default/images
    Creating directory /home/ekow/wyfbank//app/themes/default/images/icons
    Creating directory /home/ekow/wyfbank//app/themes/default/templates

    Setting up the database ...
    Enter a name for the superuser account [super]: 
    Provide your email address []: super@nothing.com

    Done! Happy programming ;)

Whew! That was a lot. However, its all over. You can now go ahead and point your
browser to http://localhost/wyfbank. You should now be presented with a
wonderfully looking login screen.

[[login-wyf-bank.png|Login page for the WYF bank|frame|align:center|width:600]]

You can log in with the username super (if that is what you created during the
setup) and you can also use super as the password. You would be prompted to
change your password and once you are done with that you would be logged into an
empty wyf framework application. You can play around by creating users, and
assigning roles.

[[wyf-bank.png|WYF Bank|frame|align:center|width:600]]

I guess that should be enough programming for a day. In our next post we would
look at how to add our own magic to the empty application that was generated by
the wyf framework.

Happy Programming.
