<template>
    <div>
            <div class="form-row">
                <router-link to="/today_orders" class="btn btn-primary">Today Orders</router-link>
                <div class="form-row">
                    <router-link to="/search_order" class="btn btn-secondary">Search Order </router-link>
                </div>
            </div>

        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4"> Order Details </h1>
                                    </div>



                                    <div class="row">
                                        <div class="col-lg-6 mb-4">
                                            <!-- Simple Tables -->
                                            <div class="card">
                                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                                                </div>
                                                <div class="table-responsive">


                                                    <ul class="list-group">
                                                        <li class="list-group-item"><b>Sub Total :</b> {{orders.sub_total}} $ </li>

                                                    </ul>



                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                        </div>


















                                    </div>





                                    <div class="row">
                                        <div class="col-lg-12 mb-4">
                                            <!-- Simple Tables -->
                                            <div class="card">
                                                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                                    <h6 class="m-0 font-weight-bold text-primary">Order Details</h6>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table align-items-center table-flush">
                                                        <thead class="thead-light">
                                                        <tr>
                                                            <th>Product Name</th>
                                                            <th>Product Code</th>
                                                            <th>Image</th>
                                                            <th>Qty</th>
                                                            <th>Unit Price </th>
                                                            <th>Total </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="detail in details">
                                                            <td>{{ detail.name }}</td>
                                                            <td>{{ detail.code }}</td>
                                                            <td><img :src="'storage/image/'+detail.image" id="em_photo"></td>
                                                            <td>{{ detail.product_quantity }}</td>
                                                            <td>{{ detail.product_price }} $</td>
                                                            <td>{{ detail.sub_total }} $</td>
                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="card-footer"></div>
                                            </div>
                                        </div>
                                    </div>








                                    <hr>
                                    <div class="text-center">


                                    </div>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
        return {

            errors:{},
            orders:{},
            details:{},
        }
    },
    created(){
        let id = this.$route.params.id
        axios.get('api/order/'+id)
            .then(({data}) => (this.orders = data))
            .catch(console.log('error'))

        axios.get('api/order_details/'+id)
            .then(({data}) => (this.details = data))
            .catch(console.log('error'))


    },

    methods:{


    }


}

</script>


<style type="text/css">
#em_photo{
    height: 40px;
    width: 40px;
}
</style>
