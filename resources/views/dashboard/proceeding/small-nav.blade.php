<ul class="nav nav-pills nav-fill sticky-top sticky-nav bg-light d-md-none mb-2">
  <li class="nav-item">
    <a class="nav-link @if(request('tab') == 'recent' || request('tab') == null) active @endif" href="?tab=recent"><i class="fa fa-file-text-o m-0"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link @if(request('tab') == 'draft') active @endif" href="?tab=draft"><i class="fa fa-pencil-square-o m-0"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link @if(request('tab') == 'published') active @endif" href="?tab=published"><i class="fa fa-paper-plane-o m-0"></i></a>
  </li>
  <li class="nav-item">
    <a class="nav-link @if(request('tab') == 'trashed') active @endif" href="?tab=trashed"><i class="fa fa-trash-o m-0"></i></a>
  </li>
</ul>