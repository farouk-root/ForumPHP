<?php

include_once "../../Controller/PostController.php";
$posts = PostController::getPosts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
        rel="stylesheet"
        href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
        crossorigin="anonymous"
    />
    <link rel="stylesheet" href="./assets/styles.css" />
    <style>
        a.button {
            display: inline-block;
            margin: 0 5px;
            padding: 10px 20px; /* Increased padding for a bigger button */
            background-color: #3ea175;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            text-decoration: none; /* Remove underline */
            cursor: pointer;
        }

        .crud__container {
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }
        .enabled-button {
            background-color: red;  /* Red for enabled buttons */
            color: white;  /* White text for contrast */
            padding: 8px 16px;  /* Padding for the button */
            border: none;  /* No border */
            border-radius: 4px;  /* Rounded corners */
            cursor: pointer;  /* Cursor changes to pointer */
            text-align: center;  /* Center align text */
            display: inline-block;  /* Display as inline block */
        }

        .disabled-button {
            background-color: gray;  /* Gray for disabled buttons */
            color: white;  /* White text for contrast */
            padding: 8px 16px;  /* Same padding as enabled buttons */
            border: none;  /* No border */
            border-radius: 4px;  /* Rounded corners */
            text-align: center;  /* Center align text */
            display: inline-block;  /* Display as inline block */
            cursor: not-allowed;  /* Cursor indicates the button is disabled */
        }

        .disabled-button a {
            color: white;  /* Ensure the link inside the disabled button is styled correctly */
        }


    </style>
    <title>wadhah s DASHBOARD</title>
