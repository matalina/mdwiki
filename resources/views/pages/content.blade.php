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
@endsection
