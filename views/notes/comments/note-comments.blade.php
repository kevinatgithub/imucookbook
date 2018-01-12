<script id="comments" type="text/x-template">
    <div class="">
        <div class="col-lg-12">
            <h1 class="text-info">Comments</h1>
        </div>
        <div class="row">
            <div class="well text-center" v-if="loading">
                <span class="glyphicon glyphicon-globe"></span> Comments are loading..
            </div>
            <div class="col-lg-12" v-for="comment in sortedComments">
                <comment-box :comment="comment"></comment-box>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <textarea cols="30" rows="3" class="form-control" style="resize:none;" placeholder="Enter Comment Here" v-model="comment"></textarea>
            </div>
            
        </div>
        <div class="col-lg-12">
            <br/>
            <button class="btn btn-default" @click="submit">Submit</button>
        </div>
        <br/>
    </div>
</script>
@include('notes.comments.box')
<script>
    Vue.component("note-comments",{
        template : "#comments",
        props : ['note'],
        data : function(){
            return {
                comment : null, comments : [], loading : true
            };
        },
        methods : {
            submit : function(){
                var el = this;
                this.loading = true;
                $.post("{{url('comments/new')}}",{
                    note_id : this.note.id,
                    user_id : "{{Auth::user()->user_id}}",
                    content : this.comment
                },function(comments){
                    el.comments = comments;
                    el.comment = null;
                    el.loading = false;
                });
            },
            refresh : function(){
                this.comment = null;
                var el = this;
                $.get("{{url('comments/of/')}}/"+this.note.id,function(comments){
                    el.loading = false;
                    el.comments = comments;
                });
            }
        },
        created : function(){this.refresh()},
        watch : {
            note : function(){this.refresh()}
        },
        computed : {
            sortedComments : function(){
                return _.orderBy(this.comments,'created_at','desc');
            }
        }
    })
</script>