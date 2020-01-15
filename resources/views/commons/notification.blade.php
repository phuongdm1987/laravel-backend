@if($errors->all())
    <notification state="is-danger">
        @foreach($errors->all() as $message)
            <p>{{ $message }}</p>
        @endforeach
    </notification>
@endif
