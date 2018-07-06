<div id="fh5co-offcanvas">
    <a href="#" class="fh5co-close-offcanvas js-fh5co-close-offcanvas"><span><i class="icon-cross3"></i> <span>Close</span></span></a>
    <div class="fh5co-bio">
        <figure>
            <img src="{{ '/images/'.$user->photo }}" alt="Free HTML5 Bootstrap Template" class="img-responsive">
        </figure>
        <h3 class="heading">About Me</h3>
        <h2>{{ $user->name }}</h2>
        <p><? echo nl2br($user->introduction)?></p>
    </div>

    <div class="fh5co-menu">
        <div class="fh5co-box">
            <h3 class="heading">Categories</h3>
            <ul>
                @foreach($catrgory as $item)
                    <li><a href="{{ url('/search/'.$item->id) }}">{{ $item->name }}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="fh5co-box">
            <h3 class="heading">Search</h3>
            <form action="/search" method="POST">
                <div class="form-group">
                   {!! csrf_field() !!}
                    <input type="text" name="keyword" class="form-control" placeholder="Type a keyword">
                    <br>
                    <div align="right">
                        <input name="submit" class="btn btn-warning" type="submit" id="submit" value="搜尋">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- END #fh5co-offcanvas -->
