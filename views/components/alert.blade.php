@if(Session::has('message'))
    <div class="row">
        <div class="col-lg-12">
            <div class="alert alert-{{Session::get('message')['type']}}">{{Session::get('message')['content']}}</div>
        </div>
    </div>
@endif