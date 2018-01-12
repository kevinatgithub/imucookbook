<transition name="slide-fade">
    <div>
        <div class="col-lg-12">
            <br/>
            <div class="row" v-if="!currentType">
                <div class="col-lg-3"  v-for="type in sorted" >
                    <type-public
                                :type="type" 
                                :key="type.id"
                                @clicked="typeClicked">
                    </type-public>
                
                </div>
            
            </div>
        </div>
        <div class="col-lg-12 text-center" v-if="loading">
            <h1 class="text-info"><span class="glyphicon glyphicon-globe"></span> Please Wait..</h1>
        </div>
        <div v-if="currentType">
            <type-notes :type="currentType" :notes="[]" @back="currentType = null" @clicked="clicked" @tagclick="tagclick" ></type-notes>
        </div>
        <div v-if="results" v-for="res in results">
            <type-notes :type="res[0].type" :notes="res" @clicked="clicked" @tagclick="tagclick" @back="clearSearch"  ></type-notes>
        </div>
    </div>
</transition>