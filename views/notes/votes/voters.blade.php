<script id="voters" type="text/x-template">
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-group">
                <li class="list-group-item">Voters @{{votes.length}}</li>
                <li class="list-group-item" v-for="vote in votes">
                    @{{vote.user.fname}} @{{vote.user.lname}}
                </li>
            </ul>
        </div>
    </div>
</script>

<script>
    Vue.component("voters",{
        template : "#voters",
        props : ['note','change'],
        data : function(){
            return { votes: [] }
        },
        methods : {
            refresh : function(){
                el = this;
                $.get("{{url('votes/of')}}/"+this.note.id,function(votes){
                    el.votes = votes;
                });
            }
        },
        created : function(){this.refresh()},
        watch : {
            note : function(){this.refresh()},
            change : function(){
                this.refresh();
            }
        }
    })
</script>