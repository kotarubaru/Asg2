<div id="loginDiv">
  <div><span>Login</span></div>
  <fieldset id="loginMenu">
      <label for="loginUsername">Username</label>
      <input id="loginUsername" name="username" value="" title="username" tabindex="4" type="text">
      </p>
      <!--
      <p>
        <label for="password">Password</label>
        <input id="password" name="password" value="" title="password" tabindex="5" type="password">
      </p>
      -->
      <p class="remember">
        <input id="login_submit" value="Log in" tabindex="6" type="button" onclick="login()">
      </p>
  </fieldset>
</div>
<script type="text/javascript">
function login() {
    var username = $("#loginUsername").get(0).value;
    if (username.length > 0)
        window.location = "/login/" + username;
}
</script>
