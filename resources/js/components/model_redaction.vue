<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">أنماط التحرير</h3>
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
                      <th>المخالفة</th>
                      <th>العنوان</th>
                      <th>النمط </th>
                      <th>أضيفت من طرف</th>
                      <th>الخيارات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(model_redaction,index) in model_redactions" :key="model_redaction.id">
                      <td>{{index+1}}</td>
                      <td>{{model_redaction.infraction.libelle}}</td>
                      <td>{{model_redaction.title}}</td>
                      <td>{{model_redaction.model}}</td>

                      <td>{{model_redaction.created_by}}</td>
                      <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a v-if="gate.isAdmin() || gate.isChef() || gate.isAgent()" class="dropdown-item"  href="" @click.prevent="edit(model_redaction)"><i class="fa fa-edit"></i></a>
                                <a v-if="gate.isAdmin()" class="dropdown-item"  href="" @click.prevent="remove(model_redaction.id)"><i class="fa fa-trash"></i></a>
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



      <!-- Modal CRUD -->
      <div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 v-if="is_edit" class="modal-title" id="exampleModalLabel">تعديل نمودج</h5>
              <h5 v-else class="modal-title" id="exampleModalLabel">إضافة نمودج</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form>

                    <div class="form-group">
                        <label for="infraction_id"> المخالفة</label>
                        <select v-if="errors.infraction_id" name="infraction_id" v-model="infraction_id" class="form-control is-invalid">
                            <option v-for="infraction in infractions" :key="infraction.id" v-bind:value="infraction.id">{{infraction.libelle}}</option>
                        </select>
                        <select v-else name="infraction_id" v-model="infraction_id" class="form-control">
                            <option v-for="infraction in infractions" :key="infraction.id" v-bind:value="infraction.id">{{infraction.libelle}}</option>
                        </select>
                        <span v-if="errors.infraction_id" class="text-danger">{{errors.infraction_id[0]}}</span>
                    </div>
                    <div class="form-group">
                        <label for="title">عنوان</label>
                        <input v-if="errors.title" type="text" name="title" v-model="title" class="is-invalid form-control" placeholder="عنوان" required>
                        <input v-else type="text" name="title" v-model="title" class="form-control" placeholder="عنوان">
                        <span v-if="errors.title" class="text-danger">{{errors.title[0]}}</span>
                    </div>

                    <div class="form-group">
                      <label for="model">نمودج التحرير</label>
                      <textarea  v-if="errors.model" class="form-control is-invalid" v-model="model" cols="30" rows="20" required></textarea>
                      <textarea  v-else class="form-control" v-model="model" cols="30" rows="20"></textarea>
                      <span v-if="errors.model" class="text-danger">{{errors.model[0]}}</span>
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
            if(this.$route.params.infraction_id==undefined){
              window.location.replace("./home#/infractions");
            }else{
              this.infraction_id=this.$route.params.infraction_id;
              //this.model_redactions=this.$route.params.model_redactions;
              this.getResults();
            }
        },
        props:[],
        watch:{


        },
        data(){
            return {
                'infraction_id':'',
                'title':'',
                'model':'',
                'created_by':'',
                'id_update':'',
                infractions:{},
                model_redactions:{},
                errors:[],
                'is_edit':false,
                'search':'',
            }
        },
        methods:{
            getResults() {
                axios.get('modelRedactionInf/' + this.infraction_id)
                .then(response => {
                    this.infractions = response.data.infractions;
                    this.model_redactions = response.data.model_redactions;
                    //this.model_redactions=this.$route.params.model_redactions;
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
                    axios.delete('modelRedaction/'+id)
                    .then((response)=>{
                        //this.getResults();
                        Swal.fire(
                        'Deleted!',
                        'commune has been deleted.',
                        'success'
                        )
                        window.location.replace("./home#/infractions");
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
            edit:function(model_infraction){
                this.errors=[];
                this.is_edit=true;
                this.infraction_id=model_infraction.infraction_id;
                this.title=model_infraction.title;
                this.model=model_infraction.model;
                this.created_by=model_infraction.created_by
                this.id_update=model_infraction.id;

                $('#CreateModal').modal('show');
            },
            creating:function(){
                this.is_edit=false;
                this.initialize();

            },
            initialize:function(){
                this.model='';
                this.title="";
                //this.commercant_id='';
                this.created_by='';
            },
            update:function(){
                axios.put('modelRedaction/'+this.id_update,
              {'infraction_id':this.infraction_id,'title':this.title,'model':this.model})
                .then((response)=> {
                    this.$Progress.start()
                    $('#CreateModal').modal('hide');
                    //this.getResults();
                    this.showMessage("updated successfully","success");
                    this.$Progress.finish()
                    window.location.replace("./home#/infractions");
                })
                .catch((error)=> {
                    this.errors=error.response.data.errors
                    this.$Progress.fail()
                    });
                //this.initialize();

            },
            index:function(){
                axios.get('modelRedaction/'+this.infraction_id)
                .then((resource) =>{
                    this.model_redactions=resource.data.model_redactions;
                    this.infractions = response.data.infractions;
                })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            create:function(){
              axios.post('modelRedaction',
              {'infraction_id':this.infraction_id, 'title':this.title,'model':this.model})
              .then((response)=>{
                    this.$Progress.start()
                    $('#CreateModal').modal('hide');
                    //this.getResults();
                    this.showMessage("created successfully","success");
                    this.$Progress.finish()
                    window.location.replace("./home#/infractions");
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
                    axios.get('modelRedaction/search/'+this.search
                    , { headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' }})
                    .then((response)=>{
                    this.model_redactions=response.data.model_redactions
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
