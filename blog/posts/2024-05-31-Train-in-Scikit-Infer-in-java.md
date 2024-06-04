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


Quite recently I had to implement an image classifier in a project I was working on. This rather simple binary task required me to filter out a particular class of undesired images. Luckily, the images for the task were simple 16x16 grayscale images, which I thought could be easily processed by a traditional feed forward network. To quickly verify my hunch, I pulled out the trusty Scikit Learn toolkit and after a few hours of tinkering, the task was solved. But there was a problem: the code base of my project was in Java, and Scikit Learn is in Python.

<!-- more -->

## Meet Scikit Learn
For the uninitiated, Scikit Learn happens to be the favourite machine learning tool of most data scientists. Although I do not have any solid evidence for such a claim, anecdotes from data scientists I spoken with over the years makes me feel confident to make it. 

Scikit Learn uses a simple, consistent API, and its ships with a vast collection of algorithms (covering almost the entire gamut of machine learning techniques) already built in. Its batteries included nature makes it my initial go-to whenever I have to evaluate a learning task or analyze data. Another impressive feature of Scikit learn is its speed and ease of use&mdash;you do not need a ton of boiler plate code, and you can easily interchange learning algorithms.

## A Conundrum, how to Scikit in Java
Although this was exciting, there was a problem. The project I was working on was implemented in Java and scikit is obviously in python. Porting the project to python (just for the sake of using scikit) was impossible, and making an external call for the classifier was a performance hit I wasn't willing to take. In trying to solve this dilema, my first hunch was to run Scikit through Jython, but that was impossible because of the reliance on numpy. Then using a Java ML library like Weka came in highly reccommended, but I was so spoiled by the simplicity of scikit, I just wasn't willing to put in the extra effort. I even considered Tensorflow for Java, but that's an entirely different story. So in looking for way, it dawned on me: Maybe I could train the network in scikit, export the weights and write a small inference engine to use in my Java project.

And that's what I'm describing in the rest of the blog post. Specifically, we'll use Scikit learn to train a classifier for the MNIST dataset in python, and we'll write two different inference engines in Java&mdash;One using OpenCV and the other using Apache Commons Math&mdash;which use the Scikit obtained weights.

## Some Background
For the uninitiated, neural networks are The basis for much of this work comes from how feed forward neural networks operate. I 

## Inferring on the Weights in Java with OpenCV

## What about with Apache Commons Math
