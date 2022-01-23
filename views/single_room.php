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
<img src="/DDWT21/Final_Project/views/skyline.jpg" style="width: 100%">
<!-- Menu -->
<?= $navigation ?>

<!-- Content -->
<div class="container">
    <!-- Breadcrumbs -->
    <div class="pd-15">&nbsp;</div>
    <?= $breadcrumbs ?>

    <div class="row">

        <!-- Left column -->
        <div class="col-md-8">
            <!-- Error message -->
            <?php if (isset($error_msg)){echo $error_msg;} ?>

            <h1><?= $page_title ?></h1>
            <h5><?= $page_subtitle ?></h5>
            <p><?= $page_content ?></p>
            <table class="table">
                <tbody>
                <tr>
                    <th scope="row">Type</th>
                    <td><?= $room_info['type'] ?></td>
                </tr>
                <tr>
                    <th scope="row">Size</th>
                    <td><?= $room_info['size'] ?> m<sup>2</sup></td>
                </tr>
                <tr>
                    <th scope="row">Rent allowance</th>
                    <td><?php if ($room_info['rent_allowance'] == 1) {echo "You can request rent allowance for this room.";} else {echo "You cannot request rent allowance for this room.";} ?></td>
                </tr>
                <tr>
                    <th scope="row">Shared kitchen?</th>
                    <td><?php if ($room_info['shared_kitchen'] == 1) {echo "You have to share the kitchen with others.";} else {echo "You have the kitchen all to yourself.";} ?></td>
                </tr>
                <tr>
                    <th scope="row">Shared bathroom?</th>
                    <td><?php if ($room_info['shared_bathroom'] == 1) {echo "You have to share the bathroom with others.";} else {echo "You have the bathroom all to yourself.";} ?></td>
                </tr>
                <tr>
                    <th scope="row">Amount of roommates</th>
                    <td><?php if ($room_info['nr_roommates'] >= 1) {echo "You will have" . " " . $room_info['nr_roommates'] . ' roommates';} else {echo "You have no roommates.";} ?></td>
                </tr>
                <tr>
                    <th scope="row">Amount of rooms</th>
                    <td><?php if ($room_info['nr_rooms'] == 1) {echo "There is one room.";} else {echo "There are" . " " . $room_info['nr_rooms'] . " rooms.";} ?></td>
                </tr>
                </tbody>
            </table>
            <?php if ($display_buttons) { ?>
                <div class="row">
                    <div class="col-sm-2">
                        <a href="/DDWT21/Final_Project/edit_room/?room_id=<?= $room_id ?>" role="button" class="btn btn-warning">Edit</a>
                    </div>
                    <div class="col-sm-2">
                        <form action="/DDWT21/Final_Project/remove_room/" method="POST">
                            <input type="hidden" value="<?= $room_id ?>" name="room_id">
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                    </div>
                </div>
            <?php } ?>

        </div>

        <!-- Right column -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Monthly price
                </div>
                <div class="card-body">
                    <p class="count">
                        The monthly price for this room is
                    </p>
                    <h2>€<?= $room_info['price'] ?></h2>
                    <br>
                    <p><?php if ($room_info['including_utilities'] == 1) {echo "This price is including utilities";} else {echo "This price is not including utilities";} ?></p>
                </div>
            </div>
            <?php if (!check_owner($db)) { ?>
                <hr>
                <div class="card">
                    <div class="card-header">
                        Opt-in
                    </div>
                    <div class="card-body">
                        <?php if (check_opt_in($db, $room_id, $_SESSION['user_id'])) { ?>
                            <p>Click the button below to opt out of this room.</p>
                            <form action="/DDWT21/Final_Project/opt-out/" method="POST">
                                <input type="hidden" value="<?= $room_id ?>" name="room_id">
                                <input type="hidden" value="<?= $_SESSION['user_id'] ?>" name="user_id">
                                <button type="submit" class="btn btn-danger">Opt-out</button>
                            </form>
                        <?php } else { ?>
                            <p>Click the button below to opt in to this room. If you do this, the owner will be able to see your information and message you.</p>
                            <form action="/DDWT21/Final_Project/opt-in/" method="POST">
                                <input type="hidden" value="<?= $room_id ?>" name="room_id">
                                <input type="hidden" value="<?= $_SESSION['user_id'] ?>" name="user_id">
                                <button type="submit" class="btn btn-primary">Opt-in</button>
                            </form>
                        <?php } ?>
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