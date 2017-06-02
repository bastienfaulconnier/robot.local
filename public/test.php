<?php

$images = file_get_contents('http://lorempicsum.com/futurama/400/200/' . rand(1,9));

file_put_contents('image.jpg', $images);