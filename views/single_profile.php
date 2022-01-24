<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css" integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Own CSS -->
    <link rel="stylesheet" href="/DDWT21/Final_Project/css/main.css">

    <title><?= $page_title ?></title>
</head>
<body>
<?= $header_picture ?>
<!-- Menu -->
<?= $navigation ?>

<!-- Content -->
<div class="container">
    <div class="pd-15">&nbsp;</div>

    <div class="row">

        <!-- Left column -->
        <div class="col-md-8">
            <!-- Error message -->
            <?php if (isset($error_msg)){echo $error_msg;} ?>

            <h1><?= $page_title ?></h1>
            <h5><?= $page_subtitle ?></h5>
            <p style="white-space: pre-wrap"><?= $page_content ?></p>
            <table class="table">
                <tbody>
                <tr>
                    <th scope="row">Name</th>
                    <td><?= $user_info['first_name'] . ' ' . $user_info['last_name'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Role</th>
                    <td><?= $user_info['role'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Date of birth</th>
                    <td><?= $user_info['birthdate'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Phone number</th>
                    <td><?= $user_info['phone_number'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Email address</th>
                    <td><?= $user_info['email'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Language</th>
                    <td><?= $user_info['language'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Occupation</th>
                    <td><?= $user_info['occupation'] ?></td>
                </tr>
                </tbody>
            </table>
            <?php if ($display_buttons) { ?>
                <div class="row">
                    <div class="col-sm-2">
                        <a href="/DDWT21/Final_Project/edit_profile/?user_id=<?= $user_profile ?>" role="button" class="btn btn-warning">Edit</a>
                    </div>
                    <div class="col-sm-2">
                        <form action="/DDWT21/Final_Project/remove_profile/" method="POST">
                            <input type="hidden" value="<?= $user_profile ?>" name="user_id">
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </div>
                </div>
            <?php } ?>

        </div>

        <!-- Right column -->
        <div class="col-md-4">
            <?php if ($current_user != $user_profile and $send_message) { ?>
            <div class="card">
                <div class="card-header">
                    Send message
                </div>
                <div class="card-body">
                    <p>Click the button below to send this user a message.</p>
                    <a href="/DDWT21/Final_Project/conversation/?user1=<?= $current_user ?>&user2=<?= $user_profile ?>" role="button" class="btn btn-primary">Send message</a>
                </div>
            </div>
            <?php } ?>
        </div>

    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js" integrity="sha512-/DXTXr6nQodMUiq+IUJYCt2PPOUjrHJ9wFrqpJ3XkgPNOZVfMok7cRw6CSxyCQxXn6ozlESsSh1/sMCTF1rL/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js" integrity="sha512-ubuT8Z88WxezgSqf3RLuNi5lmjstiJcyezx34yIU2gAHonIi27Na7atqzUZCOoY4CExaoFumzOsFQ2Ch+I/HCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
