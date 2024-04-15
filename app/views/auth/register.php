<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <h1>Register</h1>
    <form method="POST" action="/api/auth/register">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>
        <br>
        <label for="document">Document:</label>
        <input type="text" name="document" id="document" required>
        <br>
        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required>
        <br>
        <label for="type">Type:</label>
        <select name="type" id="type">
            <option value="1">Common User</option>
            <option value="2">Merchant</option>
        </select>
        <br>
        <button type="submit">Register</button>
    </form>
</body>
</html>
