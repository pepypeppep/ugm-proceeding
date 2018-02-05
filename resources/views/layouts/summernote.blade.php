{{-- INCLUDE THIS VIEW ON SCRIPT SECTION FOR EVERY FORM THAT NEED TEXT EDITOR --}}
<script src="/summernote/summernote-bs4.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
	  $('#summernote').summernote({
	  	toolbar: [
  	    // [groupName, [list of button]]
  	    ['style', ['bold', 'italic', 'underline', 'clear']],
  	    ['font', ['strikethrough', 'superscript', 'subscript']],
  	    ['fontsize', ['fontsize']],
  	    ['para', ['ul', 'ol', 'paragraph']]
  	  ],
  	  height: 250
	  });
	});
</script>