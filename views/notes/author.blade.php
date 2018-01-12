<script id="author" type="text/x-template">
    <div class="row">
        <div class="col-lg-12">
            <ul class="list-group">
                <li class="list-group-item"><b class="text-info">Author Details</b></li>
                <li class="list-group-item">
                    <div class="list-group-item-text">
                        <div class="row">
                            <div class="col-lg-2">Name</div>
                            <div class="col-lg-10">@{{author.fname}} @{{author.lname}}</div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item">
                    <div class="list-group-item-text">
                        <div class="row">
                            <div class="col-lg-2">Position</div>
                            <div class="col-lg-10">@{{author.position}}</div>
                        </div>
                    </div>
                </li>
                <li class="list-group-item"><b class="text-info">Other Posts</b></li>
                <li class="list-group-item">
                    <input type="text" class="form-control" placeholder="Search Notes" v-model="search">
                </li>
                <li class="list-group-item">
                    <ul>
                        <li v-for="note in sortedNotes">
                            <a href="#" @click="clicked(note)">@{{note.title}}</a>
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </div>
</script>

<script>
    Vue.component("author",{
        template : "#author",
        props : ['author'],
        data : function(){
            return { search : null, allnotes : [], sortedNotes : [] };
        },
        methods : {
            clicked : function(note){
                this.$emit("clicked",note);
            },
            refresh : function(){
                var el = this;
                $.get("{{url('notes/otherworkof/')}}/"+this.author.user_id,function(notes){
                    el.allnotes  = notes;
                    el.sortedNotes = _.orderBy(notes,'title');
                });
            }
        },
        created : function(){
            this.refresh();
        },
        watch : {
            search : function(){
                var el = this;
                this.sortedNotes = _.orderBy(_.filter(this.allnotes,function(note){
                    return note.title.toUpperCase().indexOf(el.search.toUpperCase()) !== -1;
                }),'title')
            },
            author : function(){
                this.refresh()
            }
        }
    })
</script>