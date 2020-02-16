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

        <!-- @todo better css -->
        <select id="autosuggest" @change="choseUser" size="5"></select>
        <input type="hidden" id="curr_username">

        <table class="table">
            <thead>
                <tr>
                    <th>Commentor</th>
                    <th>Comment</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="comment in comments" v-bind:key="comment.id">
                    <td>
                        <a :href="link_route(baseUrl, comment.commentor_id)">{{ comment.commentor.name }}</a>
                    </td>
                    <td>
                        <p v-html="comment.contents">{{ comment.contents }}</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Just Test @todo To be refined later -->
        <vue-pagination :pagination="pagination" @paginate="fetchComments()" />

	</div>

</template>

<script>
    import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

    export default {
    	props: [
            'entryId', 
            'userId',
            'baseUrl', 
        ],
		components: {

		},
        mounted() {
            ClassicEditor
                .create( document.querySelector( "textarea#comment" ) )
                .then(editor => {
                    this.editor = editor;
                    editor.editing.view.document.on( 'keyup', this.getUserList );
                })
                .catch( error => {
                    console.error( error );
                });

                $("#curr_username").val('');
                $("select#autosuggest").empty();
                $("select#autosuggest").hide();

                this.getUserList = _.debounce(this.getUserList, 500);
        },
        created() {
            this.fetchComments();
        },
        data() {
            return {
				comments: [],
				comment: '',
                editor: null,
                pagination: { // Just Test @todo To be refined later
                    "current_page" :1,
                    "from"         :1,
                    "last_page"    :1,
                    "per_page"     :20,
                    "to"           :2,
                    "total"        :2
                }
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
                var data = {
                    entry_id    : this.entryId, 
                    //contents    : this.comment, 
                    contents    : this.editor.getData(), 
                    commentor_id: this.userId,
                };

                fetch(this.baseUrl + 'api/comment', {
                    method: 'post',
                    body: JSON.stringify(data),
                    headers: {
                        'content-type' : 'application/json'
                    }
                })
                .then(res => res.json())
                .then(res => {
                    //this.comment = '';
                    this.editor.setData('');
                    this.fetchComments();
                })
                .catch(err => console.error(err));
			},
            getUserList(e, data)
            {
                var selection = window.getSelection();
                var currPos   = selection.anchorOffset;
                var currInput = selection.focusNode.wholeText;

                if (currPos)
                {
                    var currPart  = currInput.substring(0, currPos);
                    var currWord  = currPart.substring(currPart.lastIndexOf(" ") + 1);

                    if (currWord.charAt(0) === '@')
                    {
                        var username = currWord.replace("@", "");

                        if (username)
                        {
                            $("#curr_username").val(username);
                            $("select#autosuggest").empty();

                            fetch(this.baseUrl + 'api/autosuggest/user/' + username)
                                .then(users => users.json())
                                .then(users => {
                                    $(users).each(function(i) {
                                        $("select#autosuggest")
                                            .append('<option value="'+ this.id +'">'+ this.name +'</option>');
                                    });

                                    $("select#autosuggest").show();
                                })
                                .catch(err => console.error(err));
                        }
                        else
                        {
                            $("#curr_username").val('');
                            $("select#autosuggest").empty();
                            $("select#autosuggest").hide();
                        }
                    }
                    else
                    {
                        $("#curr_username").val('');
                        $("select#autosuggest").empty();
                        $("select#autosuggest").hide();
                    }
                }
            },
            choseUser(event)
            {
                var value = event.target.value;
                var text  = $(event.target).find("option:selected").text();
                var link  = '<a href="' + this.baseUrl + 'user/'+ value +'">'+ text +'</a>';

                var commentText = $("div.ck-content").html();
                var toReplace   = $("#curr_username").val();
                var replaced    = commentText.replace('@' + toReplace, link);

                this.editor.setData(replaced);
                $("#curr_username").val('');
                $("select#autosuggest").empty();
                $("select#autosuggest").hide();
            },
            link_route: function (base, id)
            {
                return base + 'user/' + id;
            },
		}
	}
</script>