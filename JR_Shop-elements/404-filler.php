<article class="flex-container four-oh-four" >

    <div>
      <img src="<?php echo site_url('/').imgSrcRoot('rhc','four-oh-four','jpg'); ?>" alt="four-oh-four">
    </div>

    <header class="article-header flex-1">
      <h1>Page Not Found</h1>
      <?php echo $safeArr[imgURL] ?>
    </header>

    <p class="flex-1">Looks like the page you were looking for wasnt here. Try looking again!</p>



    <form class="flex-2 form-central" method="get" action="<?php echo site_url('search'); ?>">
      <h2 class="text-icon-right search-w" >Search Catering Equipment</h2>

        <input type="search" name="search" placeholder="Enter Keyword or Reference">

      <button class="btn-red" type="submit"><h3>Go</h3></button>
    </form>



</article>
