<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">فرق التفتيش</h3>
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
                      <th>تسمية الفرقة</th>
                      <th>التسمية المختصرة</th>
                      <th>المصلحة</th>
                      <th>أضيفت من طرف</th>
                      <th>الخيارات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(brigade,index) in brigades.data" :key="brigade.id">
                      <td>{{index+1}}</td>
                      <td>{{brigade.libelle}}</td>
                      <td>{{brigade.code}}</td>
                      <td>{{brigade.service_id?brigade.service.service:"/"}}</td>
                      <td>{{brigade.created_by}}</td>
                      <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" v-if="gate.isAdmin()||gate.isChef()" href="" @click.prevent="edit(brigade)"><i class="fa fa-edit"></i></a>
                                <a class="dropdown-item" v-if="gate.isAdmin()||gate.isChef()" href="" @click.prevent="remove(brigade.id)"><i class="fa fa-trash"></i></a>
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

        <pagination :data="brigades" @pagination-change-page="getResults"></pagination>

      <!-- Modal -->
      <div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 v-if="is_edit" class="modal-title" id="exampleModalLabel">تعديل فرقة التفتيش</h5>
              <h5 v-else class="modal-title" id="exampleModalLabel">إضافة فرقة تفتيش</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                      <label for="libelle">تسمية الفرقة</label>
                      <input v-if="errors.libelle" type="text" class="form-control is-invalid" v-model="libelle" placeholder="التسمية">
                      <input v-else type="text" class="form-control" v-model="libelle" placeholder="التسمية">
                      <span v-if="errors.libelle" class="text-danger">{{errors.libelle[0]}}</span>
                    </div>
                    <div class="form-group">
                      <label for="code">التسمية المختصرة</label>
                      <input v-if="errors.code" type="text" class="form-control is-invalid" v-model="code" placeholder="التسمية المختصرة">
                      <input v-else type="text" class="form-control" v-model="code" placeholder="التسمية المختصرة">
                      <span v-if="errors.code" class="text-danger">{{errors.code[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="service">المصلحة</label>
                      <select v-if="errors.service" name="service" v-model="service" class="form-control is-invalid">
                        <option v-for="service in services" :key="service.id" v-bind:value="service.id">{{service.service}}</option>
                      </select>
                      <select v-else name="service" v-model="service" class="form-control">
                        <option v-for="service in services" :key="service.id" v-bind:value="service.id">{{service.service}}</option>
                      </select>
                      <span v-if="errors.service" class="text-danger">{{errors.service[0]}}</span>
                    </div>

                  <div class="card-footer">
                    <button v-if="is_edit" type="submit" @click.prevent="update" class="btn btn-primary">تعديل</button>
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
            if(this.$route.params.brigade_id!=undefined){
                axios.get('brigadeById/'+this.$route.params.brigade_id)
                .then( response => {
                    this.brigades=response.data.brigades;
                    this.services = response.data.services;
                });
            }else{
                this.getResults();
            }
        },
        props:[],
        watch:{

        },
        data(){
            return {
                'libelle':'',
                'code':'',
                'service':'',
                'id_update':'',
                brigades:{},
                services:{},
                errors:[],
                'is_edit':false,
                'search':'',
            }
        },
        methods:{
            getResults(page = 1) {

                    axios.get('brigades?page=' + page)
                    .then(response => {
                    // console.log(response);
                    this.services = response.data.services;
                    this.brigades = response.data.brigades;
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
                    axios.delete('brigades/'+id)
                    .then((response)=>{
                        this.index()
                        Swal.fire(
                        'Deleted!',
                        'brigade has been deleted.',
                        'success'
                        )
                    })
                    .catch((error)=>{
                        //this.errors=error.response.data.errors
                        console.log(error.response.data);
                        Swal.fire(
                        'Failed!',
                        'brigade has not been deleted.',
                        'error'
                        )
                        });
                }
                })
            },
            edit:function(brigade){
                this.errors=[];
                this.is_edit=true;
                this.libelle=brigade.libelle;
                this.code=brigade.code;
                this.service=brigade.service_id;
                this.id_update=brigade.id;

                $('#CreateModal').modal('show');
            },
            creating:function(){
                this.is_edit=false;
                this.libelle='';
                this.code='';
                this.service='';


            },
            update:function(){
                axios.put('brigades/'+this.id_update,
              {'libelle':this.libelle, 'code':this.code, 'service':this.service})
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
                //   this.code='';
                //   this.service='';

            },
            index:function(){
                axios.get('brigades')
                .then((response) => {
                    //console.log(response);
                    this.services=response.data.services
                    this.brigades = response.data.brigades;
                    })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            create:function(){
              axios.post('brigades',
              {'libelle':this.libelle, 'code':this.code, 'service':this.service})
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
            //   this.code='';
            //   this.service='';

            },
            searching:function(){
                if(!this.search){
                    this.index()
                }else{
                    axios.get('brigades/search/'+this.search
                    , { headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' }})
                    .then((response)=>(this.brigades=response.data.brigades))
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
