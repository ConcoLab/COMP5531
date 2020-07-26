
<?php require '../../partials/head-candidate.php' ?>

<div class="container">
    <h1>
        Profile
    </h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email address</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" disabled>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Username</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Username" disabled>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Phone</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="555-111 2233">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Address</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Address">
                        </div>

                        <button type="submit" class="btn btn-primary">Update Profile</button>
                    </form>
                    <hr>
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">First Name</label>
                            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="First Name">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Last Name</label>
                            <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="Last Name">
                        </div>


                        <div class="form-group">
                            <label for="inputCV">CV</label>
                            <textarea class="form-control" id="inputCV" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Information</button>
                    </form>
                    <hr>
                    <form>
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Old Password</label>
                            <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Old Password">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">New Password</label>
                            <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="New Password">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlInput1">Repeat New Password</label>
                            <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="Repeat New Password">
                        </div>

                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </form>
                    <hr>
                    <a class="btn btn-primary" href="../payment">Payment Methods</a>
                    <hr>
                    <a class="btn btn-danger" href="./delete.php">Invoke Account</a>
                </div>
            </div>
        </div>
    </div>

</div>


<?php require '../../partials/foot.php' ?>