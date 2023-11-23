
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Add the SweetAlert library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Log in</title>

<style>
form {
  width: 300px;
  margin: 0 auto;
  font-family: Tahoma, Geneva, sans-serif;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}
body {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh; 
}

.overview {
  width: 400px;
  border: 1px solid #ccc;
  border-radius: 5px;
  padding: 20px;  
}
header {
  background: #333;
  color: #fff;
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  padding: 0; 
}
.bottom-link {
  text-align: center;
  margin-top: 20px; 
}

.bottom-link a {
  color: #007bff;
  text-decoration: none;
}
</style>
</head>
<body>
    <header>
        <?php include 'login.nav.php'; ?>
    </header>

    <form id="loginForm" method="POST">
        <div class="overview">
            <h2>Login to Your Admin Account</h2>
            <label for="username"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="username" required>

            <label for="password"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" id="password" name="password" required>

            <button type="button" onclick="login()">Login</button>
        </div>
    </form>

    <script>
    const pswrd = document.getElementById("password");
    const icon = document.querySelector(".icon");

    icon.onclick = function () {
        if (pswrd.type === "password") {
            pswrd.type = "text";
        } else {
            pswrd.type = "password";
        }
    }

    function login() {
        // Prevent the default form submission
        event.preventDefault();

        const formData = new FormData(document.getElementById("loginForm"));

        fetch('your-php-script.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Logged In Successfully!',
                    confirmButtonColor: '#4CAF50',
                }).then(() => {
                    window.location.href = 'admin/ahome.php';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message,
                    confirmButtonColor: '#4CAF50',
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred. Please try again.',
                confirmButtonColor: '#4CAF50',
            });
        });
    }
</script>

</body>
</html>
