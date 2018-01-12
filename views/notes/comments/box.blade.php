<script id="comment-box" type="text/x-template">
    <div class="well">
        <div class="row">
            <div class="col-lg-12">
                <b class="text-danger">@{{comment.user.fname}} @{{comment.user.lname}}</b>
                <span class="pull-right"><span class="glyphicon glyphicon-time"></span> @{{comment.created_at.substr(0,10)}}</span>
            </div>
            <hr/>
            <div class="col-lg-12">@{{comment.content}}</div>
        
        </div>
    </div>
</script>

<script>
    Vue.component("comment-box",{
        template : "#comment-box",
        props : ['comment']
    });
</script>