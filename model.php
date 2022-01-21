<?php
/**
 * Model
 *
 * Database-driven Webtechnology Final Project
 * Heine Jan Lindemulder
 * Based on code from the assignments by Stijn Eikelboom
 */

/* Enable error reporting */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/**
 * Connects to the database using PDO
 * @param string $host Database host
 * @param string $db Database name
 * @param string $user Database user
 * @param string $pass Database password
 * @return PDO Database object
 */
function connect_db($host, $db, $user, $pass){
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (PDOException $e) {
        echo sprintf("Failed to connect. %s",$e->getMessage());
    }
    return $pdo;
}

/**
 * Check if the route exists
 * @param string $route_uri URI to be matched
 * @param string $request_type Request method
 * @return bool
 */
function new_route($route_uri, $request_type){
    $route_uri_expl = array_filter(explode('/', $route_uri));
    $current_path_expl = array_filter(explode('/',parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)));
    if ($route_uri_expl == $current_path_expl && $_SERVER['REQUEST_METHOD'] == strtoupper($request_type)) {
        return True;
    } else {
        return False;
    }
}

/**
 * Creates a new navigation array item using URL and active status
 * @param string $url The URL of the navigation item
 * @param bool $active Set the navigation item to active or inactive
 * @return array
 */
function na($url, $active){
    return [$url, $active];
}

/**
 * Creates filename to the template
 * @param string $template Filename of the template without extension
 * @return string
 */
function use_template($template){
    $template_doc = sprintf("views/%s.php", $template);
    return $template_doc;
}

/**
 * Creates breadcrumb HTML code using given array
 * @param array $breadcrumbs Array with as Key the page name and as Value the corresponding URL
 * @return string HTML code that represents the breadcrumbs
 */
function get_breadcrumbs($breadcrumbs) {
    $breadcrumbs_exp = '
    <nav aria-label="breadcrumb">
    <ol class="breadcrumb">';
    foreach ($breadcrumbs as $name => $info) {
        if ($info[1]){
            $breadcrumbs_exp .= '<li class="breadcrumb-item active" aria-current="page">'.$name.'</li>';
        }else{
            $breadcrumbs_exp .= '<li class="breadcrumb-item"><a href="'.$info[0].'">'.$name.'</a></li>';
        }
    }
    $breadcrumbs_exp .= '
    </ol>
    </nav>';
    return $breadcrumbs_exp;
}

/**
 * Creates navigation HTML code using given array
 * @param $template Array with page names and URL's
 * @param $active_id ID of the current active page
 * @return string HTML code that represents the navigation
 */
function get_navigation($template, $active_id){
    $navigation_exp = '
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">Kamernet 2.0</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">';
    foreach ($template as $name => $info) {
        if ($name == $active_id){
            $navigation_exp .= '<li class="nav-item active">';
            $navigation_exp .= '<a class="nav-link" href="'.$info['url'].'">'.$info['name'].'</a>';
        }else{
            $navigation_exp .= '<li class="nav-item">';
            $navigation_exp .= '<a class="nav-link" href="'.$info['url'].'">'.$info['name'].'</a>';
        }

        $navigation_exp .= '</li>';
    }
    $navigation_exp .= '
    </ul>
    </div>
    </nav>';
    return $navigation_exp;
}

/**
 * Changes the HTTP Header to a given location
 * @param string $location Location to redirect to
 */
function redirect($location){
    header(sprintf('Location: %s', $location));
    die();
}

/**
 * Creates HTML alert code with information about the success or failure
 * @param array $feedback Associative array with keys type and message
 * @return string
 */
function get_error($feedback){
    $feedback = json_decode($feedback, true);
    $error_exp = '
        <div class="alert alert-'.$feedback['type'].'" role="alert">
            '.$feedback['message'].'
        </div>';
    return $error_exp;
}

/**
 * Pretty Print Array
 * @param $input
 */
function p_print($input){
    echo '<pre>';
    print_r($input);
    echo '</pre>';
}

