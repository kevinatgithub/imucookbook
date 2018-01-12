<script id="folded-list-types" type="text/x-template">
    <ul class="list-group">
        <li :class="'list-group-item text-right ' + (current == type.id ? 'active' : null)" 
            v-for="type in types" 
            :style="{color: (current == type.id ? '#fff' : '#000') ,cursor:'pointer'}" 
            @click="typeclicked(type)">
            @{{type.value}} 
            <span :class="'glyphicon glyphicon-'+type.icon"></span> 
            <small class="pull-right text-info"></span></small>
        </li>
    </ul>
</script>

<script>
    Vue.component("note-index-list-types",{
        template : "#folded-list-types",
        props : ['types'],
        data : function(){
            return { current : null };
        },
        methods : {
            typeclicked : function(type){
                this.current = type.id;
                this.$emit('typeclicked',type);
            }
        }
    });
</script>