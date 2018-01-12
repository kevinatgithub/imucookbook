<script id="type-btn" type="text/x-template">
    <div class="row">
        <div class="col-lg-12">
            <div class="input-group">
                <div class="input-group-addon" @click="typeClicked">
                    <span  :style="{ color : type.color }"><span :class="'glyphicon glyphicon-' + type.icon"></span> <small  :style="{ color : type.color }">@{{type.value}}</small></span>
                </div>
                <div class="input-group-btn">
                    <button @click="typeClicked" class="btn"><span class="glyphicon glyphicon-ok"></span></button>
                </div>
            </div>
            <br/>
        </div>
    </div>
</script>

<script>
    Vue.component("type-btn",{
        template : "#type-btn",
        props : ['type'],
        methods : {
            typeClicked : function(){
                this.$emit("clicked",this.type)
            }
        }
    });
</script>