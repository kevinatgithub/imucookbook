<script id="type-notes" type="text/x-template">
    <div>
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="list-group">
                        <li class="list-group-item text-center" :style="{backgroundColor:type.color ? type.color : '#000'}">
                            <button class="btn btn-primary btn-sm pull-right" @click="$emit('back')"><span class="glyphicon glyphicon-remove"></span></button>
                            <h4 style="color:#fff !important;"> <span :class="'glyphicon glyphicon-'+type.icon"></span> @{{type.value}}</h4>
                        </li>
                        <li class="list-group-item">
                            <div class="list-group-item-text">
                                <div class="row">
                                    <div class="col-lg-2">Created By</div>
                                    <div class="col-lg-6">@{{type.user.fname}} @{{type.user.lname}}</div>
                                </div>
                            </div>
                        </li>
                        <!--<li class="list-group-item">
                            <div class="list-group-item-text">
                                <div class="row">
                                    <div class="col-lg-2">Notes</div>
                                    <div class="col-lg-6">@{{notes.length}}</div>
                                </div>
                            </div>
                        </li>-->
                    </ul>
                </div>
            </div>
        </div>

        <div class="col-lg-6" v-for="note in notes" v-if="notes.length">
            <note-row :note="note" @clicked="clicked" @tagclick="tagclick"></note-row>
        </div>
        
        <div class="col-lg-6" v-for="note in dnotes" v-if="!notes.length">
            <note-row :note="note" @clicked="clicked" @tagclick="tagclick"></note-row>
        </div>
    </div>
</script>

@include("notes.row")
<script>
    Vue.component("type-notes",{
        template : "#type-notes",
        data : function(){
            return {
                dnotes : []
            }
        },
        props : [
            'type','notes'
        ],
        created : function(){
            el = this;
            $.get("{{url('notes/bytype')}}",{
                type : this.type.id
            },function(data){
                el.dnotes = data;
            })
        },
        watch : {
            type : function(){
                el = this;
                $.get("{{url('notes/bytype')}}",{
                    type : this.type.id
                },function(data){
                    el.dnotes = data;
                })
            }
        },
        computed : {
            sorted : function(){
                return _.orderBy(this.dnotes,["votes","title"],"desc")
            }
        },
        methods : {
            clicked : function(note){
                this.$emit('clicked',note);
            },
            tagclick : function(tag){
                this.$emit("tagclick",tag);
            }
        }
    })
</script>