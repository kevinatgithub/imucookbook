<script id="note-details" type="text/x-template">
    <div class="row">
        <div class="col-lg-8">
            <note :note="note" @tagclick="tagclick"  @vote="vote"></note>
            <note-comments :note="note"></note-comments>           
        </div>
        <div class="col-lg-4">
            <author :author="note.author" @clicked="clicked"></author>
            <voters :note="note" :change="votechange"></voters>
        </div>
    </div>
</script>

@include("notes.note")
@include("notes.author")
@include("notes.comments.note-comments")
@include("notes.votes.voters")
    
<script>
    Vue.component("note-details",{
        template : "#note-details",
        props : ['note'],
        data : function(){
            return {votechange : 0};
        },
        methods : {
            clicked : function(note){
                el = this;
                $.get("{{url('notes/details')}}/"+note.id,function(note){
                    el.$emit('clicked',note);
                });
            },
            tagclick : function(tag){
                this.$emit('tagclick',tag);
            },
            vote : function(){
                this.votechange++;
                this.$emit('vote');
            }
        }
    })
</script>