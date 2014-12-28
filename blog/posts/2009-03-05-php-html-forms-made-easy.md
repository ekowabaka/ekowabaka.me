<<<
title="PHP/HTML Forms Made Easy"
tags="application, fields, forms, framework, html, PHP, programming, web"
category="How To do Stuff"
>>>
### Introduction
I must admit here
that one of the most annoying things for me when I was learning how to develop
PHP/HTML applications was designing those HTML forms.  Point blank, it sucks! It
is very painful validating your data and doing all the other crap that comes
along with that HTML chore. Don't tell me about DreamWeaver and all those other
WYSIWYG editors, they just don't work for me.To solve my own problems, I decided
to build a library to help me on the whole forms thing. This was actually
inspired by the concept of the forms api in the Drupal content management system
and the code igniter framework. I just didn't use either because I wanted to be
able to do something of my own so I could just extend it to do whatever I wanted
without going through lenghty documentation. Trust me, the time invested is
sometimes worth it. This forms library I am talking about has already been used
in a couple of applications already (some by me and others by some very good
developer friends of mine). This probably means that it has undergone some
amount of testing already. I cannot stick my neck out that it is very secure and
I can also not stick my neck out that it is very stable but one thing I can tell
you is that it works.

<!--more-->

Before we proceed to look at how the form library works and how it
could be incorporated into an application, let's spend some time to go through
the features of the library. This library does the following things:

- It automatically generates HTML scripts which represents your forms.
- It validates you form data (on the server side).
- It provides some form of framework on which complex forms could be built.
- It also has some features which allow you to automatically dump the values collected from the form into a table in a MySQL database.

### Creating your first form
Using this library is quite simple. All you really do is define your form and
set a couple of callbacks to handle the data collected from the form. For a
quick example lets build a small form which is used to collect data for an
address book application. This form would later be configured to dump the data
into the database. So here is the code (with the assumption that you have the
fapi folder in the correct place):

````php
<?php
require_once "fapi/fapi.php";
$form = new Form();
$firstname = new TextField("Firstname","firstname","The firstname of the person");
$form->add($firstname);
$lastname = new TextField("Lastname","lastname","The lastname of the person");
$form->add($lastname);
$email = new EmailField("Email","email","The primary email address of the person");
$form->add($email);
$phone = new TextField("Phone","phone_number","Phone number");
$form->add($phone);
$form->render();
?>
````

Putting this stub of php code anywhere in your application would cause it to
render a form which looks like the form in the image below.

[[form1.png]]

Well you would agree with me that this is ugly but with a bit of CSS styling it
could go a long way. I took some time to write a stylesheet for the output. This
CSS file is located at **fapi/css/fapi.css**. Include this
stylesheet in your HTML header and you should have a form which looks like the
one below.

[[form22.png]]

You must have noticed that the input fields in the form extends accross the
whole widht of the page. You could limit this by placing your form in a div, a
table  or any other HTML tag that would prevent its content from overflowing its
boundaries.

Now let me explain the code. For this example we used the Form class, the
TextField class and the EmailField class. The constructors of these classes
(except that of the Form class) take a similar set of parameters. The first
parameter is the label, the second parameter is the name of the field (which we
would use for other purposes later) and the last parameter is a brief
description you want to be displayed under the field when it is displayed. None
of these are compulsory though so you could just instantiate the class without
specifying any of the parameters. These type of fields are not the only types
available in the library. You have similar stuff for radio buttons, check boxes,
selection lists etc.
### A More Advanced Form
Lets extend our form a bit. We are going to add a few more fields and
containers. In this form we are going to have field sets (which are also
containers just like forms) on our form and we are going to put the fields into
the field set. The code for this form follows.

````php
<?php
require_once "fapi/fapi.php";

//forms
$form = new Form();

//name
$name_fieldset = new FieldSet("Name");
$form->add($name_fieldset);

