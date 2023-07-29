<!DOCTYPE html>
<html>
<head>
    <title>User-Editable Text</title>
</head>
<body>
    <form method="post" action="/save">
        @csrf
        <textarea name="user_editable_text">{{ $userEditableText }}</textarea>
        <button type="submit">Save</button>
    </form>
    
</body>
</html>
