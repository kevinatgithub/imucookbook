<div class="col-lg-12">
    <div class="row">
        <div class="col-lg-4 pull-right">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search Article.." id="search" @keyup="doSearch" v-model="search">
                <div class="input-group-btn">
                    <button class="btn btn-default" @click="clearSearch"><span class="glyphicon glyphicon-remove"></span></button>
                </div>
            </div>
        </div>
    
    </div>
</div>