<?php
/**
 * Controller
 *
 * Database-driven Webtechnology Final Project
 * Heine Jan Lindemulder
 * Based on code from the assignments by Stijn Eikelboom
 * The SVG icons were taken from the Bootstrap icons site
 */

/* Include model.php */
include 'model.php';

/* Connect to DB */
$db = connect_db('localhost', 'final_project', 'ddwt21', 'ddwt21');

/* Array with all the standard views */
$navigation_array = Array (
    1 => Array (
        'name' => 'Home',
        'url' => '/DDWT21/Final_Project/',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-building" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M14.763.075A.5.5 0 0 1 15 .5v15a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5V14h-1v1.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V10a.5.5 0 0 1 .342-.474L6 7.64V4.5a.5.5 0 0 1 .276-.447l8-4a.5.5 0 0 1 .487.022zM6 8.694 1 10.36V15h5V8.694zM7 15h2v-1.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 .5.5V15h2V1.309l-7 3.5V15z"/>
                    <path d="M2 11h1v1H2v-1zm2 0h1v1H4v-1zm-2 2h1v1H2v-1zm2 0h1v1H4v-1zm4-4h1v1H8V9zm2 0h1v1h-1V9zm-2 2h1v1H8v-1zm2 0h1v1h-1v-1zm2-2h1v1h-1V9zm0 2h1v1h-1v-1zM8 7h1v1H8V7zm2 0h1v1h-1V7zm2 0h1v1h-1V7zM8 5h1v1H8V5zm2 0h1v1h-1V5zm2 0h1v1h-1V5zm0-2h1v1h-1V3z"/>
                    </svg>'
    ),
    2 => Array (
        'name' => 'Register',
        'url' => '/DDWT21/Final_Project/register/',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                    <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5z"/>
                    </svg>'
    ),
    3 => Array (
        'name' => 'Log-in',
        'url' => '/DDWT21/Final_Project/login/',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-lock-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 1.5 0 0 1 8 5z"/>
                    </svg>'
    ),
    4 => Array (
        'name' => 'My Account',
        'url' => '/DDWT21/Final_Project/my_account/',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                    </svg>'
    ),
    5 => Array (
        'name' => 'Add room',
        'url' => '/DDWT21/Final_Project/add_room/',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
                    </svg>'
    ),
    6 => Array (
        'name' => 'View rooms',
        'url' => '/DDWT21/Final_Project/view_rooms/',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6zm5-.793V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
                    <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
                    </svg>'
    ),
    7 => Array (
        'name' => 'Messages',
        'url' => '/DDWT21/Final_Project/messages_overview/',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z"/>
                    </svg>'
    )
);

$header_picture = '<img src="/DDWT21/Final_Project/views/pictures/skyline.jpg" style="width: 100%">';

$nr_rooms = total_rooms($db);

/* Home page */
if (new_route('/DDWT21/Final_Project/', 'get')) {
    /* Page info */
    $page_title = 'Groningen-Net';
    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 1);

    /* Page content */
    $page_subtitle = 'The online platform for connecting owners and tenants';

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('home_text');
}

/* Register GET */
elseif (new_route('/DDWT21/Final_Project/register/', 'get')) {
    /* Page info */
    $page_title = 'Register';
    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 2);

    /* Page content */
    $page_content = 'Here you can register for Groningen-Net';
    $submit_button = 'Register now';
    $form_action = '/DDWT21/Final_Project/register/';

    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('register');
}

/* Register POST */
elseif (new_route('/DDWT21/Final_Project/register/', 'post')) {
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
elseif (new_route('/DDWT21/Final_Project/my_account/', 'get')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }

    $user_id = $_SESSION['user_id'];

    /* Page info */
    $page_title = 'My Account';
    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 4);

    /* Page content */
    if (check_owner($db)) {
        $page_content = 'This is the homepage of your account. From here you can logout, edit your profile and check your opt-ins.';
    }
    else {
        $page_content = 'This is the homepage of your account. From here you can logout, edit your profile and add a room.';
    }
    $user = display_user($db, $user_id)['first_name'];

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('account');
}

