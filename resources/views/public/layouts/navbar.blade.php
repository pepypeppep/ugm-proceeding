<nav class="navbar navbar-expand-md navbar-primary bg-light fixed-top">
	<a class="navbar-brand" href="{{ route('public.index') }}">
		<img src="/img/webkit/icotext-clr.svg" height="30px" alt="Online Library">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navHead" aria-controls="navHead" aria-expanded="false"
	aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navHead">
	<ul class="navbar-nav ml-auto">
		{{-- <li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Topics</a>
			<div class="dropdown-menu" aria-labelledby="dropdown01">
				<a class="dropdown-item" href="#">Agroforestry</a>
				<a class="dropdown-item" href="#">Health</a>
				<a class="dropdown-item" href="#">Social Humaniora</a>
				<a class="dropdown-item" href="#">STEM</a>
			</div>
		</li> --}} 
		<li class="nav-item">
			<a class="nav-link" href="{{ route('public.proceeding.index') }}">Proceedings</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#">Articles</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('public.book.index') }}">Books</a>
		</li>
		<li class="nav-item">
			<a href="../onli/sign.html"><button type="button" class="btn btn-primary">Sign in</button></a>
		</li>
	</ul>
</div>
</nav>