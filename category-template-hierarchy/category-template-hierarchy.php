<?php
/*
Plugin Name: Category Template Hierarchy
Plugin URI: eddiemoya.com
Description:  Adds two new branches to the template hierarchy, while maintaining the expected hierachical behavior that exists throughout the normal hierarchy. Includes two conditional tags: is_child_category() and is_parent_category()
Author: Eddie Moya
Version: 1.0
*/

/**
 * @todo Add is_child_of(), is_parent_of() functions, and create similarly fashioned template redirections - such that you could have a template named child-of-category-#.php
 */

class Category_Template_Hierarchy {
    
    
    /**
     * @author Eddie Moya
     * 
     * Start your engines.
     */
    function init(){
        add_action('template_redirect', array( __CLASS__,'category_relationship'), 9 );
    }
    
    /**
     * @author Eddie Moya
     * 
     * Determines the correct relationship status of a category and redirects accordingly.
     */
    function category_relationship() {

        $template_prefix = "";
  
        if (is_parent_category()) 
            $template_prefix = "parent-" . $template_prefix;
            
        if(is_child_category())
            $template_prefix = "child-"  . $template_prefix;
        
        if(is_child_category() || is_parent_category()) 
            self::template_redirect($category, $template_prefix);
        
        exit;
    }
    
    /**
     * @author Eddie Moya
     * 
     * @param type $category The category to be applied for this template.
     * @param type $template_prefix [optional] The prefix to add to the base template.
     * @param type $template [optional] The base type of template to use. This is here to allow for expansion later, which might expand upon other part of the standard TH
     */
    function template_redirect($category, $template_prefix = "", $template = "category") {
        
        $category = (empty($category )) ? get_queried_object() : $cat_id;
        $template_name = $template_prefix . $template;

        $templates = array();

        $templates[] = "{$template_name}-{$category->slug}.php";
        $templates[] = "{$template_name}-{$category->term_id}.php";
        $templates[] = "{$template_name}.php";
        $templates[] = "{$template}.php";
        $templates[] = "archive.php";
        $templates[] = "index.php";
        print_pre($templates);
        include( get_query_template($template_name, $templates));
        exit;
    }
}

Category_Template_Hierarchy::init();


/**
 * @author Eddie Moya
 * 
 * Returns true if a given category has children (e.g. is a parent).
 * 
 * @param object $category [optional] Category object. Default: Current Category
 * @return bool Returns true if category is a parent, otherwise returns false.
 */
function is_parent_category($category = null){
    if(is_category()){ 

        $is_parent = false;
        $category = (empty($category)) ? get_queried_object() : $category;
        
        
        $children = get_categories("parent={$category->term_id}&hide_empty=0");
        $is_parent = (!empty($children));
    }
    return $is_parent;
}


/**
 * @author Eddie Moya
 * 
 * Returns true if a given category has a parent (e.g. is a child).
 * 
 * @param object $category [optional] Category object. Default Current Category
 * @return bool Returns true if category has a parent, otherwise returns false.
 */
function is_child_category($category = null){
    if(is_category()){ 

        $is_child = false;
        $category = (empty($category)) ? get_queried_object() : $category;
        
        $is_child = (!empty($category->parent));
    }
    return $is_parent;
}

