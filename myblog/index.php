<?php
include 'config.php';

// Fetch all posts from the database
$query = "SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title> TECH_BLOGS</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Baskervville+SC&family=DM+Serif+Text:ital@0;1&family=Nerko+One&display=swap" rel="stylesheet">

        <link rel="stylesheet" type="text/css" href="style.css">
        <style type="text/css">
        </style>
    </head>

    <body>
       <?php
       include 'navbar.php';
       ?>
        <header class="main_header">
            <div class="d-flex justify-content-center align-items-center flex-column py-5">
                <h1 class="text-uppercase main_heading">  TECH_BLOGS</h1>
                <p class="main_heading__para">Welcome to my <span class="text-capitalize bg-dark text-white py-2 px-3"> world of blog</span> </p>
            </div>
           
        </header>
        <!-- header ends -->

        <!-- Left Column for Blog Cards -->
        <div class="container mt-4">
            <div class="row">
                <div class="col-md-8 leftcolumn">
                    <div class="card">
                        <h2 class="my-4">My Blog Posts</h2>
                        <?php while ($post = mysqli_fetch_assoc($result)): ?>
                            <div class="card mb-4 shadow-sm">
                                <div class="card-body">
                                    <h3 class="card-title text-uppercase"><?php echo htmlspecialchars($post['title']); ?></h3>
                                    <p class="card-subtitle mb-2 text-muted">
                                        <span class="font-weight-bold">By <?php echo htmlspecialchars($post['username']); ?></span>, 
                                        <?php echo date('F j, Y', strtotime($post['created_at'])); ?>
                                    </p>
                                    <figure class="right_side_img mb-3">
                                        <img src="https://images.pexels.com/photos/3815750/pexels-photo-3815750.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" class="img-fluid shadow-sm" style="max-height: 100%; max-width: 100%;">
                                    </figure>
                                    <p class="card-text"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
                                    <div class="d-flex justify-content-between">
                                        <button class="btn btn-outline-primary" id="like_btn"><i class="fa fa-thumbs-up"></i> Like</button>
                                        <button class="btn btn-outline-secondary" onclick="reply('reply<?php echo $post['id']; ?>')">Replies <span class="badge bg-secondary">1</span></button>
                                    </div>
                                    <div class="replies mt-3" id="reply<?php echo $post['id']; ?>">
                                        <div class="d-flex justify-content-start flex-row align-items-center card reply_card py-3">
                                            <div class="reply_img mx-2 align-self-center">
                                                <img src="https://img.icons8.com/doodle/48/000000/user-male-skin-type-5.png" />
                                            </div>
                                            <div class="reply_text__left">
                                                <p class="blog_title"><span class="font-weight-bold">User,</span> Date and time</p>
                                                <p>Awesome, Bro I love your content.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Add Comment Section -->
                                    <div class="add-comment-section mt-4">
                                        <h5>Add a Comment:</h5>
                                        <form id="commentForm">
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="commentInput" placeholder="Write your comment..." required>
                                                <button class="btn btn-primary" type="submit">Submit</button>
                                            </div>
                                        </form>
                                        <div id="commentsList" class="mt-3"></div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>


                        
                        <!-- First Blog Post -->
                        <div class="col-12">
                            <div class="card p-4 shadow blog_left__div">
                                <div class="d-flex justify-content-center align-items-center flex-column pt-3 pb-5">
                                <h1 class="text-uppercase">Best Laptop in 2020</h1>
                                    <p class="blog_title"><span class="font-weight-bold">Title description,</span> Aug 12, 2020</p>
                                </div>
                                <figure class="mb-5">
                                    <img src="https://images.pexels.com/photos/3815750/pexels-photo-3815750.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" class="img-fluid shadow">
                                </figure>
                                <p><span class="font-weight-bold"></span> In 2020, the laptop market saw significant advancements in performance and design, driven by new processors and innovative features. Whether for professional use, gaming, or casual browsing, there were excellent options to meet diverse needs...</p>
                                <div class="d-flex justify-content-between left_div_btns">
                                    <button class="left_div__like" id="like_btn"><i class="fa fa-thumbs-up"></i> Like</button>
                                    <button class="left_div__reply" onclick="reply('reply1')">Replies <badge class="bg-white text-dark p-2">1</badge></button>
                                </div>
                                <div class="replies mt-3" id="reply1">
                                    <!-- Replies go here -->
                                    <div class="d-flex justify-content-start align-items-center card reply_card py-3">
                                        <img src="https://img.icons8.com/doodle/48/000000/user-male-skin-type-5.png" class="reply_img mx-2">
                                        <div>
                                            <p class="blog_title"><span class="font-weight-bold">Thapa,</span> Aug 12, 2020, 7:20 PM</p>
                                            <p>Awesome, Bro I love your content.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add Comment Section -->
                                <div class="add-comment-section mt-4">
                                    <h5>Add a Comment:</h5>
                                    <form id="commentForm">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="commentInput" placeholder="Write your comment..." required>
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </form>
                                    <div id="commentsList" class="mt-3"></div>
                                </div>
                            </div>
                        </div>

                        
                    

                        <!-- Second Blog Post -->
                        <div class="col-12">
                            <div class="card p-4 shadow blog_left__div">
                                <div class="d-flex justify-content-center align-items-center flex-column pt-3 pb-5">
                                <h1 class="text-uppercase"></h1>
                                    <p class="blog_title"><span class="font-weight-bold">Introduction to JavaScript</span> Aug 12, 2020</p>
                                </div>
                                <figure class="mb-5">
                                    <img src="https://images.pexels.com/photos/4050291/pexels-photo-4050291.jpeg?auto=compress&cs=tinysrgb&dpr=3&h=750&w=1260" class="img-fluid shadow">
                                </figure>
                                <p><span class="font-weight-bold"></span> JavaScript is used in millions of Web pages to improve the design, validate forms, detect browsers, create
