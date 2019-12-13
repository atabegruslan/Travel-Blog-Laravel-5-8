<template>
    <div class="container" id="home_vue">
        <div class="row">
            <div class="col-md-12">
                <h2>Blogs</h2>

                <form class="form-inline" @submit.prevent="createBlog">

                    <div class="form-group">
                        <label for="place">Place:</label>
                        <input id="place" class="form-control" type="text" v-model="blog.place">
                    </div>

                    <div class="form-group">
                        <label for="comments">Comments:</label>
                        <textarea id="comments" class="form-control" v-model="blog.comments"></textarea>
                    </div>

                    <input class="form-control" type="hidden" v-model="blog.img_url" name="img_url" value="">
                    <input class="form-control" type="hidden" v-model="blog.user_id" name="user_id" value="2">

                    <button class="btn btn-default" type="submit">Create</button>
                </form>

                <div v-for="blog in blogs" v-bind:key="blog.id">
                    <form class="form-inline">
                        <input class="_id form-control" type="hidden" v-model="blog.id">

                        <div class="form-group">
                            <label for="place">Place:</label>
                            <input id="place" class="form-control" type="text" v-model="blog.place">
                        </div>

                        <div class="form-group">
                            <label for="comments">Comments:</label>
                            <textarea id="comments" class="form-control" v-model="blog.comments"></textarea>
                        </div>

                        <input id="img_url form-control" ref="img_url" type="hidden" v-model="blog.img_url" name="img_url" value="">

                        <input id="user_id form-control" ref="user_id" type="hidden" v-model="blog.user_id" name="user_id" value="2">

                        <button class="btn btn-default" @click.prevent="updateBlog">Update</button>
                        <button class="btn btn-error" @click="deleteBlog(blog.id)">Delete</button>
                    </form>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Blogs mounted.');
        },
        created() {
            this.fetchBlogs();
        },
        data() {
            return {
                blogs: [],
                blog: {
                    id: '',
                    place: '',
                    comments: '',
                }
            }
        },
        methods: {
            fetchBlogs() {
                fetch('api/entry')
                    .then(res => res.json())
                    .then(res => {
                        this.blogs = res;
                    })
                    .catch(err => console.log(err));
            },
            updateBlog(ev) {
                var id = $(ev.target).parent('form').find('._id').val();

                this.blog.place    = $(ev.target).parent('form').find('#place').val();
                this.blog.comments = $(ev.target).parent('form').find('#comments').val();
                this.blog.img_url  = $(ev.target).parent('form').find('#img_url').val();
                this.blog.user_id  = $(ev.target).parent('form').find('#user_id').val();

                fetch('api/entry/' + id, {
                    method: 'put',
                    body: JSON.stringify(this.blog),
                    headers: {
                        'content-type' : 'application/json'
                    }
                })
                .then(res => res.json())
                .then(res => {
                    this.blog.place = '';
                    this.blog.comments = '';
                    alert('Blog update');
                    this.fetchBlogs();
                })
                .catch(err => console.log(err));
            },
            deleteBlog(id) {
                if (confirm('Are you sure?')) 
                {
                    fetch('api/entry/' + id, {
                        method: 'delete'
                    })
                    .then(res => res.json())
                    .then(res => {
                        alert('Blog removed');
                        this.fetchBlogs();
                    })
                    .catch(err => console.log(err));
                }
            },
            createBlog() {
                fetch('api/entry', {
                    method: 'post',
                    body: JSON.stringify(this.blog),
                    headers: {
                        'content-type' : 'application/json'
                    }
                })
                .then(res => res.json())
                .then(res => {
                    this.blog.place = '';
                    this.blog.comments = '';
                    alert('Blog created');
                    this.fetchBlogs();
                })
                .catch(err => console.log(err));
            }
        }
    }
</script>
