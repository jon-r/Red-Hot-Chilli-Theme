<?php

//indev variables. list will be taken (with key names) from the carousel table.
$advertList = [
  ['Butchers','Meat Processing Equipment','2','butcher',0],
  ['Fryers','banner test1','?cat=Fryers&page_id=16','banner', 1],
  ['Sold','banner test2','?sold=1&page_id=16','banner2', 2],
];

$carouselCount = $blipCount = 0;
?>


<ul id="js-carouselMain" class="carousel-container">

  <?php foreach ($advertList as $advert) : $carouselCount++;  ?>

  <li class="slide" data-slide=<?php echo $carouselCount ?>>
    <a href="<?php echo magic_roundabout ($advert[2]); ?>">

      <img class="slide-image" src="<?php echo imgSrcRoot(carousel,$advert[3],jpg); ?>" alt="<?php echo $advert[1]; ?>" >

      <h2 class="slide-title go-left"><?php echo $advert[0]; ?></h2>

      <div class="slide-text go-mid">
        <span class="go-red"><?php echo $advert[1]; ?></span>
        <span class="go-bold"><?php echo $advert[1]; ?></span>
        <span class="go-red go-bold"><?php echo $advert[1]; ?></span>
      </div>

      <h3 class="slide-link go-right">Click Here</h3>
    </a>
  </li>

  <?php endforeach ?>

</ul>

<ul id="js-blipParent" class="carousel-blip">
  <?php foreach ($advertList as $advert) : $blipCount++; ?>
  <li data-blip="<?php echo $blipCount ?>" ></li>
  <?php endforeach ?>
</ul>
