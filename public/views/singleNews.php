<?php

use News\Core\Auth; ?>

<?php if ($loggedInUser) : ?>
    <form action="<?= BASE_URL . 'index.php' ?>" method="POST" enctype="multipart/form-data">
        <?php if (isset($_SESSION['token'])) : ?>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
        <?php endif; ?>
        <input type="hidden" name="news_id" value="<?= $news_id ?>" /><br />
        <input type="hidden" name="user_id" value="<?= $user_id ?? '' ?>" /><br />
        body<input type="text" name="body" /><br />
        <button type="submit" name="insert-comment">Comment</button><br />
    </form>
<?php endif; ?>

<p><?= "id: " . $news_id . "<br>"; ?></p>
<p><?= "title: " . $title . "<br>"; ?></p>
<p><?= "body: " . $body . "<br>"; ?></p>
<p><?= "created ad: " . $created_at . "<br>"; ?></p>
<img src="<?= BASE_URL ?>storage/images/<?= $image ?>" width="150px">

<?php foreach ($comments as $comment) : ?>
    <p><span><?= $comment['username'] ?></span>: <?= $comment['body']; ?></p>
    <form action="<?= BASE_URL . 'index.php' ?>">
        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
        <input type="hidden" name="comment-id" value="<?= $comment['id'] ?>">
        <input type="hidden" name="news-id" value="<?= $news_id ?>">
        <input type="hidden" name="user-commented-email" value="<?= $comment['email'] ?>">
        <?php if ($loggedInUser && $loggedInUser['email'] == $comment['email'] || Auth::isAdmin()) : ?>
            <br>
            <button type="submit" name="delete-comment">delete</button><br />

            <?php if ($loggedInUser && $loggedInUser['email'] == $comment['email']) : ?>
                <a href="<?= BASE_URL ?>index.php?page=update-comment&comment_id=<?php echo $comment['id'] ?>&news_id=<?php echo $news_id; ?>&user-commented-email=<?php echo $comment['email'] ?>">Edit</a>
            <?php endif; ?>
        <?php endif; ?>
    </form>
<?php endforeach; ?>