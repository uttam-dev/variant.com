<!-- THANKS MASSAGE FOR FEEDBACK  -->

<!-- Modal -->
<div class="modal fade" id="feedbackThanks" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius:2rem;">
            <div class="modal-header d-flex justify-content-center">
                <b>
                    <h3 class="modal-title fs-5 text-center" style="font-weight:bold; font-family:Arial, Helvetica, sans-serif">Your'r Welcome !</h3>
                    <h3 class="modal-title fs-5 text-center" style="font-weight:bold; font-family:Arial, Helvetica, sans-serif">We Appreciate Your Feedback</h3>
                </b>
            </div>
            <div class="modal-body py-5 d-flex justify-content-center align-items-center">
                <b>
                    <h1>Thank You !!</h1>
                </b>
            </div>
            <div class="modal-footer d-flex justify-content-center align-iteam-center">
            </div>
        </div>
    </div>
</div>
<footer>
    <div class="copyrights">
        <div class="logo"><img src="assets\img\web_img\variant_logo.png" alt=""></div>
        <div class="text">
            &copy; Variant.com
            <?php echo date("Y"); ?>
        </div>
    </div>
    <div class="contacts">
        <p>contact with us</p>
        <div class="cta_links">
            <a href="#" class="icon-link" data-media-name="instagram">
                <i class="icon fa-brands fa-instagram"></i>
            </a>
            <a href="#" class="icon-link" data-media-name="x-twitter">
                <i class="icon fa-brands fa-x-twitter"></i>
            </a>
            <a href="#" class="icon-link" data-media-name="facebook">
                <i class="icon fa-brands fa-facebook"></i>
            </a>
            <a href="#" class="icon-link" data-media-name="snapchat">
                <i class="icon fa-brands fa-snapchat"></i>
            </a>
            <a href="#" class="icon-link" data-media-name="pinterest">
                <i class="icon fa-brands fa-pinterest"></i>
            </a>
            <a href="#" class="icon-link mail-icon-link">
                <i class="icon mail-icon fa-solid fa-envelope"></i>
                <p class="mail-id">connect@variant.com</p>
            </a>
        </div>
    </div>
    <div class="feedback">
        <div class="container">
            <p>Feedback</p>
            <form id="feedback_form">
                <div class="row">
                    <div class="col-12 py-2">
                        <input type="email" class="feed-input" required name="feed_email" id="feed_email" placeholder="Email">
                    </div>
                    <div class="col-12 py-2">
                        <textarea class="feed-input" required name="feed_massage" id="feed_massage" cols="30" rows="5" placeholder="Massage "></textarea>
                    </div>
                    <div class="col-12 py-2">
                        <input type="submit" class="feed-btn" value="Submit" name="feed_submit" id="feed_submit">
                    </div>
                </div>
            </form>
        </div>
    </div>
</footer>