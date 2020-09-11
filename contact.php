<?php
include('boilerplate.php');
?>
<?php
include "dbConfig.php";
$sendEmail  = new sendEmail;

if (isset($_POST['submit'])) {

    $fullName = $_POST['fullName'];
    $email    = $_POST['email'];
    $msg      = $_POST['msg'];
    $phone    = $_POST['phone'];
    $url      = "http://" . $_SERVER['SERVER_NAME'] . "/aanav/shop.php";
    $subject  = 'Thank you';
    $body = '<p style="color:#66FCF1; font-size: 32px;" >Hi ' . $fullName . '</p><p  style="color:grey; font-size: 16px;" > Thank you for .We will contact you as soon as possible</p> 
    <p><a style="background-color: #66FCF1;
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    -webkit-transition-duration: 0.4s;
    transition-duration: 0.4s;"
    href="' . $url . '">Visit Site</a></p><p  style="color:red; font-size: 10px;" > Need Help ? <a>Contact Us</a></p>';

    if ($queries->query("INSERT INTO msg (name, email, phone, msg, type, created_date) VALUES
     ('$fullName', '$email', '$phone', '$msg', 'contact', now()) ")) {

      if ($sendEmail->send($fullName, $email, $subject, $body)) {
        $_SESSION['accountCreated'] = "Your account has been created successfully. Please verify your email";
        header("location: index.php");
      }
    }
}
?>
 <!-- Map Section Begin -->
 <div class="map carousel-info">
        <div class="container">
            <div class="map-inner">
            <div style="width: 100%">
            <iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=en&amp;q=Main%20Office,%20BulandShahr+(aanav)&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
            </iframe>
            </div>
         
                <div class="icon">
                    <i class="fa fa-map-marker"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- Map Section Begin -->

    <!-- Contact Section Begin -->
    <section class="contact-section carousel-info">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="contact-title">
                        <h4>Contacts Us</h4>
                        <p>We are always near you &#128521;</p>
                    </div>
                    <div class="contact-widget">
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-location-pin"></i>
                            </div>
                            <div class="ci-text">
                                <span>Address:</span>
                                <p>Aanav LLC GT Road</p>
                            </div>
                        </div>
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-mobile"></i>
                            </div>
                            <div class="ci-text">
                                <span>Mobile:</span>
                                <p>+91 9917955610</p>
                            </div>
                        </div>
                        <div class="cw-item">
                            <div class="ci-icon">
                                <i class="ti-email"></i>
                            </div>
                            <div class="ci-text">
                                <span>Email:</span>
                                <p>ahampriyanshu@gmail.com</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 offset-lg-1">
                    <div class="contact-form">
                        <div class="leave-comment">
                            <h4>Leave A Comment</h4>
                            <form method="post"  class="comment-form">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <input name="fullName" type="text" placeholder="Your name" required />
                                    </div>
                                    <div class="col-lg-6">
                                        <input name="phone" type="number" placeholder="Your mobile" required />
                                    </div>
                                    <div class="col-lg-6">
                                        <input name="email" type="email" placeholder="Your email" required />
                                    </div>
                                    <div class="col-lg-12">
                                        <textarea name="msg" placeholder="Your message" required ></textarea>
                                        <button type="submit"  name="submit" class="site-btn">Send message</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('footer.php'); ?></body>
</html>