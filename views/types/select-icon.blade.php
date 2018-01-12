<link rel="stylesheet" href="{{url('js/iconpicker/dist/css/bootstrap-iconpicker.min.css')}}">
<script src="{{url('js/iconpicker/dist/js/bootstrap-iconpicker-iconset-all.min.js')}}"></script>
<script src="{{url('js/iconpicker/dist/js/bootstrap-iconpicker.min.js')}}"></script>
<script id="select-icon" type="text/x-template">
    <div>
        <button class="btn btn-default" role="iconpicker" id="iconbtn" :title="icon"></button>
        <input type="hidden" class="form-control" placeholder="Icon" v-model="icon.value" v-if="icon">
    </div>
</script>
<script>
    Vue.component("select-icon",{
        template : "#select-icon",
        props : ['preselect'],
        data : function(){
            return {icon : null, iconbtn : null};
        },
        created : function(){
            var el = this;
            $(function(){
                el.iconbtn = $("#iconbtn").iconpicker().bind("click",el.clicked);
            });
        },
        methods : {
            clicked : function(){
                var el = this;
                $(".btn-icon").click(function(){
                    el.icon = $(this).val().slice(10);
                    el.$emit('onselect',$(this).val().slice(10));
                });
                $(".btn-next,.btn-previous").bind("click",el.clicked);
                $(".search-control").bind("keyup",el.clicked);
            }
        }
    });
</script>