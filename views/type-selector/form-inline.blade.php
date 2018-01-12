@include("types.select-icon")

<script id="types-form-inline" type="text/x-template">
    <div>
        <div class="row">
            <div class="col-lg-12">
                <div class="input-group">
                    <div class="input-group-btn">
                        <select-icon @onselect="setIcon" v-if="!loading"></select-icon>
                        <button class="btn btn-default" v-if="loading">&nbsp;</button>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-sm-8 col-xs-8">
                            <input type="text" class="form-control" placeholder="New Category" v-model="value" :disable="loading">
                        </div>
                        <div class="col-lg-4 col-sm-4 col-xs-4">
                            <input type="color" class="form-control" v-model="color" />
                        </div>
                    </div>
                    <div class="input-group-btn">
                        <button class="btn btn-default" :disabled="((!icon || !value || !color) || loading)" @click="submitNew"><span class="glyphicon glyphicon-ok"></span></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <i class="text-danger">
                    <span v-if="!icon"><br/>Select Icon for the Category</span>
                    <span v-if="icon && !value"><br/>Enter the Name of New the Category</span>
                    <span v-if="(icon && value) && !color"><br/>Select Category Color</span>
                </i>
            </div>
        </div>
        
    </div>
</script>

<script>
    Vue.component("types-form-inline",{
        template : "#types-form-inline",
        data : function(){
            return {
                icon : null, value : null, color : "#444444", loading : false
            };
        },
        methods : {
            setIcon : function(icon){
                this.icon = icon;
            },
            submitNew : function(){
                var el = this;
                this.loading = true;
                $.post("{{url('types/new')}}",{
                    icon : this.icon,   value : this.value, color : this.color
                },function(type){
                    el.$emit("oncomplete",type);
                    this.loading = false;
                });
            }
        }
    });
</script>