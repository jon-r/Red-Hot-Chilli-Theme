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

  <?php foreach ($advertList as $advert) : $carouselCount++; //dodgy <li> bits to fix spaces ?>

  </li><li data-slide="<?php echo $carouselCount ?>">
    <a href="<?php echo magic_roundabout ($advert[2]); ?>">
      <img src="<?php echo imgSrcRoot(carousel,$advert[3],jpg); ?>" alt="<?php echo $advert[1]; ?>" >
    </a>


  <?php endforeach ?>
  </li>
</ul>

<ul id="js-blipParent" class="carousel-blip">
  <?php foreach ($advertList as $advert) : $blipCount++; ?>
  <li data-blip="<?php echo $blipCount ?>" ></li>
  <?php endforeach ?>
</ul>
