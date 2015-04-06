<?php
  // contact form at the bottom of most pages.
?>

<article class="contact-bar flex-container">

  <form class="flex-2">
    <h2>Contact us about <?php echo $safeArr[pgName]; ?></h2>
    <p>Contact us today</p>
    <input type="text" name="name">
    <label for="Name">Name</label>
    <input type="email" name="email">
    <label for="email">Email Address</label>
    <input type="number" name="phone">
    <label for="phone">Phone Number</label>
    <input type="text" name="subject">
    <label for="subject">Subject</label>
  </form>

  <div class="testimonial-slides flex-2">

    <p>"will do something fancy with testimonials here"</p>
    <h4>Jon Richards</h4>

  </div>

</article>
