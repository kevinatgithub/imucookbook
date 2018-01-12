@extends("layout.default")

@section('content')
     <div class="row" id="app">

        <transition name="slide-fade">
            <div class="col-lg-12" v-if="currentNote">
                <div class="row">
                    <button class="btn btn-default pull-right" @click="currentNote = null"><span class="glyphicon glyphicon-remove"></span> Close</button>            
                </div>
                <div class="row">
                    <br/>
                    <note-details :note="currentNote" @clicked="clicked" @tagclick="tagclick" @vote="voteClicked"></note-details>
                    
                </div>
            </div>
        </transition>
        
        <transition name="slide-fade">
            <div :class="(tops.length ? 'col-lg-4' : null)" v-if="!currentNote">
                <div v-if="tops.length">
                    <br/><br/><br/>
                    <ul class="list-group">
                        <li class="list-group-item active">
                            Top 10 Articles
                        </li>
                        <li class="list-group-item" v-for="note in tops">
                            <a href="#" @click="clicked(note)">@{{note.title}}</a><br/>
                            Votes : @{{note.votes.length}} | By @{{note.author.fname}} @{{note.author.lname}}
                        </li>
                    </ul>
                </div>
            </div>
        </transition>

        <transition name="slide-fade">
            <div :class="(tops.length ? 'col-lg-8' : 'col-lg-12')" v-if="!currentNote">
                <div class="row">
                    @include("dashboard.index.search")
                </div>

                <div class="row">
                    @include("dashboard.index.results")
                </div>
            </div>
        </transition>
        
     </div>
@stop

@section('scripts')
    @include("slide-fade")
    @include("types.type.type-public")
    @include("notes.type-notes")
    @include("notes.note-details")
    @include("dashboard.index.js")
@stop