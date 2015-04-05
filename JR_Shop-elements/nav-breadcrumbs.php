    <?php
      $breadLinks = jr_page_crumbles ($safeArr);
      foreach ($breadLinks as $breadSlices) {
        foreach ($breadSlices as $name => $link) {
          echo $link ? '<a class="text-icon arrow-r" href="'.$link.'" ><h4>'.$name."</h4></a>" : null;
        }
      }
    ?>
