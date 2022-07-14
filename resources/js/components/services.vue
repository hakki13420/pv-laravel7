<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">المصالح</h3>
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
                <table v-if="gate.isAdmin() || gate.isChef()" class="table table-hover text-wrap">
                  <thead>
                    <tr>
                      <th>الرقم</th>
                      <th>المصلحة</th>
                      <th>العنوان</th>
                      <th>للاتصال</th>
                      <th>المسجل</th>
                      <th>الخيارات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(service,index) in services.data" :key="service.id">
                      <td>{{index+1}}</td>
                      <td>{{service.service}}</td>
                      <td>{{service.adresse}}</td>
                      <td>{{service.contact}}</td>
                      <td>{{service.created_by}}</td>
                      <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a v-if="gate.isAdmin() || gate.isChef()" class="dropdown-item"  href="" @click.prevent="edit(service)"><i class="fa fa-edit"></i></a>
                                <a v-if="gate.isAdmin()" class="dropdown-item"  href="" @click.prevent="remove(service.id)"><i class="fa fa-trash"></i></a>
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

        <pagination :data="services" @pagination-change-page="getResults"></pagination>

      <!-- Modal -->
      <div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 v-if="is_edit" class="modal-title" id="exampleModalLabel">تعديل مصلحة</h5>
              <h5 v-else class="modal-title" id="exampleModalLabel">إضافة مصلحة</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                      <label for="service">المصلحة</label>
                      <input v-if="errors.service" type="text" class="form-control is-invalid" v-model="service" placeholder="تسمية المصلحة">
                      <input v-else type="text" class="form-control" v-model="service" placeholder="تسمية المصلحة">
                      <span v-if="errors.service" class="text-danger">{{errors.service[0]}}</span>
                    </div>
                    <div class="form-group">
                      <label for="adresse">العنوان</label>
                      <input v-if="errors.adresse" type="text" class="form-control is-invalid" v-model="adresse" placeholder="العنوان">
                      <input v-else type="text" class="form-control" v-model="adresse" placeholder="العنوان">
                      <span v-if="errors.adresse" class="text-danger">{{errors.adresse[0]}}</span>
                    </div>
                    <div class="form-group">
                      <label for="contact">للاتصال</label>
                      <input v-if="errors.contact" type="text" class="form-control is-invalid" v-model="contact" placeholder="أرقام للاتصال">
                      <input v-else type="text" class="form-control" v-model="contact" placeholder="أرقام الاتصال">
                      <span v-if="errors.contact" class="text-danger">{{errors.contact[0]}}</span>
                    </div>

                  <div class="card-footer">
                    <button v-if="is_edit && gate.isAdmin()" type="submit" @click.prevent="update" class="btn btn-primary">تعديل</button>
                    <button v-else-if="!is_edit && gate.isAdmin()" type="submit" @click.prevent="create" class="btn btn-primary">حفظ</button>
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
            if(this.$route.params.service_id!=undefined){
                axios.get('serviceById/'+this.$route.params.service_id)
                .then( response => {
                    this.services=response.data.services;
                    this.chefs=response.data.chefs;
                })
            }else{
                this.getResults();
            }
        },
        props:[],
        watch:{

        },
        data(){
            return {
                'service':'',
                'adresse':'',
                'contact':'',
                'chef':'',
                'id_update':'',
                chefs:{},
                services:{},
                errors:[],
                'is_edit':false,
                'search':'',
            }
        },
        methods:{
            getResults(page = 1) {
                axios.get('services?page=' + page)
                .then(response => {
            //        console.log(response);
                    this.services = response.data.services;
                    this.chefs = response.data.chefs;
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
                    axios.delete('services/'+id)
                    .then((response)=>{
                        this.index()
                        Swal.fire(
                        'Deleted!',
                        'service has been deleted.',
                        'success'
                        )
                    })
                    .catch((error)=>{
                        //this.errors=error.response.data.errors
                        console.log(error.response.data);
                        Swal.fire(
                        'Failed!',
                        'service has not been deleted.',
                        'error'
                        )
                        });
                }
                })
            },
            edit:function(service){
                this.errors=[];
                this.is_edit=true;
                this.service=service.service;
                this.adresse=service.adresse;
                this.contact=service.contact;
                this.id_update=service.id;

                $('#CreateModal').modal('show');
            },
            creating:function(){
                this.is_edit=false;
                this.service='';
                this.adresse='';
                this.contact='';

            },
            update:function(){
                axios.put('services/'+this.id_update,
              {'service':this.service, 'adresse':this.adresse, 'contact':this.contact,})
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
                //   this.service='';
                //   this.adresse='';
                //   this.contact='';
                //   this.chef='';

            },
            index:function(){
                axios.get('services')
                .then((response) => {
                    //console.log(response);
                    this.services=response.data.services
                    this.chefs = response.data.chefs;
                    })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            create:function(){
              axios.post('services',
              {'service':this.service, 'adresse':this.adresse, 'contact':this.contact,})
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
            //   this.service='';
            //   this.adresse='';
            //   this.contact='';
            //   this.chef='';

            },
            searching:function(){
                if(!this.search){
                    this.index()
                }else{
                    axios.get('services/search/'+this.search
                    , { headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' }})
                    .then((response)=>(this.services=response.data.services))
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
