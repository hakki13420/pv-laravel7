<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">النشاطات الممارسة</h3>
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
                      <th>رمز النشاط</th>
                      <th>تسمية النشاط</th>
                      <th>أضيفت من طرف</th>
                      <th>الخيارات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(activite_com,index) in activite_coms" :key="activite_com.id">
                      <td>{{index+1}}</td>
                      <td>{{activite_com.commercant_id}}</td>
                      <td>{{activite_com.activite_id}}</td>
                      <td>{{activite_com.libelle}}</td>

                      <td>{{activite_com.created_by}}</td>
                      <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a v-if="gate.isAdmin() || gate.isChef() || gate.isAgent()" class="dropdown-item"  href="" @click.prevent="edit(activite_com)"><i class="fa fa-edit"></i></a>
                                <a v-if="gate.isAdmin()" class="dropdown-item"  href="" @click.prevent="remove(activite_com.id)"><i class="fa fa-trash"></i></a>
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
        <div class="modal-dialog">
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
                      <label for="activite_id"> النشاط</label>
                        <select v-if="errors.activite_id" name="activite_id" v-model="activite_id" class="form-control is-invalid text-wrap">
                          <option v-for="activite in activites" :key="activite.id" v-bind:value="activite.id">{{activite.libelle}}</option>
                        </select>
                        <select v-else name="activite_id" v-model="activite_id" class="form-control text-wrap">
                          <option v-for="activite in activites" :key="activite.id" v-bind:value="activite.id">{{activite.libelle}}</option>
                        </select>
                      <span v-if="errors.activite_id" class="text-danger">{{errors.activite_id[0]}}</span>
                    </div>


                    <div class="form-group">
                      <label for="commercant_id">التاجر</label>
                      <input v-if="errors.commercant_id" type="email" class="form-control is-invalid" v-model="commercant_id" placeholder="التاجر">
                      <input v-else type="text" class="form-control" v-model="commercant_id" placeholder="التاجر">
                      <span v-if="errors.commercant_id" class="text-danger">{{errors.commercant_id[0]}}</span>
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
              window.location.replace("home#/commercants");
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
                'activite_id':'',
                'libelle':'',
                'commercant_id':'',
                'created_by':'',
                'id_update':'',
                activite_coms:{},
                commercant:{},
                activites:{},
                errors:[],
                'is_edit':false,
                'search':'',
            }
        },
        methods:{
            getResults() {
                axios.get('activitesCom/' + this.commercant_id)
                .then(response => {
                    this.activite_coms = response.data.activite_coms;
                    this.commercant = response.data.commercant;
                    this.activites = response.data.activites;
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
                    axios.delete('activitescom/'+id)
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
            edit:function(activite_com){
                this.errors=[];
                this.is_edit=true;
                this.activite_id=activite_com.activite_id;
                this.libelle=activite_com.libelle;
                this.commercant_id=activite_com.commercant_id;
                this.created_by=activite_com.created_by
                this.id_update=activite_com.id;

                $('#CreateModal').modal('show');
            },
            creating:function(){
                this.is_edit=false;
                this.initialize();

            },
            initialize:function(){
                this.activite_id='';
                this.libelle='';
                this.created_by='';
            },
            update:function(){
                this.libelle=this.activites.find((element)=> element.id=this.activite_id).libelle;
                axios.put('activitescom/'+this.id_update,
              {'activite_id':this.activite_id, 'commercant_id':this.commercant_id,'libelle':this.libelle})
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
                axios.get('activitescom/'+this.commercant_id)
                .then((resource) =>{
                    this.activite_coms=resource.data.activite_coms;
                    this.commercant = response.data.commercant;
                    this.activites = response.data.activites;
                })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            create:function(){
              this.libelle=this.activites.find((element)=> element.id=this.activite_id).libelle;
              axios.post('activitescom',
              {'activite_id':this.activite_id, 'commercant_id':this.commercant_id,'libelle':this.libelle})
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
                    axios.get('activitescom/search?q='+this.search
                    , { headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' }})
                    .then((response)=>{
                    this.activite_coms=response.data
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
<style scoped>

    select option {
        font-size: 11px;
    }
</style>