$firstname = new TextField("Firstname","firstname","The firstname of the
person");
$name_fieldset->add($firstname);

$lastname = new TextField("Lastname","lastname","The lastname of the person");
$name_fieldset->add($lastname);

//internet
$internet_fieldset = new FieldSet("Internet");
$form->add($internet_fieldset);

$email = new EmailField("Email","email","The primary email address of the
person");
$internet_fieldset->add($email);

$secondary_email = new EmailField("Second Email","secondary_email","The
secondary email address of the person");
$internet_fieldset->add($secondary_email);

//phone
$phone_fieldset = new FieldSet("Phone");
$form->add($phone_fieldset);

$home_phone = new TextField("Home","home_phone_number","Home phone number");
$phone_fieldset->add($home_phone);

$work_phone = new TextField("Work","work_phone_number","Work phone number");
$phone_fieldset->add($work_phone);

$cell_phone = new TextField("Cell","cell_phone_number","Cell phone number");
$phone_fieldset->add($cell_phone);

$form->render();
?>
````

If you haven't already noticed, you should see that this time the fieldset
objects are added to the form and the textfield objects are added to the
fieldsets. This causes the fieldsets to be rendered on the form and the
textfields to be rendered within the fieldsets. This is what the code above
would output.

### An Even More Advanced Form
Let us step things up a bit higher. We are now going to create a form with tabs.
For the tabs to switch we may have to include some javascripts. The needed
scripts are the `fapi/jscripts/jquery.js` and the
`fapi/jscripts/fapi.js`. I guess we are going to fire on all
cylinders now. Lets see the code.

````php
<?php
require_once "fapi/fapi.php";

//forms
$form = new Form();

//category
$category = new SelectionList("Group","group","Which group should this address
be stored under");
$category->addOption("Friends");
$category->addOption("Family");
$category->addOption("Business");
$form->add($category);

//tabs
$tabs = new TabLayout();
$form->add($tabs);

$contact_tab = new Tab("Contact");
$tabs->add($contact_tab);

//name
$name_fieldset = new FieldSet("Name");
$contact_tab->add($name_fieldset);

$firstname = new TextField("Firstname","firstname","The firstname of the
person");
$name_fieldset->add($firstname);

$lastname = new TextField("Lastname","lastname","The lastname of the person");
$name_fieldset->add($lastname);

//internet
$internet_fieldset = new FieldSet("Internet");
$contact_tab->add($internet_fieldset);

$email = new EmailField("Email","email","The primary email address of the
person");
$internet_fieldset->add($email);

$secondary_email = new EmailField("Second Email","secondary_email","The
secondary email address of the person");
$internet_fieldset->add($secondary_email);

//phone
$phone_fieldset = new FieldSet("Phone");
$contact_tab->add($phone_fieldset);

$home_phone = new TextField("Home","home_phone_number","Home phone number");
$phone_fieldset->add($home_phone);

$work_phone = new TextField("Work","work_phone_number","Work phone number");
$phone_fieldset->add($work_phone);

$cell_phone = new TextField("Cell","cell_phone_number","Cell phone number");
$phone_fieldset->add($cell_phone);

//address
$address_tab = new Tab("Address");
$tabs->add($address_tab);

$home_fs = new FieldSet("Home","The home address of the person");
$address_tab->add($home_fs);

$home_address = new TextArea("Address","home_address");
$home_fs->add($home_address);

$home_city = new TextField("City","home_city");
$home_fs->add($home_city);

$home_rsp = new TextField("Region, State or Provice","home_rsp");
$home_fs->add($home_rsp);

$home_country = new TextField("Country","home_country");
$home_fs->add($home_country);

$work_fs = new FieldSet("Work","The work address of the person");
$address_tab->add($work_fs);

$work_address = new TextArea("Address","work_address");
$work_fs->add($work_address);

$work_city = new TextField("City","work_city");
$work_fs->add($work_city);

$work_rsp = new TextField("Region, State or Provice","work_rsp");
$work_fs->add($work_rsp);

$work_country = new TextField("Country","work_country");
$work_fs->add($work_country);

//ims
$im_tab = new Tab("IMs");
$tabs->add($im_tab);

$im_google = new TextField("Google","im_google");
$im_tab->add($im_google);

$im_yahoo = new TextField("Yahoo!","im_yahoo");
$im_tab->add($im_yahoo);

$im_msn = new TextField("MSN","im_msn");
$im_tab->add($im_msn);

$im_aol = new TextField("AOL","im_aol");
$im_tab->add($im_aol);

$im_irc = new TextField("IRC","im_irc");
$im_tab->add($im_irc);

$form->render();
````

You can click here to have a look at this code in action 
http://fahodzi.paanoo.com/fapi_tutorial1.php

### Elements, Fields and Containers
After we have done some forms lets see what more we can do. In case you haven't
noticed already, the whole library is orgarnized into fields and containers.
There are actually three major abstract classes which serve as the foundation
for the whole library. These are the Element, Field and Container classes. The
Element class, which is the base class for most of the classes in the library is
responsible for some html services. The Field class is a subclass of the Element
class and it is responsible for producing and handling fields like (TextField,
RadioButton, Checkboxes and the others). The container class is also a subclass
of the element class. It is used for containing other elements. This means it
can contain both fields and containers. Some of the contianers are the Form, the
Tab, the Box and the Fieldset.

### Validating the form data
There are several validations you can perform on your fields. First of all you
can set some fields as required just by setting the reqired property of the
field. This is done by calling the setter method as such:

````php
$field->setRequired(true);
````

As soon as you call this method on any of the fields, it would be required for
that field to contain data whenever the form is submitted. If there is no data a
simple error message is displayed for the user to handle.

Apart from the required validation you can define custom validation functions
which are called on your field whenever the data is submitted. The details of
this can be figured out from the documentation. The TextField class has an
inbuilt regular expression validation method which comes in handy when you want
to do more complex validations.

### Getting Using the Form Data

After you have collected your data you might want to perform some operations on
the form data. In most cases you might want to save the data into a database.
Every form has a property called the callback. The call back is a function which
takes one parameter. The parameter of the callback function is passed the data
that was captured in the form. Another thing that many people find cool about
this form library is the automatic data insertion into the database. These are
handled by the setDatabaseSchema(), setDatabaseTable() and setPrimaryKey()
methods.

If you set the database schema and table and a connection exists to a database,
the form class automatically dumps the form data into the table. The field names
of your table must correspond with the field names of the fields in the form. If
you set the primary key, the form is automatically filled with the form data on
rendering so that when submitted, the data is rather updated instead of it being
saved again.

### Conclusions
There are so many things I had wanted to write about but time didn't allow me
to. I am pretty sure if you really want to use this library, you can go through
the little documentation that comes with it and figure things out for your self.
It is really not that difficult. All the same, I would like to comment a little
about things I personally do not like about this library.

The paramount thing is the one that has to do with form data being saved
automatically. This is really not very good and although I liked it initially
really do not use it much these days. I rather extracted the code that does the
magic and used it to implement some form of active record system and it is even
much more simpler (I may write on that in my next post).

Another thing that I would really like to add in future is proper javascript
support so that the forms could be submitted through AJAX. Now that would be
cool. When I do that I do not want to break the library signatures so that it
would be very portable to existing code. But for now this is all I have and
unless I really feel the necessity to do that, I am really going to keep this
one. Anyway I have added the whole library and a little documentation to this
post. You can download it from here http://fahodzi.paanoo.com/fapi.tar.bz2
(please bear with me if you find any strange things in the documentation. I made
the that one for a client) . Hope you enjoy it. Happy programming.


