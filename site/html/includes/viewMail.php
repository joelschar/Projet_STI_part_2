<?php

echo date('Y-m-d H:i:s', time());

/**
 * CrepMessaging
 * Authors : Yann Lederrey and Joel Schar
 *
 * view mail pages
 */

if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    if($db->deleteMessageById($id)){
        // message to confirme deletion
        header("location: /mail.php");
    }
}

$current_username = $_SESSION['login'];

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $message = $db->getMessageById($id);

    if ($message == null) {
        ?>
        <div class="">
            <p>Message doesn't exists</p>
        </div>
    <?php } else { ?>
        <div class="MailFrom">
            <p> From : <?php echo $message->source_name ?></p>
        </div>
        <div class="MailTo">
            <p> To : <?php echo $message->destination_name ?></p>
        </div>
        <div class="Date">
            <p> Date : <?php echo date('d-m-Y H:i:s', $message->date_time) ?></p>
        </div>
        <div class="MailSubject">
            <p> Subject : <?php echo $message->subject ?></p>
        </div>
        <div class="MailMessage">
            <p> Message : </p>
            <p><?php echo $message->message ?></p>
        </div>

    <?php } // end else ?>
    <div >
        <a href="/mail.php?viewMail&delete&id=<?php echo $id ?>">Delete</a>
    </div>
    <div >
        <a href="/mail.php?sendMail&to=<?php echo $message->source_id ?>">reply</a>
    </div>

<?php
} // end if
?>
