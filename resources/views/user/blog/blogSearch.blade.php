{{-- <form action="#">
    <input placeholder="Search..." type="text">
    <button type="submit">search</button>
</form> --}}

<form method="GET" action="{{ route('user.blog.index') }}">
    <input type="text" name="search" placeholder="Tìm kiếm bài viết" value="{{ request('search') }}">
    <button type="submit">Tìm kiếm</button>
</form>
