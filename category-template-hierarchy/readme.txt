=== Category Template Hierarchy ===
Contributors: eddiemoya
Donate link: http://eddiemoya.com
Tags: plugin, theme development, theme, template, hierarchy, category, template hierarchy, subcategory, parent category, child category, parent category, category template
Requires at least: unknown
Tested up to: 3.2.1
Stable tag: trunk

Adds parent-category.php & child-category.php to the template hierarchy with all the normal hierarchical behavior with conditional tags to match

== Description ==

Adds `parent-category.php` and `child-category.php` with all the normal hierarchical behavior of the native category templates. This greatly extends the natural hierarchy of theme templates with regard to categories. Theme developers can now easily create separate templates for categories with have children, the children themselves, and categories which are neither. As a happy accident to how this was written, developers can also target templates that both are a parent, and have a parent.

Also adds `is_parent_category()` and `is_child_category()` functions for easy use in themes.

== Developer Notes: Template Hierarchy ==

What follows are the lists by which the new hierarchical elements will cascade - realize that all these lists are essentially just branches off of the existing [Template Hierarchy](http://codex.wordpress.org/Template_Hierarchy#Visual_Overview).

If category has no children and has no parent (stand-alone category):
  
* `category-{slug}.php`
* `category-{term_id}.php`
* `category.php`
* `archive.php`
* `index.php`
  
If category is a parent (has children):
  
* parent-category-{slug}.php
* parent-category-{term_id}.php
* parent-category.php
* category.php
* archive.php
* index.php

If category is a child (has a parent):
  
* child-category-{slug}.php
* child-category-{term_id}.php
* child-category.php
* category.php
* archive.php
* index.php


Additionally, as a happy accident, you can also target categories that are both parents and children:

* parent-child-category-{slug}.php
* parent-child-category-{term_id}.php
* parent-child-category.php
* parent-category.php
* archive.php
* index.php


== Developer Notes: Condional Tags ==

With this plugin comes two additional [conditional tags](http://codex.wordpress.org/Conditional_Tags) which behave much like any other in WordPress. In a similar fashion to how one might use [is_category()](http://codex.wordpress.org/Function_Reference/is_category), developers may, with this plugin, use the following functions:


`is_parent_category()`
`is_child_category()`

= Description =
These conditional tags checks if the page being displayed is for hierarchical category that has children (e.g. is a parent category), or has a parent (is a child) respectively. They are boolean functions, meaning they return either TRUE or FALSE.

= Usage =
`<?php is_parent_category( $category ); ?>`
`<?php is_child_category( $category ); ?>`


= Parameters =

$category (integer/string/object) (optional) Category ID, Category Slug, Category Object. Default: Current Category

Note: Unlike is_category(), these functions will not take arrays of categories or category titles. I'll work on that. Sorry.

= Return Values =
(boolean) True on success, false on failure.

= Examples =
`
is_parent_category()
is_child_category()
// When any parent/child category archive page is being displayed

is_parent_category( '9' );
is_child_category( '9' );
// When the archive page for Category 9 is being displayed AND its a parent/child.

is_parent_category( 'blue-cheese' );
is_child_category( 'blue-cheese' );
// When the archive page for the Category with Category Slug "blue-cheese" is being displayed AND its a parent/child.
`

= Notes =
* Clearly there is a need to have is_child_category_of() and is_parent_category_of(). They will be made available in future releases.



== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==

= Do you have any Frequently Asked Questions? =

No.

= Why not? =

Because I only just recently released the plugin. I feel that I've done a decent job of documentation, so I can't guess what people may ask on this broadly applicable plugin.

= Can I ask you a question =

Please do! Feel free to ask on the tools provided right in the WordPress plugin directory, or on my website [eddiemoya.com](http://eddiemoya.com/)
No, plugins are not loaded during installation. For alternative solutions see 
"Other manifestations, alternative solutions" on the plugin home page.