---
title: "Train in Scikit infer in Java"
category: Machine Learning
tags:
   - artificial intelligence
   - machine learning
   - software engineering
   - neural networks
   - opencv
---


Quite recently I had to implement an image classifier in a project I was working on. This rather simple binary task required me to filter out a particular class of undesired images. Luckily, the images for the task were simple 16x16 grayscale images, which I thought could be easily processed by a traditional feed forward network. To quickly verify my hunch, I pulled out the trusty Scikit Learn toolkit and after a few hours of tinkering, the task was solved. But there was a problem: the code for my project was in Java, and Scikit Learn is in Python.

<!-- more -->

## Meet Scikit Learn
For the uninitiated, Scikit Learn happens to be the favourite machine learning tool of most data scientists. Although I do not have any solid evidence for such a claim, anecdotes from data scientists I spoken with over the years makes me feel confident to make it. 

Scikit Learn uses a simple, consistent API, and its ships with a vast collection of algorithms (covering almost the entire gamut of machine learning techniques) already built in. Its batteries included nature makes it my initial go-to whenever I have to evaluate a learning task or analyze data. Another impressive feature of Scikit learn is its speed and ease of use&mdash;you do not need a ton of boiler plate code, and you can easily interchange learning algorithms.

## A Conundrum, how to Scikit in Java
With the problem solved in Scikit, I wanted a way to just use that solution without disrupting much. My first thought was to run Scikit through Jython, which is a python runtime for Java. But that was proven impossible because of Scikit learn's dependency on Numpy, which is written in C. Another option was to port the entire project to Python. But given the maturity of the project, and given that the classifier was a small (but important) component, a port was just impossible.  I also thought of using other Java ML libraries like Weka, but I was so spoiled by the simplicity of Scikit, I wasn't willing to put in the extra effort. Heck, I even considered Tensorflow for Java, but that's an entirely different story. So in looking for way, it dawned on me: Maybe I could train the network in Scikit, export the weights and write a small inference engine to use in my Java project.

And that's what I'm describing throughout the rest of this blog post. Specifically, I'll be describing how I used Scikit learn to train a classifier on the MNIST dataset in python, and how we can write two different inference engines in Java&mdash;One using OpenCV and the other using Apache Commons Math&mdash;to use the Scikit obtained weights.

## Some Background
For the uninitiated, neural networks are The basis for much of this work comes from how feed forward neural networks operate. I 

## Inferring on the Weights in Java with OpenCV

## What about with Apache Commons Math
