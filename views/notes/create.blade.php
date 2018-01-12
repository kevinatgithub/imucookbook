<script id="create-note" type="text/x-template">
    <div class="form-horizontal">
        <div class="well" v-if="loading">
        </div>

        <div class="well" v-if="!loading">
            <div class="form-group">
                <label for="" class="control-label col-lg-2">Title</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" placeholder="Title" v-model="title">
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-lg-2">Description</label>
                <div class="col-lg-10">
                    <ckeditor :value="description" @input="updateDescription"></ckeditor>
                </div>
            </div>
            <div class="form-group">
                <label for="" class="control-label col-lg-2">Tags</label>
                <div class="col-lg-10">
                    <input type="text" class="form-control" placeholder="Single words that describe this article, separated by space" v-model="tags">
                </div>
            </div>
            
            <div class="form-group">
                <label for="" class="control-label col-lg-2">Category</label>
                <div class="col-lg-10">
                    <type-selector :cls="'col-lg-3 col-sm-12 col-xs-12'" @onselect="setType"></type-selector>
                </div>
            </div>

            <div class="form-group">
                <div class="col-lg-10 col-lg-offset-2">
                    <button class="btn btn-primary" @click="save" :disabled="!createBtnStatus">Create Article</button>
                    <button class="btn btn-default" @click="cancel">Cancel</button>
                </div>
            </div>
            
            
        </div>
    </div>
</script>
@include("type-selector.type-selector")
@include("ckeditor")
<script>
    Vue.component("create-note",{
        template : '#create-note',
        data : function(){
            return {
                title : null, description : null, tags : null, loading : false, type : null
            }
        },
        computed : {
            createBtnStatus(){
                return this.title && this.description && this.tags && this.type;
            }
        },
        methods : {
            updateDescription : function(value){
                this.description = value;
            },

            setType(type){
                this.type = type;
            },

            save(){
                var el = this;
                this.loading = true;
                $.post("{{url('notes/create')}}",{
                    title : this.title,
                    description : this.description,
                    type : this.type.id,
                    tags : this.tags,
                    icon : this.icon
                },function(response){
                    el.loading = false;
                    el.$emit("createdone",response);
                });
            },

            cancel(){
                this.$emit("cancel");
            }
        }
    })
</script>