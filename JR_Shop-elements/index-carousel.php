<?php

//indev variables. list will be taken (with key names) from the carousel table.
$advertList = [
  ['Butchers','Meat Processing Equipment','2','butcher',0],
  ['Fryers','banner test1','?cat=Fryers&page_id=16','banner', 1],
  ['Sold','banner test2','?sold=1&page_id=16','banner2', 2],
];

?>

<div class="carousel">
  <div class="carousel-container">
    <ul class="carousel-float">

      <?php foreach ($advertList as $advert) : ?>

      <li id="<?php echo $advert[1]; ?>">
        <a class="no-icon" href="<?php echo magic_roundabout ($advert[2]); ?>">
          <img src="<?php echo imgSrcRoot(carousel,$advert[3],jpg); ?>" alt="<?php echo $advert[1]; ?>" >
        </a>
      </li>

      <?php endforeach ?>

    </ul>
  </div>

  <aside class="carousel-buttons" >
      <?php foreach ($advertList as $advert) :
        if ($ctr>=5) break; else $ctr++;
      ?>
        <a class="arrow-l" href="#<?php echo $advert[1]; ?>"><?php echo $advert[1]; ?></a>
      <?php endforeach ?>
  </aside>

</div>
