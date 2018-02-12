<div class="tab-pane fade @if(request('tab') == 'authors') {{ 'show active' }} @endif" id="nav-authors" role="tabpanel" aria-labelledby="nav-authors-tab">
  <!-- ARTICLES -->
  <section class="body pb-5">
    <div class="row pt-4">
      <div class="col-md-8">
        <div class="mb-3">
          <h4 class="text-primary">Author info</h4>
          <div class="card article-card">
            <div class="card-body">
              <div class="row justify-content-between">
                <div class="col-lg-7 paper-info d-flex">
                  <i class="far fa-file-alt fa-2x p-3"></i>
                  <p class="m-0 pl-2">
                    <a href="" class="text-primary"><b>Ms. Name Johnson</b></a> <br>
                    Affiliation : <span class="badge badge-secondary">1</span><br>
                    <span class="text-muted">Email : aweber@example.net</span>
                  </p>
                </div>
                <div class="col-lg-1">
                  <span class="badge badge-primary">Correspondence</span>
                </div>
                <div class="col action text-right">
                  <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a type="button" href="" class="btn btn-outline-secondary">Edit</a>
                    <a type="button" href="" class="btn btn-outline-secondary">Delete</a>
                  </div>
                </div>
              </div>  
              <hr>  
              <div class="row justify-content-between">
                <div class="col-lg-7 paper-info d-flex">
                  <i class="far fa-file-alt fa-2x p-3"></i>
                  <p class="m-0 pl-2">
                    <a href="" class="text-primary"><b>Mrs. Name Jihnsin</b></a> <br>
                    Affiliation : <span class="badge badge-secondary">2</span><br>
                  </p>
                </div>
                <div class="col-lg-1">
                  <span class="badge badge-secondary">Not Correspondence</span>
                </div>
                <div class="col action text-right">
                  <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a type="button" href="" class="btn btn-outline-secondary">Edit</a>
                    <a type="button" href="" class="btn btn-outline-secondary">Delete</a>
                  </div>
                </div>
              </div>   
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="mb-3">
          <h4 class="text-primary">Affiliation list</h4>
          <div class="card article-card">
            <div class="card-body">
              <span>1. Gulgowski-Schamberger</span><br>
              <span>2. Schamberger-Gulgowski</span><br>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  
</div>