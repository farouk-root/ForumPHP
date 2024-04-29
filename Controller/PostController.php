
<?php

include_once __DIR__ . '/../Connection.php';
include_once __DIR__ . '/../Model/PostModel.php';

class PostController {

    static function getPosts() {
        $query = "SELECT 
    idPost AS id,
    TITRE AS post_title,
    Content AS post_content,
    Create_At AS created_at,
    Updated_At AS updated_at,
    Upvote AS up_votes,
    Status AS status
FROM 
    Post;
";

        $db = Connection::getConnection(); // Correct the class name if it's Connection
        return $db->query($query)->fetchAll();
    }

    static function getPost($id) {
        $query = "SELECT idPost AS id,
                    TITRE AS post_title,
                    Content AS post_content,
                    Create_At AS created_at,
                    Updated_At AS updated_at,
                    Upvote AS up_votes,
                    Status AS status
                        FROM Post WHERE idPost = $id";
        $db = Connection::getConnection();
        return $db->query($query)->fetch();
    }

    public static function incrementUpvotes(int $postId): bool {
        try {
            // Get a PDO connection
            $db = Connection::getConnection();

            // Prepare a SQL UPDATE query to increment upvotes by 1
            $query = "UPDATE Post SET Upvote = Upvote + 1 WHERE idPost = :postId";

            // Prepare the statement
            $stmt = $db->prepare($query);

            // Bind the post ID to the query to avoid SQL injection
            $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);

            // Execute the statement
            $result = $stmt->execute();

            // Return true if the operation is successful
            return $result;
        } catch (PDOException $e) {
            // Handle exceptions
            error_log("Error incrementing upvotes for post ID {$postId}: " . $e->getMessage());
            return false;  // Return false if there's an error
        }
    }

    static function addPost(PostModel $post) {
        try {
            // Get a database connection
            $db = Connection::getConnection(); // Correct the class name if it's Connection

            $query = "INSERT INTO post (TITRE, Content, Create_At, Updated_At,Upvote,Status) VALUES (:title, :content, :createdAt, :updatedAt, :upVotes ,:status)";
            $req = $db->prepare($query);

            $createdAt = $post->getCreatedAt()->format('Y-m-d H:i:s');
            $updatedAt = $post->getUpdatedAt()->format('Y-m-d H:i:s');
            // Execute the query with the provided parameters from the PostModel object
            $req->execute([
                'title' => $post->getTitle(),
                'content' => $post->getContent(),
                'createdAt' => $createdAt,
                'updatedAt' => $updatedAt,
                'upVotes' => $post->getUpVotes(),
                'status' => false
            ]);

            // Optionally, you can return the ID of the inserted post
            return $db->lastInsertId();
        } catch (Exception $e) {
            // Handle any exceptions that occur during the process
            echo $e->getMessage(); // You might want to log the error instead of echoing it
        }
    }

    static function updatePost($id, $title, $content, $Upvote) {
        $query = "UPDATE Post SET TITRE = '$title', Content = '$content' , Upvote = '$Upvote' WHERE idPost = $id";
        $db = Connection::getConnection(); // Correct the class name if it's Connection
        return $db->exec($query);
    }
    public static function togglePostStatus(int $postId): bool {
        try {
            // Get the current status of the post
            $db = Connection::getConnection();
            $stmt = $db->prepare("SELECT status FROM Post WHERE idPost = :postId");
            $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);
            $stmt->execute();
            $currentStatus = $stmt->fetchColumn();  // Fetch the current status

            // Determine the new status by toggling the current status
            $newStatus = ($currentStatus == 'true') ? 'false' : 'true';

            // Update the status in the Post table
            $updateStmt = $db->prepare("UPDATE Post SET status = :newStatus WHERE idPost = :postId");
            $updateStmt->bindParam(':newStatus', $newStatus, PDO::PARAM_STR);
            $updateStmt->bindParam(':postId', $postId, PDO::PARAM_INT);

            // Execute the update
            $result = $updateStmt->execute();

            return $result;  // Return true if the update is successful
        } catch (PDOException $e) {
            error_log("Error toggling post status: " . $e->getMessage());
            return false;  // Return false if an error occurs
        }
    }

    public static function setPostStatusToTrue(int $postId): bool {
        try {
            // Get a database connection
            $db = Connection::getConnection();

            // Prepare the SQL UPDATE query to set status to 'true'
            $stmt = $db->prepare("UPDATE Post SET Status = 1 WHERE idPost = :postId");

            // Bind the post ID to the query
            $stmt->bindParam(':postId', $postId, PDO::PARAM_INT);

            // Execute the query to update the status
            $result = $stmt->execute();

            // Return true if the update was successful
            return $result;
        } catch (PDOException $e) {
            error_log("Error updating post status to 'true': " . $e->getMessage());
            return false;  // Return false if there's an error
        }
    }

    static function deletePost($id) {
        $query = "DELETE FROM post WHERE idPost = $id";
        $db = Connection::getConnection(); // Correct the class name if it's Connection
        return $db->exec($query);
    }

}
?>