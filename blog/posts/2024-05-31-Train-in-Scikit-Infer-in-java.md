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


## But Why?
Quite recently I was faced with a classification task in a project I was working on. This rather simple task required me to filter out certain undesired images. Luckily, the images for the task were simple 16x16 grayscale blocks, which could be easily processed by a traditional feed forward network. I quickly looked out for my trusty toolkit, and after a little tinkering, scikit solved the task. In just a few hours, I was able to train an MLP classifier that could filter out the unwanted images. I even had enough time to try out scikit's model selection tools, which helped me select the right architecture for my network.  

<!-- more -->

Scikit learn happens to be the favourite machine learning tool of most data scientists. Although I may not have a solid basis for that claim, anecdotes from data scientists I speak with tends to back that claim. It's use of a simple cosistent API, and its vast collection of algorithms (covering almost the entire gamut of machine learning techniques) makes it my initial go-to whenever I have to analyze data or whenever I have a learning task to evaluate. I am also always impressed by its speed and ease of use&mdash;you do not need a ton of boiler plate code, and you can easily interchange learning algorithms.


Although this was exciting, there was a problem. The project I was working on was implemented in Java and scikit is obviously in python. Porting the project to python (just for the sake of using scikit) was impossible, and making an external call for the classifier was a performance hit I wasn't willing to take. In trying to solve this dilema, my first hunch was to run Scikit through Jython, but that was impossible because of the reliance on numpy. Then using a Java ML library like Weka came in highly reccommended, but I was so spoiled by the simplicity of scikit, I just wasn't willing to put in the extra effort. I even considered Tensorflow for Java, but that's an entirely different story. So in looking for way, it dawned on me: Maybe I could train the network in scikit, export the weights and write a small inference engine to use in my Java project.

And that's what I'm describing in the rest of the blog post. Specifically, we'll use Scikit learn to train a classifier for the MNIST dataset in python, and we'll write two different inference engines in Java&mdash;One using OpenCV and the other using Apache Commons Math&mdash;which use the Scikit obtained weights.

## Some Background
For the uninitiated, neural networks are The basis for much of this work comes from how feed forward neural networks operate. I 

## Inferring on the Weights in Java with OpenCV

## What about with Apache Commons Math
