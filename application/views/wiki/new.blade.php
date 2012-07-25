@if(isset($warning))
 <div class="warning">{{$warning}}</div>
@endif

{{Form::open('add')}}
    
{{Form::label('title', 'Title')}}
{{$errors->first('title', '<span class="error">:message</span>')}}
{{ Form::text('title', Input::old('title', isset($page->title) ? $page->title : '')) }}

{{Form::label('content', 'Markdown Content')}}
{{$errors->first('content', '<span class="error">:message</span>')}}
{{Form::textarea('content', Input::old('content'))}}

{{Form::label('tags', 'Tags [separate with semicolon(;)]')}}
{{$errors->first('tags', '<span class="error">:message</span>')}}
{{Form::text('tags', Input::old('tags'))}}

{{Form::submit('Add Page')}}

{{Form::close()}}