/* Login GET */
elseif (new_route('/DDWT21/Final_Project/login/', 'get')) {
    /* Page info */
    $page_title = 'Login';
    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 3);

    /* Page content */
    $page_subtitle = 'Login to you Groningen-Net account';

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('login');
}

/* Login POST */
elseif (new_route('/DDWT21/Final_Project/login/', 'post')) {
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
elseif(new_route('/DDWT21/Final_Project/logout/', 'get')) {
    $feedback = logout_user();
    redirect(sprintf('/DDWT21/Final_Project/?error_msg=%s', json_encode($feedback)));
}

/* Add room GET */
elseif (new_route('/DDWT21/Final_Project/add_room/', 'get')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }
    /* Check if user is owner */
    $feedback = check_owner($db);
    if (!$feedback) {
        /* Redirect to my account */
        $feedback = ['type' => 'danger', 'message' => 'You are not an owner.'];
        redirect(sprintf('/DDWT21/Final_Project/my_account/?error_msg=%s', json_encode($feedback)));
    }

    $display_buttons = True;

    /* Page info */
    $page_title = 'Add room';
    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 5);

    /* Page content */
    $page_subtitle = 'Here you can add a room';
    $submit_button = 'Add your room';
    $form_action = '/DDWT21/Final_Project/add_room/';

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('add_room');
}

/* Add room POST */
elseif (new_route('/DDWT21/Final_Project/add_room/', 'post')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }

    /* Add room */
    $feedback = add_room($db, $_POST);
    $error_msg = get_error($feedback);

    /* Redirect to the correct page with an error or success message */
    if ($feedback['type'] == 'danger') {
        redirect(sprintf('/DDWT21/Final_Project/add_room/?error_msg=%s', json_encode($feedback)));
    }
    else {
        redirect(sprintf('/DDWT21/Final_Project/view_rooms/?error_msg=%s', json_encode($feedback)));
    }

    /* Choose template */
    include use_template('add_room');
}

/* View rooms GET */
elseif (new_route('/DDWT21/Final_Project/view_rooms/', 'get')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }

    /* Page info */
    $page_title = 'View rooms';
    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 6);

    /* Page content */
    $page_subtitle = 'The overview of all available rooms';
    $page_content = 'Here you can find all rooms available on Groningen-Net';
    if (check_owner($db)) {
        $rooms = get_rooms_owner($db, $_SESSION['user_id']);
        if (empty($rooms)) {
            $left_content = '<b>You have not added any rooms yet.</b>';
        }
        else {
            $left_content = get_rooms_table($db, $rooms);
        }
    }
    else {
        $rooms = get_rooms($db);
        if (empty($rooms)) {
            $left_content = '<b>There are no available rooms.</b>';
        }
        else {
            $left_content = get_rooms_table($db, $rooms);
        }
    }

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('main');
}

/* Single room GET */
elseif (new_route('/DDWT21/Final_Project/room/', 'get')) {
    session_start();
    /* Get room info from database */
    $room_id = $_GET['room_id'];
    $room_info = get_room_info($db, $room_id);

    /* Check if currently logged-in user is owner of the room */
    $display_buttons = $room_info['owner'] == $_SESSION['user_id'];

    /* Page info */
    $page_title = $room_info['street_name'] . ' ' . $room_info['house_number'] . $room_info['addition'] . ', ' . $room_info['city'];

    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 0);

    /* Page content */
    $page_subtitle = 'View information about this specific room';
    $page_content = $room_info['general_info'];

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('single_room');
}

/* Edit room GET */
elseif (new_route('/DDWT21/Final_Project/edit_room/', 'get')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }

    /* Get room info from database */
    $room_id = $_GET['room_id'];
    $room_info = get_room_info($db, $room_id);

    /* Check if currently logged-in user is owner of the room */
    $display_buttons = $room_info['owner'] == $_SESSION['user_id'];

    /* Page info */
    $page_title = 'Edit your room';

    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 0);

    /* Page content */
    $page_subtitle = 'Edit ' . $room_info['street_name'] . ' ' . $room_info['house_number'] .  $room_info['addition'] . ', ' . $room_info['city'];
    $page_content = 'Edit the room below';
    $submit_button = 'Edit room';
    $form_action = '/DDWT21/Final_Project/edit_room/';

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('add_room');
}

