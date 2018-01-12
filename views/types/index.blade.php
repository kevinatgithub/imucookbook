@extends("layout.default")

@section('content')
     <div class="row" id="app">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <label class="pull-right">
                        <input type="checkbox" v-model="grid"> Grid
                    </label>
                </div>
                
                <div class="col-lg-4">
                    <typeform :id="id" 
                            :isnew="isNew" 
                            :value="value" 
                            :icon="icon" 
                            :color="color"
                            :loading="loading" 
                            @save="save" 
                            @clear="clear"></typeform>
                </div>
                <div class="col-lg-8">
                    <transition name="slide-fade">
                        <div class="row" v-if="grid">
                            <div class="col-lg-4" v-for="type in types">
                                <type-private 
                                    :type="type" 
                                    @edit="edit" 
                                    @reset="reset"
                                    :key="type.id" >
                                </type-private>
                            </div>
                        </div>
                        <types :types="types" @edit="edit" v-if="!grid"></types>
                    </transition>
                </div>
            </div>
            
        </div>
     </div>
@stop

@section('scripts')
    @include("slide-fade")
    @include("types.form")
    @include("types.type.type-private")
    @include("types.list")
    <script>
        var app = new Vue({
            el : "#app",
            data : {
                types : [],
                others : [],
                isNew : true,
                id : null,
                value : {   value : null, error : null  },
                icon : {    value : null, error: null   },
                color : {    value : null, error: null   },
                loading : false,
                grid : true
            },
            methods : {
                save : function(){
                    el = this;
                    this.loading = true;
                    url = this.isNew ? "{{url('types/new')}}" : "{{url('types/update')}}";
                    $.post(url,{
                        id : this.id , 
                        value : this.value.value, 
                        icon : this.icon.value, 
                        color : this.color.value
                    },function(){
                        el.reset()
                    });
                },
                edit : function(type){
                    this.id = type.id;
                    this.value.value = type.value;
                    this.icon.value = type.icon;
                    this.color.value = type.color;
                    this.isNew = false;
                },
                clear : function(){
                    this.loading = false;
                    this.isNew = true;
                    this.id = null;
                    this.value = { value : null, error : null};
                    this.icon = { value : null, error : null};
                    this.color = { value : null, error : null};
                },
                reset : function(){
                    this.clear();
                    el = this;
                    $.get("{{url('types/list')}}",function(data){
                        el.types = data;
                    });

                    $.get("{{url('types/others')}}",function(data){
                        el.others = data;
                    });
                }
            },
            created : function(){
                this.reset();
            }
        })
    
    </script>
@stop