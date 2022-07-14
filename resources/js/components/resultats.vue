<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">نتائج التحقيق في الشكاوي</h3>
                <div class="card-tools d-flex">
                  <div class="input-group input-group-sm" style="width: 450px;">
                    <input type="text" @keyup.enter="searching" v-model="search" class="form-control float-right" placeholder="Search">

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
                <table v-if="gate.isAdmin()" class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>الرقم</th>
                      <th>نتيجة التحقيق</th>
                      <th>المسجل</th>
                      <th>الخيارات</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(resultat,index) in resultats.data" :key="resultat.id">
                      <td>{{index+1}}</td>
                      <td>{{resultat.resultat}}</td>
                      <td>{{resultat.created_by}}</td>
                      <td>
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">
                                <i class="fas fa-bars"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" v-if="gate.isAdmin()" href="" @click.prevent="edit(resultat)"><i class="fa fa-edit"></i></a>
                                <a class="dropdown-item" v-if="gate.isAdmin()" href="" @click.prevent="remove(resultat.id)"><i class="fa fa-trash"></i></a>
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

        <pagination :data="resultats" @pagination-change-page="getResults"></pagination>

      <!-- Modal -->
      <div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header bg-primary">
              <h5 v-if="is_edit" class="modal-title" id="exampleModalLabel">تعدبل نتيجة تحقيق</h5>
              <h5 v-else class="modal-title" id="exampleModalLabel">إضافة نتيجة تحقيق</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                      <label for="resultat">تسمية النتيجة</label>
                      <input v-if="errors.resultat" type="text" class="form-control is-invalid" v-model="resultat" placeholder="التسمية">
                      <input v-else type="text" class="form-control" v-model="resultat" placeholder="التسمية">
                      <span v-if="errors.resultat" class="text-danger">{{errors.resultat[0]}}</span>
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
        props:[],
        watch:{


        },
        data(){
            return {
                'resultat':'',
                'id_update':'',
                resultats:{},
                errors:[],
                'is_edit':false,
                'search':'',
            }
        },
        methods:{
            getResults(page = 1) {
                axios.get('admin/resultats?page=' + page)
                .then(response => {
            //        console.log(response);
                    this.resultats = response.data;
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
                    axios.delete('admin/resultats/'+id)
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
            edit:function(resultat){
                this.errors=[];
                this.is_edit=true;
                this.resultat=resultat.resultat;
                this.id_update=resultat.id;

                $('#CreateModal').modal('show');
            },
            creating:function(){
                this.is_edit=false;
                this.resultat='';

            },
            update:function(){
                axios.put('admin/resultats/'+this.id_update,{'resultat':this.resultat})
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
                  //this.resultat='';

            },
            index:function(){
                axios.get('admin/resultats')
                .then((response) => {
                    //console.log(response);
                    this.resultats=response.data
                    })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            create:function(){
              axios.post('admin/resultats',{'resultat':this.resultat})
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
              //this.resultat='';
            },
            searching:function(){
                if(!this.search){
                    this.index()
                }else{
                    axios.get('admin/resultats/search?q='+this.search
                    , { headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' }})
                    .then((response)=>(this.resultats=response.data))
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
