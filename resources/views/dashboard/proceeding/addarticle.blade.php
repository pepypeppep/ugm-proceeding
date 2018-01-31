<!doctype html>
<html lang="en">
  <head>
    <title>Proceeding Management - Onli</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/custom.css">
    <!-- Font Swesome CSS -->
    <link rel="stylesheet" href="/css/font-awesome.css">
    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700" rel="stylesheet">
    <!-- Favicons -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicons/apple-touch-icon.png?v=3eKR9vjrYw">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicons/favicon-32x32.png?v=3eKR9vjrYw">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicons/favicon-16x16.png?v=3eKR9vjrYw">
    <link rel="manifest" href="img/favicons/manifest.json?v=3eKR9vjrYw">
    <link rel="mask-icon" href="img/favicons/safari-pinned-tab.svg?v=3eKR9vjrYw" color="#3b77a4">
    <link rel="shortcut icon" href="img/favicons/favicon.ico?v=3eKR9vjrYw">
    <meta name="msapplication-config" content="img/favicons/browserconfig.xml?v=3eKR9vjrYw">
    <meta name="theme-color" content="#ffffff">

  </head>
  <body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="#">
        <img src="img/logos/logo-text.svg" height="30" class="d-inline-block align-top" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item active">
            <a class="nav-link" href="index.html">Proceedings</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="report.html">Report</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Manage
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="user.html">Users</a>
              <a class="dropdown-item" href="subject.html">Subject</a>
              <a class="dropdown-item" href="institution.html">Institution</a>
            </div>
          </li>
        </ul>
      </div>
    </nav>
    
    <div class="container-fluid pt-5 px-md-5">

      <!-- HEADER -->
      <section class="header py-5">
        <div class="row justify-content-between">
          <div class="col-md-6 mb-3 mb-md-0">
            <h2>Create articles</h2>
          </div>
          <div class="col-md-2">
            <button onclick="addItem()" type="button" class="btn btn-block btn-primary"><i class="fa fa-plus fa-fw"></i> Add item</button>
          </div>
        </div>
      </section>

      <!-- BODY -->
      <section class="body pb-5">
        <div class="row">
          <div class="col-lg-8">
            <form id="form" method="POST" action="">
              <div class="card" style="border: none;">
                <div class="card-body" id="cardBody">
                  <div class="form-separator">
                    <h5>Article details</h5>
                  </div>
                  <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Title</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="title" id="title" rows="1"></textarea>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="start_page" class="col-sm-2 col-form-label">Page</label>
                    <div class="col-sm-5">
                      <input name="start_page" type="number" class="form-control mb-2 mb-sm-0" id="start_page" placeholder="Start page">
                    </div>
                    <div class="col-sm-5">
                      <input name="end_page" type="number" class="form-control mb-2 mb-sm-0" id="end_page" placeholder="End page">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="abstract" class="col-sm-2 col-form-label">Abstract</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" name="abstract" id="abstract" rows="5"></textarea>
                    </div>
                  </div>
                  <div class="form-separator mt-5">
                    <h5>File</h5>
                  </div>
                  <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">File type</label>
                    <div class="col-md-5 col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="file_type" id="file_type_pdf" value="pdf"onclick="showPdfInput()" checked>
                        <label class="form-check-label" for="file_type_pdf">
                          PDF File
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="file_type" id="file_type_scopus" value="scopus" onclick="showLinkInput()">
                        <label class="form-check-label" for="file_type_scopus">
                          Indexed by Scopus
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="file_type" id="file_type_doaj" value="doaj" onclick="showLinkInput()">
                        <label class="form-check-label" for="file_type_doaj">
                          Indexed by DOAJ
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row" id="file_link" style="display: none;">
                    <label for="file_link" class="col-sm-2 col-form-label">Link</label>
                    <div class="col-md-10 col-12">
                      <input type="text" name="file_link" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row" id="file_pdf">
                    <label for="file_pdf" class="col-sm-2 col-form-label">Upload PDF</label>
                    <div class="col-md-5 col-12">
                      <input type="file" name="file_pdf" class="form-control">
                    </div>
                  </div>
                  <div class="form-separator mt-4 sticky-top sticky-nav bg-white">
                    <div class="d-flex justify-content-between align-items-baseline">
                    <h5 >Author #1</h5>
                    <button onClick="addAuthor()" type="button" class="btn btn-primary mb-2"><i class="fa fa-plus fa-fw"></i>Add Author</button>
                  </div>
                  </div>
                  <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-md-5 col-12">
                      <input type="text" name="name" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-md-5 col-12">
                      <input type="email" name="email" class="form-control">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Affiliation</label>
                    <div class="col-sm-10" id="affiliationsGroup1">
                      <input type="text" name="affiliation" class="form-control" id="inputOther1">
                    </div>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </section>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="/js/jquery-3.2.1.min.js"></script>
    <script src="/js/popper.js"></script>
    <script src="/js/bootstrap.js"></script>

    <script type="text/javascript">
      function showLinkInput() {
        $('#file_link').show();
        $('#file_pdf').hide();
      }

      function showPdfInput() {
        $('#file_link').hide();
        $('#file_pdf').show();
      }

      function toggleInput(index) {
        var inputOther = $('#inputOther'+index)
        var radioOther = $('#radioOther'+index)

        if (radioOther.is(':checked')) {
          inputOther.attr("disabled", false)
          inputOther.focus()
        } else {
          inputOther.attr("disabled", "disabled")
          inputOther.val('')
        }
      }

      var affiliations = [];
      var index = 1

      function addAuthor() {
        var lastInput = $('#inputOther'+index).val();
        index++

        if (affiliations.indexOf(lastInput) == -1 && lastInput != '' && lastInput != undefined) {
          affiliations.push(lastInput);
        }

        $('#cardBody').append('<div class="form-separator mt-4 bg-white"><div class="d-flex justify-content-between align-items-baseline"><h5 >Author #'+index+'</h5></div></div><div class="form-group row"><label for="name" class="col-sm-2 col-form-label">Name</label><div class="col-md-5 col-12"><input type="text" name="name['+index+']" class="form-control"></div></div><div class="form-group row"><label for="email" class="col-sm-2 col-form-label">Email</label><div class="col-md-5 col-12"><input type="email" name="email['+index+']" class="form-control"></div></div><div class="form-group row"><label for="affiliation" class="col-sm-2 col-form-label">Affiliation</label><div class="col-sm-10" id="affiliationsGroup'+index+'"></div></div>')

        function appendItems(item, key) {
          $('#affiliationsGroup'+index).append('<div class="form-check mb-2"><input class="form-check-input" onChange="toggleInput('+index+')" name="affiliation['+index+']" type="radio" value="'+item+'" id="check'+index+'"><label class="form-check-label" for="check'+index+'">'+item+'</label></div>');
        }

        affiliations.forEach(appendItems)
          $('#affiliationsGroup'+index).append('<div class="form-check"><input class="form-check-input" name="affiliation['+index+']" type="radio" id="radioOther'+index+'" onChange="toggleInput('+index+')"><label class="form-check-label" for="radioOther'+index+'">Other<input type="text" placeholder="Other" name="affiliation['+index+']" class="form-control mt-2" id="inputOther'+index+'" disabled="true"></label></div>');
      }
    </script>
  </body>
</html>