/**
 * Find the first and last name of a user
 * @param PDO $pdo Database
 * @param int $user_id User ID for which you want to find the name
 * @return array Contains first and last name of a user
 */
function display_user($pdo, $user_id) {
    $stmt = $pdo->prepare('SELECT first_name, last_name FROM users WHERE id = ?');
    $stmt->execute([$user_id]);
    $user_name = $stmt->fetch();
    return $user_name;
}

function display_role($pdo, $user_id) {
    $stmt = $pdo->prepare('SELECT role FROM users WHERE id = ?');
    $stmt->execute([$user_id]);
    $user_role = $stmt->fetch();
    return $user_role['role'];
}

/**
 * Register a user in the database
 * @param PDO $pdo Database
 * @param Array $form_data Data filled in by a user
 * @return array|string[]
 */
function register_user($pdo, $form_data) {
    /* Check if all fields are set */
    if (
        empty($form_data['username']) or
        empty($form_data['password']) or
        empty($form_data['first_name']) or
        empty($form_data['last_name']) or
        empty($form_data['role']) or
        empty($form_data['birthdate']) or
        empty($form_data['phone_number']) or
        empty($form_data['email']) or
        empty($form_data['language']) or
        empty($form_data['occupation'])
    ) {
        return [
            'type' => 'danger',
            'message' => 'You should fill in everything.'
        ];
    }

    /* Check if user already exists */
    try {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$form_data['username']]);
        $user_exists = $stmt->rowCount();
    }
    catch (PDOException $e) {
        return [
            'type' => 'danger',
            'message' => sprintf('There was an error: %s', $e->getMessage())
        ];
    }

    /* Check if e-mail is already in use */
    try {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$form_data['email']]);
        $email_exists = $stmt->rowCount();
    }
    catch (PDOException $e) {
        return [
            'type' => 'danger',
            'message' => sprintf('There was an error: %s', $e->getMessage())
        ];
    }

    /* Return error message for existing username */
    if (!empty($user_exists)) {
        return [
            'type' => 'danger',
            'message' => 'The username you entered exists already.'
        ];
    }

    /* Return error message for email already in use */
    if (!empty($email_exists)) {
        return [
            'type' => 'danger',
            'message' => 'There exists an account already with this e-mail.'
        ];
    }

    /* Hash password */
    $password = password_hash($form_data['password'], PASSWORD_DEFAULT);

    /* Save user to the database */
    try {
        $stmt = $pdo->prepare('INSERT INTO users (username, password, first_name, last_name, role, birthdate, phone_number, 
                   email, language, occupation, biography) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $form_data['username'],
            $password,
            $form_data['first_name'],
            $form_data['last_name'],
            $form_data['role'],
            $form_data['birthdate'],
            $form_data['phone_number'],
            $form_data['email'],
            $form_data['language'],
            $form_data['occupation'],
            $form_data['biography']
        ]);
        $user_id = $pdo->lastInsertId();
    }
    catch (PDOException $e) {
        return [
            'type' => 'danger',
            'message' => sprintf('There was an error: %s', $e->getMessage())
        ];
    }

    /* Login user */
    session_start();
    $_SESSION['user_id'] = $user_id;
    return [
        'type' => 'success',
        'message' => sprintf('%s, your account was successfully created!', display_user($pdo, $_SESSION['user_id'])['first_name'])
    ];
}

/**
 * Check if a user is logged in
 * @return bool
 */
function check_login () {
    session_start();
    if (isset($_SESSION['user_id'])) {
        return True;
    }
    else {
        return False;
    }
}

function check_owner($pdo) {
    if (display_role($pdo, $_SESSION['user_id']) == 'Owner') {
        return True;
    }
    else {
        return False;
    }
}

/**
 * Login a user
 * @param PDO $pdo Database
 * @param Array $form_data Data filled in by the user
 * @return array|string[]
 */
