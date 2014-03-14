<?php 
if ($setting['facebook_on'] == 1) {
	if (isset($_GET['task']) && $_GET['task'] != 'facebook_register')
		include 'includes/wss_facebook.php';

	if ((isset($user['facebook']) && $user['facebook'] == 1) || ($user['login_status'] == 0)) {
		?>

		<div id="fb-root"></div>
		<script type="text/javascript">
      // Load the SDK Asynchronously
      (function(d){
         var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement('script'); js.id = id; js.async = true;
         js.src = "//connect.facebook.net/en_US/all.js";
         ref.parentNode.insertBefore(js, ref);
       }(document));

      // Init the SDK upon load
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '<?php echo $setting['facebook_appid'];?>', // App ID
          channelUrl : '//'+window.location.hostname+'/includes/facebook_channel.php', // Path to your Channel File
          status     : true, // check login status
          cookie     : true, // enable cookies to allow the server to access the session
          xfbml      : true  // parse XFBML
        });
        
        <?php if ($user['login_status'] == 0) { ?>
  		FB.Event.subscribe('auth.login', function() { 
			window.location = "<?php echo $setting['site_url'];?>/facebook_auth.php"
		});
		<?php } ?>
		FB.Event.subscribe('auth.logout', function() { 
			window.location = "<?php echo $setting['site_url'];?>/login.php?action=logout"
		}); 

      } 
    </script>

<?php
	}
}
?>