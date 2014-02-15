<!DOCTYPE html><html lang="en"><head><title>Instant Gallery</title><meta charset="utf-8"><style>html,body{height:100%;margin:0;padding:0;background-color:#eee;max-height:100%;font-family:sans-serif}.hoverbar{position:absolute;margin:0;padding:0;top:0;right:0;min-width:15em;max-height:100%;overflow-y:auto;z-index:100;text-align:right;-ms-filter:"alpha(opacity=90)";filter:alpha(opacity=90);-moz-opacity:.9;-khtml-opacity:.9;opacity:.9}.title{font-weight:bold;padding:2px 10px;background-color:#44d;color:#fff}.title a{display:block;color:inherit;text-decoration:inherit}#sidebar{margin:0;padding:0 10px;background-color:#fff;color:#111;height:0;overflow:hidden;-ms-filter:"alpha(opacity=0)";filter:alpha(opacity=0);-moz-opacity:0;-khtml-opacity:0;opacity:0;-webkit-transition:height .25s linear .25s,opacity .25s;-moz-transition:height .25s linear .25s,opacity .25s;-o-transition:height .25s linear .25s,opacity .25s;-ms-transition:height .25s linear .25s,opacity .25s;transition:height .25s linear .25s,opacity .25s}#sidebar.show{height:100%;-ms-filter:"alpha(opacity=90)";filter:alpha(opacity=90);-moz-opacity:.9;-khtml-opacity:.9;opacity:.9;-webkit-transition:opacity .25s;-moz-transition:opacity .25s;-o-transition:opacity .25s;-ms-transition:opacity .25s;transition:opacity .25s}#sidebar a{text-decoration:none;color:#22f}#sidebar a:hover{background-color:#44e;color:#fff}#toolbar{position:fixed;margin:auto;bottom:2em;background-color:#fff;border:1px solid black;color:#111;padding:5px;width:100px;left:-200px;text-align:center;-ms-filter:"alpha(opacity=80)";filter:alpha(opacity=80);-moz-opacity:.8;-khtml-opacity:.8;opacity:.8;-webkit-border-radius:5px;-moz-border-radius:5px;border-radius:5px;-webkit-transition:left .25s;-moz-transition:left .25s;-o-transition:left .25s;-ms-transition:left .25s;transition:left .25s}#toolbar h1{margin-top:0}#toolbar.show{left:100px;height:auto;-webkit-transition:left .25s;-moz-transition:left .25s;-o-transition:left .25s;-ms-transition:left .25s;transition:left .25s}#toolbar ul{list-style:none;margin:0;padding:0}#toolbar ul li{display:inline}#toolbar a{text-decoration:none;color:#22f;padding:5px}#toolbar a:hover{background-color:#44e;color:#fff}#sidebar .navi,#linksarea{padding:0;margin:0 0 10px 0;list-style:none}#linksarea .show{background-color:#22f;color:#fff}#imgarea{height:100%}#imgarea img{max-width:100%;max-height:100%}#imgarea img{display:none}#imgarea .show{display:block}#noimageswarning{display:none}</style><script type="application/javascript"><?php
$image_filepattern = '/^.*[.](jpg|png|gif|jpeg)$/i';
$rewrite_enabled = isset($_GET['dorewrite']);

function get_query_var($varname, $alternative) {
  return isset($_GET[$varname]) && !empty($_GET[$varname])
         ? $_GET[$varname]
         : $alternative;
}

function image_path() {
  $current_path = realpath(".");
  $dir_raw = get_query_var("dir", ".");
  $dir = htmlspecialchars($dir_raw);
  $dir_realpath = realpath($dir);

  if (strpos($dir_realpath, $current_path) === 0)
    return $dir;
  else
    return ".";
}

function is_image($fname) {
  global $image_filepattern;
  return preg_match($image_filepattern, $fname) === 1;
}

function format_filename($dir, $fname) {
  global $rewrite_enabled;
  if ($rewrite_enabled)
    $fpath = $fname;
  else
    $fpath = join('/', array($dir, $fname));
  echo "\"" . $fpath . "\"";
}

function print_directory_images($dir) {
  $filelist = array_filter(scandir($dir), "is_image");
  if (empty($filelist)) return;

  $init = array_slice($filelist, 0, count($filelist));
  $last = end($filelist);

  foreach($init as $fname) {
    echo format_filename($dir, $fname) . ",\n";
  }
  echo format_filename($dir, $last) . "\n";
}

echo "window.imagelist = [\n";

$dir = image_path();
if (!is_dir($dir)) die("];");

print_directory_images($dir);

echo "];";
?></script><script type="application/javascript">!function t(n,e,i){function o(r,a){if(!e[r]){if(!n[r]){var u="function"==typeof require&&require;if(!a&&u)return u(r,!0);if(s)return s(r,!0);throw new Error("Cannot find module '"+r+"'")}var c=e[r]={exports:{}};n[r][0].call(c.exports,function(t){var e=n[r][1][t];return o(e?e:t)},c,c.exports,t,n,e,i)}return e[r].exports}for(var s="function"==typeof require&&require,r=0;r<i.length;r++)o(i[r]);return o}({1:[function(t,n,e){function i(t){this.window=t}var o=t("./utils");i.prototype.isIE=function(){return-1!==window.navigator.appVersion.indexOf("MSIE")},i.prototype.getElementsByIds=function(t){var n=window.document;return o.mapForKeys(t,function(t){return n.getElementById(t)})},i.prototype.onLoad=function(t){var n=this.window.document;/in/.test(n.readyState)?this.isIE()?window.setTimeout(t,9):window.setTimeout(t,9,!1):this.load(t)},i.prototype.onKeyDown=function(t){r(window,"keydown",function(n){var e=t[n.keyCode];"function"==typeof e&&(e(n),n.preventDefault())})};var s=function(t,n,e){var i=function(t){e(t),t.preventDefault()};r(t,n,i)},r=function(t,n,e){t instanceof NodeList?o.forEach(t,function(t){a(t,n,e)}):a(t,n,e)},a=function(t,n,e){"function"==typeof t.addEventListener?t.addEventListener(n,e,!1):"function"==typeof t.attachEvent?t.attachEvent("on"+n,e):console.log("Failed to attach event",t)},u=function(t,n){return t.className.indexOf(n)>=0},c=function(t,n){t.className+=" "+n},l=function(t,n){var e=new RegExp("(\\s|^)"+n+"(\\s|$)");t.className=t.className.replace(e,"")},f=function(t,n){u(t,n)?l(t,n):c(t,n)},d=function(t){t&&(t.style.display="none")},h=function(t,n){"string"!=typeof n&&(n="inline"),t&&(t.style.display=n)},m=function(t){for(;t.hasChildNodes();)t.removeChild(t.lastChild)};e.DomTools=i,e.onEventNoPrevent=r,e.onEvent=s,e.hasCssClass=u,e.addCssClass=c,e.removeCssClass=l,e.toggleCssClass=f,e.hide=d,e.show=h,e.clearNode=m},{"./utils":7}],2:[function(t,n,e){function i(t,n){this.display=t,this.imageFactory=n,this.images=new o,t.addNextHandler(this.next.bind(this)),t.addPreviousHandler(this.previous.bind(this))}var o=t("./statelist").StateList;i.prototype.initialize=function(t){this.images.setList(this.createImages(t)),this.display.setImages(this.images.list),this.showCurrentImage()},i.prototype.createImages=function(t){var n=this,e=function(){n.next()},i=function(t){var i=n.imageFactory(t,e);return i.addLinkOnClick(function(){n.showImage(i)}),i};return t.map(i)},i.prototype.showImage=function(t){this.hideCurrentImage(),t.show(),this.images.setCurrentItem(t),this.setImageInfo()},i.prototype.hideCurrentImage=function(){this.images.currentItem().hide()},i.prototype.showCurrentImage=function(){this.images.currentItem().show(),this.setImageInfo()},i.prototype.next=function(){this.hideCurrentImage();var t=this.images.next();t.show(),this.setImageInfo()},i.prototype.previous=function(){this.hideCurrentImage();var t=this.images.previous();t.show(),this.setImageInfo()},i.prototype.setImageInfo=function(){var t=this.images.currentIndex+1,n=this.images.lastIndex()+1;this.display.setImageInfoHtml(t+"/"+n)},e.Gallery=i},{"./statelist":6}],3:[function(t,n,e){function i(t,n,e){this.src=n,this.text=s(n),this.image=a(t,e),this.link=r(t,this.text)}var o=t("./domtools"),s=function(t){return t.substring(t.lastIndexOf("/")+1,t.length)},r=function(t,n){var e=t.createElement("a");return e.href="#",e.appendChild(t.createTextNode(n)),e},a=function(t,n){var e=t.createElement("img");return"function"==typeof n&&(e.onclick=n),e};i.prototype.loadImage=function(){this.image.src!==this.src&&(this.image.src=this.src)},i.prototype.hide=function(){o.removeCssClass(this.image,"show"),o.removeCssClass(this.link,"show")},i.prototype.show=function(){this.loadImage(),o.addCssClass(this.image,"show"),o.addCssClass(this.link,"show")},i.prototype.setImageOnClick=function(t){this.image.onclick=t},i.prototype.addLinkOnClick=function(t){o.onEvent(this.link,"click",t)};var u=function(t){return function(n,e){return new i(t.document,n,e)}};e.Image=i,e.imageFactory=u},{"./domtools":1}],4:[function(t,n,e){var i=t("./domtools"),o=t("./utils"),s=function(t,n){o.forEach(t,function(t){t.apply(null,n)})},r=function(t){var n={},e=new i.DomTools(t),r=["imginfo","imgarea","linksarea","sidebar","toolbar"],a={},u=[],c=[];n.initialize=function(){a=e.getElementsByIds(r),l(g("next_image"),f),l(g("previous_image"),d),l(g("toggle_toolbar"),h),l(g("toggle_sidebar"),n.toggleSidebar),e.onKeyDown({32:n.toggleSidebar,37:d,39:f,72:h})};var l=function(t,n){var e=function(t){i.onEvent(t,"click",n)};t instanceof HTMLCollection?o.forEach(t,e):e(t)},f=function(){s(u)},d=function(){s(c)},h=function(){m(a.toolbar)},m=function(t){i.toggleCssClass(t,"show")},g=function(n){return t.document.getElementsByClassName(n)};n.toggleSidebar=function(){m(a.sidebar)},n.addNextHandler=function(t){u.push(t)},n.addPreviousHandler=function(t){c.push(t)},n.setImageInfoHtml=function(t){a.imginfo.innerHTML=t},n.setImages=function(t){var n=I(),e=I();o.forEach(t,function(t){n.appendChild(p(t.link)),e.appendChild(t.image)}),y(a.linksarea,n),y(a.imgarea,e)};var p=function(n){var e=t.document.createElement("li");return e.appendChild(n),e},I=function(){return t.document.createDocumentFragment()},y=function(t,n){i.clearNode(t),t.appendChild(n)};return n.showNoImagesWarning=function(){var n=t.document.getElementById("noimageswarning");i.show(n,"block")},n};e.createView=r},{"./domtools":1,"./utils":7}],5:[function(t){(function(n){var e=t("./gallery").Gallery,i=t("./instantgalleryview"),o=t("./image"),s=t("./domtools").DomTools,r=new s(n),a=o.imageFactory(n),u=i.createView(n),c=new e(u,a);r.onLoad(function(){var t=n.imagelist;t&&t.length>0?(u.initialize(),c.initialize(t),n.instantgallery=c):u.showNoImagesWarning()})}).call(null,window)},{"./domtools":1,"./gallery":2,"./image":3,"./instantgalleryview":4}],6:[function(t,n,e){function i(t){this.list=t,this.currentIndex=0}i.prototype.setList=function(t){this.list=t,this.currentIndex=0},i.prototype.currentItem=function(){return this.list[this.currentIndex]},i.prototype.next=function(){return this.setCurrentIndex(this.currentIndex+1,0),this.currentItem()},i.prototype.setCurrentIndex=function(t,n){this.currentIndex=this.isIndexOutOfBounds(t)?n:t},i.prototype.isIndexOutOfBounds=function(t){return 0>t||t>this.lastIndex()},i.prototype.lastIndex=function(){return this.list.length-1},i.prototype.previous=function(){return this.setCurrentIndex(this.currentIndex-1,this.lastIndex()),this.currentItem()},i.prototype.setCurrentItem=function(t){var n=this.list.indexOf(t);this.setCurrentIndex(n,this.currentIndex)},e.StateList=i},{}],7:[function(t,n,e){var i=function(t,n){for(var e=0;e<t.length;e++)n(t[e],e,t)},o=function(t,n){var e={};return i(t,function(t){e[t]=n(t)}),e};e.forEach=i,e.mapForKeys=o},{}]},{},[5]);</script><base target="_blank"><meta name="viewport" content="width=device-width, initial-scale=1.0"></head><body><h1 id="noimageswarning">No images found</h1><div class="hoverbar"><div class="title"><a href="#" class="toggle_sidebar"><span>Instant Gallery</span><span id="imginfo"></span></a></div><div id="sidebar"><ul class="navi"><li><a href="#" title="hotkey: H" class="toggle_toolbar">toolbar</a></li><li><a href="http://jkpl.lepovirta.org">jkpl</a></li><li><a href="http://github.com/jkpl/instantgallery">instant gallery</a></li></ul><span>Images</span><ul id="linksarea"></ul></div></div><div id="toolbar" class="show"><ul class="navi"><li><a href="#" title="hotkey: left arrow" class="previous_image">&larr;</a></li><li><a href="#" title="hotkey: right arrow" class="next_image">&rarr;</a></li><li><a href="#" title="hotkey: space" class="toggle_sidebar">list</a></li></ul></div><div id="imgarea"></div></body></html>