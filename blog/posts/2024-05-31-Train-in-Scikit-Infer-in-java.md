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


Quite recently I had to implement an image classifier in one of my projects. The requirement was for the system to filter out a particular class of undesired images from a high speed stream of images. Luckily, the images for the task were simple 16x16 grayscale images, which I figured could be easily processed by a traditional feed forward network. In fact, I was able to verify this in a few hours of tinkering with Scikit Learn and it appeared my problem was actually solved. But there was a problem: the code for my project was in Java, and Scikit Learn is in Python.

<!-- more -->

## Meet Scikit Learn
I strongly believe Scikit Learn is the favourite machine learning tool of most data scientists. Although I do not have any evidence to back this claim, anecdotes from several data scientists, and my own personal experiences inform this claim.

Scikit Learn emphasizes simplicity through a consistent API, and it ships with a vast collection of algorithms that cover almost the entire gamut of machine learning. This batteries included nature makes Scikit my initial go-to whenever I have to evaluate a learning task or analyze data. Another impressive feature of Scikit learn is its speed&mdash;you do not need a ton of boiler plate code, you can easily interchange learning algorithms, and you can quickly iterate through your ideas when working with it.

## A Conundrum: How to Scikit in Java
So, back to my problem. With my classification task solved in Scikit, I needed a way to run the solution in my Java code. I needed to do it without disrupting much. My first thought was to run Scikit through Jython, which is a python runtime for Java. But that was proven impossible because of Scikit's dependency on Numpy (a powerful numeric library for python) which is written in C. Another option was to port the entire project to Python. This was a big no no, given the maturity of the project and the small (but important) role the classifier was meant to play.  I also thought of using other Java ML libraries like Weka, but I was so spoiled by the simplicity of Scikit, I wasn't willing to put in the extra effort. Heck, I even considered Tensorflow for Java, but that's an entirely different story. 

Stuck with few options, and looking for an elegant way out, it dawned on me: Maybe I could train the network in Scikit, export the weights and write a small inference engine to use in my Java project. And that's exactly what I did! In this post I'll be describing the entire process.

For our examples, we'll use the MNIST dataset, which is incredible close to what I was working with, and we will write an inference engine in Java using OpenCV as a numeric library. Maybe, someday, I'll make an update with a port having Apache Commons Math as the numerical library.

## Some Background
Before we get coding, however, let's cover some of the background material for thus work. The feed-forward neural network model used in Scikit's MLP classifier has an input layer of nodes, an output layer, and a series of inner, hidden layers. Nodes on each layer are fully connected to those on the previous layer, and each node computes a weighted sum of each of its inputs which is passed through an activation function. This is, of-course, the standard definition of a feed-forward neural network. 

Mathematically, the computation at each node can be represented as:

$y_o^l = f_a(w_1^l x_1^l + w_2^lx_2^l + ... + w_n^lx_n^l + b^l)$

Where $y_o^l$ represents the output of the node, x_1 througn x_n represents the inputs, w_1 through w_n represent the weights for each input, and b represents a bias (or an intercept) of the node. f_a is a special function, known as the activation function, which determines the final output of the node. In all these, l, represents the layer on which the nodes exist. You can visualize these in the following network.

One interesting advantage of representing the network this way is that you can perform all the computations of any layer as a single matrix multiplication. Thus, if you consider all the weights as a matrix W, and all the inputs as a matrix x, you can compute all the activations for a layer as $y = f_a(W.x + b)$. 

This is really good, because if there's anything modern computers are good at, it's computing a matrix multiplications. During inference we will compute the matrix multiplication of our input $x$ and the weights $W$ from Scikit, we'll then add the biases $b$, and pass the output through the activation function to produce our predictions $y$.

The choice of activation function depends on the layer of the neural network. On the input layer, the activation is a linear function that simply returns its input&mdash;essentially no activation $f(x)=x$. On the hidden layers, the activation function is the Rectified Linear Unit, which is computed as $f(x)=max(x, 0)$. On the output layer, the activation is the Sigmoid function: $f(x)=1/(1 + e^{-x})$. The choices of these activation functions are primarily because they are what Scikit Uses by default, and it uses them because they are probably the most reasonable you can make if your intend to solve a wide variety of problems.


## Obtaining the Weights: Training in Scikit
Training a classifier in Scikit is extremely simple. First you get the data, second you call the `fit(x, y)` method of your desired classifier, and tune and iterate. For this demonstration, I'll be using a copy of the MNIST dataset packaged in CSV form. This form of the MNIST has each pixels value as a column in a wide spreadsheet. You can find a copy here:  

We now need to write code for reading the data into Numpy arrays. For the inputs we just read the values from the spreadsheet and divide it by 255. For the outputs, on the other hand, because the spreasheet provides a single number, we use a one_hot_encoder to convert the number output into a one-hot encoded vector.

````python
import csv
import numpy as np

def read_data(path:str) -> tuple:
    x = []
    y = []

    with open(path, "r") as f:
        reader = csv.reader(f)
        next(reader)
        for row in reader:
            y.append([row[0]])
            x.append(np.array(row[1:], dtype=np.float64) / 255)

    return np.array(x, dtype=np.float64), one_hot_encoder.fit(y).transform(y)
````

With the function in place, we can now read ou
## Inferring on the Weights in Java with OpenCV

## What about with Apache Commons Math
