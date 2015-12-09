<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>{{ $title }} | {{ Config::get('wiki.page_title') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css"/>
    </head>
    <body>
        <div class="off-canvas-wrapper">
        <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
            <div class="off-canvas-content" data-off-canvas-content>
                <div class="top-bar">
                    <div class="top-bar-left">
                        <ul class="menu">
                            <li><button type="button" class="button" data-toggle="offCanvas"><i class="fa fa-lg fa-bars"></i></button></li>
                            <li class="menu-text">{{ Config::get('wiki.page_title') }}</li>
                        </ul>
                    </div>
                </div>
                <div class="callout large primary">
                    <div class="row column text-center">
                        <h1>{{ Config::get('wiki.page_title') }}</h1>
                        <h2 class="subheader">{{ Config::get('wiki.page_tag_line') }}</h2>
                    </div>
                </div>
                
                <div class="row small-12 medium-8 columns">
                    @yield('content')
                </div>
            </div>
            <div class="off-canvas position-left" id="offCanvas" data-off-canvas>
                {!! $menu !!}
            </div>
        </div>
        
        <script src="{{ asset('js/all.js') }}"></script>
    </body>
</html>