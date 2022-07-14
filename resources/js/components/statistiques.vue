<template>
    <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">الإحصائيات</h3>
                <div class="card-tools">

                  <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#between" role="tab" aria-controls="between" aria-selected="true">من - إلى</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#service" role="tab" aria-controls="service" aria-selected="false">حسب المصالح</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#operateur" role="tab" aria-controls="operateur" aria-selected="false">حسب التجار</a>
                    </li>
                    <li class="nav-item" role="presentation">
                      <a class="nav-link" id="contact-tab" data-toggle="tab" href="#all" role="tab" aria-controls="all" aria-selected="false">كل المحاضر</a>
                    </li>
                  </ul>

                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="between" role="tabpanel" aria-labelledby="home-tab">
                      <div class="col-8">
                        <form>
                          <div class="row mt-4">
                            <div class="col-6">
                              <div class="form-group">
                                <label for="date1">تاريخ البداية</label>
                                <input v-if="errors.date1" type="date" v-model="date1" class="form-control is-invalid" placeholder="تاريخ البداية">
                                <input v-else type="date" v-model="date1" class="form-control" placeholder="تاريخ البداية">
                                <span v-if="errors.date1" class="text-danger">{{errors.date1[0]}}</span>
                              </div>
                            </div>
                            <div class="col-6">
                              <div class="form-group">
                                <label for="date2">تاريخ النهاية</label>
                                <input v-if="errors.date2" type="date" v-model="date2" class="form-control is-invalid" placeholder="تاريخ النهاية">
                                <input v-else type="date" v-model="date2" class="form-control" placeholder="تاريخ النهاية">
                                <span v-if="errors.date2" class="text-danger">{{errors.date2[0]}}</span>
                              </div>
                            </div>
                        </div>

                        <div class="form-group">
                          <div class="input-group-append">
                            <button  @click.prevent="between" class="btn btn-primary btn-sm btn-block">
                              البحث
                            </button>

                          </div>
                        </div>
                        </form>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="service" role="tabpanel" aria-labelledby="profile-tab">
                      <div class="col-6 mt-4">
                        <form>
                          <div class="form-group">
                              <label for="service">المصلحة</label>
                              <select v-if="errors.service" class="form-control is-invalid" v-model="service_id">
                            <option v-for="service in services" :key="service.id" :value="service.id">{{service.service}}</option>
                              </select>
                              <select v-else class="form-control" v-model="service_id">
                            <option v-for="service in services" :key="service.id" :value="service.id">{{service.service}}</option>
                              </select>
                              <span v-if="errors.service" class="text-danger">{{errors.service[0]}}</span>
                          </div>
                          <div class="form-group">
                          <div class="input-group-append">
                            <button  @click.prevent="statistiqueService" class="btn btn-primary btn-sm btn-block">
                              البحث
                            </button>
                          </div>
                          </div>
                        </form>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="operateur" role="tabpanel" aria-labelledby="home-tab">
                      <div class="col-8">
                        <form>
                          <div class="row mt-4">
                            <div class="col-8">
                              <div class="form-group">
                                <label for="searchData">الاسم أو التسمية الإجتماعية أو رقم السجل التجاري</label>
                                <input v-if="errors.searchData" type="text" v-model="searchData" class="form-control is-invalid">
                                <input v-else type="text" v-model="searchData" class="form-control">
                                <span v-if="errors.searchData" class="text-danger">{{errors.searchData[0]}}</span>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                              <div class="col-8">
                                <div class="form-group">
                                <div class="input-group-append">
                                    <button  @click.prevent="statistiqueOperateur" class="btn btn-primary btn-sm btn-block">
                                    البحث
                                    </button>
                                </div>
                                </div>
                              </div>
                           </div>
                        </form>
                      </div>
                    </div>
                    <div class="tab-pane fade" id="all" role="tabpanel" aria-labelledby="contact-tab">
                      <div class="col-4">
                        <form>
                          <div class="form-group mt-3">
                            <div class="input-group-append">
                              <button  @click.prevent="index" class="btn btn-primary btn-sm btn-block">
                                البحث
                              </button>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table v-if="gate.isAdmin() || gate.isChef() || gate.isAgent() || gate.isInvite()" class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>الرقم</th>
                      <th>تاريخ المحضر </th>
                      <th>رفم المحضر</th>
                      <th>التاجر</th>
                      <th>المصلحة</th>
                      <th>المخالفة</th>
                      <th>العون1</th>
                      <th>العون2</th>
                      <th>العون3</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(statistique,index) in statistiques.data" :key="statistique.id">
                      <td>{{index+1}}</td>
                      <td>{{statistique.date_pv}}</td>
                      <td>{{statistique.num_pv}}</td>
                      <td>{{statistique.commercant.rais_soc!="/"?statistique.commercant.rais_soc:statistique.commercant.name}}</td>
                      <td>{{statistique.service.service}}</td>
                      <td><div v-for="infraction in statistique.infractions" :key="infraction.id">{{infraction.libelle}}</div></td>
                      <td>{{statistique.user1.name}}</td>
                      <td>{{statistique.user2.name}}</td>
                      <td>{{statistique.user3?statistique.user3.name:"/"}}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <pagination :data="statistiques" @pagination-change-page="getResults"></pagination>


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
            this.id=this.$route.params.id;;
        },
        props:[],
        watch:{
            clicking: function (newQuestion, oldQuestion) {
                this.getResults();
            }

        },
        data(){
            return {
                'date1':'',
                'date2':'',
                'service_id':'',
                'searchData':'',
                statistiques:{},
                services:{},
                errors:[],
                'is_edit':false,
                'search':'',
            }
        },
        methods:{
            getResults(page = 1) {

                    axios.get('statistiques?page=' + page)
                    .then(response => {
                    // console.log(response);
                    this.statistiques = response.data.statistiques;
                    this.services = response.data.services;
                });

            },
            edit:function(){


                $('#CreateModal').modal('show');
            },
            index:function(){
                axios.get('statistiques')
                .then((response) => {
                    //console.log(response);
                    this.statistiques=response.data.statistiques
                    this.services=response.data.services
                    })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            between:function(){
                axios.post('statistiques.between',{
                  'date1':this.date1, 'date2':this.date2
                })
                .then((response) => {
                    //console.log(response);
                    this.statistiques=response.data.statistiques
                  })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            exporter:function(){
                axios.post('statistiques/exporter/excel',{
                  'statistiques':this.statistiques
                })
                .then((response) => {
                    console.log('edxport reussi');
                    //this.statistiques=response.data.statistiques
                  })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            statistiqueService:function(){
                axios.post('statistiques.service',{
                  'service':this.service_id
                })
                .then((response) => {
                    //console.log(response);
                    this.statistiques=response.data.statistiques
                    this.services=response.data.services
                  })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            searching:function(){

            },
            statistiqueOperateur:function(){
                axios.post('statistiques.operateur',{
                  'searchData':this.searchData
                })
                .then((response) => {
                    //console.log(response);
                    this.statistiques=response.data.statistiques
                    this.services=response.data.services
                  })
                .catch((error)=> this.errors=error.response.data.errors)
            },
            searching:function(){

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