function login_user ($pdo, $form_data) {
    /* Check if all fields are set */
    if (
        empty($form_data['username']) or
        empty($form_data['password'])
    ) {
        return [
            'type' => 'danger',
            'message' => 'You should enter a username and password.'
        ];
    }

    /* Check if user exists */
    try {
        $stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
        $stmt->execute([$form_data['username']]);
        $user_info = $stmt->fetch();
    }
    catch (PDOException $e) {
        return [
            'type' => 'danger',
            'message' => sprintf('There was an error %s', $e->getMessage())
        ];
    }

    /* Return error message for wrong username */
    if (empty($user_info)) {
        return [
            'type' => 'danger',
            'message' => 'The username you entered does not exist.'
        ];
    }

    /* Check password */
    if (!password_verify($form_data['password'], $user_info['password'])) {
        return [
            'type' => 'danger',
            'message' => 'The password you entered is incorrect!'
        ];
    }
    else {
        session_start();
        $_SESSION['user_id'] = $user_info['id'];
        return [
            'type' => 'success',
            'message' => sprintf('%s, you were logged in successfully!', display_user($pdo, $_SESSION['user_id'])['first_name'])
        ];
    }
}

/**
 * Logout a user
 * @return string[]
 */
function logout_user () {
    session_start();
    unset($_SESSION);
    session_destroy();
    if (empty($_SESSION['user_id'])) {
        return [
            'type' => 'success',
            'message' => 'You have been logged out.'
        ];
    }
    else {
        return [
            'type' => 'danger',
            'message' => 'Something went wrong.'
        ];
    }
}

function add_room ($pdo, $room_info) {
    /* Check if all fields are set */
    if (
        empty($room_info['city']) or
        empty($room_info['street_name']) or
        !isset($room_info['house_number']) or
        empty($room_info['type']) or
        !isset($room_info['size']) or
        !isset($room_info['price']) or
        !isset($room_info['rent_allowance']) or
        !isset($room_info['including_utilities']) or
        !isset($room_info['shared_kitchen']) or
        !isset($room_info['shared_bathroom']) or
        !isset($room_info['nr_roommates']) or
        !isset($room_info['nr_rooms']) or
        empty($room_info['general_info']) or
        empty($room_info['owner'])
    ) {
        return [
            'type' => 'danger',
            'message' => 'There was an error. Not all fields were filled in.'
        ];
    }

    /* Check data types */
    if (!is_numeric($room_info['house_number']) or $room_info['house_number'] <= 0) {
        return [
            'type' => 'danger',
            'message' => 'There was an error. You should enter a number larger than zero in the house number field.'
        ];
    }
    if (!is_numeric($room_info['size']) or $room_info['size'] <= 0) {
        return [
            'type' => 'danger',
            'message' => 'There was an error. You should enter a number larger than zero in the size field.'
        ];
    }
    if (!is_numeric($room_info['price']) or $room_info['price'] <= 0) {
        return [
            'type' => 'danger',
            'message' => 'There was an error. You should enter a number larger than zero in the price field.'
        ];
    }
    if (!is_numeric($room_info['nr_roommates']) or $room_info['nr_roommates'] < 0) {
        return [
            'type' => 'danger',
            'message' => 'There was an error. You should enter a zero or larger in the number of roommates field.'
        ];
    }
    if (!is_numeric($room_info['nr_rooms']) or $room_info['nr_rooms'] <= 0) {
        return [
            'type' => 'danger',
            'message' => 'There was an error. You should enter a number larger than zero in the number of rooms field.'
        ];
    }

    /* Check if room exists already */
    try {
        $stmt = $pdo->prepare('SELECT * FROM rooms WHERE city = ? AND street_name = ? AND house_number = ? AND addition = ?');
        $stmt->execute([
            $room_info['city'],
            $room_info['street_name'],
            $room_info['house_number'],
            $room_info['addition']
        ]);
        $room = $stmt->rowCount();
    }
    catch (PDOException $e) {
        return [
            'type' => 'danger',
            'message' => sprintf('There was an error: %s', $e->getMessage())
        ];
    }
    if (!empty($room)) {
        return [
            'type' => 'danger',
            'message' => 'This room has already been added.'
        ];
    }

    /* Save room to database */
    try {
        $stmt = $pdo->prepare('INSERT INTO rooms (owner, city, street_name, house_number, addition, type, size, price, rent_allowance, including_utilities, 
                   shared_kitchen, shared_bathroom, nr_roommates, nr_rooms, general_info) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
        $stmt->execute([
            $room_info['owner'],
            $room_info['city'],
            $room_info['street_name'],
            $room_info['house_number'],
            $room_info['addition'],
            $room_info['type'],
            $room_info['size'],
            $room_info['price'],
            $room_info['rent_allowance'],
            $room_info['including_utilities'],
            $room_info['shared_kitchen'],
            $room_info['shared_bathroom'],
            $room_info['nr_roommates'],
            $room_info['nr_rooms'],
            $room_info['general_info']
        ]);
        $inserted = $stmt->rowCount();
    }
    catch (PDOException $e) {
        return [
            'type' => 'danger',
            'message' => sprintf('There was an error: %s', $e->getMessage())
        ];
    }

    if ($inserted == 1) {
        return [
            'type' => 'success',
            'message' => 'Your room was added to the website.'
        ];
    }
    else {
        return [
            'type' => 'danger',
            'message' => 'There was an error. Your room was not added to the website.'
        ];
    }
}

