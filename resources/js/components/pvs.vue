<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">المحاضر</h3>
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
                    <button @click="creating" class="bg-primary">
                        <router-link  :to="{name:'pvsCreate', params:{commercant_id:this.$route.params.commercant_id}}" class="small-box-footer nav-link">
                            <i class="fas fa-plus-circle"></i>
                        </router-link>

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
                      <th>رقم المحضر</th>
                      <th>تاريخ المحضر</th>
                      <th>التاجر</th>
                      <th>المصلحة</th>
                      <th>العون1</th>
                      <th>العون2</th>
                      <th>العون3</th>
                      <th>أضيفت من طرف</th>
                      <th>طباعة</th>
                      <th>الخيارات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <template v-if="!is_commercant">
                        <tr v-for="(pv,index) in pvs.data" :key="pv.id">
                            <td>{{index+1}}</td>
                            <td>{{pv.num_pv}}</td>
                            <td>{{pv.date_pv}}</td>
                            <td>
                                <router-link :to="{name:'commercants', params:{commercant_id:pv.id}}" class="small-box-footer nav-link">
                                    {{pv.commercant.name}}
                                </router-link>
                            </td>
                            <td>
                                <router-link :to="{name:'services', params:{service_id:pv.service_id}}" class="small-box-footer nav-link">
                                    {{pv.service.service}}
                                </router-link>
                            </td>
                            <td>
                                <router-link :to="{name:'users', params:{user_id:pv.user1.id}}" class="small-box-footer nav-link">
                                    {{pv.user1?pv.user1.name:"/"}}
                                </router-link>
                            </td>
                            <td>
                                <router-link :to="{name:'users', params:{user_id:pv.user1.id}}" class="small-box-footer nav-link">
                                    {{pv.user2?pv.user2.name:"/"}}
                                </router-link>
                            </td>
                            <td>
                                <router-link :to="{name:'users', params:{user_id:pv.user1.id}}" class="small-box-footer nav-link">
                                    {{pv.user3?pv.user3.name:'/'}}
                                </router-link>
                            </td>

                            <td>{{pv.created_by}}</td>
                            <td v-if="pv.user3" class="d-flex flex-row justify-content-center">
                                <router-link v-if="gate.isAdmin() || isAgentPv(pv.user1.id,pv.user2.id,pv.user3.id) || isChefPv(pv.user1.service_id,pv.user2.service_id,pv.user3.service_id)" :to="{name:'pvsPrint', params:{pv_id:pv.id}}" class="small-box-footer nav-link px-1">
                                    <button class="btn btn-primary btn-sm">print</button>
                                </router-link>
                                <router-link v-if="gate.isAdmin() || isAgentPv(pv.user1.id,pv.user2.id,pv.user3.id) || isChefPv(pv.user1.service_id,pv.user2.service_id,pv.user3.service_id)" :to="{name:'ordreVerssement', params:{pv_id:pv.id}}" class="small-box-footer nav-link px-1">
                                    <button class="btn btn-primary btn-sm">OV</button>
                                </router-link>
                                <router-link v-if="(gate.isAdmin() || isAgentPv(pv.user1.id,pv.user2.id,pv.user3.id) || isChefPv(pv.user1.service_id,pv.user2.service_id,pv.user3.service_id)) && pv.hasSaisie" :to="{name:'pvSaisie', params:{pv_id:pv.id}}" class="small-box-footer nav-link px-1">
                                    <button class="btn btn-primary btn-sm">saisie</button>
                                </router-link>
                            </td>
                            <td v-else class="d-flex flex-row justify-content-center">
                                <router-link v-if="gate.isAdmin() || isAgentPv(pv.user1.id,pv.user2.id,pv.user3) || isChefPv(pv.user1.service_id,pv.user2.service_id,pv.user3)" :to="{name:'pvsPrint', params:{pv_id:pv.id}}" class="small-box-footer nav-link px-1">
                                    <button class="btn btn-primary btn-sm">print</button>
                                </router-link>
                                <router-link v-if="gate.isAdmin() || isAgentPv(pv.user1.id,pv.user2.id,pv.user3) || isChefPv(pv.user1.service_id,pv.user2.service_id,pv.user3)" :to="{name:'ordreVerssement', params:{pv_id:pv.id}}" class="small-box-footer nav-link px-1">
                                    <button class="btn btn-primary btn-sm">OV</button>
                                </router-link>
                                <router-link v-if="(gate.isAdmin() || isAgentPv(pv.user1.id,pv.user2.id,pv.user3) || isChefPv(pv.user1.service_id,pv.user2.service_id,pv.user3)) && pv.hasSaisie" :to="{name:'pvSaisie', params:{pv_id:pv.id}}" class="small-box-footer nav-link px-1">
                                    <button class="btn btn-primary btn-sm">saisie</button>
                                </router-link>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <router-link v-if="gate.isAdmin() || gate.isChef() || gate.isAgent()" :to="{name:'pvsCreate', params:{pv_id:pv.id}}" class="small-box-footer nav-link">
                                            <i class="fa fa-edit"></i>
                                        </router-link>


                                        <a v-if="gate.isAdmin()" class="dropdown-item"  href="" @click.prevent="remove(pv.id)"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </template>
                    <template v-else>
                      <tr v-for="(pv,index) in pvs" :key="pv.id">
                          <td>{{index+1}}</td>
                          <td>{{pv.num_pv}}</td>
                          <td>{{pv.date_pv}}</td>
                            <td>
                                <router-link :to="{name:'commercants', params:{commercant_id:pv.id}}" class="small-box-footer nav-link">
                                    {{pv.commercant.name}}
                                </router-link>
                            </td>
                            <td>{{pv.service.service}}</td>
                          <td>{{pv.user1?pv.user1.name:"/"}}</td>
                          <td>{{pv.user2?pv.user2.name:"/"}}</td>
                          <td>{{pv.user3?pv.user3.name:'/'}}</td>
                          <td>{{pv.created_by}}</td>
                          <td v-if="pv.user3" class="d-flex flex-row justify-content-center">
                                <router-link v-if="gate.isAdmin() || isAgentPv(pv.user1.id,pv.user2.id,pv.user3.id) || isChefPv(pv.user1.service_id,pv.user2.service_id,pv.user3.service_id)" :to="{name:'pvsPrint', params:{pv_id:pv.id}}" class="small-box-footer nav-link px-1">
                                    <button class="btn btn-primary btn-sm">print</button>
                                </router-link>
                                <router-link v-if="gate.isAdmin() || isAgentPv(pv.user1.id,pv.user2.id,pv.user3.id) || isChefPv(pv.user1.service_id,pv.user2.service_id,pv.user3.service_id)" :to="{name:'ordreVerssement', params:{pv_id:pv.id}}" class="small-box-footer nav-link px-1">
                                    <button class="btn btn-primary btn-sm">OV</button>
                                </router-link>
                                <router-link v-if="(gate.isAdmin() || isAgentPv(pv.user1.id,pv.user2.id,pv.user3.id) || isChefPv(pv.user1.service_id,pv.user2.service_id,pv.user3.service_id)) && pv.hasSaisie" :to="{name:'pvSaisie', params:{pv_id:pv.id}}" class="small-box-footer nav-link px-1">
                                    <button class="btn btn-primary btn-sm">saisie</button>
                                </router-link>
                            </td>
                            <td v-else class="d-flex flex-row justify-content-center">
                                <router-link v-if="gate.isAdmin() || isAgentPv(pv.user1.id,pv.user2.id,pv.user3) || isChefPv(pv.user1.service_id,pv.user2.service_id,pv.user3)" :to="{name:'pvsPrint', params:{pv_id:pv.id}}" class="small-box-footer nav-link px-1">
                                    <button class="btn btn-primary btn-sm">print</button>
                                </router-link>
                                <router-link v-if="gate.isAdmin() || isAgentPv(pv.user1.id,pv.user2.id,pv.user3) || isChefPv(pv.user1.service_id,pv.user2.service_id,pv.user3)" :to="{name:'ordreVerssement', params:{pv_id:pv.id}}" class="small-box-footer nav-link px-1">
                                    <button class="btn btn-primary btn-sm">OV</button>
                                </router-link>
                                <router-link v-if="(gate.isAdmin() || isAgentPv(pv.user1.id,pv.user2.id,pv.user3) || isChefPv(pv.user1.service_id,pv.user2.service_id,pv.user3)) && pv.hasSaisie" :to="{name:'pvSaisie', params:{pv_id:pv.id}}" class="small-box-footer nav-link px-1">
                                    <button class="btn btn-primary btn-sm">saisie</button>
                                </router-link>
                            </td>
                        <td>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <router-link v-if="gate.isAdmin() || gate.isChef() || gate.isAgent()" :to="{name:'pvsCreate', params:{pv_id:pv.id}}" class="small-box-footer nav-link">
                                            <i class="fa fa-edit"></i>
                                        </router-link>


                                        <a v-if="gate.isAdmin()" class="dropdown-item"  href="" @click.prevent="remove(pv.id)"><i class="fa fa-trash"></i></a>
                                    </div>
                                </div>
                            </td>
                      </tr>
                    </template>

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <pagination v-if="!is_commercant" :data="pvs" @pagination-change-page="getResults"></pagination>

      <!-- Modal -->
      <div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 v-if="is_edit" class="modal-title" id="exampleModalLabel">تعديل تاجر</h5>
              <h5 v-else class="modal-title" id="exampleModalLabel">إضافة ناجر</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="num_pv">num_pv</label>
                                <input v-if="errors.num_pv" num_pv="text" class="form-control is-invalid" v-model="num_pv" placeholder="النوع">
                                <input v-else num_pv="text" class="form-control" v-model="num_pv" placeholder="النوع">
                                <span v-if="errors.num_pv" class="text-danger">{{errors.num_pv[0]}}</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="date_pv">date_pv</label>
                                <input v-if="errors.date_pv" date_pv="date" class="form-control is-invalid" v-model="date_pv" placeholder="النوع">
                                <input v-else date_pv="date" class="form-control" v-model="date_pv" placeholder="النوع">
                                <span v-if="errors.date_pv" class="text-danger">{{errors.date_pv[0]}}</span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="commercant_id"> commercant</label>
                                <select v-if="errors.commercant_id" name="commercant_id" v-model="commercant_id" class="form-control is-invalid">
                                    <option v-for="commercant in commercants" :key="commercant.id" v-bind:value="commercant.id">{{commercant.name}}</option>
                                </select>
                                <select v-else name="commercant_id" v-model="commercant_id" class="form-control">
                                    <option v-for="commercant in commercants" :key="commercant.id" v-bind:value="commercant.id">{{commercant.name}}</option>
                                </select>
                                <span v-if="errors.commercant_id" class="text-danger">{{errors.commercant_id[0]}}</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="adresse_com_id">adresse </label>
                                <select v-if="errors.adresse_com_id" name="adresse_com_id" v-model="adresse_com_id" class="form-control is-invalid">
                                    <option v-for="adresse_com in adresse_coms" :key="adresse_com.id" v-bind:value="adresse_com.id">{{adresse_com.adresse_com}}</option>
                                </select>
                                <select v-else name="adresse_com_id" v-model="adresse_com_id" class="form-control">
                                    <option v-for="adresse_com in adresse_coms" :key="adresse_com.id" v-bind:value="adresse_com.id">{{adresse_com.adresse_com}}</option>
                                </select>
                                <span v-if="errors.adresse_com_id" class="text-danger">{{errors.adresse_com_id[0]}}</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="activite_com_id">activite </label>
                                <select v-if="errors.activite_com_id" name="activite_com_id" v-model="activite_com_id" class="form-control is-invalid">
                                    <option v-for="activite_com in activite_coms" :key="activite_com.id" v-bind:value="activite_com.id">{{activite_com.activite_id}}</option>
                                </select>
                                <select v-else name="activite_com_id" v-model="activite_com_id" class="form-control">
                                    <option v-for="activite_com in adresse_coms" :key="activite_com.id" v-bind:value="activite_com.id">{{activite_com.activite_id}}</option>
                                </select>
                                <span v-if="errors.activite_com_id" class="text-danger">{{errors.activite_com_id[0]}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="user1"> user1</label>
                                <select v-if="errors.user1" name="user1" v-model="user1" class="form-control is-invalid">
                                    <option v-for="user in users" :key="user.id" v-bind:value="user.id">{{user.name}}</option>
                                </select>
                                <select v-else name="user1" v-model="user1" class="form-control">
                                    <option v-for="user in users" :key="user.id" v-bind:value="user.id">{{user.name}}</option>
                                </select>
                                <span v-if="errors.user1" class="text-danger">{{errors.user1[0]}}</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="user1"> user2</label>
                                <select v-if="errors.user2" name="user2" v-model="user2" class="form-control is-invalid">
                                    <option v-for="user in users" :key="user.id" v-bind:value="user.id">{{user.name}}</option>
                                </select>
                                <select v-else name="user2" v-model="user2" class="form-control">
                                    <option v-for="user in users" :key="user.id" v-bind:value="user.id">{{user.name}}</option>
                                </select>
                                <span v-if="errors.user2" class="text-danger">{{errors.user2[0]}}</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="user3"> user3</label>
                                <select v-if="errors.user3" name="user3" v-model="user3" class="form-control is-invalid">
                                    <option v-for="user in users" :key="user.id" v-bind:value="user.id">{{user.name}}</option>
                                </select>
                                <select v-else name="user3" v-model="user3" class="form-control">
                                    <option v-for="user in users" :key="user.id" v-bind:value="user.id">{{user.name}}</option>
                                </select>
                                <span v-if="errors.user3" class="text-danger">{{errors.user3[0]}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="service_id"> service_id</label>
                                <select v-if="errors.service_id" name="service_id" v-model="service_id" class="form-control is-invalid">
                                    <option v-for="service in services" :key="service.id" v-bind:value="service.id">{{service.service}}</option>
                                </select>
                                <select v-else name="service_id" v-model="service_id" class="form-control">
                                    <option v-for="service in services" :key="service.id" v-bind:value="service.id">{{service.service}}</option>
                                </select>
                                <span v-if="errors.service_id" class="text-danger">{{errors.service_id[0]}}</span>
                            </div>
                        </div>
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
            if(this.$route.params.commercant_id !=undefined){
                axios.get('commercantPvs/'+this.$route.params.commercant_id)
                .then(response  => {
                                    this.pvs=response.data.pvs;
                                    this.commercants=response.data.commercants;
                                    this.adresse_coms=response.data.adresse_coms;
                                    this.activite_coms=response.data.activite_coms;
                                    this.commercant_id=this.$route.params.commercant_id;
                                    this.is_commercant=true;
                                    //console.log(response.data);

                });
            }
            else{
                this.is_commercant=false;
                this.getResults();
            }
        },

        data(){
            return {
                'num_pv':'',
                'date_pv':'',
                'commercant_id':'',
                'adresse_com_id':'',
                'activite_com_id':'',
                'user1':'',
                'user2':'',
                'user3':'',
                'service_id':'',
                'date_conv':'',
                'num_conv':'',
                'date_constat':'',
                'created_by':'',
                'id_update':'',
                pvs:{},
                commercants:{},
                adresse_coms:{},
                activite_coms:{},
                services:{},
                users:{},
                errors:[],
                'is_edit':false,
                'is_commercant':false,
                'search':'',
            }
        },
        methods:{
            getResults(page = 1) {
                    axios.get('pvs?page=' + page)
                    .then(response => {
                        this.commercants = response.data.commercants;
                        this.pvs = response.data.pvs;
                        this.adresse_coms = response.data.adresse_coms;
                        this.activite_coms = response.data.activite_coms;
                        this.services = response.data.services;
                        this.users = response.data.users;
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
                    axios.delete('pvs/'+id)
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
            edit:function(pv){
                this.errors=[];
                this.is_edit=true;
                this.num_pv=pv.num_pv;
                this.date_pv=pv.date_pv;
                this.commercant_id=pv.commercant_id;
                this.adresse_com_id=pv.adresse_com_id;
                this.activite_com_id=pv.activite_com_id;
                this.user1=pv.user1;
                this.user2=pv.user2;
                this.user3=pv.user3;
                this.service_id=pv.service_id;
                this.date_constat=pv.date_constat;
                this.num_conv=pv.num_conv;
                this.date_conv=pv.date_conv;
                this.created_by=pv.created_by
                this.id_update=pv.id;

                axios.get("pvs/"+pv.id+"/edit")
                .then((response)=>{

                });
            },
            creating:function(){
                this.is_edit=false;
                this.initialize();

            },
            initialize:function(){
                this.num_pv='';
                this.date_pv='';
                this.commercant_id='';
                this.adresse_com_id='';
                this.activite_com_id='';
                this.user1='';
                this.user2='';
                this.user3='';
                this.service_id='';
                this.date_conv='';
                this.num_conv='';
                this.date_constat='';
                this.created_by='';
            },
            update:function(){
                axios.put('pvs/'+this.id_update,
              {'num_pv':this.num_pv, 'date_pv':this.date_pv, 'commercant_id':this.commercant_id,
               'adresse_com_id':this.adresse_com_id, 'activite_com_id':this.activite_com_id, 'user1':this.user1,
               'user2':this.user2, 'user3':this.user3,'service_id' :this.service_id, 'date_conv':this.date_conv,
               'num_conv':this.num_conv, 'date_constat':this.date_constat})
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
                  this.initialize();
            },
            index:function(){
                axios.get('pvs')
                .then((resource) =>{
                    this.commercants = response.data.commercants;
                    this.pvs = response.data.pvs;
                    this.adresse_coms = response.data.adresse_coms;
                    this.activite_coms = response.data.activite_coms;
                    this.services = response.data.services;
                    this.users = response.data.users;
                    })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            create:function(){
              axios.post('pvs',
              {'num_pv':this.num_pv, 'date_pv':this.date_pv, 'commercant_id':this.commercant_id,
               'adresse_com_id':this.adresse_com_id, 'activite_com_id':this.activite_com_id, 'user1':this.user1,
               'user2':this.user2, 'user3':this.user3,'service_id' :this.service_id, 'date_conv':this.date_conv,
               'num_conv':this.num_conv, 'date_constat':this.date_constat})
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
              this.initialize();
            },
            searching:function(){
                if(!this.search){
                    this.index()
                }else{
                    axios.get('pvs/search/'+this.search
                    , { headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' }})
                    .then((response)=>{
                        this.pvs=response.data
                })
                }

            },
            isAgentPv(u1,u2,u3) {
                return window.user.id==u1 || window.user.id==u2 || window.user.id==u3
            },
            isChefPv(users,u1,u2,u3) {
                if(window.user.role=="Chef"){
                    if (window.user.service_id==u1 || window.user.service_id==u2 || window.user.service_id==u3) {
                       return true;
                    }
                }

                return false;
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
