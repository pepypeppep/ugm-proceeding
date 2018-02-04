@if (session()->has('success'))
  <section>
  	<div class="row">
  		<div class="col">
  			<div class="alert alert-success alert-dismissible fade show" role="alert">
  			  <strong>Well done!</strong> {{ session('success') }}
  			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  			    <span aria-hidden="true">&times;</span>
  			  </button>
  			</div>
  		</div>
  	</div>
  </section>
@endempty

@if (session()->has('warning'))
  <section>
  	<div class="row">
  		<div class="col">
  			<div class="alert alert-warning alert-dismissible fade show" role="alert">
  			  <strong>Be careful!</strong> {{ session('success') }}
  			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  			    <span aria-hidden="true">&times;</span>
  			  </button>
  			</div>
  		</div>
  	</div>
  </section>
@endempty

@if (session()->has('danger'))
  <section>
  	<div class="row">
  		<div class="col">
  			<div class="alert alert-danger alert-dismissible fade show" role="alert">
  			  <strong>Warning!</strong> {{ session('success') }}
  			  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
  			    <span aria-hidden="true">&times;</span>
  			  </button>
  			</div>
  		</div>
  	</div>
  </section>
@endempty