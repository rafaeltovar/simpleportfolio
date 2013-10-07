<?php

// Set template
$Sp->setTemplate('basic');

// Set project title
$Sp->SetTitle("SimplePortfolio");

// Set <title /> property in header
$Sp->SetHeaderTitle("SimplePortfolio, by Rafael Tovar");

// Set home image
$Sp->SetHomeImage("example-gallery/003.jpg");

// Add content
// properties -> url, "Title in menu", file html of content
$Sp->AddContent('example', "Example", 'example.html');

// Add gallery
// properties -> url, "Title in menu", directory
$Sp->AddGallery('photos', "Photos", 'example-gallery');

?>