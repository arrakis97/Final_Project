<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css" integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Own CSS -->
    <link rel="stylesheet" href="/Final_Project/css/main.css">

    <title><?= $page_title ?></title>
</head>
<body>
<!-- Menu -->
<?= $navigation ?>

<!-- Content -->
<div class="container">
    <!-- Breadcrumbs -->
    <div class="pd-15">&nbsp;</div>
    <?= $breadcrumbs ?>

    <div class="row">

        <!-- Left column -->
        <div class="col-md-12">
            <!-- Error message -->
            <?php if (isset($error_msg)){echo $error_msg;} ?>

            <h1><?= $page_title?></h1>
            <h5><?= $page_subtitle ?></h5>

            <div class="pd-15"> </div>

            <form action="/DDWT21/Final_Project/add_room/" method="POST">
                <div class="form-group row">
                    <label for="inputCity">
                        City
                    </label>
                    <input type="text" class="form-control" id="inputCity" placeholder="Enter the city" name="city" required>
                </div>
                <div class="form-group row">
                    <label for="inputStreet">
                        Street name
                    </label>
                    <input type="text" class="form-control" id="inputStreet" placeholder="Enter the street name" name="street_name" required>
                </div>
                <div class="form-group row">
                    <label for="inputNumber">
                        House number
                    </label>
                    <input type="number" class="form-control" id="inputNumber" placeholder="Enter the house number" name="house_number" required>
                </div>
                <div class="form-group row">
                    <label for="inputAddition">
                        Addition
                    </label>
                    <input type="text" class="form-control" id="inputAddition" placeholder="Enter the addition (if required)" name="addition">
                </div>
                <div class="form-group row">
                    <label for="inputType">
                        Type of room
                    </label>
                    <select class="form-select" id="inputType" name="type" required>
                        <option selected disabled value="">
                            Pick an option
                        </option>
                        <option value="Room in student house">
                            Room in student house
                        </option>
                        <option value="Room in owner's house">
                            Room in owner's house
                        </option>
                        <option value="Apartment">
                            Apartment
                        </option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="inputSize">
                        Size of the room
                    </label>
                    <input type="number" class="form-control" id="inputSize" placeholder="Enter the size of the room in m^2" name="size" required>
                </div>
                <div class="form-group row">
                    <label for="inputPrice">
                        Price of the room
                    </label>
                    <input type="number" class="form-control" id="inputPrice" placeholder="Enter the monthly price of the room in euros" name="price" required>
                </div>
                <div class="form-group row">
                    <label for="inputAllowance">
                        Is rent allowance available?
                    </label>
                    <select class="form-select" id="inputAllowance" name="rent_allowance" required>
                        <option selected disabled value="">
                            Pick an option
                        </option>
                        <option value="True">
                            Rent allowance is available
                        </option>
                        <option value="False">
                            Rent allowance is not available
                        </option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="inputUtilities">
                        Is the price including utilities?
                    </label>
                    <select class="form-select" id="inputUtilities" name="including_utilities" required>
                        <option selected disabled value="">
                            Pick an option
                        </option>
                        <option value="True">
                            Price is including utilities
                        </option>
                        <option value="False">
                            Price is not including utilities
                        </option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="inputKitchen">
                        Is the kitchen shared?
                    </label>
                    <select class="form-select" id="inputKitchen" name="shared_kitchen" required>
                        <option selected disabled value="">
                            Pick an option
                        </option>
                        <option value="True">
                            The kitchen is shared
                        </option>
                        <option value="False">
                            The kitchen is not shared
                        </option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="inputBathroom">
                        Is the bathroom shared?
                    </label>
                    <select class="form-select" id="inputBathroom" name="shared_bathroom" required>
                        <option selected disabled value="">
                            Pick an option
                        </option>
                        <option value="True">
                            The bathroom is shared
                        </option>
                        <option value="False">
                            The bathroom is not shared
                        </option>
                    </select>
                </div>
                <div class="form-group row">
                    <label for="inputRoommates">
                        Amount of roommates
                    </label>
                    <input type="number" class="form-control" id="inputRoommates" placeholder="Enter the amount of roommates" name="nr_roommates" required>
                </div>
                <div class="form-group row">
                    <label for="inputRooms">
                        Amount of rooms
                    </label>
                    <input type="number" class="form-control" id="inputRooms" placeholder="Enter the amount of rooms" name="nr_rooms" required>
                </div>
                <div class="form-group row">
                    <label for="inputInfo">
                        General information
                    </label>
                    <textarea class="form-control" id="inputInfo" rows="3" placeholder="Here you can share general information about the room" name="general_info" required></textarea>
                </div>
                <div class="form-group row">
                    <input type="hidden" id="owner" name="owner" value="<?= $_SESSION['user_id'] ?>">
                    <button type="submit" class="btn btn-primary">
                        Add your room
                    </button>
                </div>
            </form>

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
