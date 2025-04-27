<div class="admin-panel">
    <h2>Manage Users</h2>
    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr id="user-<?= $user['id'] ?>">
                        <td>
                            <form action="edituser.php" method="POST" class="edit-form">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" class="edit-input">
                        </td>
                        <td>
                                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" class="edit-input">
                        </td>
                        <td>
                                <select name="role" class="edit-input">
                                    <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                </select>
                        </td>
                        <td class="actions">
                                <button type="submit" class="save-btn">Save</button>
                            </form>
                            <form action="deleteuser.php" method="POST" class="delete-form">
                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>