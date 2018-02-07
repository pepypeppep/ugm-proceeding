<ul class="nav nav-pills nav-fill sticky-top sticky-nav bg-light d-md-none mb-2">
  <li class="nav-item">
    <a class="nav-link @if(request('tab') == 'recent' || request('tab') == null) active @endif" href="?tab=recent"><i class="far fa-file-alt m-0"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link @if(request('tab') == 'draft') active @endif" href="?tab=draft"><i class="fas fa-edit m-0"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link @if(request('tab') == 'published') active @endif" href="?tab=published"><i class="far fa-paper-plane m-0"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link @if(request('tab') == 'trashed') active @endif" href="?tab=trashed"><i class="far fa-trash-alt m-0"></i></a>
  </li>
</ul>