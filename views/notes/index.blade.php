@extends("layout.default")

@section('content')
     <div id="app" class="row">
        <div class="col-lg-12" v-if="loading">
            <div class="text-center">
                <h1 class="text-info"><span class="glyphicon glyphicon-globe"></span> Please wait..</h1>
            </div>
        </div>
        <note-index-list :notes="notes" v-if="!loading" @notedeleted="refresh"></note-index-list>
     </div>
@stop

@section('scripts')
    @include("notes.index.note-index-list")
    <script>
        var app = new Vue({
            el : "#app",
            data : {
                user_id : "{{Auth::user()->user_id}}",
                notes : [],
                loading : true
            },
            created : function(){
               this.refresh();
            },
            methods : {
                refresh : function(){
                    this.loading = true;
                    var el = this;
                    $.get("{{url('notes/by')}}/"+this.user_id,function(response){
                        el.notes = _.groupBy(response,"type_id");
                        el.loading = false;
                    });
                }
            }
            
        })
    </script>
@stop