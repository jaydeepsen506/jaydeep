<div id="page-wrapper">
            <div class="container-fluid">
                <?php
                $redirect=base_url()."check_code/check_page";
                $url="https://auth.exorlive.com/Providers/OAuth/Authorize.aspx?response_type=code&client_id=ptplanner&redirect_uri=".$redirect."&scope=read_profile read_workout read_master write_workout write_profile read_calendar read_contact admin_user create_session configure write_calendar write_contact";
               //$url="https://auth.exorlive.com/Providers/OAuth/Token.ashx?grant_type=refresh_token&client_id=ptplanner&client_secret=QFB57cw2uUTNqJRpr4jKhkQRZZAARneN&refresh_token=bX9z!IAAAAGBHN66Ozd2DA2xJsR0H2bxdARymemdClg_u7C2uv_J3kQAAAAGfmTPJZVl6qCsYwESsdV4pBUcJSjtauFqH4hNOqT0aOupFYpKMnkm3EUndqhgEfpTf861oR2hVAImrp2Is8aJGfp4g1RsrRTj3mROhWMtO0P0WsJzqwSNZIezWr3AUCcF6kpD2bGOL94xdSMeRBsroh-JFZaeMddEh5ZIJAXyz9aUuoUdwbAumEu5301MWgC0&redirect_uri=http://esolz.co.in/lab6/ptplanner/check_code/check_page";
                ?>
                <a href="<?php echo $url; ?>">click here</a>
                
                <a href="<?php echo base_url()."check_code/check_page_val"; ?>">click here next</a>
     </div>
</div>