cookies, and much more.
JavaScript is the most popular scripting language on the Internet, and works in all major browsers, such as
Internet Explorer, Mozilla Firefox, and Opera.
</p>
                                <div class="d-flex justify-content-between left_div_btns">
                                    <button class="left_div__like" id="like_btn"><i class="fa fa-thumbs-up"></i> Like</button>
                                    <button class="left_div__reply" onclick="reply('reply2')">Replies <badge class="bg-white text-dark p-2">2</badge></button>
                                </div>
                                <div class="replies mt-3" id="reply2">
                                    <!-- Replies go here -->
                                    <div class="d-flex justify-content-start align-items-center card reply_card py-3">
                                        <img src="https://img.icons8.com/doodle/48/000000/user-male-skin-type-5.png" class="reply_img mx-2">
                                        <div>
                                            <p class="blog_title"><span class="font-weight-bold">Vinod,</span> Aug 11, 2020, 7:20 PM</p>
                                            <p>I really like the way you teach. Subscribed :)</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-start align-items-center card reply_card py-3">
                                        <img src="https://img.icons8.com/doodle/48/000000/user-male-skin-type-5.png" class="reply_img mx-2">
                                        <div>
                                            <p class="blog_title"><span class="font-weight-bold">Thapa,</span> Aug 12, 2020, 7:20 PM</p>
                                            <p>Awesome, Bro I love your content.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add Comment Section -->
                                <div class="add-comment-section mt-4">
                                    <h5>Add a Comment:</h5>
                                    <form id="commentForm">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="commentInput" placeholder="Write your comment..." required>
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </form>
                                    <div id="commentsList" class="mt-3"></div>
                                </div>
                            </div>
                        </div>


                        <!-- Third Blog Post -->
                        <div class="col-12">
                            <div class="card p-4 shadow blog_left__div">
                                <div class="d-flex justify-content-center align-items-center flex-column pt-3 pb-5">
                                <h1 class="text-uppercase">Artificial intelligence (AI)</h1>
                                    <p class="blog_title"><span class="font-weight-bold">Artificial intelligence, in its broadest sense, is intelligence exhibited by machines, particularly computer systems.</span> Aug 12, 2020</p>
                                </div>
                                <figure class="mb-5">
                                    <img src="https://images.pexels.com/photos/4050303/pexels-photo-4050303.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" class="img-fluid shadow">
                                </figure>
                                <p><span class="font-weight-bold"></span> Artificial intelligence (AI) is a set of technologies that enable computers to perform a variety of advanced functions, including the ability to see, understand and translate spoken and written language, analyze data, make recommendations, and more.</p>
                                <div class="d-flex justify-content-between left_div_btns">
                                    <button class="left_div__like" id="like_btn"><i class="fa fa-thumbs-up"></i> Like</button>
                                    <button class="left_div__reply" onclick="reply('reply3')">Replies <badge class="bg-white text-dark p-2">4</badge></button>
                                </div>
                                <div class="replies mt-3" id="reply3">
                                    <!-- Replies go here -->
                                    <div class="d-flex justify-content-start align-items-center card reply_card py-3">
                                        <img src="https://img.icons8.com/doodle/48/000000/user-male-skin-type-5.png" class="reply_img mx-2">
                                        <div>
                                            <p class="blog_title"><span class="font-weight-bold">Thapa,</span> Aug 12, 2020, 7:20 PM</p>
                                            <p>Awesome, Bro I love your content.</p>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-start align-items-center card reply_card py-3">
                                        <img src="https://img.icons8.com/doodle/48/000000/user-male-skin-type-5.png" class="reply_img mx-2">
                                        <div>
                                            <p class="blog_title"><span class="font-weight-bold">Thapatechnical,</span> Aug 12, 2020, 7:20 PM</p>
                                            <p>I enjoy watching your videos!</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add Comment Section -->
                                <div class="add-comment-section mt-4">
                                    <h5>Add a Comment:</h5>
                                    <form id="commentForm">
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" id="commentInput" placeholder="Write your comment..." required>
                                            <button class="btn btn-primary" type="submit">Submit</button>
                                        </div>
                                    </form>
                                    <div id="commentsList" class="mt-3"></div>
                                </div>
                            </div>
                        </div>

                     

               


                </div>
                </div>

               <!-- Right Column for Sidebar -->
