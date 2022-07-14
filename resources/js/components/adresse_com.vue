<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">adresse</h3>
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
                <table v-if="gate.isAdmin() || gate.isChef() || gate.isAgent()" class="table table-hover text-wrap">
                  <thead>
                    <tr>
                      <th>الرقم</th>
                      <th>التاجر</th>
                      <th>العنوان التجاري</th>
                      <th>أضيفت من طرف</th>
                      <th>الخيارات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(adresse_com,index) in adresse_coms" :key="adresse_com.id">
                      <td>{{index+1}}</td>
                      <td>{{adresse_com.commercant_id}}</td>
                      <td>{{adresse_com.adresse_com}}</td>

                      <td>{{adresse_com.created_by}}</td>
                      <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a v-if="gate.isAdmin() || gate.isChef() || gate.isAgent()" class="dropdown-item"  href="" @click.prevent="edit(adresse_com)"><i class="fa fa-edit"></i></a>
                                <a v-if="gate.isAdmin()" class="dropdown-item"  href="" @click.prevent="remove(adresse_com.id)"><i class="fa fa-trash"></i></a>
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



      <!-- Modal -->
      <div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 v-if="is_edit" class="modal-title" id="exampleModalLabel">تعديل نشاط</h5>
              <h5 v-else class="modal-title" id="exampleModalLabel">إضافة نشاط</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="form-group">
                      <label for="commercant_id">التاجر</label>
                      <input v-if="errors.commercant_id" type="email" class="form-control is-invalid" v-model="commercant_id" placeholder="التاجر">
                      <input v-else type="text" class="form-control" v-model="commercant_id" placeholder="التاجر">
                      <span v-if="errors.commercant_id" class="text-danger">{{errors.commercant_id[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="adresse_com">العنوان</label>
                      <input v-if="errors.adresse_com" type="email" class="form-control is-invalid" v-model="adresse_com" placeholder="العنوان">
                      <input v-else type="text" class="form-control" v-model="adresse_com" placeholder="العنوان">
                      <span v-if="errors.adresse_com" class="text-danger">{{errors.adresse_com[0]}}</span>
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
            if(this.$route.params.commercant_id==undefined){
              window.location.replace("/home#/commercants");
            }else{
              this.commercant_id=this.$route.params.commercant_id;
              this.getResults();
            }
        },
        props:[],
        watch:{

        },
        data(){
            return {
                'adresse_com':'',
                'commercant_id':'',
                'created_by':'',
                'id_update':'',
                adresse_coms:{},
                commercant:{},
                errors:[],
                'is_edit':false,
                'search':'',
            }
        },
        methods:{
            getResults() {
                axios.get('adressesCom/' + this.commercant_id)
                .then(response => {
                    this.adresse_coms = response.data.adresse_coms;
                    this.commercant = response.data.commercant;
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
                    axios.delete('adressescom/'+id)
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
            edit:function(adresse_com){
                this.errors=[];
                this.is_edit=true;
                this.adresse_com=adresse_com.adresse_com;
                this.commercant_id=adresse_com.commercant_id;
                this.created_by=adresse_com.created_by
                this.id_update=adresse_com.id;

                $('#CreateModal').modal('show');
            },
            creating:function(){
                this.is_edit=false;
                this.initialize();

            },
            initialize:function(){
                this.activite_id='';
                //this.commercant_id='';
                this.created_by='';
            },
            update:function(){
                axios.put('adressescom/'+this.id_update,
              {'adresse_com':this.adresse_com, 'commercant_id':this.commercant_id})
                .then((response)=> {
                    this.$Progress.start()
                    $('#CreateModal').modal('hide');
                    this.getResults();
                    this.showMessage("updated successfully","success");
                    this.$Progress.finish()
                })
                .catch((error)=> {
                    this.errors=error.response.data.errors
                    this.$Progress.fail()
                    });
                //this.initialize();

            },
            index:function(){
                axios.get('adressescom/'+this.commercant_id)
                .then((resource) =>{
                    this.adresse_coms=resource.data.adresse_coms;
                    this.commercant = response.data.commercant;
                })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            create:function(){
              axios.post('adressescom',
              {'adresse_com':this.adresse_com, 'commercant_id':this.commercant_id})
              .then((response)=>{
                    this.$Progress.start()
                    $('#CreateModal').modal('hide');
                    this.getResults();
                    this.showMessage("created successfully","success");
                    this.$Progress.finish()
              })
              .catch((error)=>{
                  this.errors=error.response.data.errors
                  this.$Progress.fail()
              });
              //this.initialize();
            },
            searching:function(){
                if(!this.search){
                    this.index()
                }else{
                    axios.get('adressescom/search?q='+this.search
                    , { headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' }})
                    .then((response)=>{
                    this.adresse_coms=response.data
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
