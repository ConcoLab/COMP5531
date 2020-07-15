<?php require '../partials/head.php' ?>
<?php require '../partials/layout.php' ?>

<div class="container">
    <h1>
        Payment
    </h1>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Authorization</h5>
                    <p class="card-text">You can authorize us to charge you monthly on your membership plan</p>
                    <a href="#" class="btn btn-success">Authorize</a>
                    <a href="#" class="btn btn-danger">Withdraw Authorization</a>
                </div>
            </div>
        </div>

    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Holder Name</th>
                <th scope="col">Card Number</th>
                <th scope="col">Method</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark Something</td>
                <td>123456789</td>
                <td>Chequing</td>
                <td>
                    <button class="btn btn-danger">Delete</button>
                </td>
            </tr>
            <tr>
                <th scope="row">1</th>
                <td>Mark Something</td>
                <td>123456789</td>
                <td>Credit</td>
                <td>
                    <button class="btn btn-danger">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>

</div>


<?php require '../partials/foot.php' ?>