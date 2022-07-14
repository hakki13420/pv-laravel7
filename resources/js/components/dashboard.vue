<template>
    <div class="container">
        <section class="content mt-4">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{nbAllPlaintes}}</h3>
                                <p>كل الشكاوي</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <router-link  :to="{name:'admin.plaintes'}" class="small-box-footer nav-link">
                                <span class="text-white">تفاصيل أكثر</span> <i class="fas fa-arrow-circle-right"></i>
                            </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{nbNewPlaintes}}</h3>

                            <p>الشكاوي الجديدة</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-bell"></i>
                        </div>
                        <router-link  :to="{name:'admin.plaintes',params:{confirmed:0}}" class="small-box-footer nav-link">
                            <span class="text-white">تفاصيل أكثر</span> <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{nbPlaintesEnCours}}</h3>

                            <p>شكاوي في طور التحقيق</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-spinner"></i>
                        </div>
                        <router-link  :to="{name:'admin.plaintes',params:{etat_plainte_id:2}}" class="small-box-footer nav-link">
                            <span class="text-white">تفاصيل أكثر</span> <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{nbClosePlaintes}}</h3>

                            <p>الشكاوي المغلقة</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-list-alt"></i>
                        </div>
                        <router-link  :to="{name:'admin.plaintes',params:{etat_plainte_id:3}}" class="small-box-footer nav-link">
                            <span class="text-white">تفاصيل أكثر</span> <i class="fas fa-arrow-circle-right"></i>
                        </router-link>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>

            </div><!-- /.container-fluid -->
        </section>
        <template v-if="gate.isAdmin()">
            <div class="row">
                <div class="col-lg-6 col-6">
                    <admin-graph v-if="existdata" :dataChart="datachart" :labelsChart="labelschart" :graph_title="title_title_plaintes_services" :step="1"></admin-graph>
                </div>
                <div class="col-lg-6 col-6">
                    <admin-graph v-if="existdataR" :dataChart="datachartR" :labelsChart="labelschartR" :graph_title="title_title_plaintes_resultats" :step="2"></admin-graph>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-6">
                    <admin-graph v-if="existdataS" :dataChart="datachartS" :labelsChart="labelschartS" :graph_title="title_title_plaintes_specialites" :step="3"></admin-graph>
                </div>
                <div class="col-lg-6 col-6">
                    <admin-graph v-if="existdataC" :dataChart="datachartC" :labelsChart="labelschartC" :graph_title="title_title_plaintes_communes" :step="4"></admin-graph>
                </div>
            </div>
        </template>
        <template v-else-if="gate.isChef()">
            <div class="row">
                <div class="col-lg-6 col-6">
                    <admin-graph v-if="chef_existdata" :dataChart="chef_datachart" :labelsChart="chef_labelschart" :graph_title="title_title_plaintes_brigades" :step="1"></admin-graph>
                </div>
                <div class="col-lg-6 col-6">
                    <admin-graph v-if="chef_existdataR" :dataChart="chef_datachartR" :labelsChart="chef_labelschartR" :graph_title="title_title_plaintes_resultats" :step="2"></admin-graph>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-6">
                    <admin-graph v-if="chef_existdataS" :dataChart="chef_datachartS" :labelsChart="chef_labelschartS" :graph_title="title_title_plaintes_specialites" :step="3"></admin-graph>
                </div>
                <div class="col-lg-6 col-6">
                    <admin-graph v-if="chef_existdataC" :dataChart="chef_datachartC" :labelsChart="chef_labelschartC" :graph_title="title_title_plaintes_communes" :step="4"></admin-graph>
                </div>
            </div>
        </template>
        <template v-else-if="gate.isAgent()">
            <div class="row">
                <div class="col-lg-6 col-6">
                    <admin-graph v-if="agent_existdataR" :dataChart="agent_datachartR" :labelsChart="agent_labelschartR" :graph_title="title_title_plaintes_resultats" :step="2"></admin-graph>
                </div>
                <div class="col-lg-6 col-6">
                    <admin-graph v-if="agent_existdataS" :dataChart="agent_datachartS" :labelsChart="agent_labelschartS" :graph_title="title_title_plaintes_specialites" :step="3"></admin-graph>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-6">
                    <admin-graph v-if="agent_existdataC" :dataChart="agent_datachartC" :labelsChart="agent_labelschartC" :graph_title="title_title_plaintes_communes" :step="4"></admin-graph>
                </div>
            </div>
        </template>
    </div>

</template>

