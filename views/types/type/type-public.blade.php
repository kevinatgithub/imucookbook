<script type="text/x-template" id="typepublic">
    <div class="well text-center" >
        <a href="#" @click="typeClicked">
            <h1  :style="{ color : type.color }"><span :class="'glyphicon glyphicon-' + type.icon"></span></h1>
            <h4  :style="{ color : type.color }">@{{type.value}}</h4>
            <small>
                <i>by @{{type.user.fname}} @{{type.user.lname}}</i> |
                <type-counter :id="type.id"></type-counter>
            </small>
        </a>
    </div>
</script>
@include('types.type.type-counter')
<script>
    Vue.component("type-public",{
        template : "#typepublic",
        data : function(){
            return {
                url : "{{url('types')}}"
            };
        },
        props : [
            'type'
        ],
        methods : {
            typeClicked : function(){
                this.$emit("clicked",this.type)
            }
        }
    });
</script>