<template>
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <!-- Left col -->
                <div class="col-md-12">
                    <!-- MAP & BOX PANE -->
                    <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Latest Products</h3>

                        <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                            <i class="fas fa-times"></i>
                        </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr v-for="product in products.data" :key="product.id">

                                    <td><img v-bind:src="'/' + product.photo" width="300" alt="product"></td>
                                    <td>{{product.name}}</td>
                                    <td>{{product.description | truncate(30, '...')}}</td>
                                    <td>{{product.category.name}}</td>
                                    <td>{{product.price}}</td>
                                    <td>

                                        <a href="#" @click="editModal(product)">
                                            <i class="fa fa-edit blue"></i>
                                        </a>
                                        /
                                        <a href="#" @click="deleteProduct(product.id)">
                                            <i class="fa fa-trash red"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- /.card -->
            </div>
            <!-- /.col -->

            </div>
            <!-- /.row -->
        </div><!--/. container-fluid -->
    </section>
</template>

<script>
import VueTagsInput from '@johmun/vue-tags-input';

export default {
    components: {
        VueTagsInput,
    },
    data () {
        return {
            editmode: false,
            products : {},
            form: new Form({
                id : '',
                category : '',
                name: '',
                description: '',
                tags:  [],
                photo: '',
                category_id: '',
                price: '',
                photoUrl: '',
            }),
            categories: [],

            tag:  '',
            autocompleteItems: [],
        }
    },
    methods: {

        getResults(page = 1) {

            this.$Progress.start();

            axios.get('api/product?page=' + page).then(({ data }) => (this.products = data.data));

            this.$Progress.finish();
        },
        loadProducts(){

            // if(this.$gate.isAdmin()){
            axios.get("api/product").then(({ data }) => (this.products = data.data));
            // }
        },
        loadCategories(){
            axios.get("/api/category/list").then(({ data }) => (this.categories = data.data));
        },
        loadTags(){
            axios.get("/api/tag/list").then(response => {
                this.autocompleteItems = response.data.data.map(a => {
                    return { text: a.name, id: a.id };
                });
            }).catch(() => console.warn('Oh. Something went wrong'));
        },
        editModal(product){
            this.editmode = true;
            this.form.reset();
            $('#addNew').modal('show');
            this.form.fill(product);
        },
        newModal(){
            this.editmode = false;
            this.form.reset();
            $('#addNew').modal('show');
        },
        createProduct(){
            this.$Progress.start();

            this.form.post('api/product')
                .then((data)=>{
                    if(data.data.success){
                        $('#addNew').modal('hide');

                        Toast.fire({
                            icon: 'success',
                            title: data.data.message
                        });
                        this.$Progress.finish();
                        this.loadProducts();

                    } else {
                        Toast.fire({
                            icon: 'error',
                            title: 'Some error occured! Please try again'
                        });

                        this.$Progress.failed();
                    }
                })
                .catch(()=>{

                    Toast.fire({
                        icon: 'error',
                        title: 'Some error occured! Please try again'
                    });
                })
        },
        updateProduct(){
            this.$Progress.start();
            this.form.put('api/product/'+this.form.id)
                .then((response) => {
                    // success
                    $('#addNew').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: response.data.message
                    });
                    this.$Progress.finish();
                    //  Fire.$emit('AfterCreate');

                    this.loadProducts();
                })
                .catch(() => {
                    this.$Progress.fail();
                });

        },
        deleteProduct(id){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    this.form.delete('api/product/'+id).then(()=>{
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                        // Fire.$emit('AfterCreate');
                        this.loadProducts();
                    }).catch((data)=> {
                        Swal.fire("Failed!", data.message, "warning");
                    });
                }
            })
        },

    },
    mounted() {

    },
    created() {
        this.$Progress.start();

        this.loadProducts();
        this.loadCategories();
        this.loadTags();

        this.$Progress.finish();
    },
    filters: {
        truncate: function (text, length, suffix) {
            return text.substring(0, length) + suffix;
        },
    },
    computed: {
        filteredItems() {
            return this.autocompleteItems.filter(i => {
                return i.text.toLowerCase().indexOf(this.tag.toLowerCase()) !== -1;
            });
        },
    },
}
</script>
