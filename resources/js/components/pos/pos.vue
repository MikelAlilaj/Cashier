
<template>

    <div>
        <div class="container-fluid" id="container-wrapper">
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">POS Dashboard</h1>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="./">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">POS</li>
                </ol>
            </div>

            <div class="row mb-3">


                <!-- Area Chart -->
                <div class="col-xl-5 col-lg-5">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Cart</h6>


                        </div>





                        <div class="table-responsive" style="font-size: 12px;">
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr v-for="cart in carts" :key="cart.id">
                                    <td>{{ cart.product_name }}</td>
                                    <td><input type="text" readonly="" style="width: 15px;" :value="cart.product_quantity">
                                        <button @click.prevent="increment(cart.id)" class="btn btn-sm btn-success">+</button>
                                        <button  @click.prevent="decrement(cart.id)" class="btn btn-sm btn-danger" v-if="cart.product_quantity >= 2">-</button>
                                        <button class="btn btn-sm btn-danger" v-else="" disabled="">-</button>

                                    </td>
                                    <td>{{ cart.product_price  }} $</td>
                                    <td>{{ cart.sub_total }} $</td>
                                    <td><a @click="removeItem(cart.id)" class="btn btn-sm btn-primary"><font color="#ffffff">X</font></a></td>
                                </tr>


                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">Total Quantity:
                                    <strong>{{ qty }}</strong>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total:
                                    <strong>{{ subtotal }} $</strong>
                                </li>

                            </ul>
                            <br>

                            <form @submit.prevent="orderdone">

                                <br>
                                <button type="submit" class="btn btn-success">Submit</button>

                            </form>



                        </div>







                    </div>
                </div>
                <!-- Pie Chart -->



                <div class="col-xl-7 col-lg-7">
                    <div class="card mb-4">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Products</h6>
                        </div>

                        <!--  Category Wise Product -->
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Products </a>
                            </li>


                            <li class="nav-item" v-for="category in categories" :key="category.id">
                                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="productByCategory(category.id)" >{{ category.name }}</a>
                            </li>



                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                <div class="card-body">
                                    <input type="text" v-model="searchTerm" class="form-control" style="width: 560px;" placeholder="Search Product">

                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="product in filtersearch" :key="product.id">
                                            <button class="btn btn-sm" @click.prevent="AddToCart(product.id)">
                                                <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                                                    <img :src="product.image" id="em_photo" class="card-img-top">
                                                    <div class="card-body">
                                                        <h6 class="card-title">{{ product.name }}</h6>
                                                        <span class="badge badge-success" v-if="product.quantity  >= 1 ">Available {{ product.quantity }}  </span>
                                                        <span class="badge badge-danger" v-else=" ">Stock Out </span>

                                                    </div>
                                                </div></button>

                                        </div>
                                    </div>

                                </div>


                            </div>  <!--  End TBAS HOME -->





                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                                <input type="text" v-model="getsearchTerm" class="form-control" style="width: 560px;" placeholder="Search Product">

                                <div class="row">
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-6" v-for="getproduct in getfiltersearch" :key="getproduct.id">
                                        <button class="btn btn-sm" @click.prevent="AddToCart(getproduct.id)">
                                            <div class="card" style="width: 8.5rem; margin-bottom: 5px;">
                                                <img :src="getproduct.image" id="em_photo" class="card-img-top">
                                                <div class="card-body">
                                                    <h6 class="card-title">{{ getproduct.name }}</h6>
                                                    <span class="badge badge-success" v-if="getproduct.quantity  >= 1 ">Available {{ getproduct.quantity }}  </span>
                                                    <span class="badge badge-danger" v-else=" ">Stock Out </span>

                                                </div>
                                            </div></button>

                                    </div>
                                </div>




                            </div>

                        </div>
                        <!-- End Category Wise Product -->






                    </div>

                </div>
            </div>



        </div>
        <!--Row-->



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

    created(){
        this.allProduct();
        this.allCategory();
        this.cartProduct();

        Reload.$on('AfterAdd',() =>{
            this.cartProduct();
        })

    },
    data(){
        return{

            products:[],
            categories:'',
            getproducts:[],
            searchTerm:'',
            getsearchTerm:'',
            errors:'',
            carts:[],


        }
    },
    computed:{
        filtersearch(){
            return this.products.filter(product => {
                return product.name.match(this.searchTerm)
            })
        },
        getfiltersearch(){
            return this.getproducts.filter(getproduct => {
                return getproduct.name.match(this.getsearchTerm)
            })
        },
        qty(){
            let sum = 0;
            for(let i = 0; i < this.carts.length; i++){
                sum += (parseFloat(this.carts[i].product_quantity));
            }
            return sum;
        },

        subtotal(){
            let sum = 0;
            for(let i = 0; i < this.carts.length; i++){
                sum += (parseFloat(this.carts[i].product_quantity) * parseFloat(this.carts[i].product_price));
            }
            return sum;
        },

    },

    methods:{
        // Cart Methods Here
        AddToCart(id){
            axios.get('api/add_to_cart/'+id)
                .then(() => {
                    Reload.$emit('AfterAdd');
                    Notification.cart_success()
                })
                .catch()
        },
        cartProduct(){
            axios.get('api/product_cart')
                .then(({data}) => (this.carts = data))
                .catch()
        },
        removeItem(id){
            axios.get('api/remove_product_cart/'+id)
                .then(() => {
                    Reload.$emit('AfterAdd');
                    Notification.cart_delete()
                })
                .catch()
        },
        increment(id){
            axios.get('api/increment/'+id)
                .then(() => {
                    Reload.$emit('AfterAdd');
                    Notification.success()
                })
                .catch()
        },
        decrement(id){
            axios.get('api/decrement/'+id)
                .then(() => {
                    Reload.$emit('AfterAdd');
                    Notification.success()
                })
                .catch()
        },

        orderdone(){
            let total = this.subtotal + this.subtotal;
            var data = {qty:this.qty, subtotal:this.subtotal}

            axios.post('api/order_done',data)
                .then(() => {
                    Reload.$emit('AfterAdd');
                    Notification.success()
                })

        },

        // End Cart Methods
        allProduct(){
            axios.get('api/product')
                .then(({data}) => (this.products = data))
                .catch()
        },
        allCategory(){
            axios.get('api/category')
                .then(({data}) => (this.categories = data))
                .catch()
        },
        productByCategory(id){
            axios.get('api/get_product/'+id)
                .then(({data}) => (this.getproducts = data))
                .catch()
        }

    }

}

</script>


<style type="text/css" scoped>
#em_photo{
    height: 100px;
    width: 135px;
}
</style>
