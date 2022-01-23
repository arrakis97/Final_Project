<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css" integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g==" crossorigin="anonymous" referrerpolicy="no-referrer"/>

    <!-- Own CSS -->
    <link rel="stylesheet" href="/DDWT21/Final_Project/css/main.css">

    <title><?= $page_title ?></title>
</head>
<body>
<img src="/DDWT21/Final_Project/views/skyline.jpg" style="width: 100%">
<!-- Menu -->
<?= $navigation ?>

<!-- Content -->
<div class="container">
    <div class="pd-15">&nbsp;</div>

    <div class="row">

        <!-- Left column -->
        <div class="col-md-12">
            <!-- Error message -->
            <?php if (isset($error_msg)){echo $error_msg;} ?>

            <h1><?= $page_title ?></h1>
            <h5><?= $page_subtitle ?></h5>
            <p><?= $page_content ?></p>



            <form action="<?= $form_action ?>" method="POST" class="row g-5">
                <div class="col-md-6">
                    <label for="inputUsername" class="form-label">
                        Username
                    </label>
                    <input type="text" class="form-control" id="inputUsername" placeholder="Enter a username" name="username" value="" required>
                </div>
                <div class="col-md-6">
                    <label for="inputPassword" class="form-label">
                        Password
                    </label>
                    <input type="password" class="form-control" id="inputPassword" placeholder="Enter a password" name="password" required>
                </div>
                <div class="col-md-5 py-3">
                    <label for="inputFirstName" class="form-label">
                        First name
                    </label>
                    <input type="text" class="form-control" id="inputFirstName" placeholder="Enter your first name" name="first_name" value="<?php if (isset($user_info['first_name'])) {echo $user_info['first_name'];} ?>" required>
                </div>
                <div class="col-md-5 py-3">
                    <label for="inputLastName" class="form-label">
                        Last name
                    </label>
                    <input type="text" class="form-control" id="inputLastName" placeholder="Enter your last name" name="last_name" value="<?php if (isset($user_info['last_name'])) {echo $user_info['last_name'];} ?>" required>
                </div>
                <div class="col-md-2 py-3">
                    <label for="inputDate" class="form-label">
                        Date of birth
                    </label>
                    <input type="text" class="form-control" id="inputDate" placeholder="yyyy-mm-dd" name="birthdate" required>
                </div>
                <div class="col-md-3 py-3">
                    <label for="inputPhone" class="form-label">
                        Phone number
                    </label>
                    <input type="text" class="form-control" id="inputPhone" placeholder="0612345678" name="phone_number" value="<?php if (isset($user_info['phone_number'])) {echo $user_info['phone_number'];} ?>" required>
                </div>
                <div class="col-md-4 py-3">
                    <label for="inputEmail" class="form-label">
                        E-mail
                    </label>
                    <input type="text" class="form-control" id="inputEmail" placeholder="example@example.com" name="email" value="<?php if (isset($user_info['email'])) {echo $user_info['email'];} ?>" required>
                </div>
                <div class="col-md-5 py-3">
                    <label for="occupation">
                        State your occupation (e.g. studies/profession)
                    </label>
                    <input type="text" class="form-control" id="occupation" placeholder="Occupation" name="occupation" value="<?php if (isset($user_info['occupation'])) {echo $user_info['occupation'];} ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="language" class="form-label">
                        Select your language
                    </label>
                    <select name="language" class="form-select" id="language" required>
                        <option <?php if (!isset($user_info['language'])) { ?> selected <?php } ?> disabled value="">
                            Pick a language
                        </option>
                        <option value="Nederlands" <?php if (isset($user_info['language']) and $user_info['language'] == 'Nederlands') { ?> selected <?php } ?>>
                            Nederlands
                        </option>
                        <option value="English" <?php if (isset($user_info['language']) and $user_info['language'] == 'English') { ?> selected <?php } ?>>
                            English
                        </option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="role" class="form-label">
                        Owner or tenant
                    </label>
                    <select name="role" class="form-select" id="role"  required>
                        <option selected disabled value="">
                            Pick an option
                        </option>
                        <option value="Owner" <?php if (isset($user_info['role']) and $user_info['role'] == 'Owner') { ?> selected <?php } elseif (isset($user_info['role']) and $user_info['role'] == 'Tenant') { ?> disabled <?php } ?>>
                            Owner
                        </option>
                        <option value="Tenant" <?php if (isset($user_info['role']) and $user_info['role'] == 'Tenant') { ?> selected <?php } elseif (isset($user_info['role']) and $user_info['role'] == 'Owner') { ?> disabled <?php } ?>>
                            Tenant
                        </option>
                    </select>
                </div>
                <div class="col-md-12  py-3">
                    <label for="biography">
                        Biography
                    </label>
                    <textarea class="form-control" id="biography" rows="3" placeholder="Here you can tell something about yourself" name="biography"><?php if (isset($user_info['biography'])) {echo $user_info['biography'];} ?></textarea>
                </div>
                <?php if (isset($current_user)) { ?><input type="hidden" name="user_id" value="<?php echo $current_user ?>"><?php } ?>
                <?php if ($form_action == '/DDWT21/Final_Project/register/') { ?>
                    <button type="submit" class="btn btn-primary"><?= $submit_button ?></button>
                <?php } ?>
                <?php if ($form_action == '/DDWT21/Final_Project/edit_profile/') { ?>
                    <button type="submit" class="btn btn-warning"><?= $submit_button ?></button>
                <?php } ?>
            </form>

        </div>

    </div>
</div>
<div class="pd-15">&nbsp;</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js" integrity="sha512-/DXTXr6nQodMUiq+IUJYCt2PPOUjrHJ9wFrqpJ3XkgPNOZVfMok7cRw6CSxyCQxXn6ozlESsSh1/sMCTF1rL/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js" integrity="sha512-ubuT8Z88WxezgSqf3RLuNi5lmjstiJcyezx34yIU2gAHonIi27Na7atqzUZCOoY4CExaoFumzOsFQ2Ch+I/HCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
