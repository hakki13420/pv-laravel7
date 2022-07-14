<template>
    <div v-if="pvdata" dir="rtl" id="pv-content">
       <div class="page-1">
           <a @click.prevent="printPv" class="btn btn-primary float-right text-white">طباعة</a>
           <div class="text-center">
                <div class="header">
                    <h3>الجمهوريـــة الجزائريـــة الدموقراطيـــة الشعبيـــة</h3>
                </div>
                <div class="qrcode float-right">
                    <qrcode-vue :value="value" :size="size" level="H"></qrcode-vue>
                </div>
                <div class="header clear">
                    <h4 class="mb-2">محضر معاينة المخالفة المتعلقة بالممارسات التجارية</h4>
                </div>

                <div class="header text-reg">
                    <div>(القانون رقم 04-02 المؤرخ في 5 جمادى الأولى عام 1425 الموافق 23 يونيو 2004 الذي يحدد القواعد المطبقة على الممارسات التجارية، المعدل و المتمم)</div>
                </div>
            </div>
            <div class="content mt-4">
                <div class="left float-left ml-5 pl-5">
                    <div>محضر معاينة</div>
                    <div>رقم :</div>
                    <div>يوم :</div>
                </div>
                <div class="right float-left">
                    <div>سنة <span style="width:74mm;" class="year data-box">{{year}}</span> يوم <span style="width:50mm;" class="day data-box">{{date_pv}}</span> من شهر <span style="width:40mm;" class="month data-box">{{month_pv}}</span></div>
                    <div>على الساعة <span style="width:60mm;" class="data-box hour">{{hour_pv}}</span> و <span style="width:70mm;" class="data-box min">{{min_pv}}</span>  نحن الممضون أسفله </div>
                    <div><span style="width:100%;text-align:right;" class="data-box">{{agent1}} {{grade1}}</span></div>
                    <div><span style="width:100%;text-align:right;" class="data-box">{{agent2}} {{grade2}}</span></div>
                    <div v-if="agent3"><span style="width:100%;text-align:right;" class="data-box">{{agent3}} {{grade3}}</span></div>

                    <div>المقيمون إداريا بـ <span style="width:167mm;" class="data-box service">{{service}}</span></div>
                    <div>حاملو بطاقة تفويض بالعمل، رقم  <span style="width:50mm;font-size:15px;" class="data-box carte-com">{{carte_com1}}-{{carte_com2}}</span>المحررة بـ <span style="width:68mm;font-size:15px" class="data-box date-carte-com">{{date_carte_com1}}/{{date_carte_com2}}</span></div>

                    <div>نشهد أنه بتاريخ <span style="width:171mm;" class="data-box date-constat">{{date_constat}}</span></div>
                    <div>تقدمنا إلى السيد/السيدة (*) <span style="width:147mm;" class="data-box commercant">{{commercant}}</span></div>
                    <div>المولود(ة) بـ <span style="width:177mm;" class="data-box date-n">{{date_nais}} {{lieux_nais}}</span></div>
                    <div>ابن و ابنة <span style="width:77mm;" class="data-box pere">{{pere}}</span> و <span style="width:100mm;" class="data-box mere">{{mere}}</span></div>
                    <div>الساكن بـ <span style="width:183mm;" class="data-box domicile">{{domicile}}</span></div>
                    <div>الممارس لنشاط <span style="width:169mm;" class="data-box activite">{{activite}}</span></div>
                    <div>الكائن بـ <span style="width:185mm;" class="data-box adresse">{{adresse}}</span></div>
                </div>

                <div class="pv-footer clear">(*) حسب حالة، التاجر أو الممثل القانوني للشركة التجارية و/أو الأشخاص المعنيين بالتحقيق</div>
                <div class="pv-footer">الأفعال و الوقائع المسجلة و المعاينة بالتفصيل، المصنفة حسب الوصف الوارد في المادة القانونية المحددة للمخالفة</div>
                <div  v-for="infraction in infractions" :key="infraction.id" class="pv-footer"><span style="width:100%;text-align:right;" class="data-box">{{infraction.libelle}}</span></div>


            </div>
        </div>
        <div class="page-1">
            <div class="redaction-bloc">
                <div v-for="i in lines" :key="i"><span style="height:45px;width:100%;" class="data-box"></span></div>
                <div class="redaction" style="height:auto;width:100%;"><p>{{redaction}}</p></div>
            </div>


        </div>
        <div class="page-1 page-3">
            <div class="haut">
                <div><h3>في حالة الحجز،</h3></div>
                <div><span>قمنا بحجز:</span></div>
                <div>- طبيعة الحجز <span style="width:211mm;" class="data-box text-center type-saisie">{{tsaisie?tsaisie.typesaisie.libelle:""}}</span></div>
                <div>- طبيعة المنتوجات المحجوزة <span style="width:183mm;" class="data-box nature">{{tsaisie?tsaisie.category.category:""}}</span></div>
                <div>- كمية المنتوجات المحجوزة <span style="width:186mm;" class="data-box quantite">{{tsaisie?tsaisie.quantite:""}}</span></div>
                <div>- قيمة المنتوجات المحجوزة <span style="width:186mm;" class="data-box sommeda">{{tsaisie?tsaisie.sommeDa:""}} </span></div>
                <div>ترفق بهذا المحضر وثائق جرد المنتوجات المحجوزة الآتية :<span style="width:133mm;top:0;" class="data-box piecesJ"></span></div>
                <div v-if="tsaisie"><span style="width:100%;text-align:right;" class="data-box pv-saisie">محضر جرد السحب</span></div>
                <div v-else><span style="width:100%;text-align:right;" class="data-box"></span></div>
                <div><span style="width:100%;text-align:right;" class="data-box"></span></div>
                <div><span style="width:100%;text-align:right;" class="data-box"></span></div>
                <div><span style="width:100%;text-align:right;" class="data-box"></span></div>
                <!-- <table border="1px" class="mb-4">
                    <thead>
                        <td>الرقم</td>
                        <td>المادة</td>
                        <td>الكمية</td>
                        <td>الوحدة</td>
                        <td>سعر الوحدة (دج)</td>
                        <td>المجموع(دج)</td>
                    </thead>
                    <tbody>
                        <tr v-for="(product,index) in produits_saisie" :key="product.id">
                            <td style="text-align:center;">{{index+1}}</td>
                            <td style="width:30%;text-align:right;">
                                <span>{{product.product}}</span>
                            </td>
                            <td style="width:18%;text-align:center;">
                                <span>{{product.qte}}</span>
                            </td>
                            <td style="width:13%;text-align:center;">
                                <span>{{product.unite}}</span>
                            </td>
                            <td style="width:15%;text-align:center;">
                                <span>{{product.pu}}</span>
                            </td>
                            <td style="width:20%;text-align:center;">
                                <span>{{product.somme}}</span>
                            </td>
                        </tr>
                    </tbody>
                </table> -->
                <div>نظرا للمخالفة المرتكبة من طرف السيد/السيدة(ّ*):<span style="width:147mm;" class="data-box com">{{commercant}}</span></div>
                <div>المنصوص عليها في المادة<span style="width:187mm;" class="data-box lois">{{articles}} من القانون {{lois}}</span></div>
                <div>المعاقب عليها في المادة<span style="width:192mm;" class="data-box lois-p">{{articles_p}} من القانون {{lois_p}}</span></div>
                <div>بموجب إستدعاء رقم :<span style="width:80mm;" class="data-box num-conv">{{pv.num_conv}}</span> مؤرخ في <span style="width:98mm;" class="data-box date-conv">{{pv.date_conv}}</span></div>
                <div>تم إعلام السيد/السيدة:<span style="width:196mm;" class="data-box com2">{{commercant}}</span></div>
                <div>بأنه سيتم تحرير محضر بالمخالفة المرتكبة :<span style="width:159mm;top:0;" class="data-box  inf"></span></div>
                <div  v-for="infraction in infractions" :key="infraction.id"><span style="width:100%;text-align:right;" class="data-box">{{infraction.libelle}}</span></div>
                <div>بتاريخ :<span style="width:226mm;" class="data-box date-constat2">{{pv.date_constat}}</span></div>
                <div>مكان المخالفة :<span style="width:210mm;" class="data-box lieux">{{adresse}}</span></div>
                <div>يقترح للمخالف تسديد غرامة مصالحة تقدر بمبلغ :<span style="width:145mm;" class="data-box amande">{{pv.amande}}</span></div>
                <div>قبل الإمضاء على هذا المحضر، صرح المخالف بما يأتي : <span style="width:133mm;top:0;" class="data-box commentaire"></span></div>
            </div>
            <div class="commentaires-bloc">
                <div><span style="height:30px;width:100%;" class="data-box"></span></div>
                <div><span style="height:30px;width:100%;" class="data-box"></span></div>
                <div><span style="height:30px;width:100%;" class="data-box"></span></div>
                <div class="commentaire" style="height:auto;width:100%;"><p>{{commentaires}}</p></div>
            </div>
            <div class="float-left signature-agent">إمضاء الموظف المحرر للمحضر</div>
            <div class="float-right signature">
                <div style="height:50px;">إمضاء المحضر من طرف المخالف</div>
                <div class="avis-line">
                    <div class="avis">وافق على الإمضاء</div>
                    <div v-if="signature" class="case-coche"></div>
                    <div v-else class="case-coche">X</div>
                </div>
                <div class="avis-line">
                    <div class="avis">رفض الإمضاء</div>
                    <div v-if="signature" class="case-coche">X</div>
                    <div v-else class="case-coche"></div>
                </div>
            </div>

            <div class="clear footer-p3">(*) حسب حالة التاجر أو الممثل القانوني للشركةالتجارية و/أو الأشخاص المعنيون بالتحقيق</div>
            <div class="footer-p3">(**) تسديد غرامة المصالحة ينهي المتابعة القضائية</div>
            <div class="footer-p3">ملاحظة : أشطب العبارة غير الضرورية</div>
        </div>

    </div>
