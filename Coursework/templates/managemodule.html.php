<div class="admin-panel">
    <h2>Manage Modules</h2>
    
    <div class="add-form">
        <h3>Add New Module</h3>
        <form action="addmodule.php" method="POST">
            <input type="text" name="moduleName" required placeholder="Enter module name">
            <button type="submit" class="add-btn">Add Module</button>
        </form>
    </div>

    <div class="data-table">
        <table>
            <thead>
                <tr>
                    <th>Module Name</th>
                    <th>Posts Count</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($modules as $module): ?>
                    <tr>
                        <td>
                            <form action="editmodule.php" method="POST" class="edit-form">
                                <input type="hidden" name="id" value="<?= $module['id'] ?>">
                                <input type="text" name="moduleName" value="<?= htmlspecialchars($module['moduleName']) ?>">
                                <button type="submit" class="save-btn">Save</button>
                            </form>
                        </td>
                        <td><?= $module['post_count'] ?></td>
                        <td class="actions">
                            <form action="deletemodule.php" method="POST" style="display: inline;">
                                <input type="hidden" name="id" value="<?= $module['id'] ?>">
                                <button type="submit" class="delete-btn" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>