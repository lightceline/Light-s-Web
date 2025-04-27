<?php
function totalPosts($pdo){
    $query = query($pdo, 'SELECT COUNT(*) FROM posts');
    $row = $query->fetch();
    return $row[0];
}

function query($pdo, $sql, $parameters = []){
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}

function getPosts($pdo, $id){
    $parameters = [':id' => $id];
    $query= query($pdo, 'SELECT * FROM posts WHERE id = :id', $parameters);
    return $query->fetch();
}

function updatePosts($pdo, $postId, $postContent, $image){
    $query = 'UPDATE posts SET postContent = :postContent, image = :image WHERE id = :id';
    $parameters = [':postContent' => $postContent, ':image' => $image, ':id' => $postId];
    query($pdo, $query, $parameters);
}

function deletePosts($pdo, $id){
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM posts WHERE id = :id', $parameters);
}

function insertPosts($pdo, $postContent, $user_id, $module_id, $image) {
    $query = 'INSERT INTO posts (postContent, created_at, user_id, module_id, image)
              VALUES (:postContent, CURDATE(), :user_id, :module_id, :image)';
    $parameters = [
        ':postContent' => $postContent,
        ':user_id' => $user_id,
        ':module_id' => $module_id,
        ':image' => $image
    ];
    query($pdo, $query, $parameters);
}

function allUsers($pdo){
    $users = query($pdo, 'SELECT * FROM users');
    return $users->fetchAll();
}

function allModules($pdo){
    $modules = query($pdo, 'SELECT * FROM modules');
    return $modules->fetchAll();
}

function insertModules($pdo, $moduleName){
    $query = 'INSERT INTO modules (moduleName) VALUES (:moduleName)';
    $parameters = [':moduleName' => $moduleName];
    query($pdo, $query, $parameters);
}

function allPosts($pdo) {
    $query = 'SELECT posts.id, posts.postContent, posts.created_at, posts.image,
                     users.username, users.email, modules.moduleName 
              FROM posts
              INNER JOIN users ON posts.user_id = users.id
              INNER JOIN modules ON posts.module_id = modules.id
              ORDER BY posts.created_at DESC, posts.id DESC';  // Added time-based sorting
    
    $result = query($pdo, $query);
    return $result->fetchAll();
}

function insertUser($pdo, $username, $email, $password, $role){
    $query = 'INSERT INTO users (username, email, password, role) VALUES (:username, :email, :password, :role)';
    $parameters = [':username' => $username, ':email' => $email, ':password' => $password, ':role' => $role];
    query($pdo, $query, $parameters);
}

function insertComments($pdo, $postId, $userId, $commentContent){
    $query = 'INSERT INTO comments (post_id, user_id, commentContent, created_at) 
              VALUES (:post_id, :user_id, :commentContent, NOW())';
    $parameters = [
        ':post_id' => $postId, 
        ':user_id' => $userId, 
        ':commentContent' => $commentContent
    ];
    query($pdo, $query, $parameters);
}

function allComments($pdo){
    $comments = query($pdo, 'SELECT * FROM comments');
    return $comments->fetchAll();
}

function totalComments($pdo){
    $query = query($pdo, 'SELECT COUNT(*) FROM comments');
    $row = $query->fetch();
    return $row[0];
}

function getComment($pdo, $id){
    $parameters = [':id' => $id];
    $query= query($pdo, 'SELECT * FROM comments WHERE id = :id', $parameters);
    return $query->fetch();
}
function updateComment($pdo, $commentId, $commentContent){
    $query = 'UPDATE comments SET commentContent = :commentContent WHERE id = :id';
    $parameters = [':commentContent' => $commentContent, ':id' => $commentId];
    query($pdo, $query, $parameters);
}

function deleteComment($pdo, $id){
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM comments WHERE id = :id', $parameters);
}


function deleteModules ($pdo, $id){
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM modules WHERE id = :id', $parameters);
}

function updateModules ($pdo, $moduleId, $moduleName){
    $query = 'UPDATE modules SET moduleName = :moduleName WHERE id = :id';
    $parameters = [':moduleName' => $moduleName, ':id' => $moduleId];
    query($pdo, $query, $parameters);
}

function getPostWithComments($pdo, $postId) {
    $parameters = [':postId' => $postId];
    
    // Get post details
    $postQuery = 'SELECT posts.id, posts.postContent, posts.created_at, 
                        posts.image, modules.moduleName, 
                        users.username, users.email, users.role
                 FROM posts
                 INNER JOIN modules ON posts.module_id = modules.id
                 INNER JOIN users ON posts.user_id = users.id
                 WHERE posts.id = :postId';
    
    $post = query($pdo, $postQuery, $parameters)->fetch(PDO::FETCH_ASSOC);
    
    if (!$post) {
        return false;
    }

    // Get comments
    $commentQuery = 'SELECT comments.commentContent, comments.created_at, users.username 
                    FROM comments
                    INNER JOIN users ON comments.user_id = users.id
                    WHERE comments.post_id = :postId
                    ORDER BY comments.created_at ASC';
    
    $post['comments'] = query($pdo, $commentQuery, $parameters)->fetchAll(PDO::FETCH_ASSOC);
    
    return $post;
}
?>


