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

/* Home page */
if (new_route('/DDWT21/Final_Project/', 'get')) {
    p_print("Home");
}

/* Register GET */
elseif (new_route('/DDWT21/Final_Project/register', 'get')) {
    p_print("Register");
}

