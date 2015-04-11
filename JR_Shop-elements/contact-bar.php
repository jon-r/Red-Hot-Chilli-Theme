<?php
  // contact form at the bottom of most pages.
?>

<article class="contact-bar flex-container">

  <form class="form-contact flex-2">
    <h2>Contact us</h2><br>
    <label for="Name">Name</label>
    <input type="text" id="name">
    <label for="email">Email Address</label>
    <input type="email" id="email" >
    <label for="phone">Phone Number</label>
    <input type="number" id="phone" >
<!--    <label for="subject">Subject</label>-->
<!--    <input type="text" name="subject" placeholder="Message Subject">-->
    <label for="message">Message</label>
    <textarea id="message" >Item: <?php echo $safeArr[pgName]; ?></textarea>
    <button class="btn-red"><h3>Send</h3></button>
  </form>

  <div class="testimonial-slides flex-2">

    <p>"will do something fancy with testimonials here"</p>
    <h4>Jon Richards</h4>

  </div>

</article>
