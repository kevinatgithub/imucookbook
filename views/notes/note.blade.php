<script id="note" type="text/x-template">
    <ul class="list-group">
        <li class="list-group-item">
            <h1>@{{note.title}}</h1>
        </li>
        <li class="list-group-item">
            <div class="list-group-item-text">
                <div class="row">
                    <div class="col-lg-2 col-xs-4">    Author</div>
                    <div class="col-lg-10 col-xs-8"><span class="glyphicon glyphicon-user"></span> @{{note.author.fname}} @{{note.author.lname}}</div>
                </div>
            </div>
            <li class="list-group-item">
                <div class="list-group-item-text">
                    <div class="row">
                        <div class="col-lg-2 col-xs-4"> Created At</div>
                        <div class="col-lg-10 col-xs-8"><span class="glyphicon glyphicon-time"></span> @{{note.created_at}}</div>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="list-group-item-text">
                    <div class="row">
                        <div class="col-lg-2 col-xs-4"> Category</div>
                        <div class="col-lg-10 col-xs-8"><span class="glyphicon glyphicon-list"></span> @{{note.type.value}}</div>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="list-group-item-text">
                    <div class="row">
                        <div class="col-lg-12" v-html="note.description"></div>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="list-group-item-text">
                    <div class="row">
                        <div class="col-lg-12">
                            <steps :note="note"></steps>   
                        </div>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="list-group-item-text">
                    <div class="row">
                        <div class="col-lg-12">
                            <small>
                                <span v-for="tag in note.tags.split(' ')" class="col-lg-3">
                                    <a href="#" @click="tagclick(tag)"> 
                                        <span class="glyphicon glyphicon-tag"></span> @{{tag}} &nbsp;
                                    </a>
                                </span>
                            </small>                   
                        </div>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="list-group-item-text">
                    <div class="row">
                        <div class="col-lg-12 text-right">
                            <i class="text-info">Upvote if you think this is helpfull</i> &nbsp; 
                            <button class="btn btn-default" @click="vote" :disabled="hasVoted">
                                <span v-if="!voteLoading">@{{note.votes.length}} <span class="glyphicon glyphicon-arrow-up"></span> Up Vote</span>
                                <span v-if="voteLoading">
                                    <span class="glyphicon glyphicon-globe"></span> Please wait..
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </li>
        </li>
    </ul>

</script>
@include("notes.steps.list")
<script>
    Vue.component("note",{
        template : "#note",
        props : ['note'],
        data : function(){
            return {voteLoading : false}
        },
        methods : {
            vote : function(){
                this.voteLoading = true;
                var el = this;
                $.post("{{url('notes/vote')}}",{
                    note_id : this.note.id,
                    user_id : "{{Auth::user()->user_id}}"
                },function(votes){
                    el.note.votes = votes;
                    el.voteLoading = false;
                    el.$emit('vote');
                })
            },
            tagclick : function(tag){
                this.$emit('tagclick',tag);
            }
        },
        computed : {
            hasVoted : function(){
                return _.filter(this.note.votes,function(n){
                    return n.user_id == "{{Auth::user()->user_id}}"
                }).length != 0;
            }
        }
    })
</script>