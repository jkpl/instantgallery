var fs = require("fs"),
    jade = require("jade"),
    uglifyjs = require("uglify-js"),
    uglifycss = require("uglifycss"),
    Browserify = require("browserify");

var cssFile = "instantgallery.css",
    listFile = "list.js",
    igSourceFile = "instantgallery.js",
    listPhpFile = "imagelist.php",
    mainFile = "./src/main.js",
    jadePageFile = "page.jade",
    multiFile = "multi.html",
    singleFile = "single.html",
    phpFile = "instantgallery.php",
    igCss = uglifycss.processFiles([cssFile]),
    jadePage = fs.readFileSync(jadePageFile),
    phpListJs = fs.readFileSync(listPhpFile);

var bundle = new Browserify(mainFile);

function minify(source) {
  return uglifyjs.minify(source, {fromString: true}).code;
}

function logCallback(message) {
  return function(err) {
    if (err) throw err;
    console.log(message);
  };
}

function writeInstantGallery(source) {
  fs.writeFile(
    igSourceFile, source,
    logCallback("Wrote JS to " + igSourceFile));
}

function writeJadePageToFile(target, opts, message) {
  jade.render(jadePage, opts, function(err, html) {
    if (err) throw err;
    fs.writeFile(target, html, logCallback(message));
  });
}

function writeMultiPage() {
  var opts = {
    cssSrc: cssFile,
    listSrc: listFile,
    igSrc: igSourceFile
  };
  writeJadePageToFile(
    multiFile, opts,
    "Wrote multi file HTML to " + multiFile);
}

function writeSinglePage(source) {
  var opts = {
    igCss: igCss,
    listSrc: listFile,
    igJs: source
  };
  writeJadePageToFile(
    singleFile, opts,
    "Wrote single file HTML to " + singleFile);
}

function writePhpGalleryPage(source) {
  var opts = {
    igCss: igCss,
    listJs: phpListJs,
    igJs: source
  };
  writeJadePageToFile(
    phpFile, opts,
    "Wrote PHP gallery file to " + phpFile);
}

bundle.bundle({}, function(err, source) {
  if (err) throw err;
  var minified = minify(source);
  writeInstantGallery(minified);
  writeMultiPage();
  writeSinglePage(minified);
  writePhpGalleryPage(minified);
});