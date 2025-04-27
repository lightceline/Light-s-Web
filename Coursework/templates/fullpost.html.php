<section class="post-detail">
    <?php if ($post): ?>
        <div class="post-header">
            <p class="post-author"><strong>Author:</strong> <?= htmlspecialchars($post['username'], ENT_QUOTES, 'UTF-8') ?></p>
            <p class="post-module"><strong>Module:</strong> <?= htmlspecialchars($post['moduleName'], ENT_QUOTES, 'UTF-8') ?></p>
        </div>

        <div class="post-content">
            <?= nl2br(htmlspecialchars($post['postContent'], ENT_QUOTES, 'UTF-8')) ?>
        </div>

        <p class="post-date"><strong>Posted on:</strong> <?= htmlspecialchars(date("D d M Y", strtotime($post['created_at'])), ENT_QUOTES, 'UTF-8') ?></p>
        
        <?php if (!empty($post['image'])): ?>
            <div class="post-image">
                <img height="500px" width="500px" src="../uploads/<?= htmlspecialchars($post['image'], ENT_QUOTES, 'UTF-8') ?>" alt="Post Image">
            </div>
        <?php endif; ?>

        <hr>

        <p>Comments (<?=$totalComments?>) </p>
            
                    <!-- Comment Form -->
        <div class="comment-section">
            <form action="addcomment.php" method="POST" class="comment-form">
                <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                <div class="comment-input-group">
                    <textarea name="commentContent" id="commentContent" rows="2" required placeholder="Write your comment here..."></textarea>
                    <button type="submit" class="comment-submit">Post</button>
                </div>
            </form>
        </div>

            <?php foreach ($comments as $comment): ?>
                <div class="comment-box">
                    <p><strong><?= htmlspecialchars($comment['username'], ENT_QUOTES, 'UTF-8') ?></strong> 
                    <br>
                    <?= nl2br(htmlspecialchars($comment['commentContent'], ENT_QUOTES, 'UTF-8')) ?></p>
                    <p class="comment-time"><?= date("D d M Y H:i", strtotime($comment['created_at'])) ?></p>
                </div>
            <?php endforeach; ?>
        

        <hr>


    <?php else: ?>
        <p>Post not found.</p>
    <?php endif; ?>
</section>