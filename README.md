**NOTICE: THIS SOFTWARE HAS BEEN RENAMED.**
Check out [Kuvia](https://github.com/Lepovirta/kuvia) instead.

# Instant Gallery

Instant Gallery is a simple image gallery for static web sites.
Give it a list of image files, and you've got an image gallery that can be hosted in any web host.

## Usage


## Documentation

The Instant Gallery command line app is used for generating gallery pages.
The app allows customizing what images are shown in the gallery.
For example, a gallery of three images can be created like this:

    $ instantgallery -o gallery.html image1.jpg image2.png directory/image3.gif

This creates a file `gallery.html` which loads three images.
The gallery file expects the images to be located relative to where the app was called.
Thus if you move the gallery file the image files should be moved accordingly.
You can also specify a prefix if you know that images won't be located relative to the gallery file.

    $ instantgallery -o gallery.html -p 'http://example.org/gallery/' image1.jpg image2.png directory/image3.gif

The gallery will then load the images from these URLs:

    http://example.org/gallery/image1.jpg
    http://example.org/gallery/image2.png
    http://example.org/gallery/directory/image3.gif

### Scanning directories for images

Specifying each file individually can be tedious, which is why the app can also scan directories for images, and generate a gallery based on the found images:

    $ instantgallery -o gallery.html -d myimages

This command scans the `myimages` directory for all the images.
You can also specify multiple directories:

    $ instantgallery -o gallery.html -d berlin -d amsterdam -d london

If you wish to scan all of the sub directories as well, you can add the `-r` flag:

    $ instantgallery -o gallery.html -r -d berlin -d amsterdam -d london

By default, the app scans the directories for all the `jpg`, `jpeg`, `gif`, and `png` files.
You can change what file types are included in the scan:

    $ instantgallery -o gallery.html -t jpg,png -d myimages

You can also specify custom patterns for scanning files:

    $ instantgallery -o gallery.html -e 'berlin/*.jpg' -e 'london/**/*.*(png|gif)'

This command scans the `berlin` directory for all the `jpg` files and the `london` directory and its subdirectories for all the `png` and `gif` files.
For more information on the pattern syntax, see [glob documentation](https://github.com/isaacs/node-glob#glob-primer).

All of these options can be used simultaneously:

    $ instantgallery -o gallery.html \
        -p 'http://example.org/gallery/' \
        -t jpg,png -r \
        -d myimages \
        -d amsterdam \
        -e 'berlin/*.jpg' \
        -e 'london/**/*.*(png|gif)' \
        image1.jpg image2.png directory/image3.gif

### Using JSON resource as an image source

Instead of specifying a static list of files, a JSON resource can be specified.
When the gallery page is opened, the gallery loads the resource and uses the contents as the image list. 
The resource contents must be in JSON array format where each element is a path to an image.
A gallery that uses a JSON resource can be generated using the following command:

    $ instantgallery -o gallery.html -j '/path/to/json/resource'

### Using PHP for loading the image list

The app can also generate a PHP gallery page that loads the list of images dynamically.
The PHP page loads the list of images from the directory specified in the `dir` query parameter.
The PHP gallery can be generated using the following command:

    $ instantgallery -o gallery.php --php

If the web server also supports htaccess files, the query parameter can be masked using rewrite rules with the help of the following `.htaccess` file.
The file must be placed to the same directory as the gallery file, and the file name in the `.htaccess` file must have the same name as the gallery file.

    RewriteEngine on
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^(.*)$ gallery.php?dorewrite=1&dir=$1 [L,QSA]

### Customizing Instant Gallery

Additional JavaScript and CSS files can be added to the gallery page using `-J` and `-C` flags.
The specified resources are loaded using stylesheet link and script tags:

    $ instantgallery -o gallery.html -d images \
        -J 'http://example.org/myscript.js' \
        -J '/another/script.js' \
        -C 'http://example.org/style.css' \
        -C '/stylesheets/style.css' \

By default, the gallery page is minified to save space.
If you don't want the page to be minified, use the `--no-min` flag:

    $ instantgallery -o gallery.html -d images --no-min


## License

(2-clause BSD license)

Copyright (c) 2012-2015, Jaakko Pallari
All rights reserved.

Redistribution and use in source and binary forms, with or without
modification, are permitted provided that the following conditions are met:

* Redistributions of source code must retain the above copyright notice, this
list of conditions and the following disclaimer.
* Redistributions in binary form must reproduce the above copyright notice,
this list of conditions and the following disclaimer in the documentation
and/or other materials provided with the distribution.

THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.

