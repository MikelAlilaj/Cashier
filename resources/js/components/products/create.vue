

<template>

    <div>

        <div class="row">
            <router-link to="/product" class="btn btn-primary">All Product </router-link>

        </div>



        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12 col-md-12">
                <div class="card shadow-sm my-5">
                    <div class="card-body p-0">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="login-form">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Add Product</h1>
                                    </div>

                                    <form class="user" @submit.prevent="ProductInsert" enctype="multipart/form-data">

                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Product Name</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Product Name" v-model="form.name">
                                                    <small class="text-danger" v-if="errors.name"> {{ errors.name[0] }} </small>
                                                </div>


                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Product Code</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Product Code" v-model="form.code">
                                                    <small class="text-danger" v-if="errors.code"> {{ errors.code[0] }} </small>
                                                </div>

                                            </div>
                                        </div>


                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Product Category</label>
                                                    <select class="form-control" id="exampleFormControlSelect1" v-model="form.category_id">
                                                        <option :value="category.id" v-for="category in categories">{{ category.name }}</option>

                                                    </select>
                                                </div>

                                                    <div class="col-md-6">
                                                        <label for="exampleFormControlSelect1">Buying Date</label>
                                                        <input type="date" class="form-control" id="exampleInputFirstName" v-model="form.buying_date">
                                                        <small class="text-danger" v-if="errors.buying_date"> {{ errors.buying_date[0] }} </small>
                                                    </div>





                                            </div>
                                        </div>




                                        <div class="form-group">

                                            <div class="form-row">



                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Buying Price</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName"  v-model="form.buying_price">
                                                    <small class="text-danger" v-if="errors.buying_price"> {{ errors.buying_price[0] }} </small>
                                                </div>


                                                <div class="col-md-6">
                                                    <label for="exampleFormControlSelect1">Selling Price</label>
                                                    <input type="text" class="form-control" id="exampleInputFirstName" v-model="form.selling_price">
                                                    <small class="text-danger" v-if="errors.selling_price"> {{ errors.selling_price[0] }} </small>
                                                </div>



                                            </div>


                                        </div>

                                        <div class="form-group">

                                            <div class="form-row">

                                                    <div class="col-md-6">
                                                        <label for="exampleFormControlSelect1">Product Quantity</label>
                                                        <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Your Quantity" v-model="form.quantity">
                                                        <small class="text-danger" v-if="errors.quantity"> {{ errors.quantity[0] }} </small>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="exampleFormControlSelect1">Product Typology</label>
                                                        <select class="form-control" id="exampleFormControlSelect1" v-model="form.typology_id">
                                                            <option :value="typology.id" v-for="typology in typologies">{{ typology.name }}</option>

                                                        </select>
                                                    </div>
                                            </div>
                                        </div>


                                        <div class="form-group">

                                            <div class="form-row">
                                                <div class="col-md-6">
                                                    <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">

                                                    <small class="text-danger" v-if="errors.image"> {{ errors.image[0] }} </small>
                                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                                </div>


                                                <div class="col-md-6">
                                                    <img :src="form.image" style="height: 40px; width: 40px;">
                                                </div>

                                            </div>
                                        </div>




                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary btn-block">Submit</button>
                                        </div>

                                    </form>
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
            form:{
                name: null,
                code: null,
                category_id: null,
                buying_price: null,
                selling_price: null,
                buying_date: null,
                image: null,
                quantity: null,
                typology_id: null,
            },
            errors:{},
            categories:{},
            typologies:{},
        }
    },

    methods:{
        onFileSelected(event){
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.image_validation()
            }else{
                let reader = new FileReader();
                reader.onload = event =>{
                    this.form.image = event.target.result
                    console.log(event.target.result);
                };
                reader.readAsDataURL(file);
            }

        },
        ProductInsert(){
            axios.post('api/product',this.form)
                .then(() => {
                    this.$router.push({ name: 'product'})
                    Notification.success()
                })
                .catch(error =>this.errors = error.response.data.errors)
        },
    },
    created(){
        axios.get('api/category/')
            .then(({data}) => (this.categories = data)),

        axios.get('api/typology/')
            .then(({data}) => (this.typologies = data))
    }



}

</script>


<style type="text/css">

</style>
