<?php
/**
 * Controller
 *
 * Database-driven Webtechnology Final Project
 * Heine Jan Lindemulder
 * Based on code from the assignments by Stijn Eikelboom
 */

/* Include model.php */
include 'model.php';

/* Connect to DB */
$db = connect_db('localhost', 'final_project', 'ddwt21', 'ddwt21');

/* Array with all the standard views */
$navigation_array = Array (
    1 => Array (
        'name' => 'Home',
        'url' => '/DDWT21/Final_Project/'
    ),
    2 => Array (
        'name' => 'Registration',
        'url' => '/DDWT21/Final_Project/register/'
    ),
    3 => Array (
        'name' => 'My Account',
        'url' => '/DDWT21/Final_Project/my_account/'
    ),
    4 => Array (
        'name' => 'Log-in',
        'url' => '/DDWT21/Final_Project/login/'
    ),
    5 => Array (
        'name' => 'Add room',
        'url' => '/DDWT21/Final_Project/add_room/'
    )
);

/* Home page */
if (new_route('/DDWT21/Final_Project/', 'get')) {
    /* Page info */
    $page_title = 'Home';
    $breadcrumbs = get_breadcrumbs([
        'Final Project' => na('/DDWT21/Final_Project/', False),
        'Home' => na('/DDWT21/Final_Project', True)
    ]);
    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 1);

    /* Page content */
    $page_subtitle = 'The online platform to find a room';
    $page_content = 'Kamernet 2.0';

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('main');
}

/* Register GET */
elseif (new_route('/DDWT21/Final_Project/register/', 'get')) {
    /* Page info */
    $page_title = 'Register';
    $breadcrumbs = get_breadcrumbs([
        'Final Project' => na('/DDWT21/Final_Project/', False),
        'Home' => na('/DDWT21/Final_Project', False),
        'Registration' => na('/DDWT21/Final_Project/register', True)
    ]);
    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 2);

    /* Page content */
    $page_subtitle = 'The online platform to find a room';

    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('register');
}

/* Register POST */
elseif (new_route('/DDWT21/Final_Project/register', 'post')) {
    /* Register user */
    $feedback = register_user($db, $_POST);

    /* Redirect to the correct page with an error or success message */
    if ($feedback['type'] == 'danger') {
        /* Redirect to register form */
        redirect(sprintf('/DDWT21/Final_Project/register/?error_msg=%s', json_encode($feedback)));
    }
    else {
        /* Redirect to My Account page */
        redirect(sprintf('/DDWT21/Final_Project/my_account/?error_msg=%s', json_encode($feedback)));
    }
}

/* My Account GET */
elseif (new_route('/DDWT21/Final_Project/my_account', 'get')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }

    /* Page info */
    $page_title = 'My Account';
    $breadcrumbs = get_breadcrumbs([
        'Final Project' => na('/DDWT21/Final_Project/', False),
        'Home' => na('/DDWT21/Final_Project/', False),
        'My Account' => na('/DDWT21/Final_Project/my_account/', True)
    ]);
    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 3);

    /* Page content */
    $page_subtitle = 'Your account';
    $page_content = 'Here you can see information about your account';
    $user = display_user($db, $_SESSION['user_id'])['first_name'];
    $role = display_role($db, $_SESSION['user_id']);

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('account');
}

/* Login GET */
elseif (new_route('/DDWT21/Final_Project/login', 'get')) {
    /* Page info */
    $page_title = 'Login';
    $breadcrumbs = get_breadcrumbs([
        'DDWT21' => na('/DDWT21/', False),
        'Final Project' => na('/DDWT21/Final_Project/', False),
        'Login' => na('/DDWT21/Final_Project/login', True)
    ]);
    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 4);

    /* Page content */
    $page_subtitle = 'Login to you Series Overview account';

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('login');
}

/* Login POST */
elseif (new_route('/DDWT21/Final_Project/login', 'post')) {
    /* Login user */
    $feedback = login_user($db, $_POST);

    /* Redirect to the correct page with an error or a success message */
    if ($feedback['type'] == 'danger') {
        /* Redirect to log in screen */
        redirect(sprintf('/DDWT21/Final_Project/login/?error_msg=%s', json_encode($feedback)));
    }
    else {
        /* Redirect to My Account page */
        redirect(sprintf('/DDWT21/Final_Project/my_account/?error_msg=%s', json_encode($feedback)));
    }
}

/* Logout GET */
elseif(new_route('/DDWT21/Final_Project/logout', 'get')) {
    $feedback = logout_user();
    redirect(sprintf('/DDWT21/Final_Project/?error_msg=%s', json_encode($feedback)));
}

/* Add room GET */
elseif (new_route('/DDWT21/Final_Project/add_room/', 'get')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login');
    }
    /* Check if user is owner */
    $feedback = check_owner($db);
    if (!$feedback) {
        /* Redirect to my account */
        $feedback = ['type' => 'danger', 'message' => 'You are not an owner'];
        redirect(sprintf('/DDWT21/Final_Project/my_account/?error_msg=%s', json_encode($feedback)));
    }

    /* Page info */
    $page_title = "Add room";
    $breadcrumbs = get_breadcrumbs([
        'DDWT21' => na('/DDWT21/', False),
        'Final Project' => na('/DDWT21/Final_Project', False),
        'Add room' => na('/DDWT21/Final_Project/add_room', False)
    ]);
    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 5);

    /* Page content */
    $page_subtitle = 'Here you can add a room';
    $page_content = display_role($db, $_SESSION['user_id']);

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('add_room');
}

/* Add room POST */
elseif (new_route('/DDWT21/Final_Project/add_room/', 'post')) {

}

else {
    http_response_code(404);
    echo '404 Not Found';
}