/* Edit room POST */
elseif (new_route('/DDWT21/Final_Project/edit_room/', 'post')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }

    /* Update room in database */
    $feedback = update_room($db, $_POST);
    $error_msg = get_error($feedback);

    /* Redirect to the correct page with an error or success message */
    if ($feedback['type'] == 'danger') {
        redirect(sprintf('/DDWT21/Final_Project/edit_room/?error_msg=%s&room_id=%s', json_encode($feedback), $_POST['room_id']));
    }
    else {
        redirect(sprintf('/DDWT21/Final_Project/room/?error_msg=%s&room_id=%s', json_encode($feedback), $_POST['room_id']));
    }

    /* Choose template */
    include use_template('single_room');
}

/* Remove room POST */
elseif (new_route('/DDWT21/Final_Project/remove_room/', 'post')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }

    /* Get room info */
    $room_id = $_POST['room_id'];
    $room_info = get_room_info($db, $room_id);

    /* Check if currently active user is owner of the room */
    if ($_SESSION['user_id'] != $room_info['owner']) {
        $feedback = ['type' => 'danger', 'message' => 'You are not the owner of this room.'];
        redirect(sprintf('/DDWT21/Final_Project/my_account/?error_msg=%s', json_encode($feedback)));
    }

    /* Remove room from database */
    $feedback = remove_room($db, $room_id);
    $error_msg = get_error($feedback);

    /* Redirect to the correct page with an error or success message */
    redirect(sprintf('/DDWT21/Final_Project/view_rooms/?error_msg=%s', json_encode($feedback)));
}

/* Opt-in to room POST */
elseif (new_route('/DDWT21/Final_Project/opt-in/', 'post')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }

    /* Opt-in to room */
    $feedback = opt_in($db, $_POST['room_id'], $_POST['user_id']);
    $error_msg = get_error($feedback);

    /* Redirect to the correct page with an error or success message */
    if ($feedback['type'] == 'danger') {
        redirect(sprintf('/DDWT21/Final_Project/room/?error_msg=%s&room_id=%s', json_encode($feedback), $_POST['room_id']));
    }
    else {
        redirect(sprintf('/DDWT21/Final_Project/my_account/?error_msg=%s', json_encode($feedback)));
    }
}

/* Opt-out of room POST */
elseif (new_route('/DDWT21/Final_Project/opt-out/', 'post')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }

    /* Opt-out of room */
    $feedback = opt_out($db, $_POST['room_id'], $_POST['user_id']);
    $error_msg = get_error($feedback);

    /* Redirect to the correct page with an error or success message */
    if ($feedback['type'] == 'danger') {
        redirect(sprintf('/DDWT21/Final_Project/room/?error_msg=%s&room_id=%s', json_encode($feedback), $_POST['room_id']));
    }
    else {
        redirect(sprintf('/DDWT21/Final_Project/my_account/?error_msg=%s', json_encode($feedback)));
    }
}

/* Check opt-ins for tenant GET */
elseif (new_route('/DDWT21/Final_Project/opt-ins/', 'get')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }
    /* Check if the user is a tenant */
    if (check_owner($db)) {
        redirect('/DDWT21/Final_Project/view_rooms/');
    }

    /* Page info */
    $page_title = 'Opt-ins';
    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 0);

    /* Page content */
    $page_subtitle = 'The overview of all your opt-ins.';
    $page_content = 'Here you can find all the rooms that you have opted-in to.';

    $rooms = get_rooms($db);
    if (empty($rooms)) {
        $left_content = '<b>There are no rooms you have opted in to yet.</b>';
    }
    else {
        $left_content = tenant_opt_in_table($db, $_SESSION['user_id']);
    }

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('main');
}

