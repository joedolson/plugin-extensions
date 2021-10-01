# Joe Dolson: Plug-in Extensions

How to use these references:

Every file in this repository can be installed as a plug-in. When installed, it'll perform some action that modifies or extends the behavior of one of my other plug-ins. The files are grouped into folders that should make it clear which plug-in they pertain to. 

To install:

* Cut and paste the code into a new file.
* Save that file with whatever name works for you, making whatever changes you need.
* Upload the file into /wp-content/plug-ins/
* Go to WordPress > Plugins and activate it. 

With plug-ins that have premium extensions, such as WP Tweets PRO for WP to Twitter, some extensions only work when the premium add-on is also installed. 

# What makes it a plugin?

The header block is a section of comments that describe the plugin, and are used to identify that this is a plugin. A header block will look something like this:

```
Plugin Name: Name of my Custom Plugin
Plugin URI: http://www.joedolson.com
Description: Describe what this plug-in does
Author: Joe Dolson
Version: 1.0.0
Author URI: http://www.joedolson.com/
```

Any PHP file in the `/wp-content/` directory that has this comment will be recognized as a plug-in.

The plug-ins in this repository are simple examples. They don't have options or settings, they are examples for manipulating the filters and actions in my plugins to customize their functionality. In most cases, you'll need to edit the code to change how they operate.

Thanks!