function get_rooms($pdo) {
    $stmt = $pdo->prepare('SELECT * FROM rooms');
    $stmt->execute();
    $rooms = $stmt->fetchAll();
    $rooms_exp = Array();

    foreach ($rooms as $key => $value) {
        foreach ($value as $user_key => $user_input) {
            $rooms_exp[$key][$user_key] = htmlspecialchars($user_input);
        }
    }
    return $rooms_exp;
}

function get_rooms_table($pdo, $rooms) {
    $table_exp = '
    <table class="table table-hover">
    <thead
    <tr>
        <th scope="col">City</th>
        <th scope="col">Address</th>
        <th scope="col"></th>
        ';
        if (check_owner($pdo)) {
            $table_exp .= '
            <th scope="col"></th>
            ';
        }
    $table_exp .= '
    </tr>
    </thead>
    <tbody>';
    foreach($rooms as $room){
        $table_exp .= '
        <tr>
            <th scope="row">'.$room['city'].'</th>
            <th scope="row">'.$room['street_name'].' '.$room['house_number'].$room['addition'].'</th>
            <td><a href="/DDWT21/Final_Project/room/?room_id='.$room['id'].'" role="button" class="btn btn-primary">More info</a></td>
            ';
            if (check_owner($pdo)) {
                $table_exp .= '
                <td><a href="/DDWT21/Final_Project/room_opt-ins/?room_id='.$room['id'].'" role="button" class="btn btn-primary">Opt-ins</a></td>
                ';
            }
        $table_exp .= '
        </tr>
        ';
    }
    $table_exp .= '
    </tbody>
    </table>
    ';
    return $table_exp;
}

function get_room_info($pdo, $room_id) {
    $stmt = $pdo->prepare('SELECT * FROM rooms WHERE id = ?');
    $stmt->execute([$room_id]);
    $room_info = $stmt->fetch();
    $room_info_exp = Array();

    foreach ($room_info as $key => $value) {
        $room_info_exp[$key] = htmlspecialchars($value);
    }
    return $room_info_exp;
}

function room_address($pdo, $room_id) {
    $stmt = $pdo->prepare('SELECT city, street_name, house_number, addition FROM rooms WHERE id = ?');
    $stmt->execute([$room_id]);
    $room_address = $stmt->fetch();
    $room_address_exp = Array();

    foreach ($room_address as $key => $value) {
        $room_address_exp[$key] = htmlspecialchars($value);
    }
    return $room_address_exp;
}

function get_rooms_owner($pdo, $owner) {
    $stmt = $pdo->prepare('SELECT * FROM rooms WHERE owner = ?');
    $stmt->execute([$owner]);
    $rooms = $stmt->fetchAll();
    $rooms_exp = Array();

    foreach ($rooms as $key => $value) {
        foreach ($value as $user_key => $user_input) {
            $rooms_exp[$key][$user_key] = htmlspecialchars($user_input);
        }
    }
    return $rooms_exp;
}

