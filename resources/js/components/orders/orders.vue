<template>

    <div>

        <div class="row">
            <router-link to="/search_order" class="btn btn-primary">Search Order </router-link>

        </div>

        <br>
        <input type="text" v-model="searchTerm" class="form-control" style="width: 300px;" placeholder="Search Here">


        <br>

        <div class="row">
            <div class="col-lg-12 mb-4">
                <!-- Simple Tables -->
                <div class="card">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Today Orders</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th>ID</th>
                                <th>QTY</th>
                                <th>Total Amount </th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="order in filtersearch" :key="order.id">
                                <td> {{ order.id }} </td>
                                <td> {{ order.qty }} </td>
                                <td> {{ order.sub_total }} $ </td>

                                <td>
                                    <router-link :to="{name: 'view_order', params:{id:order.id}}" class="btn btn-sm btn-primary">View</router-link>


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
            orders:[],
            searchTerm:''
        }
    },
    computed:{
        filtersearch(){
            return this.orders.filter(order => {
                return order.order_month.match(this.searchTerm)
            })
        }
    },

    methods:{
        today_orders(){
            axios.get('api/today_orders/')
                .then(({data}) => (this.orders = data))
                .catch()
        },


    },
    created(){
        this.today_orders();
    }


}
</script>


<style type="text/css">
#em_photo{
    height: 40px;
    width: 40px;
}
</style>
