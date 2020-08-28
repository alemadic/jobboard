<section class="contact-section section_padding">
    <div class="container">
    
      <div class="row">
        <div class="col-md-12">
          <h2 class="contact-title">Get in Touch</h2>

          <?php if(isset($_SESSION['mailStatus'])) {
            echo "<p> " . $_SESSION['mailStatus'] . "</p>";
            unset($_SESSION['mailStatus']);
          } ?>
        </div>
        <div class="col-md-8">
        <form action="contactForm.php" onSubmit="return proveraContact();" method="POST">
              <div class="form-group row">
                <div class="col-md-6 mb-4 mb-lg-0">
                  <input type="text" name="name" id="Name" class="form-control" placeholder="Name" />
                </div>
                <div class="col-md-6">
                  <input type="text" name="subject" id="Subject" class="form-control" placeholder="Subject" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <input type="text" name="email" id="Email" class="form-control" placeholder="Email address" />
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <textarea name="message" id="Message" class="form-control" placeholder="Write your message." cols="30" rows="6"></textarea>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-md-6 mr-auto">
                  <input type="submit" name="submitContact" class="btn btn-block btn-primary text-white py-2 w-50" value="Send Message" />
                </div>
              </div>
            </form>
        </div>
        <div class="col-lg-4">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              <h3>Buttonwood, California.</h3>
              <p>Rosemead, CA 91770</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
            <div class="media-body">
              <h3>00 (440) 9865 562</h3>
              <p>Mon to Fri 9am to 6pm</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3>support@colorlib.com</h3>
              <p>Send us your query anytime!</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>