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


Quite recently I had to implement an image classifier in one of my projects. This rather simple binary task required me to filter out a particular class of undesired images from a high speed stream of images. Luckily, the images for the task were simple 16x16 grayscale images, which could be easily processed by a traditional feed forward network. At least I was able to verify this in a few hours of tinkering with Scikit Learn. But there was a problem: the code for my project was in Java, and Scikit Learn is in Python.

<!-- more -->

## Meet Scikit Learn
For the uninitiated, Scikit Learn happens to be the favourite machine learning tool of most data scientists. Although I do not have any evidence to back this claim, anecdotes from several data scientists I've spoken with, and my own personal experiences make me feel this is the case.

Scikit Learn uses a simple, consistent API, and its ships with a vast collection of algorithms (that cover almost the entire gamut of machine learning techniques) already built in. Its batteries included nature, which fosters simplicity, makes it my initial go-to whenever I have to evaluate a learning task or analyze data. Another impressive feature of Scikit learn is its speed and ease of use&mdash;you do not need a ton of boiler plate code, and you can easily interchange learning algorithms.

## A Conundrum: How to Scikit in Java
So, back to my problem. With my classification task solved in Scikit, I needed a way to just the scikit solution in my Java code without disrupting much. My first thought was to run Scikit through Jython, which is a python runtime for Java. But that was proven impossible because of Scikit's dependency on Numpy (a powerful numeric library for python) which is written in C. Another option was to port the entire project to Python. This was a big no no, given the maturity of the project and the small (but important) role the classifier was meant to play.  I also thought of using other Java ML libraries like Weka, but I was so spoiled by the simplicity of Scikit, I wasn't willing to put in the extra effort. Heck, I even considered Tensorflow for Java, but that's an entirely different story. 

Stuck with few options, and looking for an elegant way out, it dawned on me: Maybe I could train the network in Scikit, export the weights and write a small inference engine to use in my Java project. And that's exactly what I did! In this post I'll be describing the entire process. We'll use the MNIST dataset, which is incredible close to what I was working with, and we will write an inference engine in Java using OpenCV.

## Some Background
The feed-forward neural network model used in Scikit's MLP classifier has an input layer of nodes, an output layer, and a series of inner, hidden layers. Nodes on each layer are fully connected to those on the previous layer, and each node computes a weighted sum of each of its inputs which is passed through an activation function. This is, of-course, the standard definition of a feed-forward neural network. 

Mathematically, the computation at each node can be represented as:

$y_o^l = f_a(w_1^l x_1^l + w_2^lx_2^l + ... + w_n^lx_n^l + b^l)$

Where $y_o^l$ represents the output of the node, x_1 througn x_n represents the inputs, w_1 through w_n represent the weights for each input, and b represents a bias (or an intercept) of the node. f_a is a special function, known as the activation function, which determines the final output of the node. In all these, l, represents the layer on which the nodes exist. You can visualize these in the following network.

One interesting advantage of representing the network this way is that you can perform all the computations of any layer as a single matrix multiplication. Thus, if you consider all the weights as a matrix W, and all the inputs as a matrix x, you can compute all the activations for a layer as $y = f_a(W.x + b)$. Now, if there's anything modern computers are good at, it's computing a matrix multiplications. So, during inference, what we mainly will be doing will be to compute these matrices on inputs $x$, along with weights and biases $W$ and $b$ from Scikit, to produce our predictions $y$.

## Obtaining the Weights: Training in Scikit


## Inferring on the Weights in Java with OpenCV

## What about with Apache Commons Math
