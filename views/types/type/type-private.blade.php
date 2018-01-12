<script type="text/x-template" id="type">
    <div class="well text-center" >
        <div v-if="!loading">
            <h1  :style="{ color : type.color }"><span :class="'glyphicon glyphicon-' + type.icon"></span></h1>
            <h4  :style="{ color : type.color }">@{{type.value}}</h4>
            <!-- <button class="" ><span class="glyphicon glyphicon-list"></span></button> -->
            <button class="" @click="edit(type)"><span class="glyphicon glyphicon-pencil"></span></button>
            <button class="" @click="deleteType(type)"><span class="glyphicon glyphicon-remove"></span></button>
        </div>
        <div v-if="loading">
            Deleting, Please Wait..
        </div>
    </div>
</script>

<script>
    Vue.component("type-private",{
        template : "#type",
        data(){
            return {loading:false};
        },
        props : [
            'type'
        ],
        methods : {
            edit(type){
                this.$emit("edit",type);
            },
            deleteType(type){
                if(confirm("Delete this Category?")){
                    this.loading = true;
                    var el = this;
                    $.post("{{url('types/delete')}}",{
                        type : type
                    },function(response){
                        el.reset();
                    });
                }
            },
            reset(){
                this.$emit("reset",true);
            }
        }
    });
</script>