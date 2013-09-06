<?php if($user->getUsername() == "Guest"): ?>
<form class="form-horizontal" action="index.php?route=user/login/" method="POST">
<fieldset>

<!-- Form Name -->
<legend>Login</legend>

<!-- Text input-->
<div class="control-group">
  <label class="control-label login-form" id="login-label-username" for="username">Username</label>
  <div class="controls" id="login-control-username">
    <input id="username" name="username" type="text" placeholder="Username" class="input-small" required="">
    
  </div>
</div>

<!-- Password input-->
<div class="control-group">
  <label class="control-label" id="login-label-password" for="password">Password</label>
  <div class="controls" id="login-control-password">
    <input id="password" name="password" type="password" placeholder="Password" class="input-small" required="">
    
  </div>
</div>

<!-- Button -->
<div class="control-group">
  <label class="control-label" for="login"></label>
  <div class="controls" id="login-control-button">
    <button id="login" name="login" class="btn btn-success">Login</button>
  </div>
</div>

</fieldset>
</form>
<?php else: ?>
<div class="row logged-in-box">
	<div class="span3"><span class="label">Logged in:</span>&nbsp;&nbsp;<?php echo ucfirst($user->getUsername());?></div>
</div>
<div class="row">
	<div class="span3">
		<a href="index.php?route=post/new/"><span class="label success">New entry</span></a>
	</div>
</div>


<?php endif; ?>