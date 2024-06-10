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


Quite recently I needed to implement an image classifier in one of my projects. The requirement was for the system to filter out a particular class of undesired images from a high speed stream of images. Luckily, the images for the task were simple 16x16 grayscale images, which I figured could be easily processed by a traditional feed forward network. In fact, I was able to verify this in a few hours of tinkering with Scikit Learn and it appeared my problem was actually solved. But there was a problem: the code for my project was in Java, and Scikit Learn is in Python.

<!-- more -->

## Meet Scikit Learn
I strongly believe Scikit Learn is the favourite machine learning tool of most data scientists. Although I do not have any evidence to back this claim, anecdotes from several data scientists, and my own personal experiences inform this claim.

Scikit Learn emphasizes simplicity through a consistent API, and it ships with a vast collection of algorithms that cover almost the entire gamut of machine learning. This batteries included nature makes Scikit my initial go-to whenever I have to evaluate a learning task or analyze data. Another impressive feature of Scikit learn is its speed&mdash;you do not need a ton of boiler plate code, you can easily interchange learning algorithms, and you can quickly iterate through your ideas when working with it.

## A Conundrum: How to Scikit in Java
So, back to my problem. With my classification task solved in Scikit, I needed a way to run the solution in my Java code. I needed to do it without disrupting much. My first thought was to run Scikit through Jython, which is a python runtime for Java. But that was proven impossible because of Scikit's dependency on Numpy (a powerful numeric library for python) which is written in C. Another option was to port the entire project to Python. This was a big no no, given the maturity of the project and the small (but important) role the classifier was meant to play.  I also thought of using other Java ML libraries like Weka, but I was so spoiled by the simplicity of Scikit, I wasn't willing to put in the extra effort. Heck, I even considered Tensorflow for Java, but that's an entirely different story. 

Stuck with few options, and looking for an elegant way out, it dawned on me: Maybe I could train the network in Scikit, export the weights and write a small inference engine to use in my Java project. And that's exactly what I did! In this post I'll be describing the entire process.

For our examples, we'll use the MNIST dataset, which is incredible close to what I was working with, and we will write an inference engine in Java using OpenCV as a numeric library. Maybe, someday, I'll make an update with a port having Apache Commons Math as the numerical library.

## Some Background
Before we get coding, let's cover some of the background material for this work. The feed-forward neural network model used in Scikit Learn's MLP classifier has an input layer of nodes, an output layer, and a series of inner, hidden layers. Nodes on each layer are fully connected to those on the previous layer, and each node computes a weighted sum of each of its inputs which is passed through an activation function. This is, of-course, the standard definition of a feed-forward neural network. 

Mathematically, the computation at each node can be represented as:

$$y_i = f_a(w_1 x_1 + w_2x_2 + ... + w_nx_n + b^i)$$

Where $y_i$ represents the output of the node, $x_1$ through $x_n$ represent the inputs to the layer, $w_1$ through $w_n$ represent the weights for each input, and $b$ represents a bias (or an intercept) of the node. $f_a()$ is a special function, known as the activation function, which determines the final output of the node. You can visualize these in the following network.

One interesting advantage of representing the network this way is that you can perform all the computations of any layer as a single matrix multiplication. As such, if you consider all the weights of a given layer as a matrix $W$, and all the inputs as a vector $X$, you can compute all the activations for a layer as: $$Y = f_a(W \cdot X + B)$$

Assuming our input vector, $X$, is of size $m$ and the layer for which we are computing has $n$ nodes, then our weights matrix $W$ will have $m$ rows and $n$ columns, and our bias and output vectors will also be of length $n$. 

Having the ability to make the computations this way is really cool because if there's anything modern computers are good at, it's multiplying matrices. This matrix approach also simplifies our inference work (we have to write less code) while allowing us to take advantage of some of these modern computation capabilities. When writing our inference code, we will only need compute the matrix multiplication between our input, $x$, and the weights, $W$, from Scikit Learn, and when we add the biases, $b$, and pass the output through the activation function, $f_a(x)$, we'll obtain our prediction $y$.

One final piece we need to cover before implementing our inference function will be the choice of activation functions. In Scikit Learn, the activation function depends on the particular layer of the neural network. By default the input and hidden layers have the Rectified Linear Unit, which is computed as: 

$$f(x)=max(x, 0)$$

It's essentially a ramp function that cuts out all negative values and preserves positive ones. The output layer, on the other hand has a the Sigmoid function:

$$f(x)=1/(1 + e^{-x})$$

This function has a special statistical property that significantly suppresses potential errors while significantly boosting predictions. These activation functions are the defaults configured in Scikit Learn, and you can change them if you wish. Just remember that if you should use any other configuration, you need to implement the same functions in your Java inference code.

## Obtaining the Weights: Training in Scikit
Training a classifier in Scikit is extremely simple. First, you get the data, second you call the `fit(x, y)` method of your desired classifier, and finally you tune and iterate. For this demonstration, I'll be using a copy of the MNIST dataset packaged in CSV form. This form of the MNIST has each pixels value as a column in a wide spreadsheet. You can find a copy here:  

