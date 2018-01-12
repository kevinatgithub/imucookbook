<script id="folded-list" type="text/x-template">
    <div class="row">
        <div class="col-lg-12 text-center" v-if="loading">
            <h1 class="text-info">Please Wait..</h1>
        </div>


        <!-- Categories and Add Button -->
        <div v-if="!currentNote && !loading">
            
            <div class="col-lg-2">
                <button :class="'btn col-lg-12 ' + (writtingnew ? 'btn-primary' : 'btn-default') " @click="writeNew">
                    <span class="glyphicon glyphicon-add"></span> New Article
                </button>
                <hr/><br/>
                <note-index-list-types :types="types" @typeclicked="selectType"></note-index-list-types>
            </div>


            <!-- Create Note -->
            <div class="col-lg-10" v-if="writtingnew">
                <create-note @cancel="cancelWriteNew" @createdone="createdone"></create-note>
            </div>


            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-12" v-if="currentType">
                        <input type="text" class="form-control" placeholder="Search Article Title" v-model="search">
                        <br/>
                    </div>
                </div>
                <div class="row" v-for="chunk in notes" v-if="currentType" v-show="currentType.id == chunk[0].type.id">
                    <div class="col-lg-6" v-for="note in chunk">
                        <note-row :note="note" 
                                    :admin="true" 
                                    @clicked="noteSelected"
                                    @ondelete="noteDeleted"
                                    v-show="search == null || note.title.toUpperCase().indexOf(search.toUpperCase()) !== -1">
                        </note-row>
                    </div>
                </div>
                <div class="row" v-if="search">
                    <div class="col-lg-12"><i>Results are filtered for @{{search}}</i></div>
                </div>
            </div>
        </div>

        <!-- Has Selected A Note -->
        <div v-if="currentNote && !loading && !writtingnew">
            <div class="row">
                <div class="col-lg-12">
                    <button class="btn btn-primary" @click="currentNote = null">Edit</button>
                    <button class="btn btn-primary" @click="currentNote = null">Delete</button>
                    <button class="btn btn-default pull-right" @click="currentNote = null">Close</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <br/>
                    <note-details :note="currentNote"></note-details>
                </div>
            </div>
        </div>
        
    </div>
</script>
@include('notes.index.notes-index-list.types')
@include('notes.row')
@include('notes.note-details')
@include('notes.create')
<script>
   
    Vue.component("note-index-list",{
        template : "#folded-list",
        props : ['notes'],
        data : function(){
            return {
                types : [], currentType : null, search : null, currentNote : null, loading : false, writtingnew :false
            }
        },
        methods : {
            refresh : function(){
                // var el = this;
                var t = [];
                _.forEach(this.notes,function(part){
                    t = t.concat(_.map(part,"type"));
                });
                this.types = _.uniqBy(t,'id');
                this.currentType = this.types[0];
            },
            selectType : function(type){
                this.currentType = type;
                this.writtingnew = false;
            },
            noteSelected : function(note){
                this.loading = true;
                var el = this;
                $.get("{{url('notes/details')}}/"+note.id,function(response){
                    el.writtingnew = false;
                    el.currentNote = response;
                    el.loading = false;
                });
            },
            noteDeleted(){
                this.$emit("notedeleted");
            },
            writeNew : function(){
                this.writtingnew = true;
                this.currentType = null;
            },
            cancelWriteNew(){
                this.writtingnew = false;
                this.refresh();
            },
            createdone(note){
                this.refresh();
                this.noteSelected(note);
            }
        },
        created : function(){
            this.refresh();
        },
        watch : {
            notes : function(){
                this.refresh();
            }
        }
    });
</script>