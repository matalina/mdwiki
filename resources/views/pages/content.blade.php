@extends('master')

@section('content')
<article>
    {!! $page  !!}
    
    @if(!empty($front_matter))
    <ul class="front_matter">
        @foreach($front_matter as $key => $value)
            @if(! is_array($value))
            <?php $value = [$value]; ?>
            @endif
            <li><span class="label">{{ $key }}:</span>&nbsp;
            @foreach($value as $v)
                {{ $v }}&nbsp;
            @endforeach
            </li>
        @endforeach
    </ul>
    @endif
</article>
<nav class="row">
    @if(!$home)
    <div class="small-6 columns">
        @if($next_previous['previous'] == null)
        Previous
        @else
        <a href="{{ url($next_previous['previous']) }}">Previous</a>
        @endif
    </div>
    <div class="small-6 columns text-right">
        @if($next_previous['next'] == null)
        Next
        @else
        <a href="{{ url($next_previous['next']) }}">Next</a>
        @endif
    </div>
    @endif
</nav>
@endsection
