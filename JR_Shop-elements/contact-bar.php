<?php
  // contact form at the bottom of most pages.
?>

<article class="contact-bar flex-container">

  <form class="form-contact flex-2">
    <h2>Contact us about <?php echo $safeArr[pgName]; ?></h2>
    <p>Contact us today</p>
<!--    <label for="Name">Name</label>-->
    <input type="text" name="name" placeholder="Name">
<!--    <label for="email">Email Address</label>-->
    <input type="email" name="email" placeholder="Email Address">
<!--    <label for="phone">Phone Number</label>-->
    <input type="number" name="phone" placeholder="Phone Number">
<!--    <label for="subject">Subject</label>-->
    <input type="text" name="subject" placeholder="Message Subject">
    <textarea placeholder="message">blah</textarea>
  </form>

  <div class="testimonial-slides flex-2">

    <p>"will do something fancy with testimonials here"</p>
    <h4>Jon Richards</h4>

  </div>

</article>
