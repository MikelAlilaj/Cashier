

<template>

    <div>

        <div class="row">
            <router-link to="/create_user" class="btn btn-primary">Add User</router-link>

        </div>
        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here">


        <br>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Product List</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email
                                <th>Action</th>

<!--                                <th>Buying Price</th>-->
<!--                                <th>Selling Price</th>-->
<!--                                <th>Action</th>-->
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in filtersearch" :key="user.id">
                                <td> {{ user.id }} </td>
                                <td> {{ user.name }} </td>
                                <td> {{ user.email }} </td>
                                <td>

                                    <a @click="deleteUser(user.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
        </div>
        <!--Row-->



    </div>


</template>



<script type="text/javascript">

export default {
    created(){
        if (!User.loggedIn()) {
            this.$router.push({name: '/'})
        }
    },
    data(){
        return{
            users:[],
            searchTerm:''
        }
    },
    computed:{
        filtersearch(){
            return this.users.filter(user => {
                return user.name.match(this.searchTerm)
            })
        }
    },

    methods:{
        allUsers(){
            axios.get('api/all_users/')
                .then(({data}) => (this.users = data))
                .catch()
        },
        deleteUser(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    axios.delete('api/delete_user/'+id)
                        .then(() => {
                            this.users = this.users.filter(user => {
                                return user.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push({name: 'all_users'})
                        })
                    Swal.fire(
                        'Deleted!',
                        'User has been deleted.',
                        'success'
                    )
                }
            })

        }

    },
    created(){
        this.allUsers();
    }


}
</script>


<style type="text/css">
#em_photo{
    height: 40px;
    width: 40px;
}
</style>
