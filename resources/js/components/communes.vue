<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">البلديات</h3>
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
                      <th>البلدية</th>
                      <th>الداءرة</th>
                      <th>الولاية</th>
                      <th>أضيفت من طرف</th>
                      <th>الخيارات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(commune,index) in communes.data" :key="commune.id">
                      <td>{{index+1}}</td>
                      <td>{{commune.commune}}</td>
                      <td>{{commune.daira}}</td>
                      <td>{{commune.wilaya}}</td>


                      <td>{{commune.created_by}}</td>
                      <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a v-if="gate.isAdmin() || gate.isChef() || gate.isAgent()" class="dropdown-item"  href="" @click.prevent="edit(commune)"><i class="fa fa-edit"></i></a>
                                <a v-if="gate.isAdmin()" class="dropdown-item"  href="" @click.prevent="remove(commune.id)"><i class="fa fa-trash"></i></a>
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

        <pagination :data="communes" @pagination-change-page="getResults"></pagination>

      <!-- Modal -->
      <div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 v-if="is_edit" class="modal-title" id="exampleModalLabel">تعديل بلدية</h5>
              <h5 v-else class="modal-title" id="exampleModalLabel">إضافة بلدية</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                      <label for="commune">البلدية</label>
                      <input v-if="errors.commune" type="text" class="form-control is-invalid" v-model="commune" placeholder="البلدبة">
                      <input v-else type="text" class="form-control" v-model="commune" placeholder="البلدية">
                      <span v-if="errors.commune" class="text-danger">{{errors.commune[0]}}</span>
                    </div>
                    <div class="form-group">
                      <label for="daira">الداءرة</label>
                      <input v-if="errors.daira" type="email" class="form-control is-invalid" v-model="daira" placeholder="الداءرة">
                      <input v-else type="text" class="form-control" v-model="daira" placeholder="الداءرة">
                      <span v-if="errors.daira" class="text-danger">{{errors.daira[0]}}</span>
                    </div>
                    <div class="form-group">
                      <label for="password">الولاية</label>
                      <input v-if="errors.wilaya" type="text" class="form-control is-invalid" v-model="wilaya" placeholder="الولاية">
                      <input v-else type="text" class="form-control" v-model="wilaya" placeholder="الولاية">
                      <span v-if="errors.wilaya" class="text-danger">{{errors.wilaya[0]}}</span>
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
                'commune':'',
                'daira':'',
                'wilaya':'',
                'created_by':'',
                'id_update':'',
                communes:{},
                services:{},
                errors:[],
                'is_edit':false,
                'search':'',
            }
        },
        methods:{
            getResults(page = 1) {
                axios.get('communes?page=' + page)
                .then(response => {
                    this.communes = response.data.communes;
                    this.services = response.data.services;
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
                    axios.delete('communes/'+id)
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
            edit:function(commune){
                this.errors=[];
                this.is_edit=true;
                this.commune=commune.commune;
                this.daira=commune.daira;
                this.wilaya=commune.wilaya;
                this.created_by=commune.created_by
                this.id_update=commune.id;
                //this.service_id=commune.service_id;

                $('#CreateModal').modal('show');
            },
            creating:function(){
                this.is_edit=false;
                this.commune='';
                this.daira='';
                this.wilaya='';
                //this.service_id='';
                this.created_by='';

            },
            update:function(){
                axios.put('communes/'+this.id_update,
              {'commune':this.commune, 'daira':this.daira, 'wilaya':this.wilaya,})
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
                //   this.commune='';
                //   this.daira='';
                //   this.wilaya='';
                //   this.service_id='';
                //   this.created_by='';

            },
            index:function(){
                axios.get('communes')
                .then((resource) =>{
                    this.communes=resource.data.communes
                    this.services=resource.data.services
                })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            create:function(){
              axios.post('communes',
              {'commune':this.commune, 'daira':this.daira, 'wilaya':this.wilaya})
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
            //   this.commune='';
            //   this.daira='';
            //   this.wilaya='';
            //   this.service_id='';
            //   this.created_by='';

            },
            searching:function(){
                if(!this.search){
                    this.index()
                }else{
                    axios.get('communes/search/'+this.search
                    , { headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' }})
                    .then((response)=>{
                    this.communes=response.data.communes
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
