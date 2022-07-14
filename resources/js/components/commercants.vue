<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">التاجر</h3>
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
                      <th>السجل التجاري</th>
                      <th>الاسم و اللقب</th>
                      <th>التسمية الاجتماعية</th>
                      <th>العنوان</th>
                      <th>البلدية</th>
                      <th>أضيفت من طرف</th>
                      <th colspan="2">الخيارات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(commercant,index) in commercants.data" :key="commercant.id">
                      <td>{{index+1}}</td>
                      <td>{{commercant.nrc}}</td>
                      <td>{{commercant.name}}</td>
                      <td>{{commercant.rais_soc?commercant.rais_soc:"/"}}</td>
                      <td>{{commercant.adresse_d}}</td>
                      <td>{{commercant.commune.commune}}</td>
                      <td>{{commercant.created_by}}</td>
                      <td class="d-flex flex-row">
                            <router-link  :to="{name:'pvs',params:{commercant_id:commercant.id}}" class="btn btn-primary btn-sm mx-1">
                                محاضر
                            </router-link>
                            <router-link  :to="{name:'adresse_com',params:{commercant_id:commercant.id}}" class="btn btn-primary btn-sm mx-1">
                                عناوين
                            </router-link>
                            <router-link  :to="{name:'activite_com',params:{commercant_id:commercant.id}}" class="btn btn-primary btn-sm mx-1">
                                نشاطات
                            </router-link>
                      </td>
                      <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a v-if="gate.isAdmin() || gate.isChef() || gate.isAgent()" class="dropdown-item"  href="" @click.prevent="edit(commercant)"><i class="fa fa-edit"></i></a>
                                <a v-if="gate.isAdmin()" class="dropdown-item"  href="" @click.prevent="remove(commercant.id)"><i class="fa fa-trash"></i></a>
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

        <pagination :data="commercants" @pagination-change-page="getResults"></pagination>

      <!-- Modal -->
      <div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 v-if="is_edit" class="modal-title" id="exampleModalLabel">تعديل تاجر</h5>
              <h5 v-else class="modal-title" id="exampleModalLabel">إضافة تاجر</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                      <label for="nrc">السجل التجاري</label>
                      <input v-if="errors.nrc" type="text" class="form-control is-invalid" v-model="nrc" placeholder="السجل التجاري">
                      <input v-else type="text" class="form-control" v-model="nrc" placeholder="السجل التجاري">
                      <span v-if="errors.nrc" class="text-danger">{{errors.nrc[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="name">الاسم و اللقب</label>
                      <input v-if="errors.name" type="text" class="form-control is-invalid" v-model="name" placeholder="الاسم و اللقب">
                      <input v-else type="text" class="form-control" v-model="name" placeholder="الاسم و اللقب">
                      <span v-if="errors.name" class="text-danger">{{errors.name[0]}}</span>
                    </div>
                    <div class="form-group">
                      <label for="rais_soc">التسمية الاجتماعية</label>
                      <input v-if="errors.rais_soc" type="email" class="form-control is-invalid" v-model="rais_soc" placeholder="التسمية الاجتماعية">
                      <input v-else type="text" class="form-control" v-model="rais_soc" placeholder="التسمية الاجتماعية">
                      <span v-if="errors.rais_soc" class="text-danger">{{errors.rais_soc[0]}}</span>
                    </div>
                    <div class="form-group">
                      <label for="date_n">تاريخ الميلاد</label>
                      <input v-if="errors.date_n" type="date" class="form-control is-invalid" v-model="date_n" placeholder="تاريخ الميلاد">
                      <input v-else type="date" class="form-control" v-model="date_n" placeholder="تاريخ الميلاد">
                      <span v-if="errors.date_n" class="text-danger">{{errors.date_n[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="lieux_n">مكان الميلاد</label>
                      <select v-if="errors.lieux_n" name="lieux_n" v-model="lieux_n" class="form-control is-invalid">
                        <option v-for="commune in communes" :key="commune.id" v-bind:value="commune.id">{{commune.commune}}</option>
                      </select>
                      <select v-else name="lieux_n" v-model="lieux_n" class="form-control">
                        <option v-for="commune in communes" :key="commune.id" v-bind:value="commune.id">{{commune.commune}}</option>
                      </select>
                      <span v-if="errors.lieux_n" class="text-danger">{{errors.lieux_n[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="adresse_d">عنوان الاقامة</label>
                      <input v-if="errors.adresse_d" type="email" class="form-control is-invalid" v-model="adresse_d" placeholder="عنوان الاقامة">
                      <input v-else type="text" class="form-control" v-model="adresse_d" placeholder="عنوان الاقامة">
                      <span v-if="errors.adresse_d" class="text-danger">{{errors.adresse_d[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="commune_id">بلدية الاقامة</label>
                      <select v-if="errors.commune_id" name="commune_id" v-model="commune_id" class="form-control is-invalid">
                        <option v-for="commune in communes" :key="commune.id" v-bind:value="commune.id">{{commune.commune}}</option>
                      </select>
                      <select v-else name="commune_id" v-model="commune_id" class="form-control">
                        <option v-for="commune in communes" :key="commune.id" v-bind:value="commune.id">{{commune.commune}}</option>
                      </select>
                      <span v-if="errors.commune_id" class="text-danger">{{errors.commune_id[0]}}</span>
                    </div>


                    <div class="form-group">
                      <label for="tel">الهاتف</label>
                      <input v-if="errors.tel" type="email" class="form-control is-invalid" v-model="tel" placeholder="الهاتف">
                      <input v-else type="text" class="form-control" v-model="tel" placeholder="الهاتف">
                      <span v-if="errors.tel" class="text-danger">{{errors.tel[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="pere">الأب</label>
                      <input v-if="errors.pere" type="email" class="form-control is-invalid" v-model="pere" placeholder="الأب">
                      <input v-else type="text" class="form-control" v-model="pere" placeholder="الأب">
                      <span v-if="errors.pere" class="text-danger">{{errors.pere[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="mere">الأم</label>
                      <input v-if="errors.mere" type="email" class="form-control is-invalid" v-model="mere" placeholder="الأم">
                      <input v-else type="text" class="form-control" v-model="mere" placeholder="الأم">
                      <span v-if="errors.mere" class="text-danger">{{errors.mere[0]}}</span>
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
            if(this.$route.params.commercant_id!=undefined){
                axios.get('commercantById/'+this.$route.params.commercant_id)
                .then( response => {
                    this.commercants=response.data.commercants;
                    this.communes = response.data.communes;
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
                'nrc':'',
                'name':'',
                'rais_soc':'',
                'date_n':'',
                'lieux_n':'',
                'adresse_d':'',
                'commune_id':'',
                'tel':'',
                'pere':'',
                'mere':'',
                'created_by':'',
                'id_update':'',

                commercants:{},
                communes:{},
                errors:[],
                'is_edit':false,
                'search':'',
            }
        },
        methods:{
            getResults(page = 1) {
                axios.get('commercants?page=' + page)
                .then(response => {
                    this.commercants = response.data.commercants;
                    this.communes = response.data.communes;

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
                    axios.delete('commercants/'+id)
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
            edit:function(commercant){
                this.errors=[];
                this.is_edit=true;
                this.name=commercant.name;
                this.nrc=commercant.nrc;
                this.rais_soc=commercant.rais_soc;
                this.date_n=commercant.date_n;
                this.lieux_n=commercant.lieux_n;
                this.adresse_d=commercant.adresse_d;
                this.commune_id=commercant.commune_id;
                this.tel=commercant.tel;
                this.pere=commercant.pere;
                this.mere=commercant.mere;
                this.created_by=commercant.created_by
                this.id_update=commercant.id;

                $('#CreateModal').modal('show');
            },
            creating:function(){
                this.is_edit=false;
                this.initialize();

            },
            initialize:function(){
                this.nrc='';
                this.name='';
                this.rais_soc='';
                this.date_n='';
                this.lieux_n='';
                this.adresse_d='';
                this.commune_id='';
                this.tel='';
                this.pere='';
                this.mere='';
                this.created_by='';
            },
            update:function(){
                axios.put('commercants/'+this.id_update,
              {'nrc':this.nrc, 'name':this.name, 'rais_soc':this.rais_soc,
               'date_n':this.date_n, 'lieux_n':this.lieux_n, 'adresse_d':this.adresse_d,
               'commune_id' :this.commune_id, 'tel':this.tel, 'pere':this.pere,
               'mere':this.mere,'created_by':this.created_by})
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
                  //this.initialize();
            },
            index:function(){
                axios.get('commercants')
                .then((resource) =>{
                    this.commercants = resource.data.commercants;
                    this.communes=resource.data.communes
                })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            create:function(){
              axios.post('commercants',
              {'nrc':this.nrc, 'name':this.name, 'rais_soc':this.rais_soc,
               'date_n':this.date_n, 'lieux_n':this.lieux_n, 'adresse_d':this.adresse_d,
               'commune_id' :this.commune_id, 'tel':this.tel, 'pere':this.pere,
               'mere':this.mere,'created_by':this.created_by})
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
              //this.initialize();
            },
            searching:function(){
                if(!this.search){
                    this.index()
                }else{
                    axios.get('commercants/search/'+this.search
                    , { headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' }})
                    .then((response)=>{
                        this.commercants=response.data.commercants
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
