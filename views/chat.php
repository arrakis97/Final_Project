<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.1/css/bootstrap.min.css" integrity="sha512-T584yQ/tdRR5QwOpfvDfVQUidzfgc2339Lc8uBDtcp/wYu80d7jwBgAxbyMh0a9YM9F8N3tdErpFI8iaGx6x5g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Own CSS -->
    <link rel="stylesheet" href="/DDWT21/Final_Project/css/css_chat.css">

    <title><?= $page_title ?></title>

    <style>
        .chat-header {
            background-color: #EBEBEB;
        }
        .chat-field {
            background-color: #f9fcf9;
        }
    </style>
</head>
<body>
<!-- Header picture -->
<?= $header_picture ?>

<!-- Menu -->
<?= $navigation ?>

<!-- Content -->
<div class="container">
    <div class="pd-15">&nbsp;</div>
    <div class="container">
        <h1><?= $page_title ?></h1>
        <!-- Error message -->
        <?php if (isset($error_msg)){echo $error_msg;} ?>

        <div class="card">
            <div class="row g-0">
                <div class="col-12">
                    <div class="py-2 px-4 border-bottom chat-header">
                        <div class="d-flex align-items-center py-1">
                            <div class="position-relative"></div>
                            <div class="flex-grow-1 pl-3">
                                <a href="/DDWT21/Final_Project/view_profile/?user_id=<?= $inactive_user_info['id'] ?>"><strong><?= $inactive_user_info['first_name'] ?></strong></a>
                            </div>
                        </div>
                    </div>
                    <!-- Display messages -->
                    <div class="position-relative">
                        <div class="chat-messages chat-field p-4">
                            <?php echo $messages_table; ?>
                        </div>
                    </div>
                    <!-- Send message -->
                    <form action="/DDWT21/Final_Project/send_message/" method="POST">
                        <div class="flew-grow-0 py-3 px-4 border-top">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Type your message" name="content" style="border-radius: 15px" required>
                                <input type="hidden" name="sender" value="<?php echo $current_user ?>">
                                <input type="hidden" name="receiver" value="<?php echo $inactive_user ?>"
                                <div class="button-container">
                                    <button type="submit" class="btn btn-primary" style="margin-left: 10px">Send message</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="pd-15">&nbsp;</div>
</body>
