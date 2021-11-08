<section class="row">
    <aside class="col-md m-auto">
        <article class="text-center">
            <img src="https://uilogos.co/img/logotype/earth.png" class="logotype wel-logo img-fluid" alt="">
            <blockquote class="blockquote bq">
                <p>"Earth is what we all have in common."</p>
                <footer class="blockquote-footer">Wendell Berry</footer>
            </blockquote>
        </article>
    </aside>
    <aside class="col-md">
        <form class="px-5 py-4 border rounded shadow" id="login" method="POST">
            <div class="text-center">
                <img src="https://uilogos.co/img/logomark/earth.png" class="mb-4" alt="" width="60px" height="">
            </div>
            <p id="err" class="form-text text-center text-danger"></p>
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="user" name="username" placeholder="Enter email" value="">
                <p id="e-err" class="form-text text-danger"></p>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                <p id="p-err" class="form-text text-danger"></p>
            </div>
            <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" id="check" name="remember" value="checked"> Remember me
                </label>
            </div>
            <div class="row">
                <div class="col-md d-grid mb-2">
                    <button type="submit" class="btn btn-success  btn-block" name="login">Login</button>
                </div>
                <div class="col-md d-grid mb-2">
                    <button type="button" class="btn btn-dark btn-block" data-bs-toggle="modal" data-bs-target="#exampleModal" name="register">New User</button>
                </div>
            </div>
        </form>
    </aside>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <form class="p-4" id="register" method="POST" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="unique-err" class="text-center form-text text-danger"></p>
                    <div class="row">
                        <div class="mb-3 col-md-6 col-sm-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                            <small id="name-err" class="form-text text-danger"></small>
                        </div>
                        <div class="mb-3 col-md-6 col-sm-12">
                            <label for="email" class="form-label">Email address</label>
                            <input type="text" class="form-control" id="email-reg" name="email" placeholder="Enter email">
                            <small id="email-err" class="form-text text-danger"></small>
                        </div>
                        <div class="mb-3 col-md-6 col-sm-12">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Enter username">
                            <small id="username-err" class="form-text text-danger"></small>
                        </div>
                        <div class="mb-3 col-md-6 col-sm-12">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" placeholder="Enter age">
                            <small id="age-err" class="form-text text-danger"></small>
                        </div>
                        <div class="mb-3 col-md-6 col-sm-12">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password-reg" name="password" placeholder="Enter password">
                            <small id="password-err" class="form-text text-danger"></small>
                        </div>
                        <div class="mb-3 col-md-6 col-sm-12">
                            <label for="cnf_password" class="form-label">Username</label>
                            <input type="password" class="form-control" id="cnf_password" name="cnf_password" placeholder="Enter password">
                            <small id="cnf-err" class="form-text text-danger"></small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $("#login").on("submit", function(e) {
        e.preventDefault();
        let username = $("#user").val();
        let password = $("#password").val();
        if (username === "") {
            $("#e-err").html("Please enter email.");
        }
        if (password === "") {
            $("#p-err").html("Please enter password.");
        }
        if (username !== "" && password !== "") {
            $.ajax({
                url: "includes/login.inc.php",
                type: "POST",
                data: {
                    username: username,
                    password: password,
                },
                success: function(data) {
                    if (data) {
                        window.location.href = "index.php";
                    } else {
                        $("#err").html("Invalid credentials")
                    }
                    console.log(data);
                }
            });
        }
    });

    $("#register").on("submit", function(e) {
        e.preventDefault();
        let name = $("#name").val();
        let email = $("#email-reg").val();
        let age = $("#age").val();
        let password = $("#password-reg").val();
        let cnf_password = $("#cnf_password").val();
        let username = $("#username").val();

        if (name === "") {
            $("#name-err").html("Please enter name.");
        }
        if (email === "") {
            $("#email-err").html("Please enter email.");
        }
        if (age === "") {
            $("#age-err").html("Please enter age.");
        }
        if (password === "") {
            $("#password-err").html("Please enter password.");
        }
        if (cnf_password === "") {
            $("#cnf-err").html("Please enter confirm password.");
        }
        if (username === "") {
            $("#username-err").html("Please enter username.");
        }

        if (name !== "" && email !== "" && age !== "" && password !== "" && cnf_password !== "" && username !== "") {
            $.ajax({
                url: "includes/register.inc.php",
                type: "POST",
                data: {
                    name: name,
                    email: email,
                    password: password,
                    username: username,
                    age: age,
                },
                success: function(data) {
                    if (data) {
                        window.location.href = "index.php";
                    } else {
                        $("#unique-err").html("Username or Email is already taken Please try with different username or email");
                        $("#name-err").html("");
                        $("#email-err").html("");
                        $("#password-err").html("");
                        $("#cnf-err").html("");
                        $("#username-err").html("");
                        $("#age-err").html("");
                    }
                }
            });
        }
    });
</script>