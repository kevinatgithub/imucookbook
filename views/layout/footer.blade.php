<footer>
        <div class="row">
          <div class="col-lg-12">

            <ul class="list-unstyled">
              <li class="pull-right"><a href="#top">Back to top</a></li>
              @foreach(Config::get('ref.FOOTER_LINKS') as $link)
                <li><a href="{{url($link['url'])}}">{{$link['title']}}</a></li>
              @endforeach
            </ul>
            

          </div>
        </div>

      </footer>