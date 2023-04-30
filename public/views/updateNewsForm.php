<form action="<?= BASE_URL . 'index.php' ?>" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?>">
    <input type="hidden" name="id" value="<?php echo $_GET['news_id'] ?>"> <br />
    title<input type="text" name="title" value="<?= $news['title'] ?>"><br />
    body<input type="text" name="body" value="<?= $news['body'] ?>"><br />
    img<input type="file" name="image"><br />
    <button type="submit" name="updateNews"> Update</button>
</form>