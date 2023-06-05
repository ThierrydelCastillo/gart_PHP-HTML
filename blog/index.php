<?php

use App\Post;

require_once '../vendor/autoload.php';

$pdo = new PDO('sqlite:../data.db', null, null, [ 
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // array de parametres
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
]);
//$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$error = null;

try {
    if(isset($_POST['name'], $_POST['content'])){
        $query = $pdo->prepare('INSERT INTO posts (name, content, created_at) VALUES (:name, :content, :created)');
        $query->execute([
            'name' => $_POST['name'],
            'content' => $_POST['content'],
            'created' => time()
        ]);
        header('Location: /blog/edit.php?id=' . $pdo->lastInsertId());
    }
    $query = $pdo->query('SELECT * FROM posts');
    $posts = $query->fetchAll(PDO::FETCH_CLASS, Post::class);
} catch (PDOException $e) {
    $error = $e->getMessage();
}


require '../elements/header.php' ?>
<div class="container">
    <?php if($error): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php else: ?>
            <?php foreach($posts as $post): ?>
            <?php dump($post)?>
               <h2><a href="/blog/edit.php?id=<?= $post->id ?>"><?= htmlentities($post->name) ?></a></h2>
               <p>
                    <?= $post->getBody() ?>
               </p>
               <p class="small text-muted">Ecrit le <?= $post->created_at->format('d/m/Y à H:i') ?></p>
            <?php endforeach ?>

        <form method='post'>
            <div class="form-group">
                <input type="text" class="form-control" name="name" value="">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="content"></textarea>
            </div>
            <button class="btn btn-primary">Sauvegarder</button>
        </form>
    <?php endif ?>
</div>

<?php require '../elements/footer.php' ?>