function update_room($pdo, $room_info) {
    /* Check if all fields are set */
    if (
        empty($room_info['city']) or
        empty($room_info['street_name']) or
        !isset($room_info['house_number']) or
        empty($room_info['type']) or
        !isset($room_info['size']) or
        !isset($room_info['price']) or
        !isset($room_info['rent_allowance']) or
        !isset($room_info['including_utilities']) or
        !isset($room_info['shared_kitchen']) or
        !isset($room_info['shared_bathroom']) or
        !isset($room_info['nr_roommates']) or
        !isset($room_info['nr_rooms']) or
        empty($room_info['general_info']) or
        empty($room_info['owner']) or
        empty($room_info['room_id'])
    ) {
        return [
            'type' => 'danger',
            'message' => 'There was an error. Not all fields were filled in.'
        ];
    }

    /* Check data types */
    if (!is_numeric($room_info['house_number']) or $room_info['house_number'] <= 0) {
        return [
            'type' => 'danger',
            'message' => 'There was an error. You should enter a number larger than zero in the house number field.'
        ];
    }
    if (!is_numeric($room_info['size']) or $room_info['size'] <= 0) {
        return [
            'type' => 'danger',
            'message' => 'There was an error. You should enter a number larger than zero in the size field.'
        ];
    }
    if (!is_numeric($room_info['price']) or $room_info['price'] <= 0) {
        return [
            'type' => 'danger',
            'message' => 'There was an error. You should enter a number larger than zero in the price field.'
        ];
    }
    if (!is_numeric($room_info['nr_roommates']) or $room_info['nr_roommates'] < 0) {
        return [
            'type' => 'danger',
            'message' => 'There was an error. You should enter a zero or larger in the number of roommates field.'
        ];
    }
    if (!is_numeric($room_info['nr_rooms']) or $room_info['nr_rooms'] <= 0) {
        return [
            'type' => 'danger',
            'message' => 'There was an error. You should enter a number larger than zero in the number of rooms field.'
        ];
    }

    /* Create room_info array to easily compare addresses */
    $room_info_array = Array (
        'city' => $room_info['city'],
        'street_name' => $room_info['street_name'],
        'house_number' => $room_info['house_number'],
        'addition' => $room_info['addition']
    );

    /* Get current room address */
    $current_address = room_address($pdo, $room_info['room_id']);

    /* Check if room exists already */
    $stmt = $pdo->prepare('SELECT city, street_name, house_number, addition FROM rooms WHERE city = ? AND street_name = ? AND house_number = ? AND addition = ?');
    $stmt->execute([
        $room_info['city'],
        $room_info['street_name'],
        $room_info['house_number'],
        $room_info['addition']
    ]);
    $rooms = $stmt->fetch();

    if (
        $room_info_array === $rooms and $room_info !== $current_address
    ) {
        return [
            'type' => 'danger',
            'message' => 'There already exists a room at this address.'
        ];
    }

    /* Update room */
    $stmt = $pdo->prepare('UPDATE rooms SET city = ?, street_name = ?, house_number = ?, addition = ?, type = ?, size = ?, 
                 price = ?, rent_allowance = ?, including_utilities = ?, shared_kitchen = ?, shared_bathroom = ?, nr_roommates = ?, 
                 nr_rooms = ?, general_info = ? WHERE id = ? AND owner = ?');
    $stmt->execute([
        $room_info['city'],
        $room_info['street_name'],
        $room_info['house_number'],
        $room_info['addition'],
        $room_info['type'],
        $room_info['size'],
        $room_info['price'],
        $room_info['rent_allowance'],
        $room_info['including_utilities'],
        $room_info['shared_kitchen'],
        $room_info['shared_bathroom'],
        $room_info['nr_roommates'],
        $room_info['nr_rooms'],
        $room_info['general_info'],
        $room_info['room_id'],
        $room_info['owner']
    ]);
    $updated = $stmt->rowCount();
    if ($updated == 1) {
        return [
            'type' => 'success',
            'message' => 'The room was successfully updated.'
        ];
    }
    else {
        return [
            'type' => 'danger',
            'message' => 'Something went wrong. The room was not updated.'
        ];
    }
}

function remove_room($pdo, $room_id) {
    /* Get room address */
    $room_address = room_address($pdo, $room_id);

    /* Delete room */
    $stmt = $pdo->prepare('DELETE FROM rooms WHERE id = ?');
    $stmt->execute([$room_id]);
    $deleted = $stmt->rowCount();
    if ($deleted == 1) {
        return [
            'type' => 'success',
            'message' => sprintf('The room at %s %s%s, %s was removed', $room_address['street_name'], $room_address['house_number'], $room_address['addition'], $room_address['city'])
        ];
    }
    else {
        return [
            'type' => 'danger',
            'message' => 'Something went wrong. The room was not removed.'
        ];
    }
}

function check_opt_in ($pdo, $room, $user) {
    $stmt = $pdo->prepare('SELECT * FROM opt_in WHERE room = ? AND user = ?');
    $stmt->execute([$room, $user]);
    $check = $stmt->rowCount();
    if ($check) {
        return True;
    }
    else {
        return False;
    }
}

function opt_in ($pdo, $room, $user) {
    $room = (int) $room;
    $user = (int) $user;
    /* Check if all fields are set */
    if (
        empty($room) or
        empty($user)
    ) {
        return [
            'type' => 'danger',
            'message' => 'Not all fields are set.'
        ];
    }

    /* Check if the user is a tenant */
    if (check_owner($pdo)) {
        return [
            'type' => 'danger',
            'message' => 'As an owner you are not able to opt-in to rooms.'
        ];
    }

    /* Check if the user has already opted-in */
    if (check_opt_in($pdo, $room, $user)) {
        return [
            'type' => 'danger',
            'message' => 'You have already opted-in to this room.'
        ];
    }

    /* Opt-in user to room */
    $stmt = $pdo->prepare('INSERT INTO opt_in (room, user) VALUES (?, ?)');
    $stmt->execute([$room, $user]);
    $inserted = $stmt->rowCount();
    if ($inserted == 1) {
        return [
            'type' => 'success',
            'message' => 'You have successfully opted-in to this room.'
        ];
    }
    else {
        return [
            'type' => 'danger',
            'message' => 'Something went wrong and you have not been opted-in to this room.'
        ];
    }
}

function opt_out ($pdo, $room, $user) {
    /* Check if all fields are set */
    if (
        empty($room) or
        empty($user)
    ) {
        return [
            'type' => 'danger',
            'message' => 'Not all fields are set.'
        ];
    }

    /* Check if the user is a tenant */
    if (check_owner($pdo)) {
        return [
            'type' => 'danger',
            'message' => 'As an owner you are not able to opt-out from rooms.'
        ];
    }

    /* Check if the user has already opted-in */
    if (!check_opt_in($pdo, $room, $user)) {
        return [
            'type' => 'danger',
            'message' => 'You have not yet opted in to this room, so you cannot opt out.'
        ];
    }

    /* Opt out user from room */
    $stmt = $pdo->prepare('DELETE FROM opt_in WHERE room = ? AND user = ?');
    $stmt->execute([$room, $user]);
    $deleted = $stmt->rowCount();
    if ($deleted == 1) {
        return [
            'type' => 'success',
            'message' => 'You have successfully opted out of the room.'
        ];
    }
    else {
        return [
            'type' => 'danger',
            'message' => 'Something went wrong and you have not been opted out of the room.'
        ];
    }
}

function tenant_opt_in_table ($pdo, $user) {
    $stmt = $pdo->prepare('SELECT id, owner, city, street_name, house_number, addition FROM rooms JOIN opt_in ON rooms.id = opt_in.room WHERE opt_in.user = ?');
    $stmt->execute([$user]);
    $rooms = $stmt->fetchAll();
    $table_exp = '
    <table class="table table-hover">
    <thead
    <tr>
        <th scope="col">City</th>
        <th scope="col">Address</th>
        <th scope="col"></th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>';
    foreach($rooms as $room){
        $table_exp .= '
        <tr>
            <th scope="row">'.$room['city'].'</th>
            <th scope="row">'.$room['street_name'].' '.$room['house_number'].$room['addition'].'</th>
            <td><a href="/DDWT21/Final_Project/room/?room_id='.$room['id'].'" role="button" class="btn btn-primary">More info</a></td>
            <td><a href="/DDWT21/Final_Project/view_profile/?user_id='.$room['owner'].'" role="button" class="btn btn-primary">View owner\'s profile</a></td>
        </tr>
        ';
    }
    $table_exp .= '
    </tbody>
    </table>
    ';
    return $table_exp;
}

function get_users_table ($users) {
    $table_exp = '
    <table class="table table-hover">
    <thead
    <tr>
        <th scope="col">Tenant</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>';
    foreach ($users as $user) {
        $table_exp .= '
        <tr>
            <td>' . $user['first_name'] . ' ' . $user['last_name'] . '</td>
            <td><a href="/DDWT21/Final_Project/view_profile/?user_id='.$user['id'].'" role="button" class="btn btn-primary">View profile</a></td>
        </tr>
        ';
    }
    $table_exp .= '
    </tbody>
    </table>
    ';
    return $table_exp;
}

function owner_opt_in_table ($pdo, $room) {
    $stmt = $pdo->prepare('SELECT users.id, users.first_name, users.last_name FROM users JOIN opt_in ON users.id = opt_in.user WHERE opt_in.room = ?');
    $stmt->execute([$room]);
    $users = $stmt->fetchAll();
    $users_exp = Array();

    foreach ($users as $key => $value) {
        foreach ($value as $user_key => $user_input) {
            $users_exp[$key][$user_key] = htmlspecialchars($user_input);
        }
    }

    return get_users_table($users_exp);
}

function check_room_interest ($pdo, $room) {
    $stmt = $pdo->prepare('SELECT * FROM opt_in WHERE room = ?');
    $stmt->execute([$room]);
    $check = $stmt->rowCount();
    if ($check) {
        return True;
    }
    else {
        return False;
    }
}

function check_owner_tenant ($pdo, $owner, $tenant) {
    $stmt = $pdo->prepare('SELECT rooms.owner FROM rooms JOIN opt_in ON rooms.id = opt_in.room JOIN users ON opt_in.user = users.id WHERE users.id = ?');
    $stmt->execute([$tenant]);
    $owners = $stmt->fetchAll();
    foreach ($owners as $value) {
        if ($value['owner'] == $owner) {
            return True;
        }
    }
    return False;
}

function check_tenant_owner($pdo, $owner, $tenant) {
    $stmt = $pdo->prepare('SELECT users.id FROM users JOIN opt_in ON users.id = opt_in.user JOIN rooms ON opt_in.room = rooms.id WHERE rooms.owner = ?');
    $stmt->execute([$owner]);
    $tenants = $stmt->fetchAll();
    foreach ($tenants as $value) {
        if ($value['id'] == $tenant) {
            return True;
        }
    }
    return False;
}

function get_profile_info ($pdo, $user_id) {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$user_id]);
    $user_info = $stmt->fetch();
    $user_info_exp = Array();

    foreach ($user_info as $key => $value) {
        $user_info_exp[$key] = htmlspecialchars($value);
    }
    return $user_info_exp;
}

