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
<!-- Header picture -->
<?= $header_picture ?>

<!-- Menu -->
<?= $navigation ?>

<!-- Content -->
<div class="container">
    <div class="pd-15">&nbsp;</div>

    <div class="row">

        <div class="col-md-12">
            <!-- Error message -->
            <?php if (isset($error_msg)){echo $error_msg;} ?>

            <h1><?= $page_title ?></h1>
            <p><?= $page_content ?></p>
        </div>
    </div>
    <div class="pd-15">&nbsp;</div>

    <!-- Display cards on my account page -->
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Welcome, <?= $user ?>
                </div>
                <div class="card-body">
                    <p>You're logged in to Kamernet 2.0.</p>
                    <a href="/DDWT21/Final_Project/logout/" class="btn btn-primary">Logout</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Profile
                </div>
                <div class="card-body">
                    <p>Click the button below to view, edit or remove your profile.</p>
                    <a href="/DDWT21/Final_Project/view_profile/?user_id=<?= $user_id ?>" class="btn btn-primary">View/edit profile</a>
                </div>
            </div>
        </div>

        <?php if (check_owner($db)) { ?>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        Add a room
                    </div>
                    <div class="card-body">
                        <p>Click here to add a room</p>
                        <a href="/DDWT21/Final_Project/add_room/" class="btn btn-primary">Add room</a>
                    </div>
                </div>
            </div>
        <?php } ?>

        <?php if (!check_owner($db)) { ?>
            <div class="col-md-4" >
                <div class="card">
                    <div class="card-header">
                        Opt-ins
                    </div>
                    <div class="card-body">
                        <p>Click here to check your opt-ins</p>
                        <a href="/DDWT21/Final_Project/opt-ins/" class="btn btn-primary">Check opt-ins</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.slim.min.js" integrity="sha512-/DXTXr6nQodMUiq+IUJYCt2PPOUjrHJ9wFrqpJ3XkgPNOZVfMok7cRw6CSxyCQxXn6ozlESsSh1/sMCTF1rL/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js" integrity="sha512-ubuT8Z88WxezgSqf3RLuNi5lmjstiJcyezx34yIU2gAHonIi27Na7atqzUZCOoY4CExaoFumzOsFQ2Ch+I/HCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/js/bootstrap.min.js" integrity="sha512-UR25UO94eTnCVwjbXozyeVd6ZqpaAE9naiEUBK/A+QDbfSTQFhPGj5lOR6d8tsgbBk84Ggb5A3EkjsOgPRPcKA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
