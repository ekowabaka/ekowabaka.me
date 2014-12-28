<<<
title="Building a Mini Banking App With The WYF PHP Framework (Part 2)"
tags=""
category="Uncategorized"
>>>
In the previous post we looked at how we could bootstrap a simple application
(Mini Banking App) with the WYF framework. In this post we are going to add some
more flesh to this dummy app. We're actually going to start storing data and
displaying them in views to our users. Being an app for a bank, we expect the
database to store information about clients and their transactions. For this
reason we are going to build our app to have one table to store information
about clients and another to store their transactions. To make things even more
interesting we are going to have another table which would allow us to define
new transaction types. Let's start coding.
<h2>Client Registration</h2>