<x-layout>
    <h1 class="text-2xl font-semibold">Use Noto!</h1>
    <p class="max-w-xl">
        I use Noto all over the place. I found I was repeating the same conversion + import process on every site. So, I built this project as a way for me to import <a href="https://www.google.com/get/noto/" class="text-blue-500">Noto</a> quickly.
    </p>
    <p class="max-w-xl">Import the stylesheets of the variants you want into your project:</p>
    <details>
        <summary>
            There are quite a few...
        </summary>
        <code class="block bg-gray-100 p-2 text-sm overflow-x-auto">
            @foreach (\App\Models\Font::get() as $font)
                @foreach (explode(',', $font->weights) as $weight)
                    <div class="whitespace-no-wrap">@import <span class="text-blue-500">'{{ config('app.url') }}/stylesheets/{{ $font->weight($weight) }}.css'</span>;</div>
                @endforeach
            @endforeach
        </code>
    </details>
    <p class="max-w-xl">...or you can import everything per family:</p>
    <code class="block bg-gray-100 p-2 text-sm overflow-x-auto">
        @foreach (\App\Models\Font::get() as $font)
            <div class="whitespace-no-wrap">@import <span class="text-blue-500">'{{ config('app.url') }}/stylesheets/{{ $font->file_for_all }}.css'</span>;</div>
        @endforeach
    </code>
    <p class="max-w-xl">Then, use the fonts in your CSS:</p>
    <code class="block bg-gray-100 p-2 text-sm overflow-x-auto">
        @foreach (\App\Models\Font::get() as $font)
            @if (!$font->show_in_css)
                @continue
            @endif
            <div class="whitespace-no-wrap">.{{ str($font->name)->slug() }} { font-family: <span class="text-blue-500">'{{ $font->name }}'</span>; }</div>
        @endforeach
    </code>
    <h2 class="text-xl font-semibold">Samples</h2>
    <div class="p-2">
        <details>
            <summary>There are quite a few...</summary>
            <div class="grid grid-cols-3 gap-4 items-center">
                @foreach (\App\Models\Font::get() as $font)
                    <div class="bg-gray-100 p-2 flex flex-col text-center">
                        @foreach (explode(',', $font->weights) as $weight)
                            <div
                                style="
                                    font-family: {{ $font->name }};
                                    font-weight: {{ $weight }};
                                    font-style: {{ $font->style }};
                                "
                            >
                                @if ($font->sample)
                                    {{ $font->sample }}
                                @else
                                    {{ $font->name }} {{ $font->style }} sample
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </details>
    </div>
</x-layout>
