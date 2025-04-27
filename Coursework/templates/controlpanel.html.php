<div class="control-panel">
    <h2>Admin Control Panel</h2>
    
    <div class="stats-grid">
        <div class="stat-card">
            <h3>Total Users</h3>
            <p class="stat-number"><?= $totalUsers ?></p>
        </div>
        <div class="stat-card">
            <h3>Total Posts</h3>
            <p class="stat-number"><?= $totalPosts ?></p>
        </div>
        <div class="stat-card">
            <h3>Total Modules</h3>
            <p class="stat-number"><?= $totalModules ?></p>
        </div>
    </div>

    <div class="admin-actions">
        <div class="action-card">
            <h3>Module Management</h3>
            <div class="action-links">
                <a href="managemodule.php" class="admin-btn">Manage Modules</a>
            </div>
        </div>

        <div class="action-card">
            <h3>User Management</h3>
            <div class="action-links">
                <a href="manageuser.php" class="admin-btn">Manage Users</a>
            </div>
        </div>

        <div class="action-card">
            <h3>Post Management</h3>
            <div class="action-links">
                <a href="managepost.php" class="admin-btn">Manage Posts</a>
            </div>
        </div>
    </div>
</div>