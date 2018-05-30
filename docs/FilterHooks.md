Tweakr Filter Hooks
=========================


FILTER::tweakr_rewrites_custom_taxonomies
-----------------------------------------------

**Description:** Filter to modify the list of custom taxonomies which should be rewritten (.html extension)

#### Example 1 - Remove a Single Taxonomy ####

```php
function mm_taxonomies($taxonomies){
    unset $taxonomies['addon'];
    return $taxonomies;
}

// add a custom filter to modify the taxonomy list
add_filter('tweakr_rewrites_custom_taxonomies', 'mm_taxonomies');
```
