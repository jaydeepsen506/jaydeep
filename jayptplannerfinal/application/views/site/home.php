<!-- INTRO BEGIN -->
	<header id="full-intro" class="intro-block bg-color-main intro-block-new" >
		<div class="ray ray-vertical y-100 x-50 ray-rotate-135 laser-blink hidden-sm hidden-xs" ></div>
		<div class="ray ray-horizontal y-25 x-0 ray-rotate-45 laser-blink hidden-sm hidden-xs" ></div>
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-12">
                                        
					 <h1 class="slogan"><?php  echo $web_content[0]['header_content'];?></h1>
					<a class="download-btn-alt ios-btn" href="#">
						<i class="icon fa fa-apple fa-3x"></i>Download for <b>Apple iOS</b>
					</a>
					<a class="download-btn-alt android-btn" href="#">
						<i class="icon fa fa-android fa-3x"></i>Download for <b>Android</b>
					</a>
				</div>
                                <form id="registration_form" name="registration_form" method="post" action="<?php echo base_url('registration/add'); ?>" autocomplete="off">
                                    <div class="col-md-4 col-sm-12 registration">
                                        <div class="rgishead"><?php  echo $web_content[0]['trial_content'];  ?></div>
                                        <input id="registration_email" name="email" type="text" class="fieldforrgis" placeholder="Email" autocomplete="off" autocorrect="off" autocapitalize="off">
                                        <input type="text" style="display:none;">
                                        <input id="registration_password" name="password" type="password" class="fieldforrgis" placeholder="password" autocomplete="off" autocorrect="off" autocapitalize="off">
                                        <input id="registration_btn" name="registration_btn" type="submit" class="tryforfree" value="Try for free">
                                        <div class="ortxt">or</div>
                                        <div class="signupalter"><a href="#" data-toggle="modal" data-target="#modallogin">Already have an account?</a></div>
                                    </div>
                                </form>
			</div>
		</div>
		<div class="block-bg" data-stellar-ratio="0.4"></div>
	</header>
	<!-- INTRO END --> 
	
	<!-- THE-WEB BEGIN -->
	<section id="the-web" class="img-block-2col bg-color2">
		<div class="container">
			<div class="row">
                                <?php  echo $web_content[0]['web_content'];  ?>
                              
                                
				<!--<div class="col-sm-6">
					<div class="title">
						<h2>The PT-Planner Web</h2>
					</div>
					
					<ul class="item-list-left">
						<li>
							<i class="icon fa fa-bolt fa-2x"></i>
							<h4 class="color">Effective and fun planning</h4>
							<p>Do not iterate boring assignments and use your time at what you do best. Saves a PT on average 4 hours per month (based on case studies).</p>
						</li>
						<li>
							<i class="icon fa fa-bullseye fa-2x"></i>
							<h4 class="color">Competitive Advantage</h4>
							<p>PT-Planner will give you a competetive advantage versus other PTs and do-it-yourself-apps thanks to The PT-Planner App.</p>
						</li>
						<li>
							<i class="icon fa fa-line-chart fa-2x"></i>
							<h4 class="color">Increase Your Revenue</h4>
							<p>Bill your clients whatever you want for the PT-Planner app, coach clients all over the world and keep a passive income from clients who quit but wants to keep the app.</p>
						</li>
					</ul>
				</div>-->
				<div class="col-md-5 col-md-offset-1 col-sm-6">
					<div class="screen-couple-right wow fadeInRightBig">
						<div class="flare">
							<img class="base wow" src="<?php echo base_url(); ?>assets/site/images/flare_base.png" alt="" />
							<img class="shapes wow" src="<?php echo base_url(); ?>assets/site/images/flare_shapes.png" alt="" />
						</div>
						<img class="screen above" src="<?php echo base_url(); ?>assets/site/images/screen_couple_above.png" alt=""/>

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- THE-WEB END -->
	
			<!-- WEB SCREENSHOTS BEGIN -->
	<section id="web-screenshots">
		<div class="container-fluid wow fadeIn">
			<h2>Web Screenshots</h2>
			<div id="screenshots-slider" class="owl-carousel">
				<a class="item" href="./images/web1.png" title="Web Screen 1"><img src="<?php echo base_url(); ?>assets/site/images/web1.png" alt="screen1" width="585" height="400" /></a>
				<a class="item" href="./images/web2.png" title="Web Screen 2"><img src="<?php echo base_url(); ?>assets/site/images/web2.png" alt="screen1" width="585" height="400"/></a>
				<a class="item" href="./images/web3.png" title="Web Screen 3"><img src="<?php echo base_url(); ?>assets/site/images/web3.png" alt="screen1" width="250" height="444"/></a>
				<a class="item" href="./images/web4.png" title="Web Screen 4"><img src="<?php echo base_url(); ?>assets/site/images/web4.png" alt="screen1" width="250" height="444"/></a>
				<a class="item" href="./images/web5.png" title="Web Screen 5"><img src="<?php echo base_url(); ?>assets/site/images/web5.png" alt="screen1" width="250" height="444"/></a>
				<a class="item" href="./images/web6.png" title="Web Screen 4"><img src="<?php echo base_url(); ?>assets/site/images/web6.png" alt="screen1" width="250" height="444"/></a>
			</div>
		</div>
	</section>
	<!-- WEB SCREENSHOTS END -->
	
			<!-- THE-APP BEGIN -->
	<section id="the-app" class="img-block-3col bg-color2">
		<div class="container">
			<div class="title">
				<h2>The PT-Planner App</h2>
				<p>What the PT-Planners app does for your clients</p>
			</div>
			<div class="row">
				<div class="col-sm-4">
					<ul class="item-list-right item-list-big">
						<li class="wow fadeInLeft">
							<i class="icon fa fa-calendar fa-2x"></i>
							<!--<h3>Bookings</h3>-->
                                                        <h3><?php echo $web_content[0]['app_booking_text'];?>
                                                        </h3>
							<p><?php echo $web_content[0]['app_booking_content']?></p>
						</li>
						<li class="wow fadeInLeft">
							<i class="icon fa fa-heartbeat fa-2x"></i>
                                                        <h3>
							   <?php echo $web_content[0]['app_trainaway_text'];?>
                                                        </h3>
							<p><?php echo $web_content[0]['app_trainaway_content'];?></p>
						</li>
						<li class="wow fadeInLeft">
							<i class="icon fa fa-cutlery fa-2x"></i>
							<h3>
                                                        <?php echo $web_content[0]['app_diets_text'];?>
                                                        </h3>
                                                       <p><?php echo $web_content[0]['app_diets_content'];?></p>
						</li>
					</ul>
				</div>
				<div class="col-sm-4 col-sm-push-4">
					<ul class="item-list-left item-list-big">
						<li class="wow fadeInRight">
							<i class="icon fa fa-book fa-2x"></i>
                                                        <h3>
							<?php echo $web_content[0]['diary_text'];?>
                                                        </h3>
                                                      <p><?php  echo $web_content[0]['diary_content'];?></p>
							
						</li>
						<li class="wow fadeInRight">
							<i class="icon fa fa-bar-chart fa-2x"></i>
                                                        <h3>
							<?php  echo $web_content[0]['program_text'];?>
                                                        </h3>
                                                        <p><?php  echo $web_content[0]['program_content'];?></p>
						</li>
						<li class="wow fadeInRight">
							<i class="icon fa fa-weixin fa-2x"></i>
                                                        <h3>
							<?php  echo $web_content[0]['messages_text'];?>
                                                        </h3>
                                                       <p><?php  echo $web_content[0]['messages_content'];?></p> 
							
						</li>
					</ul>
				</div>
				<div class="col-sm-4 col-sm-pull-4">
					<div class="animation-box wow bounceIn">
					 	<img class="highlight-left wow" src="<?php echo base_url(); ?>assets/site/images/light.png" height="192" width="48" alt="" />
						<img class="highlight-right wow" src="<?php echo base_url(); ?>assets/site/images/light.png" height="192" width="48" alt="" />
						<img class="screen" src="<?php echo base_url(); ?>assets/site/images/features_screen.png" alt="" height="581" width="300" />
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- THE-APP END --> 

			<!-- APP-SCREENSHOTS BEGIN -->
	<section id="app-screenshots">
		<div class="container-fluid wow fadeIn">
			<h2>App Screenshots</h2>
			<div id="screenshots_m" class="owl-carousel owl-theme" style="opacity: 1; display: block;">
				<div class="owl-wrapper-outer">
				<a class="item" href="./images/app1.png" title="App Screen 1"><img src="<?php echo base_url(); ?>assets/site/images/app1.png" alt="screen1" width="250" height="444" /></a>
				<a class="item" href="./images/app2.png" title="App Screen 2"><img src="<?php echo base_url(); ?>assets/site/images/app2.png" alt="screen1" width="250" height="444"/></a>
				<a class="item" href="./images/app3.png" title="App Screen 3"><img src="<?php echo base_url(); ?>assets/site/images/app3.png" alt="screen1" width="250" height="444"/></a>
				<a class="item" href="./images/app4.png" title="App Screen 4"><img src="<?php echo base_url(); ?>assets/site/images/app4.png" alt="screen1" width="250" height="444"/></a>
				</div>
			</div>
		</div>
	</section>
	<!-- APP-SCREENSHOTS END -->
	
	<!-- TESTIMONIALS BEGIN -->
	<section id="testimonials" class="bg-color3">
		<div class="container-fluid">
			<h2>What Do People Think of Us</h2>
			<div id="testimonials-slider" class="owl-carousel">
                            <?php foreach($testimonials as $testimonial){ ?>
				<div class="item container">
					<div class="talk"><?php echo stripslashes($testimonial['desc']) ?></div>
					<img class="photo" src="<?php echo base_url().'testimonial_images/'.$testimonial['image']; ?>" alt="customer" />
					<div class="name"><?php echo stripslashes($testimonial['name']) ?></div>
					<div class="ocupation"><?php echo stripslashes($testimonial['short_desc']) ?></div>
				</div>
                            <?php } ?>
			</div>
		</div>
		<div class="block-bg"></div>
	</section>
	<!-- TESTIMONIALS END -->


	<!-- PRICING TABLE BEGIN -->
	<section id="pricing-table" class="bg-color-grad">
		<div class="container">
			<div class="title">
				<h2><?php  echo $web_content[0]['price_text'];?></h2>
				<p><?php  echo $web_content[0]['price_content'];?></p>
				<ul class="pricing-table">
					<li class="wow flipInY">
                                                <?php echo $web_content[0]['plan1'];?>
					</li>
                                        
					<li class="silver wow flipInY" data-wow-delay="0.2s">
						<?php echo $web_content[0]['plan2'];?>
					</li>
					<li class="gold wow flipInY" data-wow-delay="0.4s">
						<?php echo $web_content[0]['plan3'];?>
					</li>
					<li class="platinum wow flipInY" data-wow-delay="0.6s">
						<?php echo $web_content[0]['plan4'];?>
					</li>
				</ul>
			</div>
		</div>
	</section>
	<!-- PRICING TABLE END --> 
	
	<!-- ABOUT-US BEGIN -->
	<section id="about-us" class="bg-color2">
            <div class="container-fluid">
                <div class="title">
                        <?php echo stripslashes($about_us[0]['page_content']); ?>
                </div>
            </div>
	</section>
</div>