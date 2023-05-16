<?php
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'GuestBook.php';
    require_once __DIR__ . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Message.php';
    require_once 'elements' . DIRECTORY_SEPARATOR. 'header.php';
    $nav = "guestbook";
    $guestBook = new GuestBook(__DIR__ . DIRECTORY_SEPARATOR . "data" . DIRECTORY_SEPARATOR . "messages");
    $messages = $guestBook->getMessages();
 

    //Traitement formulaire
    if(!empty($_POST)) {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $message = htmlspecialchars($_POST['message']);
        $message = new Message($pseudo, $message , new DateTime());

        if($message->isValid()) {
            $guestBook->addMessage($message);
            header('Location: guestbook.php');
        }
        if(strlen($message->pseudo) < 3) {
            $message->errors[] = "- Votre pseudo doit être de 3 caractères minimum  \n";
        }
        if(strlen($message->message) < 10) {
            $message->errors[] = "- Votre message doit être de 10 caractères minimum \n";
        }
    }
    $messages = $guestBook->getMessages();
?>

<h1>Livre d'or</h1>

<?php if(isset($message)): ?>
    <?php if(!empty($message->errors)): ?>
        <?php foreach($message->getErrors() as $error): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endforeach ?>
    <?php endif ?>
<?php endif ?>

<form method="post">
    <div class="form-group">
        <input type="text" class="form-control" name="pseudo" placeholder="Votre pseudo (3 caractères minimum)" value="<?= $message->pseudo ?? '' ?>">
    </div>
    <div class="form-group">
        <textarea class="form-control" name="message" placeholder="Votre message (10 caractères minimum)"><?= $message->message ?? '' ?></textarea>
    </div>
    <button class="btn btn-primary">Envoyer</button>
</form>

<h2>Vos messages :</h2>

<?php foreach($messages as $message): ?>
    <?= $message->toHTML() ?>
<?php endforeach ?>

<?php  require 'elements' . DIRECTORY_SEPARATOR. 'footer.php'; ?>