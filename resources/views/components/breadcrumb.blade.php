@if (!empty($items))
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-white mt-3 pl-0">
        @foreach ($items as $item)
        <li
            class="breadcrumb-item {{ $item['active'] ?: 'active' }}"
            {{ $item['active'] ?: 'aria-current="page"' }}
            >
            <a href="{{Arr::get($item, 'url', '#')}}">{{$item['text']}}</a>
        </li>
        @endforeach
    </ol>
</nav>
@endif

