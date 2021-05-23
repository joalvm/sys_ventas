@if (Auth::check())
    <script id="initStorage">
        window.localStorage.setItem('token', '{{ Session::get('token') }}');

        document.head.querySelector('#initStorage').remove();
    </script>
@else
    <script id="initStorage">
        window.localStorage.removeItem('token');

        document.head.querySelector('#initStorage').remove();
    </script>
@endif