/* Check opt-ins for owner GET */
elseif (new_route('/DDWT21/Final_Project/room_opt-ins/', 'get')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }
    /* Check if the user is an owner */
    if (!check_owner($db)) {
        redirect('/DDWT21/Final_Project/opt-ins/');
    }

    $room_id = $_GET['room_id'];
    $room_info = get_room_info($db, $room_id);

    /* Check if currently logged-in user is owner of the room */
    if ($room_info['owner'] != $_SESSION['user_id']) {
        $feedback = ['type' => 'danger', 'message' => 'You are not the owner of this room.'];
        redirect(sprintf('/DDWT21/Final_Project/view_rooms/?error_msg=%s', json_encode($feedback)));
    }

    $address = room_address($db, $room_id);

    /* Page info */
    $page_title = 'Opt-ins for ' . $address['street_name'] . ' ' . $address['house_number'] . $address['addition'] . ', ' . $address['city'];
    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 0);

    /* Page content */
    $page_subtitle = 'The overview of all opt-ins for this room.';
    $page_content = 'Here you can see who has opted in to your room and you can check out their profile or send them a message.';

    if (check_room_interest($db, $room_id)) {
        $left_content = owner_opt_in_table($db, $room_id);
    }
    else {
        $left_content = '<b>No one has opted in yet.</b>';
    }

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('main');
}

/* View profile GET */
elseif (new_route('/DDWT21/Final_Project/view_profile/', 'get')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }

    /* Check if the viewer is either the user self or the owner of a room the user opted in to */
    $current_user = $_SESSION['user_id'];
    $user_profile = $_GET['user_id'];

    if ($current_user != $user_profile) {
        if (display_role($db, $current_user) == 'Tenant') {
            if (display_role($db, $user_profile) == 'Tenant') {
                $feedback = ['type' => 'danger', 'message' => 'You are not allowed to see the user profiles of other tenants.'];
                redirect(sprintf('/DDWT21/Final_Project/my_account/?error_msg=%s', json_encode($feedback)));
            }
            else {
                $rooms = get_rooms_owner($db, $user_profile);
                if (empty($rooms)) {
                    $feedback = ['type' => 'danger', 'message' => 'This owner does not offer any rooms and you cannot see their profile.'];
                    redirect(sprintf('/DDWT21/Final_Project/my_account/?error_msg=%s', json_encode($feedback)));
                }
                $send_message = True;
            }
        }
        else {
            if (display_role($db, $user_profile) == 'Owner') {
                $feedback = ['type' => 'danger', 'message' => 'You are not allowed to see the user profiles of other owners.'];
                redirect(sprintf('/DDWT21/Final_Project/my_account/?error_msg=%s', json_encode($feedback)));
            }
            else {
                if (!check_owner_tenant($db, $current_user, $user_profile)) {
                    $feedback = ['type' => 'danger', 'message' => 'This tenant has not opted in to one of your rooms and you cannot see their profile.'];
                    redirect(sprintf('/DDWT21/Final_Project/my_account/?error_msg=%s', json_encode($feedback)));
                }
                $send_message = True;
            }
        }
    }

    /* Get profile info from database */
    $user_info = get_profile_info($db, $user_profile);

    /* Check if currently logged-in user is owner of the profile */
    $display_buttons = $current_user == $user_profile;

    /* Page info */
    $page_title = 'View profile';

    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 0);

    /* Page content */
    $page_subtitle = 'This is the profile of '.$user_info['first_name'] . ' ' . $user_info['last_name'];
    $page_content = $user_info['biography'];

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('single_profile');
}

/* Edit profile GET */
elseif (new_route('/DDWT21/Final_Project/edit_profile/', 'get')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }

    /* Check if the one trying to edit the room is the owner of the profile */
    $current_user = $_SESSION['user_id'];
    $user_profile = $_GET['user_id'];
    if ($current_user != $user_profile) {
        $display_buttons = False;
        $feedback = ['type' => 'danger', 'message' => 'You are not allowed to edit the user profile of others.'];
        redirect(sprintf('/DDWT21/Final_Project/my_account/?error_msg=%s', json_encode($feedback)));
    }
    $display_buttons = True;

    /* Get profile info from database */
    $user_info = get_profile_info($db, $user_profile);

    /* Page info */
    $page_title = 'Edit your profile';

    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 0);

    /* Page content */
    $page_subtitle = $user_info['first_name'] . ' ' . $user_info['last_name'] . ', here you can edit your own profile';
    $page_content = 'Edit the profile below';
    $submit_button = 'Edit profile';
    $form_action = '/DDWT21/Final_Project/edit_profile/';

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    /* Choose template */
    include use_template('register');
}

