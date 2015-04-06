<?php
/* carousel on the front page */
$carouselCount = $blipCount = 0;
?>


<ul id="js-carouselMain" class="carousel-container">

  <?php foreach ($carouselList as $slideRaw) :
    $carouselCount++;
    $slide = magic_roundabout($slideRaw);
  ?>

  <li class="slide<?php echo $carouselCount == 1 ? ' is-active' : null ?>" data-slideNum="<?php echo $carouselCount ?>" >
    <a href="<?php echo $slide[link]; ?>">

      <img class="slide-image" src="<?php echo $slide[image]; ?>" alt="<?php echo $slide[title]; ?>" >

      <h2 class="slide-title <?php echo $slide[titlePos]; ?>"><?php echo $slide[title]; ?></h2>

      <div class="slide-text <?php echo $slide[textPos]; ?>">
        <span class="<?php echo $slide[style1]; ?>"><?php echo $slide[text1]; ?></span>
        <span class="<?php echo $slide[style2]; ?>"><?php echo $slide[text2]; ?></span>
        <span class="<?php echo $slide[style3]; ?>"><?php echo $slide[text3]; ?></span>
      </div>

      <h3 class="slide-link <?php echo $slide[linkPos]; ?>">Click Here</h3>
    </a>
  </li>

  <?php endforeach ?>

</ul>

<ul id="js-blipParent" class="carousel-blips">
  <?php foreach ($carouselList as $slide) : $blipCount++; ?>
  <li class="blipper<?php echo $blipCount++ == 1 ? ' active' : null ?>" data-blipNum="<?php echo $blipCount ?>" ></li>
  <?php endforeach ?>
</ul>
