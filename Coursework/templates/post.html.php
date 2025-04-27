<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

<p>Posts (<?=$totalPosts?>)</p>

<?php
foreach($posts as $post): ?>
    <section class="post-card" onclick="window.location.href='fullpost.php?id=<?= $post['id'] ?>'">
    <section class="post-view" data-post-id="<?= $post['id'] ?>">

    <blockquote style="position: relative;">
        <span style="position: absolute; top: 10px; right: 10px;">      
        <form action="deletepost.php" method="post">
            <input type='hidden' name='id' value='<?=$post['id']?>'>
            <input type="submit" value="Delete">
            <a href="editpost.php?id=<?=$post['id']?>">Edit</a>
        </form>

        </span>

        <a href="mailto:<?=htmlspecialchars($post['email'], ENT_QUOTES, 'UTF-8');?>">
        <?=htmlspecialchars($post['username'], ENT_QUOTES, 'UTF-8'); ?></a><br /><br />
        
        <?=htmlspecialchars($post['moduleName'], ENT_QUOTES, 'UTF-8');?><br /><br />

        <?=htmlspecialchars($post['postContent'], ENT_QUOTES, 'UTF-8' )?><br /><br />
        
        <small>Posted on: <?= date("D d M Y H:i", strtotime($post['created_at'])) ?></small><br /><br />
        
        <?php if (!empty($post['image'])) : ?>
            <img height="100px" src="../uploads/<?= htmlspecialchars($post['image']); ?>" alt="Post Image">
        <?php else : ?>
            No image
        <?php endif; ?><br /><br />

            <a href="fullpost.php?id=<?=$post['id']?>"> 
                <i class='bx bx-comment'></i> Comments</a>
    </section>        

    </blockquote>
    <?php endforeach;?>
    