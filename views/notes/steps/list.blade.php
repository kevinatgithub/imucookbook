<script id="steps" type="text/x-template">
    <ul style="list-style:none;">
        <li v-for="step in steps">
            <div class="row">
                <div class="col-lg-12">
                    <b class="text-info">@{{step.title}}</b>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-11 col-lg-offset-1">
                    <i><br/>@{{step.description}}</i>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-11 col-lg-offset-1" v-if="step.followers">
                    <br/>
                    <steps :usesteps="step.followers"></steps>
                    <br/>
                </div>
            </div>
        </li>
    </ul>
</script>

<script>
    Vue.component("steps",{
        template : "#steps",
        props : ['note','usesteps'],
        data : function(){
            return { steps : []}
        },
        methods : {
            refresh : function(){
                var el = this;
                if(this.note){
                    $.get("{{url('steps/ofnote')}}/"+this.note.id,function(response){
                        el.steps = response;
                    });
                }else if(this.usesteps){
                   this.steps = this.usesteps;
                }
            }
        },
        created : function(){
            this.refresh();
        },
        watch : {
            note : function(){
                this.refresh();
            },
            step : function(){
                this.refresh();
            }
        }
    })
</script>