<form action="" method="post" enctype="multipart/form-data">
    <div class="post-form">
        <input type="hidden" name="user_id" value="<?= $_SESSION['user_id'] ?>">
        
        <p class="posting-as">Posting as: <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></p>

        <div class="form-group">
            <label for="postContent">Type your content here:</label>
            <textarea name="postContent" id="postContent" rows="4" required></textarea>
        </div>

        <div class="form-group">
            <label for="image">Choose your image:</label>
            <input type="file" name="image" id="image" accept="image/*">
        </div>

        <div class="form-group">
            <label for="module_id">Select a module:</label>
            <select name="module_id" id="module_id" required>
                <option value="">Select a module</option>
                <?php foreach ($modules as $module):?>
                    <option value="<?=htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8'); ?>">
                        <?=htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8'); ?>
                    </option>
                <?php endforeach;?>
            </select>
        </div>

        <button type="submit" name="submit" class="submit-btn">Add Post</button>
    </div>
</form>