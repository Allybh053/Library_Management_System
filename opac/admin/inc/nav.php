<div class="my-1 mt-2 bg-light">
  <div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-center anchor">
      <a class="p-2 mx-1 link-secondary" href="<?= $base_url ?>">Home</a>
      <a class="p-2 mx-1 link-secondary" target="_blank" href="http://macclibrary.sprm.gov.my/index.html">Koha</a>
      <a class="p-2 mx-1 link-secondary" target="_blank" href="https://www.u-library.gov.my/portal/">U-Pustaka</a>
      <a class="p-2 mx-1 link-secondary" href="<?= $base_url ?>e-book">E-Book</a>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
		  <?= $lang['info_library']; ?>
        </a>
        <ul class="dropdown-menu bg-light">
          <li><a class="dropdown-item" href="general-info"><?= $lang['general_info']; ?></a></li>
          <li><a class="dropdown-item" href="library-activity"><?= $lang['library_activity']; ?></a></li>
          <li><a class="dropdown-item" href="weblink"><?= $lang['web_link']; ?></a></li>
          <li><a class="dropdown-item" href="brochure-library"><?= $lang['brochure_library']; ?></a></li>         
          <li><a class="dropdown-item" href="download"><?= $lang['download']; ?></a></li>
        </ul>
      </li>
    </nav>
  </div>
</div>