function update_profile($pdo, $user_info) {
    /* Check if all fields are set */
    if (
        empty($user_info['first_name']) or
        empty($user_info['last_name']) or
        empty($user_info['phone_number']) or
        empty($user_info['email']) or
        empty($user_info['language']) or
        empty($user_info['occupation']) or
        empty($user_info['user_id'])
    ) {
        return [
            'type' => 'danger',
            'message' => 'You should fill in everything'
        ];
    }
    /* Get current email */
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    $stmt->execute([$user_info['user_id']]);
    $users = $stmt->fetch();
    $current_email = $users['email'];

    /* Check if email is already in use */
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$user_info['email']]);
    $users = $stmt->fetch();
    if ($user_info['email'] == $users['email'] and $users['email'] != $current_email) {
        return [
            'type' => 'danger',
            'message' => 'This email is in use already.'
        ];
    }

    /* Update profile */
    $stmt = $pdo->prepare('UPDATE users SET first_name = ?, last_name = ?, phone_number = ?, email = ?, language = ?, occupation = ?, biography = ? WHERE id = ?');
    $stmt->execute([
        $user_info['first_name'],
        $user_info['last_name'],
        $user_info['phone_number'],
        $user_info['email'],
        $user_info['language'],
        $user_info['occupation'],
        $user_info['biography'],
        $user_info['user_id']
    ]);
    $updated = $stmt->rowCount();
    if ($updated == 1) {
        return [
            'type' => 'success',
            'message' => 'Your profile was successfully updated.'
        ];
    }
    else {
        return [
            'type' => 'danger',
            'message' => 'Something went wrong. Your profile was not updated.'
        ];
    }
}

