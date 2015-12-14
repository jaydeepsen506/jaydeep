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
            <form action="<?php echo base_url('contactus'); ?>" role="form"  id="contact_form">
                <div class="form-group">
                        <input type="text" class="form-control" id="contact_name" placeholder="Full name" name="name">
                </div>
                <div class="form-group">
                        <input type="email" class="form-control" id="contact_email" placeholder="Email Address" name="email">
                </div>
                <div class="form-group">
                        <textarea class="form-control" rows="3" placeholder="Your message or question" id="contact_message" name="message"></textarea>
                </div>
                <button type="submit" id="contact_submit" data-loading-text="&bull;&bull;&bull;"> <i class="icon fa fa-envelope-square fa-2x"></i></button>
            </form>
        </div>
    </div>
</div>

<!-- MODALS END-->