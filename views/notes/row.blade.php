<script id="note-row" type="text/x-template">
    <div class="well">
        <div v-if="!loading">
            <h4 class="text-info">@{{note.title.substr(0,50)}}..</h4>
            <b class="row">
                <small>
                    <span class="col-lg-4"><span class="glyphicon glyphicon-user"></span> @{{note.author.fname}} @{{note.author.lname}}</span>
                    <span class="col-lg-4"><span class="glyphicon glyphicon-time"></span> @{{note.created_at.substr(0,10)}}</span>
                    <span class="col-lg-4"><span class="glyphicon glyphicon-list"></span> @{{note.type.value}}</span>
                
                </small>
            </b><br/>
            <small>
                <span v-for="tag in note.tags.split(' ')" class="col-lg-3">
                    <a href="#" @click="tagclick(tag)">
                        <span class="glyphicon glyphicon-tag"></span> @{{tag}} &nbsp;
                    </a>
                </span>
            </small><br/><hr/>
            <small v-html="note.description.substr(0,150)"></small><hr/>
            <span v-if="admin">
                <a href="#" class="btn btn-primary btn-sm">Edit</a>
                <a href="#" class="btn btn-primary btn-sm" @click="deleteNote">Delete</a>
            </span>
            <span class="col-lg-offset-1">@{{votes}} Votes</span>
            <a href="#" class="btn btn-default btn-sm pull-right" @click="clicked">Read More</a><br/>
        </div>
        <div v-if="loading">
            Deleteing, Please Wait...
        </div>
    </div>
</script>

<script>
    Vue.component("note-row",{
        template : "#note-row",
        props : ['note','admin'],
        data(){
            return { votes : 0, loading : false };
        },
        methods : {
            clicked : function(){                
                this.$emit('clicked',this.note);
            },
            tagclick : function(tag){
                this.$emit('tagclick',tag);
            },
            delete(){
                this.loading = true;
                var el = this;
                $.post("notes/delete",{
                    note : this.note
                },function(){
                    el.$emit("ondelete");
                })
            },
            deleteNote(){
                if(confirm("Delete this Article?")){
                    this.delete();
                }
            }
        },
        created(){
            var el = this;
            $.get("notes/votescount/"+this.note.id,function(votes){
                el.votes = votes;
            });
        }
    })
</script>