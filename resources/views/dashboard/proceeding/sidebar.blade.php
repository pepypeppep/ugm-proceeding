<div class="col-md-2 pr-md-4 d-md-block d-none">
  <ul class="nav nav-pills flex-column sticky-top sticky-nav pb-3" style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
  <h5>Status</h5>
    <li class="nav-item">
      <a class="nav-link @if(request('tab') == 'recent') {{ 'active' }} @endif" href="?tab=recent"><i class="fa fa-file-text-o fa-fw"></i>Recent</a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(request('tab') == 'draft') {{ 'active' }} @endif" href="?tab=draft"><i class="fa fa-pencil-square-o fa-fw"></i>Draft</a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(request('tab') == 'published') {{ 'active' }} @endif" href="?tab=published"><i class="fa fa-paper-plane-o fa-fw"></i>Published</a>
    </li>
    <li class="nav-item">
      <a class="nav-link @if(request('tab') == 'deleted') {{ 'active' }} @endif" href="?tab=deleted"><i class="fa fa-trash-o fa-fw"></i>Deleted</a>
    </li>
  </ul>
</div>