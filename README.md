# iCaptcha

[![License](http://img.shields.io/badge/License-MIT-blue.svg)](http://opensource.org/licenses/MIT)

A simple and easy to use plugin to create captcha 

- [Blog Article](http://devsfolder.mooo.com/iCaptcha)

Invite me to a coffee
[![Donate](https://www.paypalobjects.com/en_US/GB/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5RPKVPUWX2S9G)

## Introduction
This is pretty simple captcha jquery plugin

## Usage
As you can see in the example files, you will need to include:
	- [jQuery Library](http://jquery.com/)
	- Font ( suitable for your language )
	- php-gd

###Including files:
```html
	<script src="src/jquery.icaptcha.js"></script>
	
```


###Required HTML structure
Create Div Tag (`<div id="icaptcha">` in this case).
```html
<div id="icaptcha"></div>
```

###Script
After that using jquery grammer with iCaptcha plugin.

```javascript

$("#icaptcha").iCaptcha({
		path: 'src', // parent path where your captcha.php file  , if src/catcha.php then, path : 'src'
		lang:'ko'	 // language which u want there are three options ko:korean, jp:japanese, en:english 
});

```
##Contact
Please [![Email](mailto:lkp0907@email.com)] to me. 