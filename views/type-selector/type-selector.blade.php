<script id="type-selector" type="text/x-template">
    <div>
        <div v-if="loading" class="text-center">
            <h2 class="text-info">Please wait..</h2>
        </div>
        <div v-if="!loading && !selected">
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active"><a href="#type-own" aria-controls="type-own" role="tab" data-toggle="tab">Own Categories</a></li>
                <li role="presentation"><a href="#type-other"  aria-controls="type-other" role="tab" data-toggle="tab">Others</a></li>
                <li role="presentation"><a href="#type-new"  aria-controls="type-new" role="tab" data-toggle="tab">New Category</a></li>
            </ul>

            <div class="tab-content">
                <div  role="tabpanel" class="tab-pane active" id="type-own">
                    <div class="row">
                        <div :class="(cls ? cls : 'col-lg-2')" v-for="type in types"  v-if="!selected">
                            <type-btn :type="type" @clicked="selectType(type)"></type-btn>        
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="type-other">
                    <div class="row">
                        <div :class="(cls ? cls : 'col-lg-2')" v-for="type in fromOthers"  v-if="!selected">
                            <type-btn :type="type" @clicked="selectType(type)"></type-btn>        
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="type-new">
                    <div class="row">
                        <div class="col-lg-8">
                            <types-form-inline @oncomplete="refreshThenSelectType"></types-form-inline>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div :class="(cls ? cls : 'col-lg-2')" v-if="selected">
                <type-btn-selected :type="selected" @clicked="selected = null" />
            </div>
        </div>
    </div>
</script>
@include("type-selector.btn")
@include("type-selector.btn-selected")
@include("type-selector.form-inline")
<script>
    Vue.component("type-selector",{
        template : "#type-selector",
        props : ['preselected','cls'],
        data : function(){
            return {
                types : [], fromOthers : [], loading : true, selected : null
            };
        },
        methods : {
            refresh : function(){
                this.selected = this.preselected;
                var el = this;
                $.get("{{url('types/own')}}",function(response){
                    el.types = response;
                    el.loading = false;
                });

                $.get("{{url('types/others')}}",function(response){
                    el.fromOthers = response;
                    el.loading = false;
                });
            },
            selectType : function(type){
                this.selected = type;
                this.$emit("onselect",type);
            },
            refreshThenSelectType : function(type){
                this.refresh();
                this.selectType(type);
            }
        },
        created : function(){
            this.refresh();
        }
    })
</script>