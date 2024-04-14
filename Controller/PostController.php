
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
    Upvote AS up_votes
FROM 
    Post;
";

        $db = Connection::getConnection(); // Correct the class name if it's Connection
        return $db->query($query)->fetchAll();
    }

    static function getPost($id) {
        $query = "SELECT * FROM Post WHERE idPost = $id";
        $db = Connection::getConnection(); // Correct the class name if it's Connection
        return $db->query($query)->fetch();
    }

    static function addPost(PostModel $post) {
        try {
            // Get a database connection
            $db = Connection::getConnection(); // Correct the class name if it's Connection

            $query = "INSERT INTO post (TITRE, Content, Create_At, Updated_At,Upvote) VALUES (:title, :content, :createdAt, :updatedAt, :upVotes)";
            $req = $db->prepare($query);

            $createdAt = $post->getCreatedAt()->format('Y-m-d H:i:s');
            $updatedAt = $post->getUpdatedAt()->format('Y-m-d H:i:s');
            // Execute the query with the provided parameters from the PostModel object
            $req->execute([
                'title' => $post->getTitle(),
                'content' => $post->getContent(),
                'createdAt' => $createdAt,
                'updatedAt' => $updatedAt,
                'upVotes' => $post->getUpVotes()
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

    static function deletePost($id) {
        $query = "DELETE FROM post WHERE idPost = $id";
        $db = Connection::getConnection(); // Correct the class name if it's Connection
        return $db->exec($query);
    }

}
?>