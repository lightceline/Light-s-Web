<div class="admin-panel">
    <h2>Manage Posts</h2>
    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th>Author</th>
                    <th>Module</th>
                    <th>Content</th>
                    <th>Posted Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($posts as $post): ?>
                    <tr>
                        <td><?= htmlspecialchars($post['username']) ?></td>
                        <td><?= htmlspecialchars($post['moduleName']) ?></td>
                        <td><?= htmlspecialchars(substr($post['postContent'], 0, 50)) ?>...</td>
                        <td><?= date('d M Y', strtotime($post['created_at'])) ?></td>
                        <td class="actions">
                            <a href="editpost.php?id=<?= $post['id'] ?>" class="edit-btn">Edit</a>
                            <form action="deletepost.php" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $post['id'] ?>">
                                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>