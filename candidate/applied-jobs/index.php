<?php require '../partials/head.php' ?>
<?php require '../partials/layout.php' ?>

<div class="container">
    <h1>
        Applied Jobs
    </h1>
    <h3 class="my-4">Number of applied jobs: 3</h3>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Job Title</th>
                <th scope="col">Date</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>20 December 2020</td>
                <td>
                    <span class="text-success">
                        Accepted
                    </span>
                </td>
                <td>
                    <button class="btn btn-danger">
                        Withdraw
                    </button>
                </td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td>Larry</td>
                <td>the Bird</td>
                <td>@twitter</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
</div>


<?php require '../partials/foot.php' ?>