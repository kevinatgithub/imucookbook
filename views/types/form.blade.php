<script type="text/x-template" id="typeform">
    <div class="well">
        <div class="form-horizontal">

            <div class="form-group">
                <div class="col-lg-9 col-lg-offset-3">
                    <h4 v-show="isnew">Create New Category</h4>
                    <h4 v-show="!isnew">Update Existing Category</h4>
                </div>
            </div>

            <div class="form-group" v-if="!isnew">
                <label for="" class="control-label col-lg-3">ID</label>
                <div class="col-lg-9">
                    <div class="form-control">@{{id}}</div>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="control-label col-lg-3">Value</label>
                <div class="col-lg-9">
                    <input type="text" class="form-control" placeholder="Value" v-model="value.value">
                </div>
                <div class="col-lg-9 col-lg-offset-3" v-if="value.error">
                    <b class="text-danger">@{{value.error}}</b>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="control-label col-lg-3">Icon</label>
                <div class="col-lg-9">
                    <select-icon @onselect="setIcon"></select-icon>
                </div>
            </div>

            <div class="form-group">
                <label for="" class="control-label col-lg-3">Color</label>
                <div class="col-lg-9">
                    <input type="color" class="form-control" placeholder="Color" v-model="color.value">
                </div>
                <div class="col-lg-9 col-lg-offset-3" v-if="color.error">
                    <b class="text-danger">@{{color.value}}</b>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-9 col-lg-offset-3" v-if="!loading">
                    <button class="btn btn-default" v-if="isnew" @click="save">Create Type</button>
                    <button class="btn btn-default" v-if="!isnew" @click="save">Save Changes</button>
                    <button class="btn btn-primary" v-if="value || icon" @click="clear">Cancel</button>
                </div>

                <div class="col-lg-9 col-lg-offset-3 text-info" v-if="loading">
                    Please wait...
                </div>
            </div>
        </div>
    </div>
</script>
@include("types.select-icon")
<script>
  
    var app = Vue.component("typeform",{
        template : "#typeform",
        props : [
            "isnew", "id", "value", "icon", "loading","color"
        ],
        methods : {
            save : function(){
                this.$emit("save");
            },
            clear : function(){
                this.$emit("clear");
            },
            setIcon(icon){
                this.icon.value = icon;
            }
        }
    });

    

</script>