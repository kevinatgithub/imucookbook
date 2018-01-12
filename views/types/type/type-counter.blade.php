<script type="text/x-template" id="type-counter">
    <small>Notes : @{{count}}</small>
</script>

<script>
    Vue.component("type-counter",{
        template : "#type-counter",
        props : ['id'],
        data : function(){
            return {
                count : ".." 
            };
        },
        created : function(){
            var el = this;
            $.get("notes/typecounter",{id:this.id},function(data){
                el.count = data;
            });
        }
    })
</script>