<div class="col-md-4 rightcolumn">
    <!-- About Me -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">About Me</h5>
            <p>Welcome to my journey! I’m a curious soul navigating the vast universe of the unknown. With a heart full of love, 
                I’m passionate about exploring intriguing topics like lorem ipsum and mauris neque quam. I’m excited to share my unique perspective and experiences with you.
                 Join me as we uncover the wonders of the world together!</p>
        </div>
    </div>

    <!-- Popular Posts -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Popular Posts</h5>
            <ul>
                <li>Bill Gates - CEO Microsoft</li>
                <li>Mark Zuckerberg - Programmer</li>
                <li>Jeff Bezos - Amazon</li>
                <li>Steve Jobs - Apple</li>
            </ul>
        </div>
    </div>

    <!-- Advertise -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Advertise</h5>
            <div class="advertise_img bg-light shadow">
                <p>Ads goes here</p>
            </div>
        </div>
    </div>

    <!-- Tags -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Tags</h5>
            <div class="tags_main">
                <a href="https://youtu.be/5p8e2ZkbOFU" target="_thapa" class="badge shadow text-capitalize">html</a>
                <a href="#" class="badge shadow text-capitalize">css</a>
                <a href="#" class="badge shadow text-capitalize">js</a>
                <a href="#" class="badge shadow text-capitalize">react</a>
                <a href="#" class="badge shadow text-capitalize">vue</a>
                <a href="#" class="badge shadow text-capitalize">php</a>
                <a href="#" class="badge shadow text-capitalize">python</a>
                <a href="#" class="badge shadow text-capitalize">kotlin</a>
                <a href="#" class="badge shadow text-capitalize">c++</a>
                <a href="#" class="badge shadow text-capitalize">java</a>
            </div>
        </div>
    </div>

    <!-- Inspiration -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Inspiration</h5>
            <div class="row gx-3">
                <div class="col-6">
                    <figure>
                        <img src="https://images.pexels.com/photos/196659/pexels-photo-196659.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260" class="img-fluid shadow">
                    </figure>
                </div>
                <div class="col-6">
                    <figure>
                        <img src="https://images.pexels.com/photos/34140/pexels-photo.jpg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" class="img-fluid shadow">
                    </figure>
                </div>
                <div class="col-6">
                    <figure>
                        <img src="https://images.pexels.com/photos/38547/office-freelancer-computer-business-38547.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" class="img-fluid shadow">
                    </figure>
                </div>
                <div class="col-6">
                    <figure>
                        <img src="https://images.pexels.com/photos/196659/pexels-photo-196659.jpeg?auto=compress&cs=tinysrgb&h=750&w=1260" class="img-fluid shadow">
                    </figure>
                </div>
            </div>
        </div>
    </div>

    <!-- Follow Me -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Follow Me</h5>
            <div class="d-flex justify-content-around">
                <a href="#"> <i class="fab fa-facebook-square fa-3x"></i></a>
                <a href="https://www.instagram.com/vinodthapa55/" target="_thapa"> <i class="fab fa-3x fa-instagram"></i></a>
                <a href="#"> <i class="fab fa-3x fa-github-square"></i> </a>
                <a href="#"> <i class="fab fa-3x fa-twitter-square"></i></a>
                <a href="#"> <i class="fab fa-3x fa-youtube-square"></i> </a>
                <a href="#"> <i class="fab fa-3x fa-linkedin"></i></a>
            </div>
        </div>
    </div>

    <!-- Subscribe -->
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Subscribe</h5>
            <form>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Enter your e-mail below and get notified on the latest blog posts.</label>
                    <input type="email" class="form-control mt-2" id="exampleFormControlInput1" placeholder="name@example.com">
                </div>
                <div class="col-12">
                    <button class="subs_btn d-block" type="submit">Subscribe</button>
                </div>
            </form>
        </div>
    </div>
