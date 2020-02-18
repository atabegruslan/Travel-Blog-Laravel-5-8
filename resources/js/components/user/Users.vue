<template>
	<div>
        <h1>Users</h1>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users" v-bind:key="user.id">
                    <td>
                        <p>
                            <a :href="link_route('user.show', user.id)">{{ user.name }}</a>
                        </p>
                    </td>
                    <td>
                        <p>{{ user.email }}</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <vue-pagination :pagination="pagination" @paginate="fetchUsers()" />

	</div>

</template>

<script>
export default {
    created() {
        this.fetchUsers();
    },
    data() {
        return {
            users: [],
            pagination: {},
        }
    },
    methods: {
        fetchUsers ()
        {
            let params = {
                'page'     : this.pagination.current_page,
                'per_page' : this.pagination.per_page,
            };
            axios.get(route('api.user.index'), {params: params})
                .then(res => {
                    this.users = res.data.data;
                    this.pagination = { ...res.data }; // https://stackoverflow.com/questions/4215737/convert-array-to-object
                })
                .catch(err => {
                    console.error(err);
                });
        },
        link_route(name, id)
        {
            return route(name, {user: id});
        },
    },
}
</script>