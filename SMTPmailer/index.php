<?php
// error_reporting(0);
// Require the PHP components
require_once('mailer.php');
if (isset($_POST['send_mail'])) {
    if ($_POST['From'] && $_POST['ReplyTo'] && $_POST['Subject'] && $_POST['Body'] && $_POST['Emails']) {
        $From = $_POST['From'];
        $ReplyTo = $_POST['ReplyTo'];
        $Body = $_POST['Body'];
        $FromName = isset($_POST['FromName']) ? trim($_POST['FromName']) : null;
        $Subject = trim($_POST['Subject']);

        $Emails = trim($_POST['Emails']);

        $Emails_array = explode(",", $Emails);

        // remove extra spaces from start and end of email characters
        $Emails_array = array_map(function ($value) {
            return trim($value);
        }, $Emails_array);

        // die("$Emails_array, $Subject, $Body, $From, $FromName, $ReplyTo");

        // Send the mail
        if (send_mail($Emails_array, $Subject, $Body, $From, $FromName, $ReplyTo, true)) {
            $success = true;
        } else {
            $errors[] = 'Error occurred, mail not sent!';
        }
    } else {
        // 
        $errors[] = 'Please fill in all fields';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bulk PHP Mailer</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha256-YLGeXaapI0/5IgZopewRJcFXomhRMlYYjugPLSyNjTY=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" integrity="sha256-ENFZrbVzylNbgnXx0n3I1g//2WeO47XxoPe0vkp3NC8=" crossorigin="anonymous" />
    <style type="text/css">
        textarea {
            height: 300px;
        }

        .tox-notifications-container {
            display: none !important;
        }
    </style>
</head>

<body>
    <div class="container p-5">
        <form class="col-md-8 m-auto" method="post">
            <h2>Bulk PHP Mailer</h2>
            <div class="form-group float-left col-md-6 pl-0">
                <label for="exampleInputEmail1">From Email address</label>
                <input type="email" value="<?= htmlentities($_POST['From']); ?>" name="From" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group float-left col-md-6 pr-0">
                <label for="exampleInputEmail2">From Name(Optional)</label>
                <input type="text" value="<?= htmlentities($_POST['FromName']); ?>" name="FromName" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="Enter Name">
            </div>
            <div class="form-group">
                <label for="To">Reply-To address</label>
                <input type="email" value="<?= htmlentities($_POST['ReplyTo']); ?>" name="ReplyTo" class="form-control" id="To" placeholder="Reply To address">
            </div>
            <div class="form-group">
                <label for="Subject">Email Subject</label>
                <input type="text" value="<?= htmlentities($_POST['Subject']); ?>" name="Subject" class="form-control" id="To" placeholder="Email Subject">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Comma separated Emails</label>
                <textarea class="form-control" value="<?= htmlentities($_POST['Emails']); ?>" name="Emails" id="emails" rows="3"></textarea>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">E-mail Body</label>
                <textarea class="form-control" value="<?= htmlentities($_POST['Body']); ?>" name="Body" id="bodyD" rows="3"></textarea>
            </div>
            <button type="submit" name="send_mail" class="btn btn-primary">Send Mail</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js" integrity="sha256-BJeo0qm959uMBGb65z40ejJYGSgR7REI4+CW1fNKwOg=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js" integrity="sha256-3blsJd4Hli/7wCQ+bmgXfOdK7p/ZUMtPXY08jmxSSgk=" crossorigin="anonymous"></script>
    <script src="https://cloud.tinymce.com/5/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#bodyD',
            plugins: ["code","link"],
        });
        $(document).ready(function(e) {
            tinymce.get('bodyD').setContent('<?= $_POST['Body']; ?>');
        })
    </script>
    <script>
        <?php
        if ($success) {
            ?>
            toastr.success('Mails successfully sent!');
        <?php
    }
    foreach ($errors as $err) {
        ?>
            toastr.error('<?= $err; ?>');
        <?php
    }
    ?>
    </script>
</body>

</html>