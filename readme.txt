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

Don't forget to copy `just-theme-framework-checker.php` as well!

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

= Version 1.2.6 - 8 August 2017 =
    * Bugfix: Remove test info from helper
= Version 1.2.5 - 7 August 2017 =
    * Bugfix: Just Post Preview plugin support: templates hierarchy hook works wrong
= Version 1.2.4 - 1 August 2017 =
    * New: Added default Ajax Load More functionality
= Version 1.2.3 - 26 May 2017 =
	* Hotfix: PageBuilderWidget raise fatal error when Site Origin Widgets Bundle plugin is not installed or deactivated.
= Version 1.2.2 - 12 May 2017 =
	* Hotfix: Page Builder design options (background, borders) were missing in new version. Fixed.
= Version 1.2.1 - 12 May 2017 =
	* Improvement: Change wp hook to widgets_init for register_widget method
= Version 1.2 - 12 May 2017 =
	* Refactor: Update Page Builder classes to work with new Site Origin Page Builder 2.5+
	* New: Added version folder prefix for Page Builder to be able to have different patches inside in future.
	* New: Page Builder Row/Widget layouts changed structure to container - style container (instead of wrapper - container) to match origin Page Builder logic
	* New: Base class for quick widgets creating based on Site Origin Widgets Bundle pack
	* New: Autoptimize class has new exceptions for Wordfence plugin by default.
= Version 1.1.3 - 20 April 2017 =
	* New: Enables SVG uploads support by default
= Version 1.1.2 - 29 March 2017 =
	* Code style: Fixed code style according to latest WPCS 0.11
= Version 1.1.1 - 24 March 2017 =
	* Improvements: Support of Autoptimize plugin improved, added more hooks. Set to move jquery.js, CF7 scripts first, just before optimized cached file.
= Version 1.1 =
	* Bug fix: Allow wp-login.php when theme is active, but requirements are not met.
	* New: Support for ACF and JCF inside Models. Now you can use "field_{fieldname}" magic property or get_field() method inside models.
= Version 1.0 =
	* Our mini-framework launch.