<script>
import AdminGraph from './graphs/adminGraph.vue';

    export default {
        name: 'dashboard',
        components: {
            AdminGraph,
        },
        mounted() {

                //AdminGraph //console.log('Component mounted.');
            this.getAdminData();
            this.index();
        },
        watch:{
            datachart: function (newQuestion, oldQuestion) {
                this.existdata=true;
                //this.existdata=true;
            },
            datachartR: function (newQuestion, oldQuestion) {
                this.existdataR=true;
            },
            datachartS: function (newQuestion, oldQuestion) {
                this.existdataS=true;
            },
            datachartC: function (newQuestion, oldQuestion) {
                this.existdataC=true;
            },

            chef_datachart: function (newQuestion, oldQuestion) {
                //this.existdata=true;
                this.chef_existdata=true;
            },
            chef_datachartR: function (newQuestion, oldQuestion) {
                //this.existdata=true;
                this.chef_existdataR=true;
            },
            chef_datachartS: function (newQuestion, oldQuestion) {
                //this.existdata=true;
                this.chef_existdataS=true;
            },
            chef_datachartC: function (newQuestion, oldQuestion) {
                //this.existdata=true;
                this.chef_existdataC=true;
            },

            agent_datachart: function (newQuestion, oldQuestion) {
                //this.existdata=true;
                this.agent_existdata=true;
            },
            agent_datachartR: function (newQuestion, oldQuestion) {
                //this.existdata=true;
                this.agent_existdataR=true;
            },
            agent_datachartS: function (newQuestion, oldQuestion) {
                //this.existdata=true;
                this.agent_existdataS=true;
            },
            agent_datachartC: function (newQuestion, oldQuestion) {
                //this.existdata=true;
                this.agent_existdataC=true;
            },
        },

        props:[],


        data(){
            return {
                'nbNewPlaintes':'',
                'nbPlaintesEnCours':'',
                'nbClosePlaintes':'',
                'nbAllPlaintes':'',
                'existdata':false,
                'existdataR':false,
                'existdataS':false,
                'existdataC':false,

                'chef_existdata':false,
                'chef_existdataR':false,
                'chef_existdataS':false,
                'chef_existdataC':false,

                'agent_existdata':false,
                'agent_existdataR':false,
                'agent_existdataS':false,
                'agent_existdataC':false,

                'title_title_plaintes_services':'الشكاوي حسب المصالح',
                'title_title_plaintes_resultats':'الشكاوي حسب النتائج',
                'title_title_plaintes_specialites':'الشكاوي حسب الإختصاص',
                'title_title_plaintes_communes':'الشكاوي حسب البلديات',

                'title_title_plaintes_brigades':'الشكاوي حسب فرق التحقيق',
                 plaintes:{},
                 services:{},
                 resultats:{},
                 specialites:{},
                 communes:{},
                 brigades:{},
                 errors:[],

                 datachart:[] ,  //data pour requete  par services
                 labelschart: [], //data pour requete  par services
                 datachartR:[] , //data pour requete  par resultats
                 labelschartR: [],  //data pour requete  par resultats
                 datachartS:[] ,  //data pour requete  par specialites
                 labelschartS: [],  //data pour requete  par specialites
                 datachartC:[] ,  //data pour requete  par specialites
                 labelschartC: [],  //data pour requete  par specialites

                 chef_datachart:[] ,  //data pour requete  par services
                 chef_labelschart: [], //data pour requete  par service
                 chef_datachartR:[] , //data pour requete  par resultats
                 chef_labelschartR: [],  //data pour requete  par resultats
                 chef_datachartS:[] ,  //data pour requete  par specialites
                 chef_labelschartS: [],  //data pour requete  par specialites
                 chef_datachartC:[] ,  //data pour requete  par specialites
                 chef_labelschartC: [],  //data pour requete  par specialit

                 agent_datachart:[] ,  //data pour requete  par services
                 agent_labelschart: [], //data pour requete  par service
                 agent_datachartR:[] , //data pour requete  par resultats
                 agent_labelschartR: [],  //data pour requete  par resultats
                 agent_datachartS:[] ,  //data pour requete  par specialites
                 agent_labelschartS: [],  //data pour requete  par specialites
                 agent_datachartC:[] ,  //data pour requete  par specialites
                 agent_labelschartC: [],  //data pour requete  par specialit
            }
        },
        methods:{

            index:function(){
                if(this.gate.isAdmin()){
                    axios.get('admin/dashboard')
                    .then((response) => {
                        this.nbNewPlaintes=response.data.nbNewPlaintes;
                        this.nbPlaintesEnCours=response.data.nbPlaintesEnCours;
                        this.nbClosePlaintes=response.data.nbClosePlaintes;
                        this.nbAllPlaintes=response.data.nbAllPlaintes;

                        this.services=response.data.services;
                        this.resultats=response.data.resultats;
                        this.specialites=response.data.specialites;
                        this.communes=response.data.communes;

                        this.labelschart=[];
                        this.datachart=[];
                        this.services.forEach(element => {
                            this.labelschart.push(element.service);
                            this.datachart.push(element.plainte_count);
                        });

                        this.labelschartR=[];
                        this.datachartR=[];
                        this.resultats.forEach(element => {
                            this.labelschartR.push(element.resultat);
                            this.datachartR.push(element.plainte_count);
                        });

                        this.labelschartS=[];
                        this.datachartS=[];
                        this.specialites.forEach(element => {
                            this.labelschartS.push(element.specialite);
                            this.datachartS.push(element.plainte_count);
                        });

                        this.labelschartC=[];
                        this.datachartC=[];
                        this.communes.forEach(element => {
                            this.labelschartC.push(element.commune);
                            this.datachartC.push(element.plainte_count);
                        });

                    })
                    .catch((error)=> this.errors=error.response.data.errors)
                }else if(this.gate.isChef()){
                    this.existdata=false;
                    this.existdataR=false;
                    this.existdataC=false;
                    this.existdataS=false;
                    axios.get('admin/dashboard')
                    .then((response) => {
                        //console.log(response);
                        this.nbNewPlaintes=response.data.nbNewPlaintes;
                        this.nbPlaintesEnCours=response.data.nbPlaintesEnCours;
                        this.nbClosePlaintes=response.data.nbClosePlaintes;
                        this.nbAllPlaintes=response.data.nbAllPlaintes;

                        this.brigades=response.data.brigades;
                        this.resultats=response.data.resultats;
                        this.specialites=response.data.specialites;
                        this.communes=response.data.communes;

                        this.chef_labelschart=[];
                        this.chef_datachart=[];
                        this.brigades.forEach(element => {
                            this.chef_labelschart.push(element.name);
                            this.chef_datachart.push(element.plainte_count);
                        });

                        this.chef_labelschartR=[];
                        this.chef_datachartR=[];
                        this.resultats.forEach(element => {
                            this.chef_labelschartR.push(element.resultat);
                            this.chef_datachartR.push(element.plainte_count);
                        });

                        this.chef_labelschartS=[];
                        this.chef_datachartS=[];
                        this.specialites.forEach(element => {
                            this.chef_labelschartS.push(element.specialite);
                            this.chef_datachartS.push(element.plainte_count);
                        });

                        this.chef_labelschartC=[];
                        this.chef_datachartC=[];
                        this.communes.forEach(element => {
                            this.chef_labelschartC.push(element.commune);
                            this.chef_datachartC.push(element.plainte_count);
                        });

                        })
                    .catch((error)=> this.errors=error.response.data.errors)
                }else if(this.gate.isAgent()){
                    axios.get('admin/dashboard')
                    .then((response) => {
                        //console.log(response);
                        this.nbNewPlaintes=response.data.nbNewPlaintes;
                        this.nbPlaintesEnCours=response.data.nbPlaintesEnCours;
                        this.nbClosePlaintes=response.data.nbClosePlaintes;
                        this.nbAllPlaintes=response.data.nbAllPlaintes;

                        //this.brigades=response.data.brigades;
                        this.resultats=response.data.resultats;
                        this.specialites=response.data.specialites;
                        this.communes=response.data.communes;

                        /* this.labelschart=[];
                        this.datachart=[];
                        this.brigades.forEach(element => {
                            this.labelschart.push(element.name);
                            this.datachart.push(element.plainte_count);
                        }); */

                        this.agent_labelschartR=[];
                        this.agent_datachartR=[];
                        this.resultats.forEach(element => {
                            this.agent_labelschartR.push(element.resultat);
                            this.agent_datachartR.push(element.plainte_count);
                        });

                        this.agent_labelschartS=[];
                        this.agent_datachartS=[];
                        this.specialites.forEach(element => {
                            this.agent_labelschartS.push(element.specialite);
                            this.agent_datachartS.push(element.plainte_count);
                        });

                        this.agent_labelschartC=[];
                        this.agent_datachartC=[];
                        this.communes.forEach(element => {
                            this.agent_labelschartC.push(element.commune);
                            this.agent_datachartC.push(element.plainte_count);
                        });

                        })
                    .catch((error)=> this.errors=error.response.data.errors)
                }
            },
            getAdminData:function(){
                axios.get('admin/admin.graphs')
                .then((response) => {
                    //console.log(response);
                    this.services=response.data.services;
                    this.labelschart=[];
                    this.datachart=[];
                    let i=0;
                    this.services.forEach(element => {
                       this.labelschart.push(element.service);
                       this.datachart.push(element.plainte_count);
                    });
                    console.log(this.datachart);
                    })
                .catch((error)=> this.errors=error.response.data.errors)
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
<style>
    .btn-menu{
        border-radius: 0;
    }
</style>
