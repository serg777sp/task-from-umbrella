<script type="text/template" id='link-add-form-template'>
    <form class='form' method='post' action='/link/add'>
	<div>
	    <label>Original url</label>
	    <small> (Example: http://site.ru/something/action)</small>
	    <input class="form-control" name="original_url" id="link-add-form-original-url">
	    <div class="field-errors">
		<ul id="original-url-errors"></ul>
	    </div>
	</div>
	<div>
	    <label>Short url</label>
	    <input class="form-control" name="short_url" id="link-add-form-short-url">
	    <div class="field-errors">
		<ul id="short-url-errors"></ul>
	    </div>
	</div>
	<div id="link-add-buttons">
	    <button type="submit" class="btn btn-success">Send</button>
	</div>
	{{ csrf_field() }}
    </form>
</script>