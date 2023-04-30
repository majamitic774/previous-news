<?php foreach ($category as $cat) : ?>
    <a href="?page=news&category=<?php echo $cat['id'] ?>"><?= $cat['name'] ?></a>
<?php endforeach; ?>

<?php foreach ($all_news as $news) : ?>
    <p>title: <?= $news['title'] ?></p>
    <p>body: <?= $news['body'] ?></p>
    <p>created at: <?= $news['created_at'] ?></p>
    <p>category: <?= $news['name'] ?></p>
    <img src="<?= BASE_URL ?>storage/images/<?= $news['image'] ?>" width="150px">

    <form action="<?= BASE_URL . 'index.php' ?>" method="POST">
        <?php if (isset($_SESSION['token'])) : ?>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
            <input type="hidden" name="id" value="<?= $news['id'] ?>">
            <?php if (false == $auth->isAdmin()) : ?>
            <?php else : ?>
                <button type="submit" name="delete-news">delete</button><br />
            <?php endif; ?>
        <?php endif; ?>
    </form>

    <a href="<?= BASE_URL ?>/index.php?page=single-news&news_id=<?php echo $news['id'] ?>">single news</a>
    <?php if ($auth != False && false == $auth->isAdmin()) : ?>
    <?php else : ?>
        <a href="<?= BASE_URL ?>index.php?page=update-news&news_id=<?php echo $news['id'] ?>">update</a>
    <?php endif; ?>
<?php endforeach;  ?>