</template>

<script>
    import QrcodeVue from 'qrcode.vue'
    export default {
        mounted() {
            //console.log('Component mounted.');
            //this.index();
            //this.getResults();
            if(this.$route.params.pv_id != undefined){
                axios.get('pvsPrint/'+this.$route.params.pv_id)
                .then(response  => {

                    //this.value=response.data.actual_link;
                    this.value="http://www.zandal.net/pvs/public/home#/pvsPrint/"+this.$route.params.pv_id;
                    this.pv=response.data.pv;
                    this.grades=response.data.grades;
                    this.year=response.data.year;
                    this.lieux_nais=response.data.commune_n;
                    this.infractions=response.data.infractions;
                    this.redaction=this.pv.redaction;

                    this.commentaires=this.pv.commentaires;

                    this.tsaisie=response.data.tsaisie;
                    this.produits_saisie=response.data.produits_saisie;

                    this.infractions.forEach(element => {
                        this.lois+=element.lois+'-';
                        this.articles+=element.articles+'-';

                        this.lois_p+=element.lois_p+'-';
                        this.articles_p+=element.articles_p+'-';
                    });
                    this.lois=this.lois.slice(0,-1);
                    this.articles=this.articles.slice(0,-1);
                    this.lois_p=this.lois_p.slice(0,-1);
                    this.articles_p=this.articles_p.slice(0,-1);
                    this.signature=this.pv.signature;


                    this.date_pv=this.jour[new Date(this.pv.date_pv).getDate()];
                    this.month_pv=this.mois[new Date(this.pv.date_pv).getMonth()];
                    this.hour_pv=this.hour[this.pv.hour_pv];
                    this.min_pv=this.minute[this.pv.min_pv];



                    this.agent1=this.pv.user1.name;
                    this.agent2=this.pv.user2.name;





                    this.grade1=this.getGrade(this.pv.user1.grade_id);
                    this.grade2=this.getGrade(this.pv.user2.grade_id);
                    if(this.pv.user3){
                        this.agent3=this.pv.user3.name;
                        this.grade3=this.getGrade(this.pv.user2.grade_id);
                        this.carte_com3=this.pv.user3.carte_com;
                        this.date_carte_com3=this.pv.user3.date_carte_com;
                    }


                    this.carte_com1=this.pv.user1.carte_com;
                    this.carte_com2=this.pv.user2.carte_com;
                    this.date_carte_com1=this.pv.user1.date_carte_com;
                    this.date_carte_com2=this.pv.user2.date_carte_com;
                    this.service=this.pv.service.service;

                    this.date_constat=this.pv.date_constat;
                    this.commercant=this.pv.commercant.name;
                    //console.log(this.pv.commercant.rais_soc);
                    if(this.pv.commercant.rais_soc != "" && this.pv.commercant.rais_soc != "/"
                        && this.pv.commercant.rais_soc != null){
                        this.commercant+=" مسير "+this.pv.commercant.rais_soc;
                    }
                    this.date_nais=this.pv.commercant.date_n;
                    //this.lieux_nais=this.pv.commercant.lieux_n;
                    this.pere=this.pv.commercant.pere;
                    this.mere=this.pv.commercant.mere;
                    this.domicile=this.pv.commercant.adresse_d;

                    this.activite=response.data.activite;
                    this.adresse=this.pv.adresse_com.adresse_com;



                    this.pvdata=true;

                });
            }

        },
        watch:{


        },
        components: {
            QrcodeVue,
        },
        data(){
            return {
                'year':'',
                'date_pv':'',
                'month_pv':'',
                'hour_pv':'',
                'min_pv':'',

                'agent1':'',
                'agent2':'',
                'agent3':'',
                'grade1':'',
                'grade2':'',
                'grade3':'',
                'service':'',

                'carte_com1':'',
                'date_carte_com1':'',
                'carte_com2':'',
                'date_carte_com2':'',
                'carte_com3':'',
                'date_carte_com3':'',

                'date_constat':'',
                'commercant':'',
                'date_nais':'',
                'lieux_nais':'',
                'pere':'',
                'mere':'',
                'domicile':'',
                'activite':'',
                'adresse':'',

                'redaction':'',
                'lois':'',
                'articles':'',
                'lois_p':'',
                'articles_p':'',
                'commentaires':'',


                'value': '',
                'size': 100,



                'pvdata':false,
                'signature':false,

                'created_by':'',
                'id_update':'',
                pvs:{},
                grades:{},
                infractions:{},
                tsaisie:{},
                produits_saisie:{},

                errors:[],
                lines:[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27],

                mois:[
                    "يناير","فيفري","مارس","أفريل","ماي","جوان","جويلية","أوت","سبتمبر","أكتوبر","نوفمبر","ديسمبر"
                ],
                jour:{
                    "1":"الفاتح",
                    "2":"الثاني",
                    "3":"الثالث",
                    "4":"الرابع",
                    "5":"الخامس",
                    "6":"السادس",
                    "7":"السابع",
                    "8":"الثامن",
                    "9":"التاسع",
                    "10":"العاشر",
                    "11":"الحادي عشر",
                    "12":"الثاني عشر",
                    "13":"الثالث عشر",
                    "14":"الرابع عشر",
                    "15":"الخامس عشر",
                    "16":"السادس عشر",
                    "17":"السابع عشر",
                    "18":"الثامن عشر",
                    "19":"التاسع عشر",
                    "20":"العشرين",
                    "21":"الواحد و العشرين",
                    "22":"الثاني و العشرين",
                    "23":"الثالث و العشرين",
                    "24":"الرابع و العشرين",
                    "25":"الخامس و العشرين",
                    "26":"السادس و العشرين",
                    "27":"السابع و العشرين",
                    "28":"الثامن و العشرين",
                    "29":"التاسع و العشرين",
                    "30":"الثلاثين",
                    "31":"الواحد و الثلاثين",
                },
                hour:{
                    "0":"الثانية عشر ليلا",
                    "1":"الواحدة ليلا",
                    "2":"الثانية ليلا",
                    "3":"الثالثة صباحا",
                    "4":"الرابعة صباحا",
                    "5":"الخامسة صباحا",
                    "6":"السادسة صباحب",
                    "7":"السابعة صباحا",
                    "8":"الثامنة صباحا",
                    "9":"التاسعة صباحا",
                    "10":"العاشرة صباحا",
                    "11":"الحادية عشر صباحا",
                    "12":"الثانية عشر زوالا",
                    "13":"الواحدة بعد الزوال",
                    "14":"الثانية بعد الزوال",
                    "15":"الثالثة مساءا",
                    "16":"الرابعة مساءا",
                    "17":"الخامسة مساءا",
                    "18":"السادسة مساءا",
                    "19":"السابعة مساءا",
                    "20":"الثامنة ليلا",
                    "21":"التاسعة ليلا",
                    "22":"العاشرة ليلا",
                    "23":"الحادية عشر ليلا"
                },
                minute:{
                    "0":"",
                    "1":"دقيقة",
                    "2":"دقيقتان",
                    "3":"ثلاث دقائق",
                    "4":"أربع دقائق",
                    "5":"خمس دقائق",
                    "6":"ست دقائق",
                    "7":"سبع دقائق",
                    "8":"ثمان دقائق",
                    "9":"تسع دقائق",
                    "10":"عشر دقائق",
                    "11":"إحدى عشر دقيقة",
                    "12":"إثنى عشر دقيقة",
                    "13":"ثلاثة عشر دقيقة",
                    "14":"أربعة عشر دقيقة",
                    "15":"خمسة عشر دقيقة",
                    "16":"ستة عشر دقيقة",
                    "17":"سبعة عشر دقيقة",
                    "18":"ثمانية عشر دقيقة",
                    "19":"تسعة عشر دقيقة",
                    "20":"عشرون دقيقة",
                    "21":"واحد و عشرون دقيقة",
                    "22":"إثنان و عشرون دقيقة",
                    "23":"ثلاثة و عشرون دقيقة",
                    "24":"أربعة و عشرون دقيقة",
                    "25":"خمسة و عشرون دقيقة",
                    "26":"ستة و عشرون دقيقة",
                    "27":"سبعة و عشرون دقيقة",
                    "28":"ثمانية و عشرون دقيقة",
                    "29":"تسعة و عشرون دقيقة",
                    "30":"ثلاثون دقيقة",
                    "31":"واحد و ثلاثون دقيقة",
                    "32":"إثنان و ثلاثون دقيقة",
                    "33":"ثلاثة و ثلاثون دقيقة",
                    "34":"أربعة و ثلاثون دقيقة",
                    "35":"خمسة و ثلاثون دقيقة",
                    "36":"ستة و ثلاثون دقيقة",
                    "37":"سبعة و ثلاثون دقيقة",
                    "38":"ثمانية و ثلاثون دقيقة",
                    "39":"تسعة و ثلاثون دقيقة",
                    "40":"أربعون دقيقة",
                    "41":"واحد و أربعون دقيقة",
                    "42":"إثنان و أربعون دقيقة",
                    "43":"ثلاثة و أربعون دقيقة",
                    "44":"أربعة و أربعون دقيقة",
                    "45":"خمسة و أربعون دقيقة",
                    "46":"ستة و أربعون دقيقة",
                    "47":"سبعة و أربعون دقيقة",
                    "48":"ثمانية و أربعون دقيقة",
                    "49":"تسعة و أربعون دقيقة",
                    "50":"خمسون دقيقة",
                    "51":"واحد و خمسون دقيقة",
                    "52":"إثنان و خمسون دقيقة",
                    "53":"ثلاثة و خمسون دقيقة",
                    "54":"أربعة و خمسون دقيقة",
                    "55":"خمسة و خمسون دقيقة",
                    "56":"ستة و خمسون دقيقة",
                    "57":"سبعة و خمسون دقيقة",
                    "58":"ثمانية و خمسون دقيقة",
                    "59":"تسعة و خمسون دقيقة",
                },

            }
        },
        methods:{

            printPv:function(){
                window.print();
            },
            getGrade:function(id){
                let grade = this.grades.find((element) => element.id === id);

                return grade?grade.grade:"";
            }


        }
    }
