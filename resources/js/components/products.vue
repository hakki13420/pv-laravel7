<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">المواد</h3>
                <div class="card-tools d-flex">
                  <div class="input-group input-group-sm" style="width: 450px;">
                    <input type="text" @keyup.enter="searching" v-model="search" class="form-control float-right" placeholder="بحث">

                    <div class="input-group-append">
                      <button  @click="searching" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>

                  </div>
                  <div class="input-group input-group-sm d-flex justify-content-end" style="width: 100px;">
                    <button @click="creating" class="bg-primary" data-toggle="modal" data-target="#CreateModal">
                      <i class="fas fa-plus-circle"></i>
                    </button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table v-if="gate.isAdmin() || gate.isChef() || gate.isAgent()"  class="table table-hover text-wrap">
                  <thead>
                    <tr>
                      <th>الرقم</th>
                      <th>إسم المادة</th>
                      <th>النوع</th>
                      <th>أضيفت من طرف</th>
                      <th>الخيارات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(product,index) in products.data" :key="product.id">
                      <td>{{index+1}}</td>
                      <td>{{product.libelle}}</td>
                      <td>{{product.category.category}}</td>
                      <td>{{product.created_by}}</td>
                      <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a v-if="gate.isAdmin() || gate.isChef() || gate.isAgent()" class="dropdown-item"  href="" @click.prevent="edit(product)"><i class="fa fa-edit"></i></a>
                                <a v-if="gate.isAdmin()" class="dropdown-item"  href="" @click.prevent="remove(product.id)"><i class="fa fa-trash"></i></a>
                            </div>
                        </div>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <pagination :data="products" @pagination-change-page="getResults"></pagination>

      <!-- Modal -->
      <div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 v-if="is_edit" class="modal-title" id="exampleModalLabel">تعديل مادة</h5>
              <h5 v-else class="modal-title" id="exampleModalLabel">إضافة مادة</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                      <label for="libelle">اسم المادة</label>
                      <input v-if="errors.libelle" type="text" class="form-control is-invalid" v-model="libelle" placeholder="اسم المادة">
                      <input v-else type="text" class="form-control" v-model="libelle" placeholder="اسم المادة">
                      <span v-if="errors.libelle" class="text-danger">{{errors.libelle[0]}}</span>
                    </div>

                    <div class="form-group">
                        <label for="category_id">نوع المادة</label>
                        <select v-if="errors.category_id" name="category_id" v-model="category_id" class="form-control is_invalid">
                            <option v-for="category in categories" :key="category.id" value="category.id">{{category.category}}</option>
                        </select>
                        <select v-else name="category_id" v-model="category_id" class="form-control">
                            <option v-for="category in categories" :key="category.id" v-bind:value="category.id">{{category.category}}</option>
                        </select>
                        <span v-if="errors.category_id" class="text-danger">{{errors.category_id[0]}}</span>
                    </div>

                  <div class="card-footer">
                    <button v-if="is_edit" type="submit" @click.prevent="update" class="btn btn-primary">تعدبل</button>
                    <button v-else type="submit" @click.prevent="create" class="btn btn-primary">حفظ</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">غلق</button>
                  </div>
                </form>


            </div>

          </div>
        </div>
      </div>



    </div>
</template>

<script>
    export default {
        mounted() {
            //console.log('Component mounted.');
            //this.index();
            this.getResults();
        },
        props:[],
        watch:{

        },
        data(){
            return {
                'libelle':'',
                'category_id':'',
                'created_by':'',
                'id_update':'',
                products:{},
                categories:{},
                errors:[],
                'is_edit':false,
                'search':'',
            }
        },
        methods:{
            getResults(page = 1) {
                axios.get('products?page=' + page)
                .then(response => {
                    this.categories = response.data.categories;
                    this.products = response.data.products;
                });
            },
            remove:function(id){
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('products/'+id)
                    .then((response)=>{
                        this.index()
                        Swal.fire(
                        'Deleted!',
                        'commune has been deleted.',
                        'success'
                        )
                    })
                    .catch((error)=>{
                        //this.errors=error.response.data.errors
                        console.log(error.response.data);
                        Swal.fire(
                        'Failed!',
                        'user has not been deleted.',
                        'error'
                        )
                        });
                }
                })
            },
            edit:function(product){
                this.errors=[];
                this.is_edit=true;
                this.libelle=product.libelle;
                this.category_id=product.category_id;
                this.created_by=product.created_by
                this.id_update=product.id;

                $('#CreateModal').modal('show');
            },
            creating:function(){
                this.is_edit=false;
                this.libelle='';
                this.category_id='';
                this.created_by='';

            },
            update:function(){
                axios.put('products/'+this.id_update,
              {'libelle':this.libelle,'category_id':this.category_id})
                .then((response)=> {
                    this.$Progress.start()
                    $('#CreateModal').modal('hide');
                    this.index();
                    this.showMessage("updated successfully","success");
                    this.$Progress.finish()
                })
                .catch((error)=> {
                    this.errors=error.response.data.errors
                    this.$Progress.fail()
                    });
                //   this.libelle='';
                //   this.category_id='';
                //   this.created_by='';

            },
            index:function(){
                axios.get('products')
                .then((resource) =>{
                    this.categories=resource.data.categories;
                    this.products=resource.data.products;
                })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            create:function(){
              axios.post('products',
              {'libelle':this.libelle, 'category_id':this.category_id})
              .then((response)=>{
                    this.$Progress.start()
                    $('#CreateModal').modal('hide');
                    this.index();
                    this.showMessage("created successfully","success");
                    this.$Progress.finish()
              })
              .catch((error)=>{
                  this.errors=error.response.data.errors
                  this.$Progress.fail()
              });
            //   this.libelle='';
            //   this.category_id='';
            //   this.created_by='';

            },
            searching:function(){
                if(!this.search){
                    this.index()
                }else{
                    axios.get('products/search/'+this.search
                    , { headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' }})
                    .then((response)=>{
                    this.products=response.data.products
                })
                }

            },
            showMessage:function(message,type){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                    })

                    Toast.fire({
                    icon: type,
                    title: message
                    })
            },
        }
    }
</script>
