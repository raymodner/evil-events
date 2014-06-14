<div class='error'>
	@foreach($errors->all() as $error)
		<div class="text-error">{{ $error }}</div>
	@endforeach
</div>
{{ Form::open(array(
"action"    => "ContactController@addAction",
'file' => true,
'enctype' => 'multipart/form-data',
'class' => 'contact-form'
)) }}
<div class="control-group">
	<div class="controls">
		{{ Form::label("email", "Email") }}
		{{ Form::text("email", $contact->email, array(
		"placeholder" => "Email"
		)) }}
	</div>
<!--</div>-->
<!--<div class="control-group">-->
	<div class="controls">
		{{ Form::label("message", "Bericht") }}
		{{ Form::textarea("message", $contact->message, array(
		"placeholder" => "Bericht"
		)) }}
	</div>
	<div class="controls right">
		{{ Form::submit("Opslaan", ['class' => 'btn btn-custom openbutton right']) }}

	</div>
</div>
{{ Form::close() }}
<script type="text/javascript">
		$('form.contact-form').submit(function(event){
			submitFancyBox(event, $(this));
		});

</script>