<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
</head>
<body>
<h1>Contact aanvraag</h1>
<p>
	Email: {{ $contact->email}}<br>
	Bericht: {{ nl2br($contact->message) }}
</p>
</body>
</html>