</div>

    </header>

    <footer class="text-center py-4 bg-light">
        <p>Design with love by TECH_BLOGS</p>
    </footer>

   <!-- JavaScript -->
<script>
    document.getElementById('commentForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const commentInput = document.getElementById('commentInput');
        const commentText = commentInput.value.trim();
        if (commentText) {
            const commentsList = document.getElementById('commentsList');
            const commentDiv = document.createElement('div');
            commentDiv.classList.add('card', 'py-2', 'mt-2');
            commentDiv.innerHTML = `
                <div class="d-flex justify-content-start align-items-center">
                    <div class="reply_img mx-2">
                        <img src="https://img.icons8.com/doodle/48/000000/user-male-skin-type-5.png" />
                    </div>
                    <div class="reply_text__left">
                        <p class="blog_title"><strong>You</strong>, just now</p>
                        <p>${commentText}</p>
                    </div>
                </div>
            `;
            commentsList.appendChild(commentDiv);
            commentInput.value = ''; // Clear the input field
        }
    });

    const likeBtn = document.getElementById('like_btn');
    const toggleLike = () => {
        likeBtn.style.fontWeight = likeBtn.style.fontWeight === 'bold' ? 'normal' : 'bold';
        likeBtn.style.background = likeBtn.style.fontWeight === 'bold' ? '#bbe1fa' : '#3282b8';
        likeBtn.style.color = likeBtn.style.fontWeight === 'bold' ? '#1b262c' : '#fff';
        likeBtn.innerHTML = likeBtn.style.fontWeight === 'bold' ? '✓ Liked' : 'Like';
    }
    likeBtn.addEventListener('click', toggleLike);
</script>
    <!-- Popper.js first, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>

</html>
