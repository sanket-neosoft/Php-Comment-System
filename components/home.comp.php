
<!-- jQuery  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- Modal post -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Post</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col m-auto">
                            <label for="image" class="form-label">Select Image</label>
                            <input type="file" name="image" class="form-control" id="image">
                            <input type="hidden" name="user" id="user" value="<?= $_SESSION["username"]; ?>">
                        </div>
                        <div id="preview" class="col text-center">
                            <img src="https://www.bastiaanmulder.nl/wp-content/uploads/2013/11/dummy-image-square.jpg" class="logotype preview">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="caption" class="form-label">Caption</label>
                        <textarea class="form-control" name="caption" id="caption" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Post</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal password -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" id="change_pass">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="old_pass" class="form-label">Old Password</label>
                        <input type="password" class="form-control" id="old_pass">
                        <div id="old" class="form-text text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="new_pass" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_pass">
                        <div id="new" class="form-text text-danger"></div>
                    </div>
                    <div class="mb-3">
                        <label for="cnf_pass" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="cnf_pass">
                        <div id="cnf" class="form-text text-danger"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Change</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="post m-5">
    <?php
    include("classes/db.class.php");

    $conn = new Connection();
    $cards = $conn->connect()->query("SELECT * FROM post ORDER BY created_at DESC;");
    $cards_data = $cards->fetchAll(PDO::FETCH_ASSOC);

    foreach ($cards_data as $card_data) {
    ?>
        <div class="card mb-3">
            <div class="row g-0">
                <div class="col-md-7 border-end image-section">
                    <div class="row">
                        <div class="col">
                            <p class="card-title m-3 text-success"><i class="bi bi-person-circle me-3"></i><?= $card_data["user"]; ?></p>
                        </div>
                        <div class="col">
                            <p class="m-3 text-end text-muted"><small><?= $card_data["created_at"]; ?></small>
                            <p>
                        </div>
                    </div>

                    <img src="media/<?= $card_data["image"]; ?>" id="post_image" class=" m-0 p-0 border-top logotype border-bottom" alt="..." height="400vh" width="100%">
                    <form action="" class="comment" data-post_id="<?= $card_data["id"]; ?>">
                        <div class="input-group mt-2">
                            <input type="text" class="form-control border-white comment-text" placeholder="Write some comments" name="comment" aria-describedby="button-addon2">
                            <button class="btn btn-outline-success rounded-0 border-white" type="submit">Comment</button>
                        </div>
                    </form>

                </div>
                <div class="col-md-5">
                    <div class="card-body">
                        <?= $card_data["caption"] ?>
                        <hr>

                        <h5 class="card-title border-bottom pb-3">Comments</h5>
                        <div id="comments-section" class="comment-section">
                            <?php
                            $show_comment = $conn->connect()->prepare("SELECT * FROM comments WHERE post_id = ? ORDER BY created_at DESC;");
                            $show_comment->execute(array($card_data["id"]));
                            $comments = $show_comment->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($comments as $comment) {

                            ?>
                                <div class="comment alert alert-secondary rounded p-2">
                                    <div class="comment">
                                    </div>
                                    <div class="row">
                                        <p class="card-text col pb-0 mb-0"><span class="text-success"><?= $comment["user"] ?></span></p>
                                        <p class="text-end col pb-0 mb-0"><small class="card-text text-secondary "><?= $comment["created_at"] ?></small></p>
                                    </div>
                                    <p class="mb-0"><?= $comment["comment"]; ?></p>
                                </div>
                            <?php
                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>

<script>
    $("#image").change(function(event) {
        let imagePreview = URL.createObjectURL(event.target.files[0]);
        let image = `<img src=${imagePreview} class='logotype preview'>`
        $("#preview").html(image);
    });

    $("#post").on("submit", function(event) {
        event.preventDefault();
        let formData = new FormData(this);
        let image = $("#image").val();
        if (image === "") {
            alert("Please select image.")
        } else {
            $.ajax({
                url: "includes/post.inc.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(data) {
                    if (data) {
                        window.location.href = "index.php";
                    }
                }
            });
        }
    });

    $(".comment").submit(function(event) {
        event.preventDefault();
        let post_id = $(this).data("post_id");
        let user = "<?= $_SESSION["username"] ?>";
        let comment = $(this).children().children().val();
        if (comment !== "") {
            $.ajax({
                url: "includes/comment.inc.php",
                type: "POST",
                data: {
                    post_id: post_id,
                    user: user,
                    comment: comment
                },
                success: function(data) {
                    alert("comment added successfully");
                    window.location.href = "index.php";
                }
            });
        } else {
            alert("Please Enter Something in comment box");
        }
    });

    $("#change_pass").submit(function(event) {
        event.preventDefault();
        if (!old_empty() && !new_empty() && !cnf_empty()) {
            if ($("#cnf_pass").val() !== $("#new_pass").val()) {
                $("#new").html("");
                $("#old").html("");
                $("#cnf").html("Password doesn't match.");
            } else {
                $.ajax({
                    url: "includes/change_pass.inc.php",
                    type: "POST",
                    data: {
                        user: "<?= $_SESSION["username"] ?>",
                        oldpass: $("#old_pass").val(),
                        newpass: $("#new_pass").val(),
                    },
                    success: function(data) {
                        if (data) {
                            alert("Password Changed Successfully");
                            window.location.href = "index.php";
                        } else {
                            $("#old").html("Please check your password.");
                            $("#new").html("");
                            $("#cnf").html("");
                        }
                    }
                });
            }
        }

    });

    function old_empty() {
        if ($("#old_pass").val() === "") {
            $("#old").html("Please enter old password.");
            return true;
        }
    }

    function new_empty() {
        if ($("#new_pass").val() === "") {
            $("#new").html("Please enter new password.");
            return true;
        }
    }

    function cnf_empty() {
        if ($("#cnf_pass").val() === "") {
            $("#cnf").html("Please enter confirm password.");
            return true;
        }
    }
</script>