</script>
<style scoped>
    /* print media */
    @media print{
        #pv-content * {
            visibility: visible;

        }
        p{
            visibility: visible!important;
        }
        .page-1{
            height: 290mm;
            width: 240mm;
            margin: 0 auto;
            padding:27px 48px 110px 27px;
            page-break-after: always;
        }
        .page-3{
            page-break-after: unset;
        }
        .btn{
            display: none!important;
        }
        .redaction{
        position: relative;
        top:-1378px;

        }

    }
    /* end print media */

@media screen and (max-width: 414px) and (min-width: 200px) {
        #pv-content, .page-1{
            margin-left: 2mm!important;
            margin-right: 8mm!important;
        }
        .header h3{
            font-size:.6em;
        }
        .header h4{
            font-size:.5em;
        }

        .text-reg div {
            font-size:.55em;
        }

        .left{
            width: 16%!important;
            font-size: .36em;
            right:-7mm!important;
            margin-left: 10px!important;
            padding-left: 10px!important;
        }

        div.left div, div.right div, .pv-footer, .haut div{
            height: 22px!important;
        }
        .pv-footer{
            height: 36px!important;
        }
        div.right div, div.right div span, .pv-footer,
        .redaction-block {
            font-size: .48em!important;
        }
        .data-box{
            top: -2px!important;
        }

        .right .year{
            width: 18mm!important;
        }
        .right .day{
            width: 18mm!important;
        }
        .right .month{
            width: calc(100% - 54mm)!important;
            /*19mm!important;*/
        }

        .right .hour{
            width: 22mm!important;
        }
        .right .min{
            width: calc(100% - 56mm)!important;
        }

        .right .service{
            width: calc(100% - 17mm)!important;
        }
        .right .carte-com{
            width: 13mm!important;
        }
        .right .date-carte-com{
            width: calc(100% - 54mm)!important;
        }
        .right .date-constat{
            width: calc(100% - 15mm)!important;
        }
        .right .commercant{
            width: calc(100% - 27mm)!important;
        }
        .right .date-n{
            width: calc(100% - 12mm)!important;
        }
        .right .pere{
            width: 24mm!important;
        }
        .right .mere{
            width: calc(100% - 36mm)!important;
        }
        .right .domicile{
            width: calc(100% - 9mm)!important;
        }
        .right .activite{
            width: calc(100% - 16mm)!important;
        }
        .right .adresse{
            width: calc(100% - 8mm)!important;
        }


        .redaction p{
            font-size: .48em!important;
        }


        .haut h3{
            font-size: 1.1em!important;
        }
        .haut div{
            font-size: .45em!important;
        }

        .type-saisie{
            width: calc(100% - 13mm)!important;
        }
        .nature{
            width: calc(100% - 26mm)!important;
        }
        .quantite{
            width: calc(100% - 24mm)!important;
        }
        .sommeda{
            width: calc(100% - 24mm)!important;
        }
        .piecesJ{
            width: calc(100% - 48mm)!important;
        }
        .com{
            width: calc(100% - 42mm)!important;
        }
        .lois{
            width: calc(100% - 24mm)!important;

        }
        .lois-p{
            width: calc(100% - 22mm)!important;

        }
        .num-conv{
            width: 20mm!important;
        }
        .date-conv{
            width: calc(100% - 48mm)!important;
        }
        .com2{
            width: calc(100% - 20mm)!important;
        }
        .inf{
            width: calc(100% - 37mm)!important;
        }
        .date-constat2{
            width: calc(100% - 7mm)!important;
        }
        .lieux{
            width: calc(100% - 14mm)!important;
        }
        .amande{
            width: calc(100% - 43mm)!important;
        }
        .commentaire{
            width: calc(100% - 48mm)!important;
        }

        .signature-agent, .signature, .footer-p3{
            font-size: .45em!important;
        }
        .case-coche {
            width: 4mm!important;
            height: 3mm!important;
            border: 1px solid;
        }




    }

    @media screen and (max-width: 576px) and (min-width:414px ) {
        #pv-content, .page-1{
            margin-left: 2mm!important;
            margin-right: 8mm!important;
        }
        .header h3{
            font-size:.8em;
        }
        .header h4{
            font-size:.7em;
        }

        .text-reg div {
            font-size:.65em;
        }

        .left{
            width: 16%!important;
            font-size: .36em;
            right:-7mm!important;
            margin-left: 10px!important;
            padding-left: 10px!important;
        }

        div.left div, div.right div, .pv-footer, .haut div{
            height: 28px!important;
        }
        .pv-footer{
            height: 36px!important;
        }
        div.right div, div.right div span, .pv-footer,
        .redaction-block {
            font-size: .58em!important;
        }
        .data-box{
            top: -3px!important;
        }

        .right .year{
            width: 24mm!important;
        }
        .right .day{
            width: 20mm!important;
        }
        .right .month{
            width: calc(100% - 66mm)!important;
            /*19mm!important;*/
        }

        .right .hour{
            width: 22mm!important;
        }
        .right .min{
            width: calc(100% - 64mm)!important;
        }

        .right .service{
            width: calc(100% - 20mm)!important;
        }
        .right .carte-com{
            width: 18mm!important;
        }
        .right .date-carte-com{
            width: calc(100% - 67mm)!important;
        }
        .right .date-constat{
            width: calc(100% - 18mm)!important;
        }
        .right .commercant{
            width: calc(100% - 32mm)!important;
        }
        .right .date-n{
            width: calc(100% - 15mm)!important;
        }
        .right .pere{
            width: 30mm!important;
        }
        .right .mere{
            width: calc(100% - 44mm)!important;
        }
        .right .domicile{
            width: calc(100% - 11mm)!important;
        }
        .right .activite{
            width: calc(100% - 19mm)!important;
        }
        .right .adresse{
            width: calc(100% - 10mm)!important;
        }


        .redaction p{
            font-size: .55em!important;
        }

        .haut h3{
            font-size: 1.1em!important;
        }
        .haut div{
            font-size: .55em!important;
        }

        .type-saisie{
            width: calc(100% - 16mm)!important;
        }
        .nature{
            width: calc(100% - 32mm)!important;
        }
        .quantite{
            width: calc(100% - 30mm)!important;
        }
        .sommeda{
            width: calc(100% - 30mm)!important;
        }
        .piecesJ{
            width: calc(100% - 59mm)!important;
        }
        .com{
            width: calc(100% - 51mm)!important;
        }
        .lois{
            width: calc(100% - 29mm)!important;
        }
        .lois-p{
            width: calc(100% - 27mm)!important;
        }
        .num-conv{
            width: 40mm!important;
        }
        .date-conv{
            width: calc(100% - 74mm)!important;
        }
        .com2{
            width: calc(100% - 24mm)!important;
        }
        .inf{
            width: calc(100% - 45mm)!important;
        }
        .date-constat2{
            width: calc(100% - 8mm)!important;
        }
        .lieux{
            width: calc(100% - 16mm)!important;
        }
        .amande{
            width: calc(100% - 52mm)!important;
        }
        .commentaire{
            width: calc(100% - 59mm)!important;
        }

        .signature-agent, .signature, .footer-p3{
            font-size: .55em!important;
        }
        .case-coche {
            width: 6mm!important;
            height: 4mm!important;
            border: 1px solid;
        }




    }
    @media screen and (max-width: 768px) and (min-width: 576px){
        #pv-content, .page-1{
            margin-left: 2mm!important;
            margin-right: 8mm!important;
        }
        .header h3{
            font-size:.9em;
        }
        .header h4{
            font-size:.8em;
        }

        .text-reg div {
            font-size:.75em;
        }
        .left{
            width: 16%!important;
            font-size: .43em;
            right:-10mm!important;
        }

        div.left div, div.right div, .pv-footer, .haut div{
            height: 28px!important;
        }
        .pv-footer{
            height: 36px!important;
        }
        div.right div, div.right div span, .pv-footer,
        .redaction-block {
            font-size: .68em!important;
        }
        .data-box{
            top: -4px!important;
        }

        .right .year{
            width: 28mm!important;
        }
        .right .day{
            width: 23mm!important;
        }
        .right .month{
            width: calc(100% - 77mm)!important;
            /*19mm!important;*/
        }

        .right .hour{
            width: 22mm!important;
        }
        .right .min{
            width: calc(100% - 71mm)!important;
        }

        .right .service{
            width: calc(100% - 24mm)!important;
        }
        .right .carte-com{
            width: 19mm!important;
        }
        .right .date-carte-com{
            width: calc(100% - 76mm)!important;
        }
        .right .date-constat{
            width: calc(100% - 21mm)!important;
        }
        .right .commercant{
            width: calc(100% - 38mm)!important;
        }
        .right .date-n{
            width: calc(100% - 17mm)!important;
        }
        .right .pere{
            width: 30mm!important;
        }
        .right .mere{
            width: calc(100% - 47mm)!important;
        }
        .right .domicile{
            width: calc(100% - 13mm)!important;
        }
        .right .activite{
            width: calc(100% - 22mm)!important;
        }
        .right .adresse{
            width: calc(100% - 11mm)!important;
        }


        .redaction p{
            font-size: .68em!important;
        }

        .haut h3{
            font-size: 1.1em!important;
        }
        .haut div{
            font-size: .55em!important;
        }

        .type-saisie{
            width: calc(100% - 16mm)!important;
        }
        .nature{
            width: calc(100% - 32mm)!important;
        }
        .quantite{
            width: calc(100% - 30mm)!important;
        }
        .sommeda{
            width: calc(100% - 30mm)!important;
        }
        .piecesJ{
            width: calc(100% - 59mm)!important;
        }
        .com{
            width: calc(100% - 51mm)!important;
        }
        .lois{
            width: calc(100% - 29mm)!important;
        }
        .lois-p{
            width: calc(100% - 27mm)!important;
        }
        .num-conv{
            width: 40mm!important;
        }
        .date-conv{
            width: calc(100% - 74mm)!important;
        }
        .com2{
            width: calc(100% - 24mm)!important;
        }
        .inf{
            width: calc(100% - 45mm)!important;
        }
        .date-constat2{
            width: calc(100% - 8mm)!important;
        }
        .lieux{
            width: calc(100% - 16mm)!important;
        }
        .amande{
            width: calc(100% - 52mm)!important;
        }
        .commentaire{
            width: calc(100% - 59mm)!important;
        }

        .signature-agent, .signature, .footer-p3{
            font-size: .55em!important;
        }
        .case-coche {
            width: 6mm!important;
            height: 4mm!important;
            border: 1px solid;
        }


    }
    @media screen and (max-width: 992px) and (min-width: 768px) {
        #pv-content, .page-1{
            margin-left: 2mm!important;
            margin-right: 8mm!important;
        }
        .header h3{
            font-size:1.1em;
        }
        .header h4{
            font-size:1em;
        }

        .text-reg div {
            font-size:.95em;
        }


        .left{
            width: 16%!important;
            font-size: .6em;
            right:-10mm!important;
        }

        div.left div, div.right div, .pv-footer, .haut div{
            height: 30px!important;
        }
        .pv-footer{
            height: 36px!important;
        }
        div.right div, div.right div span, .pv-footer,
        .redaction-block {
            font-size: .8em!important;
        }
        .data-box{
            top: -5px!important;
        }

        .right .year{
            width: 36mm!important;
        }
        .right .day{
            width: 32mm!important;
        }
        .right .month{
            width: calc(100% - 98mm)!important;
            /*19mm!important;*/
        }

        .right .hour{
            width: 32mm!important;
        }
        .right .min{
            width: calc(100% - 89mm)!important;
        }

        .right .service{
            width: calc(100% - 28mm)!important;
        }
        .right .carte-com{
            width: 26mm!important;
        }
        .right .date-carte-com{
            width: calc(100% - 93mm)!important;
        }
        .right .date-constat{
            width: calc(100% - 25mm)!important;
        }
        .right .commercant{
            width: calc(100% - 44mm)!important;
        }
        .right .date-n{
            width: calc(100% - 20mm)!important;
        }
        .right .pere{
            width: 40mm!important;
        }
        .right .mere{
            width: calc(100% - 60mm)!important;
        }
        .right .domicile{
            width: calc(100% - 15mm)!important;
        }
        .right .activite{
            width: calc(100% - 26mm)!important;
        }
        .right .adresse{
            width: calc(100% - 13mm)!important;
        }


        .redaction p{
            font-size: .8em!important;
        }

        .haut h3{
            font-size: 1.3em!important;
        }
        .haut div{
            font-size: .8em!important;
        }

        .type-saisie{
            width: calc(100% - 23mm)!important;
        }
        .nature{
            width: calc(100% - 46mm)!important;
        }
        .quantite{
            width: calc(100% - 43mm)!important;
        }
        .sommeda{
            width: calc(100% - 43mm)!important;
        }
        .piecesJ{
            width: calc(100% - 86mm)!important;
        }
        .com{
            width: calc(100% - 75mm)!important;
        }
        .lois{
            width: calc(100% - 42mm)!important;
        }
        .lois-p{
            width: calc(100% - 39mm)!important;
        }
        .num-conv{
            width: 40mm!important;
        }
        .date-conv{
            width: calc(100% - 90mm)!important;
        }
        .com2{
            width: calc(100% - 35mm)!important;
        }
        .inf{
            width: calc(100% - 65mm)!important;
        }
        .date-constat2{
            width: calc(100% - 11mm)!important;
        }
        .lieux{
            width: calc(100% - 24mm)!important;
        }
        .amande{
            width: calc(100% - 76mm)!important;
        }
        .commentaire{
            width: calc(100% - 86mm)!important;
        }

        .signature-agent, .signature, .footer-p3{
            font-size: .7em!important;
        }
        .case-coche {
            width: 8mm!important;
            height: 5mm!important;
            border: 1px solid;
        }

    }

     @media screen and (max-width: 1200px) and (min-width: 992px) {
         #pv-content, .page-1{
            margin-left: 2mm!important;
            margin-right: 8mm!important;
        }
        .header h3{
            font-size:1.3em;
        }
        .header h4{
            font-size:1.2em;
        }
        .text-reg div {
            font-size:1.15em;
        }



        .left{
            width: 16%!important;
            font-size: .9em;
            right:-10mm!important;
        }

        div.left div, div.right div, .pv-footer, .haut div{
            height: 40px!important;
        }
        .pv-footer{
            height: 40px!important;
        }
        div.right div, div.right div span, .pv-footer,
        .redaction-block {
            font-size: .9em!important;
        }
        .data-box{
            top: -6px!important;
        }

        .right .year{
            width: 42mm!important;
        }
        .right .day{
            width: 40mm!important;
        }
        .right .month{
            width: calc(100% - 116mm)!important;
            /*19mm!important;*/
        }

        .right .hour{
            width: 42mm!important;
        }
        .right .min{
            width: calc(100% - 106mm)!important;
        }

        .right .service{
            width: calc(100% - 31mm)!important;
        }
        .right .carte-com{
            width: 35mm!important;
        }
        .right .date-carte-com{
            width: calc(100% - 111mm)!important;
        }
        .right .date-constat{
            width: calc(100% - 28mm)!important;
        }
        .right .commercant{
            width: calc(100% - 50mm)!important;
        }
        .right .date-n{
            width: calc(100% - 23mm)!important;
        }
        .right .pere{
            width: 60mm!important;
        }
        .right .mere{
            width: calc(100% - 82mm)!important;
        }
        .right .domicile{
            width: calc(100% - 17mm)!important;
        }
        .right .activite{
            width: calc(100% - 29mm)!important;
        }
        .right .adresse{
            width: calc(100% - 15mm)!important;
        }


        .redaction p{
            font-size: .9em!important;
        }

        .haut h3{
            font-size: 1.4em!important;
        }
        .haut div{
            font-size: .9em!important;
        }

        .type-saisie{
            width: calc(100% - 26mm)!important;
        }
        .nature{
            width: calc(100% - 51mm)!important;
        }
        .quantite{
            width: calc(100% - 48mm)!important;
        }
        .sommeda{
            width: calc(100% - 48mm)!important;
        }
        .piecesJ{
            width: calc(100% - 96mm)!important;
        }
        .com{
            width: calc(100% - 84mm)!important;
        }
        .lois{
            width: calc(100% - 47mm)!important;
        }
        .lois-p{
            width: calc(100% - 43mm)!important;
        }
        .num-conv{
            width: 60mm!important;
        }
        .date-conv{
            width: calc(100% - 116mm)!important;
        }
        .com2{
            width: calc(100% - 39mm)!important;
        }
        .inf{
            width: calc(100% - 73mm)!important;
        }
        .date-constat2{
            width: calc(100% - 13mm)!important;
        }
        .lieux{
            width: calc(100% - 27mm)!important;
        }
        .amande{
            width: calc(100% - 85mm)!important;
        }
        .commentaire{
            width: calc(100% - 96mm)!important;
        }

        .signature-agent, .signature, .footer-p3{
            font-size: .9em!important;
        }
        .case-coche {
            width: 10mm!important;
            height: 6mm!important;
            border: 1px solid;
        }
    }

    @media screen and (min-width: 1200px) {
         #pv-content, .page-1{
            margin-left: 2mm!important;
            margin-right: 8mm!important;
        }
        .header h3{
            font-size:1.4em;
        }
        .header h4{
            font-size:1.3em;
        }
        .text-reg div {
            font-size:1.25em;
        }



        .left{
            width: 16%!important;
            font-size: 1em;
            right:-10mm!important;
        }

        div.left div, div.right div, .pv-footer, .haut div{
            height: 45px!important;
        }
        .pv-footer{
            height: 45px!important;
        }
        div.right div, div.right div span, .pv-footer,
        .redaction-block {
            font-size: 1em!important;
        }
        .data-box{
            top: -7px!important;
        }

        .right .year{
            width: 52mm!important;
        }
        .right .day{
            width: 52mm!important;
        }
        .right .month{
            width: calc(100% - 141mm)!important;
            /*19mm!important;*/
        }

        .right .hour{
            width: 52mm!important;
        }
        .right .min{
            width: calc(100% - 123mm)!important;
        }

        .right .service{
            width: calc(100% - 35mm)!important;
        }
        .right .carte-com{
            width: 50mm!important;
        }
        .right .date-carte-com{
            width: calc(100% - 134mm)!important;
        }
        .right .date-constat{
            width: calc(100% - 31mm)!important;
        }
        .right .commercant{
            width: calc(100% - 55mm)!important;
        }
        .right .date-n{
            width: calc(100% - 25mm)!important;
        }
        .right .pere{
            width: 80mm!important;
        }
        .right .mere{
            width: calc(100% - 105mm)!important;
        }
        .right .domicile{
            width: calc(100% - 19mm)!important;
        }
        .right .activite{
            width: calc(100% - 32mm)!important;
        }
        .right .adresse{
            width: calc(100% - 17mm)!important;
        }


        .redaction p{
            font-size: 1em!important;
        }

        .haut h3{
            font-size: 1.5em!important;
        }
        .haut div{
            font-size: 1em!important;
        }

        .type-saisie{
            width: calc(100% - 29mm)!important;
        }
        .nature{
            width: calc(100% - 57mm)!important;
        }
        .quantite{
            width: calc(100% - 54mm)!important;
        }
        .sommeda{
            width: calc(100% - 54mm)!important;
        }
        .piecesJ{
            width: calc(100% - 107mm)!important;
        }
        .com{
            width: calc(100% - 93mm)!important;
        }
        .lois{
            width: calc(100% - 53mm)!important;
        }
        .lois-p{
            width: calc(100% - 48mm)!important;
        }
        .num-conv{
            width: 80mm!important;
        }
        .date-conv{
            width: calc(100% - 142mm)!important;
        }
        .com2{
            width: calc(100% - 44mm)!important;
        }
        .inf{
            width: calc(100% - 81mm)!important;
        }
        .date-constat2{
            width: calc(100% - 14mm)!important;
        }
        .lieux{
            width: calc(100% - 30mm)!important;
        }
        .amande{
            width: calc(100% - 95mm)!important;
        }
        .commentaire{
            width: calc(100% - 107mm)!important;
        }

        .signature-agent, .signature, .footer-p3{
            font-size: 1em!important;
        }
        .case-coche {
            width: 10mm!important;
            height: 6mm!important;
            border: 1px solid;
        }
    }



    .content{
        font-size: 18px;
        margin: 0;
        padding: 0;
        width: 100%;
        height: 100%;
    }
    body,.page-1, #pv-content{
        /* width: 240mm!important;
        to centre page on screen*/
        margin-left: 39mm;
        margin-right: 10mm;
        padding:10mm 0;
    }
    .commentaire p{
        width: 100%;
        font-size: 18px;
        line-height: 2.6em;
        text-align: justify;
    }
    .redaction p{
        width: 100%;
        font-size: 18px;
        line-height: 2.9em;
        text-align: justify;
    }
    .page-3{
        padding:0;
        font-size: 18px;
    }
    .header{
        height: 80px;
    }
    .text-reg{
        width:80%;
        margin:0 auto;
    }
    .right div{
        height: 60px;
    }
    .page-3 .haut div{
        height: 42px;
    }
    .page-3{
        margin-top: 30px;
    }
    .data-box{
        border-bottom: 1px dashed;
        text-align: center;
        display:inline-block;
        position: relative;
        top: -7px;
    }
    .left{
        width: 16%;
        padding: 0 !important;
        margin: 0 !important;
        position:relative;
        right:-10mm;
    }
    .left div{
        height:40px;
    }
    .right{
        width: 84%;
        padding: 0 !important;
        margin: 0 !important;
    }
    .avis-line{
        height: 35px;
    }
    .pv-footer{
        height: 50px;
    }
    .redaction{
        position: relative;
        top:-1378px;

    }
    .commentaires-bloc{
        height: 155px;
    }
    .commentaire{
        position: relative;
        top: -147px;
    }
    .avis{
        width: 60%;
        padding: 0;

        float: right;
    }
    .case-coche{
        width: 12mm;
        height: 7mm;
        border: 1px solid;
        display: inline-block;
        width: 20%;
        text-align: center;
        font-weight: bold;
    }
    .signature{
        height: 150px!important;
    }
    .clear{
        clear: both;
    }
    table thead td{
        text-align: center;
    }
    .page{
        float: left;
        border: 1px solid;
        border-radius: 3px;
        padding: 4px 5px;
    }
</style>
