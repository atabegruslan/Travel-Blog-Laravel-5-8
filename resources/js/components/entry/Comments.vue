<template>
	<div>
		<h1>Comments</h1>

        <form class="form-inline" @submit.prevent="createComment">

            <div class="form-group">
                <label for="place">Comment:</label>
				<textarea id="comment" v-model="comment"></textarea>
            </div>

            <button class="btn btn-default" type="submit">Submit Comment</button>
        </form>

		<div v-for="comment in comments" v-bind:key="comment.id">
			<p v-html="comment.contents">{{ comment.contents }}</p>
		</div>
	</div>
</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
    	props: ['entryId', 'baseUrl'],
		components: {

		},
        mounted() {
            ClassicEditor
                .create( document.querySelector( "textarea#comment" ) )
                .catch( error => {
                    console.error( error );
                } );
        },
        created() {
            this.fetchComments();
        },
        data() {
            return {
				comments: [],
				comment: '',
            }
        },
        methods: {
			fetchComments ()
			{
                fetch(this.baseUrl + 'api/comment/' + this.entryId)
                    .then(res => res.json())
                    .then(res => {
                        this.comments = res;
                    })
                    .catch(err => console.error(err));
			},
			createComment ()
			{
                fetch(this.baseUrl + 'api/comment', {
                    method: 'post',
                    body: JSON.stringify({entry_id: this.entryId, contents: this.comment, commentor_id: 1}),
                    headers: {
                        'content-type' : 'application/json'
                    }
                })
                .then(res => res.json())
                .then(res => {
                    this.comment = '';
                    this.fetchComments();
                })
                .catch(err => console.error(err));
			},
		}
	}
</script>