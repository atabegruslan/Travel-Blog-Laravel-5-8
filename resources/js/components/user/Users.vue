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
//            fetch('http://localhost/laravel_5_8/travel_blog/public/api/user')
//                .then(res => res.json())
//                .then(res => {
//                    this.users = res.data;
//                })
//                .catch(err => console.error(err));
        },
    },
}
</script>