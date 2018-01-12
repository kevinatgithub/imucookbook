<script id="ckeditor" type="text/x-template">
    <div class="row">
        <div class="col-lg-12">
            <textarea id="ckeditortextarea" cols="30" rows="10">@{{value}}</textarea>
        </div>
    </div>
</script>
<script src="{{url('js/ckeditor/ckeditor.js')}}"></script>
<script>
    Vue.component("ckeditor",{
        template : "#ckeditor",
        name: 'ckeditor',
        props: ['value'],
        computed: {
            instance : function(){
                return CKEDITOR.instances['ckeditortextarea']
            }
        },
        watch: {
            value : function(val){
                if (this.instance) {
                    this.update(val)
                }
            }
        },
        mounted : function(){
            this.create()
        },
        beforeDestroy : function(){
            this.destroy()
        },
        methods: {
            create : function(){
                if (typeof CKEDITOR === 'undefined') {
                    console.log('CKEDITOR is missing (http://ckeditor.com/)')
                } else {
                    if (this.types === 'inline') {
                        CKEDITOR.inline('ckeditortextarea', this.config)
                    } else {
                        CKEDITOR.replace('ckeditortextarea', this.config)
                    }

                    this.instance.setData(this.value)
                    this.instance.on('change', this.onChange)
                    this.instance.on('blur', this.onBlur)
                    this.instance.on('focus', this.onFocus)
                }
            },
            update : function(val){
                var html = this.instance.getData()
                if (html !== val) {
                    this.instance.setData(val)
                }
            },
            destroy : function(){
                this.instance.focusManager.blur(true)
                this.instance.removeAllListeners()
                this.instance.destroy()
            },
            onChange : function(){
                var html = this.instance.getData()
                if (html !== this.value) {
                    this.$emit('input', html)
                }
            },
            onBlur : function () {
                this.$emit('blur', this.instance)
            },
            onFocus : function () {
                this.$emit('focus', this.instance)
            }
        }
    });
</script>