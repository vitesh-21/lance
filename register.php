<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add System User</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background: #0f172a; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; color: #fff; }
        .card { background: #fff; color: #333; padding: 40px; border-radius: 12px; width: 350px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.5); border-top: 5px solid #10b981; }
        h2 { margin-top: 0; text-align: center; color: #1e293b; }
        label { display: block; margin: 15px 0 5px; font-weight: 600; font-size: 13px; color: #4b5563; }
        input, select { width: 100%; padding: 12px; border: 1px solid #cbd5e1; border-radius: 8px; box-sizing: border-box; outline: none; }
        input:focus { border-color: #10b981; }
        button { width: 100%; padding: 12px; background: #10b981; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: bold; margin-top: 25px; transition: 0.2s; }
        button:hover { background: #059669; transform: translateY(-1px); }
        .msg { padding: 10px; border-radius: 6px; margin-bottom: 20px; text-align: center; font-size: 14px; display: none; }
        .error { background: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }
        .success { background: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .back { display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #64748b; font-size: 13px; }
        .back:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="card">
    <h2><i class="fas fa-user-plus"></i> Register User</h2>

    <div id="messageBox" class="msg"></div>

    <form id="registerForm" onsubmit="handleRegister(event)">
        <label>Username</label>
        <input type="text" id="username" required placeholder="e.g. admin_jane">

        <label>Password</label>
        <input type="password" id="id_password" required placeholder="••••••••">

        <label>System Role</label>
        <select id="role">
            <option value="staff">staff</option>
            <option value="admin">admin</option>
        </select>

        <button type="submit">Create Account</button>
        <a href="index.html" class="back">← Back to Login page</a>
    </form>
</div>

<script>
    function handleRegister(event) {
        event.preventDefault(); // Stop page reload

        // 1. Get Values
        const userVal = document.getElementById('username').value.trim();
        const passVal = document.getElementById('id_password').value;
        const roleVal = document.getElementById('role').value;
        const msgDiv = document.getElementById('messageBox');

        // 2. Fetch existing users from LocalStorage or create empty array
        let users = JSON.parse(localStorage.getItem('systemUsers')) || [];

        // 3. Check if username already exists
        const userExists = users.find(u => u.username.toLowerCase() === userVal.toLowerCase());

        if (userExists) {
            showMsg("Error: Username '" + userVal + "' is already taken.", "error");
        } else {
            // 4. Save new user object
            const newUser = {
                username: userVal,
                password: passVal,
                role: roleVal
            };

            users.push(newUser);
            localStorage.setItem('systemUsers', JSON.stringify(users));

            showMsg("Success! User '" + userVal + "' registered.", "success");
            
            // Clear the form
            document.getElementById('registerForm').reset();
        }
    }

    function showMsg(text, type) {
        const msgDiv = document.getElementById('messageBox');
        msgDiv.innerText = text;
        msgDiv.className = "msg " + type;
        msgDiv.style.display = "block";
    }
</script>

</body>
</html>
