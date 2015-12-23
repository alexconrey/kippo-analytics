<?php

include('header.php');

?>

        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Live Info</h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder">
		<?php Widget::load('password_chart'); ?>
              <h4>Password Popularity</h4>
              <span class="text-muted">Most Frequently Attempted Passwords Today</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
		<?php Widget::load('username_chart'); ?>
              <h4>Username Popularity</h4>
              <span class="text-muted">Most Frequently Attempted Usernames Today</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
		<?php Widget::load('dow_chart'); ?>
              <h4>DOW Popularity</h4>
              <span class="text-muted">Shows which of the last 7 days had the most authentication requests.</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
		<?php Widget::load('source_chart'); ?>
              <h4>Source Popularity</h4>
              <span class="text-muted">Most Popular Source IPs Today</span>
            </div>
          </div>

	<?php
	Widget::load('sessions');
	?>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="js/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
<?php include('footer.php'); ?>
