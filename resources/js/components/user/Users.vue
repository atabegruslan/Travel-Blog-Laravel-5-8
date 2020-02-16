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
                        <p>{{ user.name }}</p>
                    </td>
                    <td>
                        <p>{{ user.email }}</p>
                    </td>
                </tr>
            </tbody>
        </table>
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
        }
    },
    methods: {
        fetchUsers ()
        { // @todo Finish
//            axios.post(route('api.user.index'))
//                .then(res => {
//                    this.users = res.data;
//                })
//                .catch(err => {
//                    console.error(err);
//                });
        },
    },
}
</script>