</head>
<body id="body">
<div class="container">
    <nav class="navbar">
        <div class="nav_icon" onclick="toggleSidebar()">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <div class="navbar__left">
            <a href="Reclamation/reclamation.html">Subscribers</a>
            <a class="active_link" href="#">Admin</a>
        </div>
        <div class="navbar__right">
            <a href="#">
                <i class="fa fa-search" aria-hidden="true"></i>
            </a>
            <a href="#">
                <i class="fa fa-clock-o" aria-hidden="true"></i>
            </a>
            <a href="#">
                <img width="30" src="assets/avatar.svg" alt="" />
            </a>
        </div>
    </nav>

    <main>
        <div class="main__container">
            <!-- MAIN TITLE -->
            <div class="main__title">
                <img src="assets/hello.svg" alt="zt" />
                <div class="main__greeting">
                    <h1>Hello Wadhah</h1>

                    <p>Welcome to your admin dashboard</p>
                </div>
            </div>

            <!-- MAIN CARDS -->
            <div class="main__cards">
                <div class="card">
                    <i class="fa fa-user-o fa-2x text-lightblue" aria-hidden="true"></i>
                    <div class="card_inner">
                        <p class="text-primary-p">Number of Subscribers</p>
                        <span class="font-bold text-title">578</span>
                    </div>
                </div>
                <!-- Ajoutez d'autres cartes ici -->
                <div class="card">
                    <i class="fa fa-calendar fa-2x text-red" aria-hidden="true"></i>
                    <div class="card_inner">
                        <p class="text-primary-p">Times of using</p>
                        <span class="font-bold text-title">2467</span>
                    </div>
                </div>

                <div class="card">
                    <i
                        class="fa fa-video-camera fa-2x text-yellow"
                        aria-hidden="true"
                    ></i>
                    <div class="card_inner">
                        <p class="text-primary-p">Number of offre d emploie</p>
                        <span class="font-bold text-title">340</span>
                    </div>
                </div>

                <div class="card">
                    <i
                        class="fa fa-thumbs-up fa-2x text-green"
                        aria-hidden="true"
                    ></i>
                    <div class="card_inner">
                        <p class="text-primary-p">Number of reclamation</p>
                        <span class="font-bold text-title">645</span>
                    </div>
                </div>

            </div>

            <!-- CHARTS -->
            <div class="charts">
                <div class="charts__left">
                    <div class="charts__left__title">
                        <div>
                            <h1>Daily Reports</h1>
                            <p>Hay el khadra, ultras 2002, TUNISIE</p>
                        </div>
                        <i class="fa fa-usd" aria-hidden="true"></i>
                    </div>
                    <div id="apex1"></div>
                </div>
                <!-- Ajoutez d'autres éléments de graphique ici -->

            </div>

            

            <!-- CRUD TABLE -->
            <div class="crud__container">
                <a href="AddTest.php" class="button" id="addPostButton">Add Post</a>
                <div class="crud__table">
                    <div class="crud__table-header">

                        <div>#</div>
                        <div>Title</div>
                        <div>Actions</div>
                    </div>

                    <?php
                    // Loop through each post and display them in the table
                    $posts = array_reverse($posts);
                    foreach ($posts as $index => $post) {
                        $postStatus = $post['status'] ;

                        // Determine the class based on the post's status


                        echo '<div class="crud__table-row">';
                        echo '<div data-label="#">' . $post['id'] . '</div>';
                        echo '<div data-label="Title">' . $post['post_title'] . '</div>';
                        echo '<div data-label="Actions">';
                        echo '<button>';
                        echo "<a href='edit_post.php?id=" . $post['id'] . "'><i class='fa fa-pencil'></i></a>";
                        echo '</button>';
                        echo '<button>';
                        echo "<a   href='delete_post.php?id=" . $post['id'] . "'><i class='fa fa-trash'></i></a>";;
                        echo '</button>';
                    $postStatus = $post['status'];  // Post status

                    // Determine the button attributes based on the status
                    if ($postStatus == 1) {
                        // If the post status is 1, the button is disabled
                        $buttonClass = "disabled-button";  // Gray or some other color for disabled
                        $buttonAttributes = "disabled";  // Disable the button
                    } else {
                        // If the post status is not 1, the button is enabled and red
                        $buttonClass = "enabled-button";  // Red color for enabled
                        $buttonAttributes = "";  // No additional attributes for enabled
                    }

                    // Define the link for the action
                    $confirmLink = "ConfirmerPost.php?id=" . $post['id'];

                    // Output the button with the correct attributes
                    echo '<button class="' . $buttonClass . '" ' . $buttonAttributes . '>';
                    echo "<a href='" . $confirmLink . "' style='text-decoration: none; color: inherit;'><i class='fa fa-check'></i></a>";
                    echo '</button>';

                        echo '</div>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </main>


    <div id="sidebar">
        <div class="sidebar__title">
            <i class="fa fa-bars fa-lg text-white" id="sidebarIcon" aria-hidden="true" onclick="toggleSidebar()"></i>
            <h1>Dashboard</h1>

        </div>
        <div class="sidebar__menu">
            <div class="sidebar__link">
                <i class="fa fa-home"></i>
                <a href="./Home.php">Dashboard</a>
            </div>
            <h2>ADMIN</h2>
            <div class="sidebar__link">
                <i class="fa fa-user-secret"></i>
                <a href="#">reclamation Management</a>

            </div>
            <h2>USER</h2>
            <div class="sidebar__link">
                <i class="fa fa-building-o"></i>
                <a href="user.html">user management</a>
            </div>
            <h2>FORMATION</h2>
            <div class="sidebar__link">
                <i class="fa fa-archive"></i>
                <a href="#">formation management</a>
            </div>
            <h2>FORUM</h2>
            <div class="sidebar__link active_menu_link">
                <i class="fa fa-user"></i>
                <a href="#">forum management</a>
            </div>
            <h2>OFFRE D EMPLOIE</h2>
            <div class="sidebar__link">
                <i class="fa fa-calendar"></i>
                <a href="#">offre d emploie maagement</a>
            </div>

        </div>
    </div>


</div>





</body>
</html>