function remove_profile ($pdo, $user_id) {
    /* Delete profile */
    $stmt = $pdo->prepare('DELETE FROM users WHERE id = ?');
    $stmt->execute([$user_id]);
    $deleted = $stmt->rowCount();
    if ($deleted == 1) {
        logout_user();
        return [
            'type' => 'success',
            'message' => 'Your profile was deleted.'
        ];
    }
    else {
        return [
            'type' => 'danger',
            'message' => 'Something went wrong. Your profile was not deleted.'
        ];
    }
}

function inbox ($pdo, $user) {
    $stmt = $pdo->prepare('SELECT DISTINCT users.id FROM users JOIN messages ON users.id = messages.receiver WHERE messages.sender = ?');
    $stmt->execute([$user]);
    $receivers = $stmt->fetchAll();
    $stmt = $pdo->prepare('SELECT DISTINCT users.id FROM users JOIN messages ON users.id = messages.sender WHERE messages.receiver = ?');
    $stmt->execute([$user]);
    $senders = $stmt->fetchAll();
    $diff = array_diff_assoc(array_column($receivers, 'id'), array_column($senders, 'id'));
    $inter = array_intersect_assoc(array_column($receivers, 'id'), array_column($senders, 'id'));
    $merge = array_merge($diff, $inter);
    $names = Array();
    foreach ($merge as $value) {
        $stmt = $pdo->prepare('SELECT id, first_name, last_name FROM users WHERE id = ?');
        $stmt->execute([$value]);
        $name = $stmt->fetchAll();
        $names = array_merge($names, $name);
    }
    return messages_overview_table($names);
}

