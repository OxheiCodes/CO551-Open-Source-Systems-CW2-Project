<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <?php echo isset($message) ? $message : ''; ?>
                    <form action="authenticate.php" method="post">
                        <div class="mb-3">
                            <label for="txtid" class="form-label">Student ID:</label>
                            <input type="text" class="form-control" name="txtid" id="txtid" required>
                        </div>
                        <div class="mb-3">
                            <label for="txtpwd" class="form-label">Password:</label>
                            <input type="password" class="form-control" name="txtpwd" id="txtpwd" required>
                        </div>
                        <button type="submit" name="btnlogin" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
