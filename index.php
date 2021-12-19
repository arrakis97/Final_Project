<?php
/**
 * Controller
 *
 * Database-driven Webtechnology Final Project
 * Heine Jan Lindemulder
 * Based on code from the assignments
 */

/* Include model.php */
include 'model.php';

/* Connect to DB */
$db = connect_db('localhost', 'final_project', 'ddwt21', 'ddwt21');

/* Array with all the standard views */
$navigation_array = Array (
    1 => Array (
        'name' => 'Home',
        'url' => '/Final_Project/'
    ),
    2 => Array (
        'name' => 'Overview',
        'url' => '/Final_Project/overview/'
    ),
    3 => Array (
        'name' => 'Add series',
        'url' => '/Final_Project/add/'
    ),
    4 => Array (
        'name' => 'My Account',
        'url' => '/Final_Project/myaccount/'
    ),
    5 => Array (
        'name' => 'Registration',
        'url' => '/Final_Project/register/'
    )
);

/* Home page */
if (new_route('/Final_Project/', 'get')) {
    /* Page info */
    $page_title = "Home";
    $breadcrumbs = get_breadcrumbs([
        'Final Project' => na('/Final_Project/', False),
        'Home' => na('/Final_Project', True)
    ]);
    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 1);

    /* Page content */
    $page_subtitle = 'The online platform to list your favorite series';
    $page_content = 'On Series Overview you can list your favorite series. You can see the favorite series of all Series Overview users. By sharing your favorite series, you can get inspired by others and explore new series.';

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }


    include use_template('main');
}
