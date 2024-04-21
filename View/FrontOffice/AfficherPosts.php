<?php

include_once "../../Controller/PostController.php";
include_once '../../Model/CommentaireModel.php';
include_once "../../Controller/CommentaireController.php";
$posts = PostController::getPosts();
function insert_line_breaks($string, $interval) {
    // Break the string into segments of the specified interval
    $pattern = "/.{1,$interval}/";
    preg_match_all($pattern, $string, $matches);

    // Join the segments with a line break
    return implode("<br />", $matches[0]);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize the content input
    //$content = filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING);
    $content = $_POST['commentaire-content'];
    // Validate that content is not empty
    if (!empty($content)) {
        //$postId = filter_input(INPUT_POST, 'post_id', FILTER_SANITIZE_NUMBER_INT);
        $postId = $_POST['post_id'];
        // Create a new comment model and set its attributes
        $comment = new CommentaireModel(
            1, // ID of the current user
            $content,
            new DateTime(),
            $postId
        );

        // Add the comment to the database
        $commentController = new CommentaireController();
        $result = $commentController->addCommentaire($comment);

        if ($result) {
            // Redirect to the page or display a success message
        } else {
            // Handle error
        }
    } else {
        // Handle validation error (content is empty)
    }

}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactez-nous</title>
    <link rel="stylesheet" href="../Assets/reclamation.css">
    <link rel="stylesheet" href="./assets/style.css">

</head>
<body>

<header class="header-style">
    <div class="logo-header">
        <img src="../Assets/photos/EasyRecruit-logo.svg" alt="logo" width="150" height="60"/> <!-- Réduction de la taille du logo -->
    </div>
    <div class="links-header">
        <a href="#" class="btn-recrut">Espace Recruteur</a>
        <a href="#" class="btn-inscri"> <img src="../Assets/photos/icon-inscription.svg" alt="Inscription" width="30" height="30">Inscription</a>
        <a href="#" class="btn-compte"> <img src="../Assets/photos/icon-compte.svg" alt="mon compte" width="30" height="30"> Mon compte</a>
    </div>
</header>

<div class="block-intro">
    <div class="overlay">
        <div class="desc-intro">
            <h1 class="desc-style">Forgez votre avenir, <br>
                <span> trouvez votre voie professionnelle ici !</span> </h1>
            <a href="#" class="btn-decouvrir">découvrir plus</a>
        </div>
    </div>
</div>

<div id="mother">

    <div id="option">
        <div class="container">
            <ul>
                <li>
                    <img src="./assets/assets/save_post.png" class="icon">
                    <span class="option-title">Save Post</span>
                    <p class="option-title">Add this to your saved items</p>
                </li>
                <li class="turn_off_post">
                    <img src="./assets/assets/notification.png" class="icon">
                    <span class="option-title">Turn off notification for this post.</span>
                </li>
                <li>
                    <img src="./assets/assets/hide_post.png" class="icon">
                    <span class="option-title">Hide post</span>
                    <p class="option-title">Add this to your saved items.</p>
                </li>
                <li>
                    <img src="./assets/assets/snooze.png" class="icon">
                    <span class="option-title">Snooze</span>
                    <p class="option-title">Temporarily stop seeing posts.</p>
                </li>
                <li>
                    <img src="./assets/assets/unfollow.png" class="icon">
                    <span class="option-title">Unfollow Rejwan Islam Rijvy</span>
                    <p class="option-title">Temporarily stop seeing posts.</p>
                </li>
                <li>
                    <img src="./assets/assets/find_post.png" class="icon">
                    <span class="option-title">Find support or report pos</span>
                    <p class="option-title">I'm concerned about this post.</p>
                </li>
            </ul>
        </div>
    </div>

    <div class="reaction" id="emojies">
        <div class="row">
            <img id="e-like" src="./assets/svg/like.svg" alt="">
            <img id="e-love" src="./assets/svg/love.svg" alt="">
            <img id="e-care" src="./assets/svg/care.svg" alt="">
            <img id="e-haha" src="./assets/svg/haha.svg" alt="">
            <img id="e-wow" src="./assets/svg/wow.svg" alt="">
            <img id="e-sad" src="./assets/svg/sad.svg" alt="">
            <img id="e-angry" src="./assets/svg/angry.svg" alt="">
        </div>
    </div>
</div>

