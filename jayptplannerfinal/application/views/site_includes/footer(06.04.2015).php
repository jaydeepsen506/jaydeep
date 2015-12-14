<!-- MODALS BEGIN--> 

<!-- subscribe modal-->
<div class="modal fade" id="modalMessage" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="modal-title"></h3>
        </div>
    </div>
</div>

<!-- contact modal-->
<div class="modal fade" id="modalContact" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="modal-title">Contact</h3>
            <form action="<?php echo base_url('contactus'); ?>" method="post" role="form"  id="contact_form">
                <div class="form-group">
                        <input type="text" class="form-control" id="contact_name" placeholder="Full name" name="name">
                </div>
                <div class="form-group">
                        <input type="email" class="form-control" id="contact_email" placeholder="Email Address" name="email">
                </div>
                <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Your message or question" id="contact_message" name="message"></textarea>
                </div>
                <button type="submit" id="contact_submit" data-loading-text="&bull;&bull;&bull;"> <i class="icon fa fa-paper-plane-o"></i></button>
            </form>
        </div>
    </div>
</div>

<!-- MODALS END-->

<!-- login modal-->
<div class="modal fade" id="modallogin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="modal-title">Login</h3>
            <form action="<?php echo base_url('login/verify'); ?>" method="post" role="form"  id="login_form">
                <div class="form-group">
                    <input type="email" class="form-control" id="login_email" placeholder="Email Address" name="email">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="login_password" placeholder="Password" name="password">
                </div>
                <button type="submit" id="login_submit" data-loading-text="&bull;&bull;&bull;"> <i class="icon signinfont fa fa-sign-in"></i></button>
                <div class="clearfix rememberblog">                      
                    <div class="pull-left"><input type="checkbox" id="checkbox79" class="css-checkbox lrg" checked="checked"/>
                        <label for="checkbox79" name="checkbox79_lbl" class="css-label lrg klaus">remember me</label>
                    </div>
                    <div class="pull-right forgot">
                        <a href="javascript:;" id="forgetpassword_btn" >forgot password?</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- MODALS END-->

<!-- forget password modal-->
<div class="modal fade" id="modalforgetpassword" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="modal-title">Forget Password</h3>
            <form action="<?php echo base_url('forget_password'); ?>" method="post" role="form"  id="forgetpassword_form">
                <div class="form-group">
                    <input type="email" class="form-control" id="forgetpassword_email" placeholder="Email Address" name="email">
                </div>
                <button type="submit" id="forgetpassword_submit" data-loading-text="&bull;&bull;&bull;"> <i class="icon signinfont fa fa-sign-in"></i></button>
            </form>
        </div>
    </div>
</div>
<!-- MODALS END-->
<?php
    $ci = &get_instance();
    $segment_1 = $ci->uri->segment(1);
    $segment_2 = $ci->uri->segment(2);
?>
<!-- reset password modal-->
<div class="modal fade" id="modalresetpassword" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            <h3 class="modal-title">Reset Password</h3>
            <form action="<?php echo base_url('forget_password/reset_password'); ?>" method="post" role="form"  id="resetpassword_form">
                <input type="hidden" id="forget_code" name="code" value="<?php echo $segment_2; ?>" />
                <div class="form-group">
                    <input type="password" class="form-control" id="resetpassword_password" placeholder="New Password" name="password">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="resetpassword_cpassword" placeholder="Confirm Password" name="cpassword">
                </div>
                <button type="submit" id="resetpassword_submit" data-loading-text="&bull;&bull;&bull;"> <i class="icon signinfont fa fa-sign-in"></i></button>
            </form>
        </div>
    </div>
</div>
<!-- MODALS END-->