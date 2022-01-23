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

    <style>
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        input, label {
            display:block;
        }
    </style>
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

            <h1><?= $page_title?></h1>
            <h5><?= $page_subtitle ?></h5>

            <div class="pd-15"> </div>

            <form action="<?= $form_action ?>" method="POST" class="row g-5">
                <div class="col-md-4">
                    <label for="inputCity">
                        City
                    </label>
                    <input type="text" class="form-control" id="inputCity" name="city" value="<?php if (isset($room_info)){echo $room_info['city'];} ?>" required>
                </div>
                <div class="col-md-4">
                    <label for="inputStreet">
                        Street name
                    </label>
                    <input type="text" class="form-control" id="inputStreet" name="street_name" value="<?php if (isset($room_info)){echo $room_info['street_name'];} ?>" required>
                </div>
                <div class="col-md-2">
                    <label for="inputNumber">
                        House number
                    </label>
                    <input type="number" class="form-control" id="inputNumber" name="house_number" value="<?php if (isset($room_info)){echo $room_info['house_number'];} ?>" required>
                </div>
                <div class="col-md-2">
                    <label for="inputAddition">
                        Addition
                    </label>
                    <input type="text" class="form-control" id="inputAddition" name="addition" value="<?php if (isset($room_info)){echo $room_info['addition'];} ?>">
                </div>
                <div class="col-md-3 py-3">
                    <div class="form-floating">
                        <label for="inputSize">
                            Size
                        </label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="inputSize" placeholder="Size of room" name="size" value="<?php if (isset($room_info)){echo $room_info['size'];} ?>" required>
                            <span class="input-group-text">m<sup>2</sup></span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 py-3">
                    <label for="inputPrice">
                        Price
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">€</span>
                        <input type="number" class="form-control" id="inputPrice" placeholder="Monthly price" name="price" value="<?php if (isset($room_info)){echo $room_info['price'];} ?>" required>
                    </div>
                </div>
                <div class="col-md-3 py-3">
                    <label for="inputUtilities">
                        Utilities
                    </label>
                    <select class="form-select" id="inputUtilities" name="including_utilities" required>
                        <option <?php if (!isset($room_info)){ ?>selected <?php } ?> disabled value="">
                            Pick an option
                        </option>
                        <option <?php if (isset($room_info) and $room_info['including_utilities'] == 1){ ?> selected <?php } ?> value="1">
                            Price is including utilities
                        </option>
                        <option <?php if (isset($room_info) and $room_info['including_utilities'] == 0){ ?> selected <?php } ?> value="0">
                            Price is not including utilities
                        </option>
                    </select>
                </div>
                <div class="col-md-3 py-3">
                    <label for="inputAllowance">
                        Rent allowance
                    </label>
                    <select class="form-select" id="inputAllowance" name="rent_allowance" required>
                        <option <?php if (!isset($room_info)){ ?>selected <?php } ?> disabled value="">
                            Pick an option
                        </option>
                        <option <?php if (isset($room_info) and $room_info['rent_allowance'] == 1){ ?> selected <?php } ?> value="1">
                            Rent allowance is available
                        </option>
                        <option <?php if (isset($room_info) and $room_info['rent_allowance'] == 0){ ?> selected <?php } ?> value="0">
                            Rent allowance is not available
                        </option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="inputRoommates">
                        Amount of roommates
                    </label>
                    <div class="input-group">
                        <span class="input-group-text">#</span>
                        <input type="number" class="form-control" id="inputRoommates" placeholder="Roommates" name="nr_roommates" value="<?php if (isset($room_info)){echo $room_info['nr_roommates'];} ?>" required>
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="inputRooms">
                        Amount of rooms
                    </label>
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text">#</span>
                        <input type="number" class="form-control" id="inputRooms" placeholder="Rooms" name="nr_rooms" value="<?php if (isset($room_info)){echo $room_info['nr_rooms'];} ?>" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <label for="inputType">
                        Type
                    </label>
                    <select class="form-select" id="inputType" name="type" required>
                        <option <?php if (!isset($room_info)){ ?>selected <?php } ?> disabled value="">
                            Pick an option
                        </option>
                        <option <?php if (isset($room_info) and $room_info['type'] == 'Room in student house'){ ?> selected <?php } ?> value="Room in student house">
                            Room in student house
                        </option>
                        <option <?php if (isset($room_info) and $room_info['type'] == 'Room in owner\'s house'){ ?> selected <?php } ?> value="Room in owner's house">
                            Room in owner's house
                        </option>
                        <option <?php if (isset($room_info) and $room_info['type'] == 'Apartment'){ ?> selected <?php } ?> value="Apartment">
                            Apartment
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputKitchen">
                        Kitchen
                    </label>
                    <select class="form-select" id="inputKitchen" name="shared_kitchen" required>
                        <option <?php if (!isset($room_info)){ ?>selected <?php } ?> disabled value="">
                            Pick an option
                        </option>
                        <option <?php if (isset($room_info) and $room_info['shared_kitchen'] == 1){ ?> selected <?php } ?> value="1">
                            The kitchen is shared
                        </option>
                        <option <?php if (isset($room_info) and $room_info['shared_kitchen'] == 0){ ?> selected <?php } ?> value="0">
                            The kitchen is not shared
                        </option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label for="inputBathroom">
                        Bathroom
                    </label>
                    <select class="form-select" id="inputBathroom" name="shared_bathroom" required>
                        <option <?php if (!isset($room_info)){ ?>selected <?php } ?> disabled value="">
                            Pick an option
                        </option>
                        <option <?php if (isset($room_info) and $room_info['shared_bathroom'] == 1){ ?> selected <?php } ?> value="1">
                            The bathroom is shared
                        </option>
                        <option <?php if (isset($room_info) and $room_info['shared_bathroom'] == 0){ ?> selected <?php } ?> value="0">
                            The bathroom is not shared
                        </option>
                    </select>
                </div>

                <div class="col-md-12 py-3">
                    <label for="inputInfo">
                        General information
                    </label>
                    <textarea class="form-control" id="inputInfo" rows="6" placeholder="Here you can share general information about the room" name="general_info" required><?php if (isset($room_info)){echo $room_info['general_info'];} ?></textarea>
                </div>
                <?php if (isset($room_id)) { ?><input type="hidden" name="room_id" value="<?php echo $room_id ?>"><?php } ?>
                <?php if ($display_buttons) { ?>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <input type="hidden" id="owner" name="owner" value="<?= $_SESSION['user_id'] ?>">
                            <button type="submit" class="btn btn-primary"><?= $submit_button ?></button>
                        </div>
                    </div>
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
