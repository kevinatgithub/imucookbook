<script id="type-btn-selected" type="text/x-template">
    <div class="input-group">
        <div class="input-group-addon"  :style="{ color : type.color }">
            <span :class="('glyphicon glyphicon-' + type.icon)"></span> @{{type.value}}
        </div>
        <div class="input-group-btn">
            <button class="btn" @click="typeClicked"><small> <span class="glyphicon glyphicon-remove"></span></small></button>
        </div>
    </div>
</script>

<script>
     Vue.component("type-btn-selected",{
        template : "#type-btn-selected",
        props : ['type'],
        methods : {
            typeClicked : function(){
                this.$emit("clicked",this.type)
            }
        }
    });
</script>