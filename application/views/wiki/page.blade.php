<article>
  <header>
    <h1>
      {{ $title }}
      <span class="slug">{{ $slug }}</span>
    </h1>
    <p id="tags">Tags: 
      @foreach ($tags as $slug => $tag)
        {{ HTML::link('tag/'.$slug, $tag).' ' }}
      @endforeach
    </p>
  </header>
  <section>
    {{ $content }}
  </section>
</article>