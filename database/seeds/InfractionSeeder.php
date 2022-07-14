<?php

use App\Infraction;
use Illuminate\Database\Seeder;

class InfractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Infraction::truncate();
        Infraction::create([
           'id' =>1,
           'code' =>'0101',
           'libelle' =>'عدم الإعلام بالأسعار و التعريفات',
           'libelle_fr' =>'Défaut d\'information sur les prix et les tarifs',
           'lois' =>"القانون 04-02",
           'articles' =>"7-6-4",
           'lois_p' =>"القانون 04-02",
           'articles_p' =>"31",
           'created_by' =>"admin",
        ]);
        Infraction::create([
            'id' =>2,
            'code' =>'0201',
            'libelle' =>'عدم تبليغ شروط البيع',
            'libelle_fr' =>'Défaut de communication des conditions de vente',
            'lois' =>"القانون 04-02",
            'articles' =>"8-9",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"32",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>3,
            'code' =>'0301',
            'libelle' =>'عدم الفوترة',
            'libelle_fr' =>'Défaut de facturation',
            'lois' =>"القانون 04-02",
            'articles' =>"10-11-13",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"33",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>4,
            'code' =>'0401',
            'libelle' =>'فاتورة غير مطابقة',
            'libelle_fr' =>'Facture non-conforme',
            'lois' =>"القانون 04-02",
            'articles' =>"12",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"34",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>5,
            'code' =>'0501',
            'libelle' =>'ممارسات تجارية غير مطابقة (رفض البيع)',
            'libelle_fr' =>'Pratiques commerciales illicites  - refus de vente',
            'lois' =>"القانون 04-02",
            'articles' =>"15",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"35",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>6,
            'code' =>'0502',
            'libelle' =>'ممارسات تجارية غير مطابقة (بيع مشروط بمكافأة مجانية)',
            'libelle_fr' =>'Pratiques commerciales illicites - vente donnant droit à titre gratuit à une prime',
            'lois' =>"القانون 04-02",
            'articles' =>"16",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"35",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>7,
            'code' =>'0503',
            'libelle' =>'ممارسات تجارية غير مطابقة (البيع المشروط)',
            'libelle_fr' =>'Pratiques commerciales illicites-Vente concomitante',
            'lois' =>"القانون 04-02",
            'articles' =>"17",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"35",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>8,
            'code' =>'0504',
            'libelle' =>'ممارسات تجارية غير مطابقة (البيع بالتمييز)',
            'libelle_fr' =>'Pratiques commerciales illicites - vente discriminatoire',
            'lois' =>"القانون 04-02",
            'articles' =>"18",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"35",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>9,
            'code' =>'0505',
            'libelle' =>'ممارسات تجارية غير مطابقة (اعادة بيع سلعة أدنى من سعر كلفتها الحقيقية)',
            'libelle_fr' =>'Pratiques commerciales illicites - Vente à un prix inférieur au prix de revient effectif',
            'lois' =>"القانون 04-02",
            'articles' =>"19",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"35",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>10,
            'code' =>'0506',
            'libelle' =>'ممارسات تجارية غير مطابقة(بيع المواد الأولية في حالتها الأصلية)',
            'libelle_fr' =>'Pratiques commerciales illicites - Revente en l\'état des matières premières',
            'lois' =>"القانون 04-02",
            'articles' =>"20",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"35",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>11,
            'code' =>'0601',
            'libelle' =>'ممارسة أسعار غير شرعية',
            'libelle_fr' =>'Pratiques de prix illicite',
            'lois' =>"القانون 04-02",
            'articles' =>"22-23",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"36",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>12,
            'code' =>'0701',
            'libelle' =>'ممارسات تجارية تدليسية (دفع أو استلام فوارق مخفية للقيمة)',
            'libelle_fr' =>'Pratiques commerciales frauduleuses -remise ou perception de soultes occultes',
            'lois' =>"القانون 04-02",
            'articles' =>"24",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"37",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>13,
            'code' =>'0702',
            'libelle' =>'ممارسات تجارية تدليسية (تحرير فواتير وهمية أو مزيفة)',
            'libelle_fr' =>'Pratiques commerciales frauduleuses - établissement de fausses factures',
            'lois' =>"القانون 04-02",
            'articles' =>"24",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"37",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>14,
            'code' =>'0703',
            'libelle' =>'ممارسات تجارية تدليسية (إتلاف و إخفاء أو تزوير الوثائق التجارية, المحاسبية )',
            'libelle_fr' =>'Pratiques commerciales frauduleuses- destruction, dissimulation et falsification de documents commerçiaux obligatoires',
            'lois' =>"القانون 04-02",
            'articles' =>"24",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"37",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>15,
            'code' =>'0704',
            'libelle' =>'ممارسات تجارية تدليسية (حيازة منتوجات مستوردة أو مصنعة بصفة غير شرعية)',
            'libelle_fr' =>'Pratiques commerciales frauduleuses - Détention de produits importés ou fabriqués de manière illicite',
            'lois' =>"القانون 04-02",
            'articles' =>"25",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"37",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>16,
            'code' =>'0705',
            'libelle' =>'ممارسات تجارية تدليسية (حيازة مخزون من منتوجات بهدف تحفيز الإرتفاع غير المبرر للأسعار)',
            'libelle_fr' =>'Pratiques commerciales frauduleuses - Détention des stocks de produits dans le but de provoquer des hausses injustifiées de prix',
            'lois' =>"القانون 04-02",
            'articles' =>"25",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"37",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>17,
            'code' =>'0706',
            'libelle' =>'ممارسات تجارية تدليسية (حيازة مخزون من منتوجات خارج موضوع التجارة الشرعية قصد بيعه)',
            'libelle_fr' =>'Pratiques commerciales frauduleuses - Détention des stocks de produits étrangers à l\'objets légal de leur activité en vue de leur vente',
            'lois' =>"القانون 04-02",
            'articles' =>"25",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"37",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>18,
            'code' =>'0801',
            'libelle' =>'ممارسات تجارية غير نزيهة (تشويه سمعة عون اقتصادي منافس)',
            'libelle_fr' =>'Pratiques commerciales déloyales - dénigrement d\'un agent économique concurrent',
            'lois' =>"القانون 04-02",
            'articles' =>"27",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>19,
            'code' =>'0802',
            'libelle' =>'ممارسات تجارية غير نزيهة (تقليد العلامات المميزة لعون اقتصادي منافس)',
            'libelle_fr' =>'Pratiques commerciales déloyales - Immitation des signes distinctifs d\'un agent économique concurrent',
            'lois' =>"القانون 04-02",
            'articles' =>"27",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>20,
            'code' =>'0803',
            'libelle' =>'ممارسات تجارية غير نزيهة (استغلال مهارة تقنية أو تجارية مميزة دون ترخيص من صاحبها)',
            'libelle_fr' =>'Pratiques commerciales déloyales - Exploitation d\'un savoir faire technique ou commercial sans autorisation de son titulaire',
            'lois' =>"القانون 04-02",
            'articles' =>"27",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>21,
            'code' =>'0804',
            'libelle' =>'ممارسات تجارية غير نزيهة (إغراء مستخدمين متعاقدين مع عون اقتصادي منافس)',
            'libelle_fr' =>'/',
            'lois' =>"القانون 04-02",
            'articles' =>"27",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>22,
            'code' =>'0805',
            'libelle' =>'ممارسات تجارية غير نزيهة (الإستفادة من الأسرار المهنية قصد الإضرار بصاحب العمل أو الشريك)',
            'libelle_fr' =>'Pratiques commerciales déloyales - utilisation de secrets profesionnels à l\'encontre d\'un ancien employeur ou associé',
            'lois' =>"القانون 04-02",
            'articles' =>"27",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>23,
            'code' =>'0806',
            'libelle' =>'ممارسات تجارية غير نزيهة (إحداث خلل في تنظيم عون إقتصادي منافس)',
            'libelle_fr' =>'Pratiques commerciales déloyales - utilisation de procédés déloyaux tels que destruction, dégradation de moyens publicitaires, détournement',
            'lois' =>"القانون 04-02",
            'articles' =>"27",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>24,
            'code' =>'0807',
            'libelle' =>'ممارسات تجارية غير نزيهة (الإخلال بتنظيم السوق و إحداث اضطرابات فيها)',
            'libelle_fr' =>'/',
            'lois' =>"القانون 04-02",
            'articles' =>"27",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>25,
            'code' =>'0808',
            'libelle' =>'ممارسات تجارية غير نزيهة (إقامة محل تجاري في الجوار القريب لمحل منافس بهدف استغلال شهرته)',
            'libelle_fr' =>'/',
            'lois' =>"القانون 04-02",
            'articles' =>"27",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>26,
            'code' =>'0809',
            'libelle' =>'ممارسات تجارية غير نزيهة (إشهار غير شرعي و ممنوع لتضمن تصريحات أو بيانات تضلل بالمنتوج)',
            'libelle_fr' =>'Publicité illicite ou interdite - 1',
            'lois' =>"القانون 04-02",
            'articles' =>"28",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>27,
            'code' =>'0810',
            'libelle' =>'ممارسات تجارية غير نزيهة (إشهار غير شرعي و ممنوع لتضمن عناصر تؤدي إلى الإلتباس مع بائع آخر أو مع نشاطه أو منتوجاته)',
            'libelle_fr' =>'Publicité illicite ou interdite - 2',
            'lois' =>"القانون 04-02",
            'articles' =>"28",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>28,
            'code' =>'0811',
            'libelle' =>'ممارسات تجارية غير نزيهة (إشهار غير شرعي و ممنوع لعرض سلع غير متوفرة بصفة كافية في المخزون )',
            'libelle_fr' =>'Publicité illicite ou interdite - 3',
            'lois' =>"القانون 04-02",
            'articles' =>"28",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>29,
            'code' =>'0901',
            'libelle' =>'ممارسات تعاقدية تعسفية(أخذ حقوق أو امتيازات لا تقابلها حقوق أو امتيازات)',
            'libelle_fr' =>'Pratiques contractuelles abusives - 1',
            'lois' =>"القانون 04-02",
            'articles' =>"29",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>30,
            'code' =>'0902',
            'libelle' =>'ممارسات تعاقدية تعسفية(فرض التزامات فورية و نهائية على المستهلك في العقود)',
            'libelle_fr' =>'Pratiques contractuelles abusives - 2',
            'lois' =>"القانون 04-02",
            'articles' =>"29",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>31,
            'code' =>'0903',
            'libelle' =>'ممارسات تعاقدية تعسفية(امتلاك حق تعديل عناصر العقد دون موافقة المستهلك)',
            'libelle_fr' =>'Pratiques contractuelles abusives - 3',
            'lois' =>"القانون 04-02",
            'articles' =>"29",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>32,
            'code' =>'0904',
            'libelle' =>'ممارسات تعاقدية تعسفية(التفرد بحق تفسير شرط من عقد العملية)',
            'libelle_fr' =>'Pratiques contractuelles abusives - 4',
            'lois' =>"القانون 04-02",
            'articles' =>"29",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>33,
            'code' =>'0905',
            'libelle' =>'ممارسات تعاقدية تعسفية(إلزام المستهلك بتنفيذ التزاماته دون أن يلزم نفسه بها)',
            'libelle_fr' =>'Pratiques contractuelles abusives - 5',
            'lois' =>"القانون 04-02",
            'articles' =>"29",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>34,
            'code' =>'0906',
            'libelle' =>'ممارسات تعاقدية تعسفية(رفض حق المستهلك في فسخ العقد إذا أخل هو بالإلتزام)',
            'libelle_fr' =>'Pratiques contractuelles abusives - 6',
            'lois' =>"القانون 04-02",
            'articles' =>"29",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>35,
            'code' =>'0907',
            'libelle' =>'ممارسات تعاقدية تعسفية(التفرد بتغيير آجال تسليم منتوج أو آجال تنفيذ خدمته)',
            'libelle_fr' =>'Pratiques contractuelles abusives - 7',
            'lois' =>"القانون 04-02",
            'articles' =>"29",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>36,
            'code' =>'0908',
            'libelle' =>'ممارسات تعاقدية تعسفية(تهديد المستهلك بقطع العلاقة التعاقدية)',
            'libelle_fr' =>'Pratiques contractuelles abusives - 8',
            'lois' =>"القانون 04-02",
            'articles' =>"29",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>37,
            'code' =>'1001',
            'libelle' =>'معارضة للمراقبة(رفض تقديم الوثائق)',
            'libelle_fr' =>'Opposition au contrôle - refus de communication de documents',
            'lois' =>"القانون 04-02",
            'articles' =>"54",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"53",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>38,
            'code' =>'1002',
            'libelle' =>'معارضة للمراقبة(منع الدخول الحر إلى المحل التجاري)',
            'libelle_fr' =>'Opposition au contrôle - refus du libre accés dans les locaux commerciaux',
            'lois' =>"القانون 04-02",
            'articles' =>"54",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"53",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>39,
            'code' =>'1003',
            'libelle' =>'معارضة للمراقبة(رفض الإستجابة عمدا للإستدعاء)',
            'libelle_fr' =>'Opposition au contrôle - refus délibéré de répondre à leurs convocations.',
            'lois' =>"القانون 04-02",
            'articles' =>"54",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"53",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>40,
            'code' =>'1004',
            'libelle' =>'معارضة للمراقبة(التهرب من المراقبة)',
            'libelle_fr' =>'Opposition au contrôle - cessation d\'activité (en vue de se soustraire au contrôle)',
            'lois' =>"القانون 04-02",
            'articles' =>"54",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"53",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>41,
            'code' =>'1005',
            'libelle' =>'معارضة للمراقبة(استعمال المناورة للمماطلة أو العرقلة)',
            'libelle_fr' =>'Opposition au contrôle - entraves à la réalisation des enquêtes économiques',
            'lois' =>"القانون 04-02",
            'articles' =>"54",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"53",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>42,
            'code' =>'1006',
            'libelle' =>'معارضة للمراقبة(الإهانة أو التهديد أو الشتم و السب)',
            'libelle_fr' =>'Opposition au contrôle - outrage, menaces et injures de toute nature',
            'lois' =>"القانون 04-02",
            'articles' =>"54",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"53",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>43,
            'code' =>'1007',
            'libelle' =>'معارضة للمراقبة(العنف أو التعدي الجسدي)',
            'libelle_fr' =>'Opposition au contrôle - violences et voies de fait portant atteinte à leur intégrité physique',
            'lois' =>"القانون 04-02",
            'articles' =>"54",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"53",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>44,
            'code' =>'1101',
            'libelle' =>'عدم القيد في السجل التجاري (نشاط قار)',
            'libelle_fr' =>'Défaut d\'immatriculation au registre de commerce - activité sédentaire',
            'lois' =>"القانون 04-02",
            'articles' =>"04-19-20-28",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"31",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>45,
            'code' =>'1102',
            'libelle' =>'عدم امتلاك السجل التجاري',
            'libelle_fr' =>'Défaut d\'immatriculation au registre de commerce - activité non sédentaire',
            'lois' =>"القانون 04-02",
            'articles' =>"04",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"32",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>46,
            'code' =>'1104',
            'libelle' =>'تزوير مستخرج السجل التجاري',
            'libelle_fr' =>'Falsification de l\'extrait du registre de commerce',
            'lois' =>"القانون 04-02",
            'articles' =>"34",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"34",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>47,
            'code' =>'1105',
            'libelle' =>'عدم اشهار المعلومات القانونية (شخص معنوي)',
            'libelle_fr' =>'Défaut de publicité mentions légales - personne morale',
            'lois' =>"القانون 04-02",
            'articles' =>"11-12-14",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"35",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>48,
            'code' =>'1106',
            'libelle' =>'عدم اشهار المعلومات القانونية (شخص طبيعي)',
            'libelle_fr' =>'Défaut de publicité mentions légales - personne physique',
            'lois' =>"القانون 04-02",
            'articles' =>"15",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"36",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>49,
            'code' =>'1107',
            'libelle' =>'عدم التعديل (شخص معنوي و شخص طبيعي)',
            'libelle_fr' =>'Défaut de modification de l\'extrait du registre de commerce - personne physique ou morale',
            'lois' =>"القانون 04-02",
            'articles' =>"37",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"37",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>50,
            'code' =>'1108',
            'libelle' =>'منح وكالة لغير  المؤهلين قانونا',
            'libelle_fr' =>'Procuration illégale',
            'lois' =>"القانون 04-02",
            'articles' =>"38",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"38",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>51,
            'code' =>'1109',
            'libelle' =>'ممارسة نشاط تجاري دون حيازة محل',
            'libelle_fr' =>'Exercice d\'une activité commerciale sans détention d\'un local',
            'lois' =>"القانون 04-02",
            'articles' =>"39",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"39",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>52,
            'code' =>'1110',
            'libelle' =>'ممارسة نشاطات أو مهن منظمة دون رخصة أو اعتماد',
            'libelle_fr' =>'Exercice d\'une activité commerciale réglementée sans détention d\'une autorisation ou agrément',
            'lois' =>"القانون 04-02",
            'articles' =>"40",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"24-25",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>53,
            'code' =>'1111',
            'libelle' =>'نشاط خارج عن موضوع السجل التجاري',
            'libelle_fr' =>'Activité étrangère à l\'objet du registre du commerce',
            'lois' =>"القانون 04-02",
            'articles' =>"41",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"41",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>54,
            'code' =>'1112',
            'libelle' =>'عدم تعديل بيانات مستخرج السجل التجاري',
            'libelle_fr' =>'Defaut de modification',
            'lois' =>"القانون 04-02",
            'articles' =>"",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>55,
            'code' =>'1113',
            'libelle' =>'رفض البيع',
            'libelle_fr' =>'OPPSITION DE VENT',
            'lois' =>"القانون 04-02",
            'articles' =>"17",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"35",
            'created_by' =>"admin",
         ]);
         Infraction::create([
            'id' =>56,
            'code' =>'1114',
            'libelle' =>'عدم الإعلام بشروط البيع',
            'libelle_fr' =>'',
            'lois' =>"القانون 04-02",
            'articles' =>"8-9",
            'lois_p' =>"القانون 04-02",
            'articles_p' =>"32",
            'created_by' =>"admin",
         ]);
    }
}
