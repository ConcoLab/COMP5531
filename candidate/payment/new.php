<?php require '../partials/head.php' ?>
<?php require '../partials/layout.php' ?>

<div class="container">
    <h1>
        Add New Payment
    </h1>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">New Payment Method</h5>
                    <form>
                        <div class="form-group">
                            <label for="holderName">Holder Name</label>
                            <input type="text" class="form-control" id="holderName" aria-describedby="holderNameHelp">
                        </div>
                        <div class="form-group">
                            <label for="cardNumber">Card Number</label>
                            <input type="text" class="form-control" id="cardNumber">
                        </div>
                        <div class="form-group">
                            <label for="method">Method</label>
                            <select class="form-control" id="method">
                                <option value="0">Chequing</option>
                                <option value="1">Credit</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>


<?php require '../partials/foot.php' ?>