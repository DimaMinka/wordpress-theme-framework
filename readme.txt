=== Just Theme Framework === 
Contributors: aprokopenko
Description: Lightweight MVC theming framework for developers who want to better organize their own custom themes with an MVC approach.
Tags: mvc theme, theme boilerplate, oop theme, mini framework
Author: JustCoded / Alex Prokopenko
Author URI: http://justcoded.com/
Requires at least: 4.7
Tested up to: 4.7.3
License: GPL3
Stable tag: trunk

Lightweight MVC theming framework for developers who want to better organize their own custom themes with an MVC approach.

== Description ==

Just Theme Framework is a lightweight MVC theming framework for developers who want to better organize their own custom
themes with an MVC approach.

Our mini framework features:

* Better organized templates system.
* Easy Post Types or Taxonomies registration.
* Base Model class.
* Advanced Theme registration class.
* Easy creation of Admin options pages.
* Supports numerous plugins:
	* WooCommerce
	* Autoptimize, WP Super Cache (easy customization of scripts optimization)
	* Contact Form 7 (auto save all requests to DB)
	* Just Custom Fields
	* Just TinyMce Custom Styles
	* Just Responsive Images

We didn't added "Controllers" level, because WordPress has it's own routing system and replacing it with one more level
	will impact the site speed. So basically it's very close to standard WordPress theme with much better organization
	of custom logic parts, custom queries etc.

= Better organized templates system =

You can now place all templates under "views" folder with section-by-section break down. Search your templates easily
under `page`, `post`, `search` folders. Or create new folder for your new Custom Post type and place all your templates
there.

Modern layouts system, taken from Laravel and Yii PHP Frameworks. Under `views` folder you can have different
nested `layouts` to keep header and footer in the same place. All repeatable wrappers from section templates can be moved
just as a new layout.

The template system is patched with standard WordPress hooks, which were added in version 4.7. We support all WordPress
standard template hierarchy. Our patch just adds `/views/{section}` prefix to the list of available templates.

= Easy Post Types or Taxonomies registration =

Use our base PostType or Taxonomy class to register your own Post Types or Taxonomies. It has more intuitive options;
built-in support for redirects, if you don't need a single page.

A lot of registered constants simplify the development, because your IDE will help you to set correct supports values,
post statuses or order by values in WP_Query.

= Base Model class =

Base Model class has wrappers for WP_Query, which works correctly with Custom Archives of Custom Post Types.
Standard custom archives doesn't have pagination, if you want to print them manually.

= Advanced Theme registration class =

Nice organized Theme registration class, which has a lot of hooks to patch standard WordPress installation with better
security and SEO optimizations.

= Easy creation of Admin options pages =
Built in wrapper for Titan Framework to rapidly build Admin option pages

= Theme Build Example =
You can find theme build example in plugin folder under "themes" folder.

= Have a feedback? =
Write to us on our github repository:
https://github.com/justcoded/just-theme-framework

== Installation ==

1. Download, unzip and upload to your WordPress plugins directory
2. Download, unzip and upload Titan Framework (https://wordpress.org/plugins/titan-framework/) plugin to your WordPress plugins directory
3. Activate Just Theme Framework and Titan Framework plugins within you WordPress Administration Backend
4. Copy `just-theme-framework-checker.php` file from plugin directory to your theme's root and include it at the top of your theme `functions.php` file.
5. You are okay now to start using the framework.

== Upgrade Notice ==

To upgrade remove the old plugin folder. After than follow the installation steps 1-2.

== Changelog ==

= Version 1.0 =
	* Our mini-framework launch.