We now need to write code for reading the data into Numpy arrays. For the inputs ($x$) we read the values from the spreadsheet and divide it by 255 to normalize it. For the outputs ($y$) on the other hand, because the spreadsheet provides a single number, we need to encode the output as a one-hot vector covering the 10 possible outputs. Luckily, scikit ships with a one hot encoder we can use for this. 

Below is a a simple implementation of a python function to read this data.

````python
import csv
import numpy as np
import sklearn.preprocessing import OneHotEncoder

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

With the function in place, we can now import our MNIST data as follows.

````python
train_x, train_y = read_data("mnist_train.csv")
test_x, test_y = read_data("mnist_test.csv")
````

Then, we can tap into the simplicity of scikit learn to train our neural network classifier. Since we are using MNIST, which is made up of 28x28 images, our input layer already has 784 nodes. We can choose to have two hidden layers of sizes 512 and 128, and we can cap off the network with a final set of 10 nodes for the output layer. This architecture can be configured simply in Scikit learn as shown below:

````python
clf = MLPClassifier(hidden_layer_sizes=(512, 128))
````

Note that we do not specify the sizes of the inputs and outputs, because those will be inferred by Scikit Learn from the dataset. The classifier we set up can be trained simply by executing the line:

````python
clf.fit(train_x, train_y)
````

We can now save the weights and biases into JSON that can be moved into Java for inference. The `clf` object holds the weights and biases in its `clf.coefs_` and `clf.intercepts_` properties respectively. The weights in 

````python
with open(f"weights.json", "w") as weights_file:
        json.dump([x.tolist() for x in clf.coefs_], weights_file)
with open(f"biases.json", "w") as weights_file:
        json.dump([x.tolist() for x in clf.intercepts_], weights_file)
````

And with that we have all we need from Scikit. Next, we'll look at inference in Java.

## Inferring from the Weights in Java with OpenCV
Our first step in inference will be to load the weights from Scikit into Java as OpenCV Matrix objects. Because we saved our weights to JSON files, we can rely on Google's Gson library (or whatever your favourite JSON library is) to read in these values. As already discussed, each layer has a weights matrix, and a bias matrix. We do not explicitly need to know the number of nodes each layer has, because its inherently represented in the size of the matrix. Also we must remember that while the weights are two-dimensional, the biases are stored in a single dimension.

### Loading the Weights and Biases
We can first load the biases as follows:

````java
Gson gson = new Gson();
List<Mat> biases = new ArrayList<Mat>();

try (FileReader reader = new FileReader("biases.json")) {
    for(double[] bias: gson.fromJson(reader, double[][].class)) {
        Mat mat = new Mat(bias.length, 1, CvType.CV_64F);
        mat.put(0, 0, bias);
        biases.add(mat);
    }
}
````
Here the biases are read into a list of 64 bit floating point OpenCV Mat objects. We can similarly load the weights as follows:

````java
Gson gson = new Gson();
List<Mat> weights = new ArrayList<Mat>();

try (FileReader reader = new FileReader("weights.json")) {
    for(double[][] weights: gson.fromJson(reader, double[][][].class)) {
        Mat mat = new Mat(weight.length, weight[0].length, CvType.CV_64F);
        double[] flatWeight = Arrays.stream(weight).flatMapToDouble(Arrays::stream).toArray();
        mat.put(0, 0, bias);
        weights.add(mat.t());
    }
}
````
The difference between the two loaders comes in the dimensions. With biases being single dimensioned, they are relatively easy to read into mats without much modification. Weights, however, have to be mapped out into a flat array before being loaded into the Mat object, and this result must also be transposed to get the orientation right for matrix multplication.

### Making Predictions
Now that the model is loaded, we can make predictions by iterating through the loaded weights. At each stage of this iteration, we compute the multiplacation between the input and the weights with the `Core.gemm` function. `Core.gemm` performs matrix multipications between arrays through the OpenCV library. After a relu activation is applied to any of the inner layers, the output becomes the input for the next layer. The final output is passed through the sigmoid function and the prediction comes in the form of a one-hot vector.

```java
public Mat predict(Mat x) {
    int i = 0;
    Mat activations = new Mat();
    for (i = 0; i < numberOfLayers; i++) {
        Core.gemm(weights.get(i), x, 1, biases.get(i), 1, x);
        // Compute relu activation for hidden layers only.
        if (i < numberOfHiddenLayers) {
            Core.max(x, Scalar.all(0), x);
        }
    }

    // Sigmoid activation
    Mat output = new Mat();
    Core.exp(x, x);
    Core.reduce(x, output, 0, Core.REDUCE_SUM);
    Core.divide(x, Scalar.all(output.get(0, 0)[0]), output);

    return output;
}
```

When evaluated, the inference performs at the same rate as the original implementation in python. It's really simple, but whenever you find yourself in a bind, you can always use this approach.

## Putting it all together

The full python and Java scripts are below. Remember the python script requires the scikit learn dependency, while the Java code requires Gson and OpenCV as dependencies. Happy coding, and find the full listings in the following [[gist|https://gist.github.com/ekowabaka/3ef942928b45750e0ab4bb8dff54d65a]].

