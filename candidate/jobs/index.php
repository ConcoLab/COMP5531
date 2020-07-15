<?php require '../partials/head.php' ?>
<?php require '../partials/layout.php' ?>

<div class="container">
    <h1>
        Jobs
    </h1>
    <div class="card mb-5">
        <div class="card-body">
            <h5 class="card-title">Search</h5>
            <form>
                <div class="form-row align-items-center">
                    <div class="col-5">
                        <label class="sr-only" for="inlineFormInputGroup">Title Search</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Title Search</div>
                            </div>
                            <input type="text" class="form-control" id="inputTitle" placeholder="Search">
                        </div>
                    </div>
                    <div class="col-5">
                        <label class="sr-only" for="inlineFormInputGroup">Category</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Category</div>
                            </div>
                            <select id="category" class="form-control">
                                <option selected>Choose...</option>
                                <option>Cat 1</option>
                                <option>Cat 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h2>
                <strong>
                    Company Name
                </strong>
            </h2>

        </div>
        <div class="card-body">
            <h5 class="card-title">Job Title</h5>
            <p class="card-text">Description: Lorem ipsum dolor sit amet consectetur adipisicing elit. Eveniet eos, quia, delectus unde est rerum hic iure dicta soluta cumque veniam voluptatum, tenetur dignissimos. Reprehenderit veritatis distinctio sit a tenetur!</p>
            <a href="#" class="btn btn-primary">Apply</a>
        </div>
    </div>
</div>


<?php require '../partials/foot.php' ?>