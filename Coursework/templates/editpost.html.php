
<?php
require_once '../includes/session.php';
?>

<form action="" method="post">
    <input type="hidden" name="postId" value="<?=$post['id'];?>">
    <label for="postContent">Edit your post here:</label>
    <textarea name="postContent" rows="3" cols="40">
        <?=$post['postContent']?>
    </textarea>
    <label for="image">Edit your image here:</label>
    <!-- <textarea name="image" rows="3" cols="40"> -->
    <input type="file" name="image" id="image" accept="image/*">
        <?=$post['image']?>
    </textarea>
    <input type="submit" name="submit" value="Save">
</form>