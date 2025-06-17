const loginBtn = document.getElementById('login-btn');
const popup = document.getElementById('popup');

loginBtn.addEventListener('click', () => {
    popup.classList.remove('hidden');
    html = `<form method ="POST" action="login.php" class="container">

            <div>
            <label for="name">Name </label>
            <br>
            <input type="name" id="name" name="name" placeholder="Name" required class="form-control">
            </div>
            <br>

            <div>
            <label for="password">Password </label>
            <br>
            <input type="password" id="password" name="password" placeholder="Password" required
            minlength="8" class="form-control"></form>
            <br>
            <br>
            <input type="submit" value="Send"/>
            </div></form>`;
    popup.innerHTML = html;
});