<?php
// Loop through each post and display them in the table
foreach ($posts as $index => $post) {
    ?>

    <div class="fb-post" id="fpost0">

        <!-- Top Section -->

        <div class="top-s">
            <div class="top-info">
                <div class="profile-picture">
                    <img src="./assets/assets/profile-pic.jpg">
                </div>
                <div class="top-title">
                    <div class="profile-name">
                        <a href="#">Melek Rabboudi</a>
                    </div>
                    <div class="post-time">
                        <span> <?php echo $post['created_at']?> </span>
                        <img src="./assets/svg/lock.svg">
                    </div>
                </div>
                <div class="top-options">
                    <button>
                        <img src="./assets/svg/three_dot.svg">
                    </button>
                </div>
            </div>
            <div class="post-content">
                <strong> <?php echo $post['post_title']?> </strong><br />
                 <br />
                <?php echo insert_line_breaks($post['post_content'], 40)?>
            </div>
        </div>

        <!-- Like section -->

        <div class="like-section">
            <div class="top-part">
                <div class="left-part">
                    <div class="react">
                        <img src="./assets/svg/love.svg" alt="">
                        <img src="./assets/svg/care.svg" alt="">
                        <img src="./assets/svg/like.svg" alt="">
                    </div>
                    <div class="id-name">
                        <p>You, Ahmed and <span>9</span> others</p>
                    </div>
                </div>
                <div class="right-part">
                    <p><span>1</span>Comments</p>
                </div>
            </div>
            <div class="bottom-part">
                <div class="like-btn" fpost="0">
                    <img src="./assets/svg/thumbs-up.svg" alt="">
                    <span>Like</span>
                </div>
                <div class="comment-btn" fpost="0">
                    <img src="./assets/svg/message-square.svg" alt="">
                    <span>Comment</span>
                </div>
                <div class="share-btn">
                    <img src="./assets/svg/share-2.svg" alt="">
                    <span>Share</span>
                </div>
            </div>
        </div>

        <!-- Comment section-->

        <div class="all-comments">
            <h4>All comments <img src="./assets/svg/sort-down.svg" class="all-comments-h4-i" alt=""></h4>
        </div>
            <?php
            $postId  = $post['id'];
            $comments = CommentaireController::getCommentsByPostId($postId);
$maxCommentsToShow = 3; // Maximum number of comments to display initially
$commentsToDisplay = array_slice($comments, 0, $maxCommentsToShow); // Get the first 5 comments
$additionalCommentsExist = count($comments) > $maxCommentsToShow; // Check if more comments exist

foreach ($commentsToDisplay as $comment) {
?>
        <div class="comment-box">
            <div class="comment-container">
                <div class="comment">
                    <img src="./assets/assets/maruf.jpg" alt="" class="comment-img">
                    <div class="comment-text">
                        <div class="comment-header">
                            <p><strong>Abdullah Al Maruf</strong></p>
                        </div>
                        <p><?php echo $comment->getContent(); ?></p>
                    </div>
                    <div class="three-dot">
                        <img src="./assets/svg/three_dot_gray.svg" class="three-dot-img" alt="">
                    </div>
                </div>
                <div class="comment-lks">
                    <p>
                        <span>Like</span><span class="dot"> . </span>
                        <span>Reply</span><span class="dot"> . </span>
                        <span>Share</span><span class="dot"> . </span>
                        <span>2 m</span>
                    </p>
                </div>
            </div>
        </div>
        <?php
        }

        // Display a "Read More" link if there are additional comments
        if ($additionalCommentsExist) {
        ?>
        <div class="read-more">
            <a href="all-comments.php?postId=<?php echo $postId; ?>">Read More</a>
        </div>
        <?php
        }
        ?>
        <div class="comment-s">
            <div class="comment-area">
                <div class="comment-profile-pic">
                    <img src="./assets/assets/profile-pic.jpg" alt="user">
                </div>
                <div class="comment-input-area">
                    <form method="post" >
                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                        <input type="text" placeholder="Write a comment..." id="commentaire-content" name="commentaire-content">
                        <button type="submit">Comment</button>
                    </form>
                    <div class="comment-icon">
                        <div class="icon-comment"><img src="./assets/svg/smile-1.svg" alt=""></div>
                        <div class="icon-comment"><img src="./assets/svg/camera.svg" alt=""></div>
                        <div class="icon-comment"><img src="./assets/svg/gif%20(1).svg" alt=""></div>
                        <div class="icon-comment"><img src="./assets/svg/circular-sticker.svg" alt=""></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
}
?>







<footer>
    <div class="footer-container">
        <div class="footer-links">
            <h3 class="titre-footer">Liens rapides</h3>
            <div class="block-links-style">
                <a href="#" class="link-footer">Inscription</a>
                <a href="#" class="link-footer">Espace Recruteur</a>
                <a href="#" class="link-footer">Mon Compte</a>
                <a href="#" class="link-footer">Nous Contacter</a>
            </div>
        </div>
        <div class="footer-social">
            <h3 class="titre-footer">Suivez-nous</h3>
            <div class="block-links-style-rs">
                <a href="#" class="link-footer-rs"><img src="../Assets/photos/fb.png" alt="Facebook"></a>
                <a href="#" class="link-footer-rs"><img src="../Assets/photos/insta.png" alt="Instagram"></a>
                <a href="#" class="link-footer-rs"><img src="../Assets/photos/linkidin.png" alt="LinkedIn"></a>
                <a href="#" class="link-footer-rs"><img src="../Assets/photos/twitter.png" alt="Twitter"></a>
            </div>
        </div>
    </div>
    <div class="copy-right">
        <p>Copyright © 2024 EasyRecruit</p>
    </div>
</footer>

<script src="./assets/script.js"></script>



</body>