/* Edit profile POST */
elseif (new_route('/DDWT21/Final_Project/edit_profile/', 'post')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }

    /* Edit profile */
    $feedback = update_profile($db, $_POST);
    $error_msg = get_error($feedback);

    /* Redirect to the correct page with an error or success message */
    if ($feedback['type'] == 'danger') {
        redirect(sprintf('/DDWT21/Final_Project/edit_profile/?error_msg=%s&user_id=%s', json_encode($feedback), $_POST['user_id']));
    }
    else {
        redirect(sprintf('/DDWT21/Final_Project/view_profile/?error_msg=%s&user_id=%s', json_encode($feedback), $_POST['user_id']));
    }
}

/* Remove profile POST */
elseif (new_route('/DDWT21/Final_Project/remove_profile/', 'post')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }

    /* Get user id */
    $user_id = $_POST['user_id'];

    if ($_SESSION['user_id'] != $user_id) {
        $feedback = ['type' => 'danger', 'message' => 'You are not the owner of this profile.'];
        redirect(sprintf('/DDWT21/Final_Project/my_account/?error_msg=%s', json_encode($feedback)));
    }

    /* Delete profile */
    $feedback = remove_profile($db, $user_id);
    $error_msg = get_error($feedback);

    /* Redirect to the correct page with an error or success message */
    if ($feedback['type'] == 'success') {
        redirect(sprintf('/DDWT21/Final_Project/?error_msg=%s', json_encode($feedback)));
    }
    else {
        redirect(sprintf('/DDWT21/Final_Project/my_account/?error_msg=%s', json_encode($feedback)));
    }
}

/* Messages overview GET */
elseif (new_route('/DDWT21/Final_Project/messages_overview/', 'get')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }

    /* Page info */
    $page_title = 'Messages';

    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 7);

    /* Page content */
    $page_subtitle = 'The overview of all people you have messaged with';
    $page_content = 'Click on the \'View conversation\' button to see more';
    $messages_overview = inbox($db, $_SESSION['user_id']);

    if (empty($messages_overview)) {
        $left_content = '<b>You have not started any conversations yet</b>';
    }
    else {
        $left_content = messages_overview_table($messages_overview);
    }

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('main');
}

/* View single conversation GET */
elseif (new_route('/DDWT21/Final_Project/conversation/', 'get')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }

    $user1 = $_GET['user1'];
    $user2 = $_GET['user2'];
    $current_user = $_SESSION['user_id'];
    if ($current_user != $user1 AND $current_user != $user2) {
        $feedback = ['type' => 'danger', 'message' => 'You are not a participator in this conversation.'];
        redirect(sprintf('/DDWT21/Final_Project/messages_overview/?error_msg=%s', json_encode($feedback)));
    }

    if ($_SESSION['user_id'] == $user1) {
        $inactive_user = $user2;
    }
    else {
        $inactive_user = $user1;
    }
    $inactive_user_info = get_profile_info($db, $inactive_user);

    /* Page info */
    $page_title = 'Messages';

    /* Check which page is the active page */
    $navigation = get_navigation($navigation_array, 7);

    $messages_table = conversation_table($db, $user1, $user2);

    /* Check if an error message is set and display it if available */
    if (isset($_GET['error_msg'])) {
        $error_msg = get_error($_GET['error_msg']);
    }

    include use_template('chat');
}

/* Send message POST */
elseif (new_route('/DDWT21/Final_Project/send_message/', 'post')) {
    /* Check if logged in */
    if (!check_login()) {
        redirect('/DDWT21/Final_Project/login/');
    }

    $feedback = send_message($db, $_POST);
    $error_msg = get_error($feedback);

    redirect(sprintf('/DDWT21/Final_Project/conversation/?error_msg=%s&user1=%s&user2=%s', json_encode($feedback), $_POST['sender'], $_POST['receiver']));
}

else {
    http_response_code(404);
    echo '404 Not Found';
}