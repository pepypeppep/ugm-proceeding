<div class="tab-pane fade @if(request('tab') == 'articles' || request('tab') == null) {{ 'show active' }} @endif" id="nav-articles" role="tabpanel" aria-labelledby="nav-articles-tab">
  <!-- ARTICLES -->
  <section class="body pb-5">
    <div class="row pt-4">
      <div class="col-md-10">
        <div class="mb-2">
          <h4 class="text-primary">Abstract</h4>
          {!! $article->data['abstract'] !!}
        </div>
        <div class="mb-4">
          <b><span>Keywords</span></b> : {{ $article->keywords->implode(',') }}
        </div>
        <div class="mb-3">
          <h4 class="text-primary">Article info</h4>
          <div class="row">
            @foreach($article->data['identifiers'] as $identifiers)
              <div class="col-sm-6 col-md-3">
                <table>
                  <tr>
                    <th>{{ $identifiers['type'] }}</th>
                  </tr>
                  <tr>
                    <td>{{ $identifiers['id'] }}</td>
                  </tr>
                </table>
              </div>
              <div class="clearfix visible-md-block"></div>
            @endforeach
            <div class="col-sm-6 col-md-2">
              <table>
                <tr>
                  <th>Date Added</th>
                </tr>
                <tr>
                  <td>{{ $article->data['date_added'] }}</td>
                </tr>
              </table>
            </div>
            <div class="clearfix visible-md-block"></div>
            <div class="col-sm-6 col-md-2">
              <table>
                <tr>
                  <th>Page(s)</th>
                </tr>
                <tr>
                  <td>{{ $article->data['start_page'] }} &ndash; {{ $article->data['end_page'] }}</td>
                </tr>
              </table>
            </div>
            <div class="clearfix visible-md-block"></div>
            <div class="col-sm-2 col-md-1">
              <table>
                <tr>
                  <th>Indexed</th>
                </tr>
                <tr>
                  <td>
                    @if ($article->indexed)
                    <a href="{{ $article->file['link'] }}">
                      <img src="{{ $article->img[$article->file['type']] }}" class="img-fluid">
                    </a>
                    @else
                    <span>PDF</span>
                    @endif
                  </td>
                </tr>
              </table>
            </div>
            <div class="clearfix visible-md-block"></div>
          </div>
        </div>
      </div>
      <div class="col-md-2">
        <div class="d-md-block d-none">
          <ul class="nav nav-pills flex-column sticky-top sticky-nav pb-3" style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);">
            <h4 class="text-primary mb-2">Properties</h4>
            <li class="nav-item">
              <a class="nav-link" href=""><i class="fas fa-print fa-fw mr-2"></i>Print</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href=""><i class="far fa-file-pdf fa-fw mr-2"></i>Download PDF</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('article.edit', ['article' => $article->id]) }}"><i class="fas fa-edit fa-fw mr-2"></i>Edit</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</div>
