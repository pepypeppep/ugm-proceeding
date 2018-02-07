<div class="col-md-2 pr-md-4 d-md-block d-none">
  <ul class="nav nav-pills flex-column sticky-top sticky-nav pb-3" style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
  <h5>Status</h5>
    <li class="nav-item">
      <a class="nav-link @if(request('tab') == 'recent' || request('tab') == null) {{ 'active' }} @endif" href="?tab=recent"><i class="far fa-file-alt fa-fw mr-2"></i>Recent</a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(request('tab') == 'draft') {{ 'active' }} @endif" href="?tab=draft"><i class="fas fa-edit fa-fw mr-2"></i>Draft</a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(request('tab') == 'published') {{ 'active' }} @endif" href="?tab=published"><i class="far fa-paper-plane fa-fw mr-2"></i>Published</a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(request('tab') == 'trashed') {{ 'active' }} @endif" href="?tab=trashed"><i class="far fa-trash-alt fa-fw mr-2"></i>Deleted</a>
    </li>
  </ul>
</div>