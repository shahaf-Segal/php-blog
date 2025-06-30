<h1>Login</h1>
<form action="/login" method="post">
    <!-- Place for CSRF -->
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" placeholder="Email" required>
    </div>
    <div>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" required>
    </div>
    <div>
        <label for="remember">Remember me
            <input type="checkbox" name="remember" id="remember">
        </label>
    </div>
    <!-- remember me -->
    <button type="submit">Login</button>
</form>