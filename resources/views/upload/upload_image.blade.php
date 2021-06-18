<form 
	method="post"
	action="{{ route('works.store') }}"
	enctype="multipart/form-data"
>
	@csrf
	<input type="file" name="image" accept="image/png, image/jpeg">/>
	<input type="submit" value="Upload">
</form>

<!--@isset ($filename)-->
                    <!--    <div>-->
                    <!--        <img src="{{ asset('storage/' . $filename) }}">-->
                    <!--    </div>-->
                    <!--@endisset-->