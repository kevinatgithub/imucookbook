<script>
    var app = new Vue({
        el : "#app",
        data : {
            types : [],
            alltypes : [],
            currentType : null,
            search : null,
            loading : false,
            results : [],
            currentNote : null,
            tops : []
        },
        computed : {
            sorted : function(){
                return _.orderBy(this.types,'value')
            }
        },
        methods : {
            typeClicked : function(type){
                this.currentType = type;
            },
            doSearch : _.debounce(function(){
                this.currentType = null;
                if(!this.search){
                    this.clearSearch();
                    return;
                }
                this.loading = true;
                var el = this;
                this.types = _.filter(this.alltypes,function(t){
                    return t.value.toUpperCase().indexOf(el.search.toUpperCase()) !== -1;
                });
                $.get("{{url('notes/search')}}",{
                    keywords : el.search
                },function(result){
                    el.loading = false;
                    result = _.groupBy(result,'type_id');
                    el.results = result;
                });
            },1500),
            clearSearch : function(){
                this.loading = false;
                this.results = [];
                this.types = this.alltypes;
                this.search = null;
            },
            clicked : function(note){
                this.loading = true;
                var el = this;
                $.get("{{url('notes/details')}}/"+note.id,function(note){
                    el.currentNote = note;
                    el.loading = false;
                });
            },
            tagclick : function(tag){
                this.currentNote = null;
                this.search = tag;
                this.currentType = null;
                this.doSearch();
            },
            voteClicked : function(){
                console.log('parent vote');
                var el = this;
                $.get("{{url('notes/top')}}",function(tops){
                    el.tops = tops;
                });
            }
        },
        created : function(){
            var el = this;
            $.get("{{url('types/all')}}",function(types){
                el.types = types;
                el.alltypes = types;
            });
            $.get("{{url('notes/top')}}",function(tops){
                el.tops = tops;
            });
        }
    })

    $(function(){
        $("#search").focus()
    })
</script>