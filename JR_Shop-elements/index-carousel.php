<?php

//indev variables. list will be taken (with key names) from the carousel table.
$advertList = [
  ['Butchers','Meat Processing Equipment','2','butcher',0],
  ['Fryers','banner test1','?cat=Fryers&page_id=16','banner', 1],
  ['Sold','banner test2','?sold=1&page_id=16','banner2', 2]
];

?>

<div class="carousel">
  <ul class="carousel-container" >

    <?php foreach ($advertList as $advert) : ?>

    <li class="carousel-float" >
      <a href="<?php echo magic_roundabout ($advert[2]); ?>" >
        <img src="<?php echo imgSrcRoot(carousel,$advert[3],jpg); ?>" alt="<?php echo $advert[1]; ?>" >
      </a>
    </li>

    <?php endforeach ?>

  </ul>
</div>
