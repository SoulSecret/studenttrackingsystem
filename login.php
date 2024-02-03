<h2>Login</h2>
<form action="login_process.php" method="post">
    <div class="form-group">
        <label for="loginUsername">Username:</label>
        <input type="text" class="form-control" id="loginUsername" name="loginUsername" required>
    </div>
    <div class="form-group">
        <label for="loginPassword">Password:</label>
        <input type="password" class="form-control" id="loginPassword" name="loginPassword" required>
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form>