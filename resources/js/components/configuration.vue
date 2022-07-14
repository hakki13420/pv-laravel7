<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">الإعدادات</h3>
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
                    <button v-if="count<1" @click="creating" class="bg-primary" data-toggle="modal" data-target="#CreateModal">
                      <i class="fas fa-plus-circle"></i>
                    </button>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table v-if="gate.isAdmin()" class="table table-hover text-wrap">
                  <thead>
                    <tr>
                      <th>الرقم</th>
                      <th>الوزارة الوصية</th>
                      <th>الهيأة</th>
                      <th>الشعار</th>
                      <th>العنوان</th>
                      <th>الهاتف</th>
                      <th>الفاكس</th>
                      <th>البريد الإليكتروني</th>
                      <th>الموقع الإليكتروني</th>
                      <th>أضيفت من طرف</th>
                      <th>الخيارات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(configuration,index) in configurations.data" :key="configuration.id">
                      <td>{{index+1}}</td>
                      <td>{{configuration.ministere}}</td>
                      <td>{{configuration.organisme}}</td>
                      <td>{{configuration.slogan}}</td>
                      <td>{{configuration.adresse}}</td>
                      <td>{{configuration.tel}}</td>
                      <td>{{configuration.fax}}</td>
                      <td>{{configuration.email}}</td>
                      <td>{{configuration.site}}</td>
                      <td>{{configuration.created_by}}</td>
                      <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a v-if="gate.isAdmin()" class="dropdown-item" href="" @click.prevent="edit(configuration)"><i class="fa fa-edit"></i></a>
                                <a v-if="gate.isAdmin()" class="dropdown-item" href="" @click.prevent="remove(configuration.id)"><i class="fa fa-trash"></i></a>
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
              <h5 v-if="is_edit" class="modal-title" id="exampleModalLabel">تعديل الإعدادات</h5>
              <h5 v-else class="modal-title" id="exampleModalLabel">إضافة الإعدادت</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                      <label for="ministere">الوزارة الوصية</label>
                      <input v-if="errors.ministere" type="text" class="form-control is-invalid" v-model="ministere" placeholder="الوزارة الوصية">
                      <input v-else type="text" class="form-control" v-model="ministere" placeholder="الوزارة الوصية">
                      <span v-if="errors.ministere" class="text-danger">{{errors.ministere[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="organisme">الهيأة</label>
                      <input v-if="errors.organisme" type="text" class="form-control is-invalid" v-model="organisme" placeholder="الهيأة">
                      <input v-else type="text" class="form-control" v-model="organisme" placeholder="الهيأة">
                      <span v-if="errors.organisme" class="text-danger">{{errors.organisme[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="slogan">الشعار</label>
                      <input v-if="errors.slogan" type="text" class="form-control is-invalid" v-model="slogan" placeholder="الضعار">
                      <input v-else type="text" class="form-control" v-model="slogan" placeholder="الشعار">
                      <span v-if="errors.slogan" class="text-danger">{{errors.slogan[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="adresse">العنوان</label>
                      <input v-if="errors.adresse" type="text" class="form-control is-invalid" v-model="adresse" placeholder="العنوان">
                      <input v-else type="text" class="form-control" v-model="adresse" placeholder="العنوان">
                      <span v-if="errors.adresse" class="text-danger">{{errors.adresse[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="tel">الهاتف</label>
                      <input v-if="errors.tel" type="text" class="form-control is-invalid" v-model="tel" placeholder="الهاتف">
                      <input v-else type="text" class="form-control" v-model="tel" placeholder="الهاتف">
                      <span v-if="errors.tel" class="text-danger">{{errors.tel[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="fax">الفاكس</label>
                      <input v-if="errors.fax" type="text" class="form-control is-invalid" v-model="fax" placeholder="الفاكس">
                      <input v-else type="text" class="form-control" v-model="fax" placeholder="الفاكس">
                      <span v-if="errors.fax" class="text-danger">{{errors.fax[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="email">البريد الإليكتروني</label>
                      <input v-if="errors.email" type="text" class="form-control is-invalid" v-model="email" placeholder="البريد الإليكتروني">
                      <input v-else type="text" class="form-control" v-model="email" placeholder="البريد الإليكتروني">
                      <span v-if="errors.email" class="text-danger">{{errors.email[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="site">الموقع الإليكتروني</label>
                      <input v-if="errors.site" type="text" class="form-control is-invalid" v-model="site" placeholder="الموقع الإليكتروني">
                      <input v-else type="text" class="form-control" v-model="site" placeholder="الموقع الإليكتروني">
                      <span v-if="errors.site" class="text-danger">{{errors.site[0]}}</span>
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
            this.getResults();
        },
        created() {
            //console.log('Component mounted.');
            //this.index();

        },
        props:[],
        watch:{

        },
        data(){
            return {
                'ministere':'',
                'organisme':'',
                'slogan':'',
                'adresse':'',
                'tel':'',
                'fax':'',
                'email':'',
                'site':'',
                'count':'',
                'id_update':'',
                configurations:{},
                errors:[],
                'is_edit':false,
                'search':'',
            }
        },
        methods:{
            getResults() {
                    axios.get('configurations')
                    .then(response => {
                    // console.log(response);
                    this.configurations = response.data.configurations;
                    this.count = response.data.count;
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
                    axios.delete('configurations/'+id)
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
            edit:function(configuration){
                this.errors=[];
                this.is_edit=true;
                this.ministere=configuration.ministere;
                this.organisme=configuration.organisme;
                this.slogan=configuration.slogan;
                this.adresse=configuration.adresse;
                this.tel=configuration.tel;
                this.fax=configuration.fax;
                this.email=configuration.email;
                this.site=configuration.site;
                this.id_update=configuration.id;

                $('#CreateModal').modal('show');
            },
            creating:function(){
                this.is_edit=false;
                this.ministere='';
                this.organisme='';
                this.slogan='';
                this.adresse='';
                this.tel='';
                this.fax='';
                this.site='';
                this.email='';
                this.count='';

            },
            update:function(){
                axios.put('configurations/'+this.id_update,
              {'ministere':this.ministere, 'organisme':this.organisme,
               'slogan':this.slogan,'adresse':this.adresse, 'tel':this.tel,
               'fax':this.fax, 'email':this.email , 'site':this.site})
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
                //   this.ministere='';
                //   this.name='';
                //   this.organisme='';
                //   this.adresse='';
                //   this.tel='';
                //   this.fax='';
                //   this.email='';
                //   this.site='';
                //   this.count='';

            },
            index:function(){
                axios.get('configurations')
                .then((response) => {
                    //console.log(response);
                    this.configurations=response.data.configurations
                    this.count = response.data.count;
                    })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            create:function(){
              axios.post('configurations',
              {'ministere':this.ministere, 'organisme':this.organisme,
               'slogan':this.slogan,'adresse':this.adresse, 'tel':this.tel,
               'fax':this.fax, 'email':this.email , 'site':this.site})
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
            //   this.ministere='';
            //   this.organisme='';
            //   this.adresse='';
            //   this.tel='';
            //   this.fax='';
            //   this.email='';
            //   this.site='';
            //   this.count='';

            },
            searching:function(){
                if(!this.search){
                    this.index()
                }else{
                    axios.get('configurations/search?q='+this.search
                    , { headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' }})
                    .then((response)=>(this.configurations=response.data))
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
