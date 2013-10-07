	<!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="<?php echo get_menu_link_by_index(0); ?>"><?php echo get_title(); ?></a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
          <?php while(have_menu()): ?>
          	<li><a href="<?php echo get_menu_link(); ?>"><?php echo get_menu_name(); ?></a></li>
          <?php endwhile; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