function messages_overview_table ($users) {
    $table_exp = '
    <table class="table table-hover">
    <thead
    <tr>
        <th scope="col">User</th>
        <th scope="col"></th>
    </tr>
    </thead>
    <tbody>';
    foreach ($users as $user) {
        $table_exp .= '
        <tr>
            <td>' . $user['first_name'] . ' ' . $user['last_name'] . '</td>
            <td><a href="/DDWT21/Final_Project/conversation/?user1='.$user['id'].'&user2='.$_SESSION['user_id'].'" role="button" class="btn btn-primary">View conversation</a></td>
        </tr>
        ';
    }
    $table_exp .= '
    </tbody>
    </table>
    ';
    return $table_exp;
}

function get_messages ($pdo, $user1, $user2) {
    $stmt = $pdo->prepare('SELECT * FROM messages WHERE sender = ? AND receiver = ? ORDER BY date_time ASC');
    $stmt->execute([$user1, $user2]);
    $user1_sent = $stmt->fetchAll();
    $stmt = $pdo->prepare('SELECT * FROM messages WHERE sender = ? AND receiver = ? ORDER BY date_time ASC');
    $stmt->execute([$user2, $user1]);
    $user2_sent = $stmt->fetchAll();
    return [$user1_sent, $user2_sent];
}
