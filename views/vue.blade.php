@extends("layout.default")

@section('content')
    <div id="app" class="row">
        <div class="col-lg-12">
            <alert type="success">test</alert>
            <vaside placement="left" header="Test" :show="showSideBar" :width="350">
                test
            </vaside>
            <btngrp v-model="checkboxValue">
                <checkbox true-value="left">Left</checkbox>
                <checkbox true-value="middle">Middle</checkbox>
                <checkbox true-value="right">Right</checkbox>
            </btngrp>
        </div>
    </div> 
@stop

@section('scripts')
    <script src="{{url('bower_components/vue-strap/dist/vue-strap.js')}}"></script>
    <script>
        var app = new Vue({
            el : '#app',
            components : {
                alert : VueStrap.alert,
                vaside : VueStrap.aside,
                btngrp : VueStrap.checkboxGroup,
                checkbox : VueStrap.checkboxBtn
            }, 
            data : {
                icon :"asd",
                options : [],
                checked : false,
                showSideBar : false,
                checkboxValue : []
            },
            methods : {
                setIcon : function(icon){
                    this.icon = icon;
                }
            }
        });
    </script>
@stop