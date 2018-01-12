<script type="text/x-template" id="types">
    <table class="table table-condensed table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Value</th>
                <th>Icon</th>
                <th>Color</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr v-if="!types.length">
                <td colspan="5" class="text-center">No Types Available</td>
            </tr>

            <tr v-if="types.length" v-for="type in types">
                <td class="col-lg-1">@{{type.id}}</td>
                <td>@{{type.value}}</td>
                <td class="col-lg-1"><i v-bind:class="'glyphicon glyphicon-'+type.icon"></i></td>
                <td class="col-lg-1">@{{type.color}}</td>
                <td class="col-lg-2">
                    <a href="#" class="btn btn-warning btn-xs" @click="edit(type)"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="#" class="btn btn-danger btn-xs" @click="deleteType(type)"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
            </tr>
        </tbody>
    </table>
</script>

<script>
    Vue.component("types",{
        template : "#types",
        props : [
            "types"
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
                        el.$emit("reset");
                    });
                }
            }
        }
    })
</script>