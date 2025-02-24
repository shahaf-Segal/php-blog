<h1>Login</h1>
<form action="/login" method="post">
    <!-- Place for CSRF -->
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <!-- remember me -->
    <button type="submit">Login</button>
</form>