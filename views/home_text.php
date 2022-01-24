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
        <div class="col-md-9">
            <!-- Error message -->
            <?php if (isset($error_msg)){echo $error_msg;} ?>

            <h1><?= $page_title ?></h1>
            <h5><?= $page_subtitle ?></h5>
            <div>
                <p>
                    <img src="/DDWT21/Final_Project/views/pictures/emergency_housing.jpeg" class="img-fluid rounded" width="400px" height="225px" style="float: right; margin-left: 15px">
                </p>
                <p>
                    Everyone knows it: there is a shortage of rooms everywhere, but this hits especially hard in cities with lots of students, like Groningen.
                    Often, students don't have much to spend and have only the bus and their bike as a means of transportation. This means that many students don't have the
                    luxury of living outside of Groningen. Furthermore, UKrant (a newspaper from students and staff of the UG) reported that the university grew with 9.8%
                    in 2020 and 3.1% in 2021 (<a href="https://ukrant.nl/gevreesde-monstergroei-blijft-uit-38-290-studenten-op-de-rug/">source</a>). The housing shortage combined with this growth of the university means that there is just enough room for everybody.
                    Some students have even been forced to live in emergency housing, which you can see here on the right.
                </p>
            </div>
            <div>
                <p>
                    <img src="/DDWT21/Final_Project/views/pictures/room_exploitation.jpeg" class="img-fluid rounded" width="600px" height="258px" style="float: left; margin-right: 15px">
                </p>
                <p>
                    Renting a room is expensive already, but with these shortages, some people have started taking advantage of the situation. For example, the ad on the left
                    here shows a room of 9 m<sup>2</sup> for which they want €800 per month. Exploitation like this is especially hurtful towards the international students,
                    because they often do not have the possibility to come to Groningen and look at rooms in person. And even if you could come in person, there is still a
                    worldwide pandemic going on, which means that something like a hospiteeravond is not always possible.
                </p>
            </div>
            <div>
                <p>
                    We here at Groningen-Net want to try and help solve this problem. We think that finding a room here in Groningen should be easy and possible for everyone.
                    To do this, we have made this website. Here, everyone can register an account as an owner or a tenant. Owners can add rooms, tenants can opt in to rooms
                    and once this connection is made, the owner and the tenant can send messages to each other. Both owners and tenants have a user profile where they can
                    tell something about themselves. This way, everyone can find their perfect match!
                </p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    Available rooms
                </div>
                <div class="card-body">
                    <p>There are </p>
                    <h2><?= $nr_rooms ?></h2>
                    <p> available rooms!</p>
                </div>
            </div>
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
