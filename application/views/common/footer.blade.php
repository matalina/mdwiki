  </div> <!-- end twelve columns -->
</div> <!-- end row -->
<footer class="row">
  <dl class="six columns sub-nav">
    <dt>Navigation:</dt>
    <dd>{{ HTML::link('/','Home') }}</dd>
    <dd>{{ HTML::link('random','Random Page') }}</dd>
    <dd>{{ HTML::link('index','Site Map') }}</dd>
  </dl>
  <div class="six columns text-right" id="copyright">
    All rights reserved | &copy 2012 
    @if(date('Y') != 2012)
     {{ ' - '.date('Y') }}
    @endif
     | <a href="http://matalina.github.com/mdwiki">Download MDWiki</a>
  </div>
</footer>