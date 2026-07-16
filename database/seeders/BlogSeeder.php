<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Blog;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $blogs = [
            [
                'title' => 'İşitme Cihazı Teknolojilerinde Yeni Dönem: Şarjlı ve Akıllı Cihazlar',
                'slug' => Str::slug('İşitme Cihazı Teknolojilerinde Yeni Dönem: Şarjlı ve Akıllı Cihazlar'),
                'excerpt' => 'Gelişen teknolojiyle birlikte işitme cihazları artık çok daha akıllı, şarj edilebilir ve kullanışlı. Yeni nesil kablosuz ve kanal içi işitme cihazlarının hayatınıza katacağı konforu keşfedin.',
                'image_path' => '/images/hero_devices.png',
                'content' => '
                    <h2>İşitme Cihazlarında Teknolojik Devrim</h2>
                    <p>Günümüzde işitme cihazı teknolojisi, geçmiş yıllara kıyasla hayal edilemeyecek bir noktaya ulaştı. Eskiden sadece sesi yükselten basit analog aygıtlar olarak bilinen bu cihazlar, bugün yapay zeka (AI) destekli, akıllı ve çevreye duyarlı mikrobilgisayarlar haline geldi. Şarjlı işitme cihazları, kablosuz (Bluetooth) bağlantı özellikleri ve neredeyse görünmez olan kanal içi işitme cihazları, işitme kaybı yaşayan bireylerin yaşam kalitesini dramatik bir şekilde artırıyor.</p>
                    
                    <h3>Şarjlı İşitme Cihazları ile Kesintisiz Yaşam</h3>
                    <p>İşitme cihazı kullanıcılarının en çok şikayet ettiği konulardan biri sürekli pil değiştirme zorunluluğuydu. Küçük pilleri takıp çıkarmak, özellikle yaşlı hastalar veya el becerisinde kısıtlılık yaşayanlar için büyük bir problem olabiliyordu. Yeni nesil şarjlı işitme cihazları bu sorunu tamamen ortadan kaldırıyor. Tıpkı bir akıllı telefon gibi gece yatarken cihazınızı şarj ünitesine yerleştiriyorsunuz ve sabah uyandığınızda tüm gün size yetecek bir şarjla güne başlıyorsunuz. Üstelik Lityum-İyon pil teknolojisi sayesinde cihazlar çok daha uzun ömürlü ve güvenli bir performans sunuyor. Çevreye duyarlı bu teknoloji, aynı zamanda atık pil sorununu da çözerek doğayı korumamıza yardımcı oluyor.</p>
                    
                    <h3>Kablosuz İşitme Cihazları ve Bluetooth Entegrasyonu</h3>
                    <p>Akıllı Bluetooth uyumlu cihazlar, işitme cihazınızı doğrudan cep telefonunuzla, televizyonunuzla veya bilgisayarınızla eşleştirmenize olanak tanır. Telefon çaldığında sesi doğrudan kulağınıza bir kulaklık netliğinde alabilir, müzik dinleyebilir veya favori dizinizi izlerken televizyonun sesini doğrudan cihazlarınıza aktarabilirsiniz. Bu durum, gürültülü ortamlarda bile telefon görüşmelerinin %100 anlaşılabilmesini sağlar. Kablosuz teknolojiler sayesinde cihazlar birbiriyle de iletişim kurarak, sağ ve sol kulağın duyduğu sesleri senkronize eder ve doğal işitmeye en yakın 360 derecelik çevresel ses algısını yaratır.</p>

                    <h3>Kanal İçi İşitme Cihazları (CIC ve IIC)</h3>
                    <p>Estetik kaygılar, birçok kişinin işitme cihazı kullanmayı ertelemesinin en büyük nedenidir. Ancak günümüzde kanal içi işitme cihazları (CIC) ve tamamen görünmez (IIC) modeller sayesinde cihazlar kulak kanalının derinliklerine yerleştirilir ve dışarıdan kesinlikle fark edilmez. Kulak ölçünüz birebir alınarak 3D yazıcı teknolojisiyle size özel üretilen bu cihazlar, hem estetik açıdan kusursuzdur hem de sesleri doğal kaynağı olan kulak kepçesinin içinden topladığı için mükemmel bir yön tayini sağlar.</p>

                    <h3>Akıllı Telefon Uygulamaları ile Tam Kontrol</h3>
                    <p>Yeni nesil işitme cihazları, cep telefonunuza indireceğiniz bir uygulama üzerinden kontrol edilebilir. Ses seviyesini artırıp azaltabilir, farklı dinleme ortamları (restoran, trafik, toplantı) için özel programlar seçebilir ve hatta cihazınızı kaybettiğinizde "Cihazımı Bul" özelliği ile yerini tespit edebilirsiniz. Yapay zeka, bulunduğunuz ortamın akustik haritasını çıkararak ayarları saniyeler içinde otomatik olarak optimize eder. Tüm bu teknolojiler, Samsun Şehir İşitme Merkezimizde siz değerli hastalarımızın deneyimine sunulmaktadır. Modern işitme cihazı uygulamalarımız hakkında detaylı bilgi almak ve ücretsiz deneme fırsatından yararlanmak için kliniğimizden randevu alabilirsiniz.</p>
                    <p>Unutmayın, işitme cihazı sadece bir donanım değil, sizi hayata yeniden bağlayan bir köprüdür. Erken teşhis ve doğru cihaz seçimi ile yaşam kalitenizi zirveye taşıyabilirsiniz.</p>
                '
            ],
            [
                'title' => 'Pediatrik İşitme Çözümleri: Çocuğunuzun İşitme Sağlığını Nasıl Korursunuz?',
                'slug' => Str::slug('Pediatrik İşitme Çözümleri: Çocuğunuzun İşitme Sağlığını Nasıl Korursunuz?'),
                'excerpt' => 'Çocuklarda işitme kaybı, dil gelişimi ve akademik başarıyı doğrudan etkiler. Ebeveynler için hazırladığımız bu rehberde pediatrik işitme testleri ve tedavi çözümlerini anlatıyoruz.',
                'image_path' => '/images/pediatric.png',
                'content' => '
                    <h2>Çocuklarda İşitme Kaybının Önemi</h2>
                    <p>İşitme, bir çocuğun konuşmayı, dili ve sosyal becerileri öğrenmesindeki en temel yapı taşıdır. Hayatın ilk yıllarında beynin dil merkezleri son derece aktiftir ve bu dönemde işitme girdisinin eksik olması, çocuğun zihinsel ve dil gelişiminde geri döndürülemez gecikmelere yol açabilir. Pediatrik işitme uygulamaları, tam da bu nedenle yetişkin işitme uygulamalarından tamamen ayrılır ve özel bir uzmanlık gerektirir. Samsun Şehir İşitme olarak, çocuklarımızın sesli dünyayla bağlarını en erken dönemde kurmayı ve onlara yaşıtlarıyla eşit şanslar sunmayı amaçlıyoruz.</p>
                    
                    <h3>Çocuklar İçin İşitme Testleri (Odyolojik Değerlendirme)</h3>
                    <p>Bebeklerde ve çocuklarda işitme testi, yetişkinlere uygulanan standart testlerden farklı teknikler gerektirir. Yenidoğan döneminde Otoakustik Emisyon (OAE) ve ABR (BERA) testleri ile bebeğin tepkisine ihtiyaç duyulmadan işitme yolları değerlendirilir. Daha büyük çocuklarda ise Oyun Odyometrisi ve Görsel Pekiştireçli Odyometri (VRA) gibi yöntemler kullanılır. Bu testlerde çocuğun ilgisini çeken ışıklar, oyuncaklar ve animasyonlar kullanılarak işitme seviyesi eğlenceli bir ortamda, oyun oynar gibi ölçülür. Çocuğunuz seslere tepki vermiyorsa, konuşmasında gecikme varsa veya televizyonun sesini çok açıyorsa vakit kaybetmeden kliniğimizde detaylı bir işitme testi yaptırmanız kritik öneme sahiptir.</p>
                    
                    <h3>Pediatrik İşitme Çözümleri</h3>
                    <p>Çocukların kulak yapıları sürekli büyüdüğü ve yaşam tarzları (oyun, okul, spor) çok daha hareketli olduğu için onlara özel işitme çözümleri üretilmiştir. Pediatrik işitme cihazları, çocukların ilgisini çekecek renkli tasarımlara sahiptir. Aynı zamanda darbelere, suya ve toza karşı çok daha dayanıklıdır. Bebeklerde pil yutma riskini önlemek için kilitli pil kapakları bulunur. Ayrıca cihazlarda bulunan LED uyarı ışıkları sayesinde öğretmenler ve ebeveynler cihazın aktif olup olmadığını veya pilinin bitip bitmediğini kolayca görebilirler.</p>

                    <h3>Ebeveyn Kılavuzu: Ailelere Düşen Görevler</h3>
                    <p>Çocuğunda işitme kaybı teşhis edilen ebeveynlerin sürece aktif olarak katılması tedavinin başarısı için şarttır. İlk adım, cihazın düzenli kullanımının sağlanmasıdır. Çocuğun cihazı reddetmemesi için ona olumlu yaklaşmak, cihazını takmayı bir oyun haline getirmek önemlidir. FM sistemleri ve sınıf içi dinleme asistanları gibi yardımcı aksesuarlar, okul çağındaki çocukların öğretmenlerini gürültülü bir sınıfta bile net duymasını sağlar. Ebeveynler, cihazların günlük temizliğini yapmalı, kulak kalıplarını çocuğun büyümesine paralel olarak düzenli aralıklarla (genellikle 3-6 ayda bir) yeniletmelidir.</p>

                    <h3>Odyolog ve Aile İşbirliği</h3>
                    <p>Pediatrik işitme rehabilitasyonu sadece cihaz takmakla bitmez; uzun soluklu bir yolculuktur. Odyologlar, özel eğitim uzmanları ve ailenin sıkı bir işbirliği içinde olması gerekir. Düzenli kontrollerle cihaz ayarları çocuğun büyümesine ve dil gelişimine göre sürekli güncellenir. Samsun Şehir İşitme Merkezi uzman ekibimiz, bu zorlu süreçte ebeveyn rehberliği sunarak hem ailenin endişelerini gidermekte hem de çocuğun sağlıklı bir şekilde gelişmesine katkı sağlamaktadır. Çocuklarımızın geleceği için erken teşhisin önemini unutmayın ve rutin kontrollerinizi ihmal etmeyin.</p>
                '
            ],
            [
                'title' => 'Kulak Çınlaması (Tinnitus) Nedir ve Tedavi Yöntemleri Nelerdir?',
                'slug' => Str::slug('Kulak-Çınlaması-Tinnitus-Nedir-ve-Tedavi-Yöntemleri-Nelerdir'),
                'excerpt' => 'Sürekli duyduğunuz zil, vızıltı veya uğultu seslerinden kurtulmak mümkün mü? Kulak çınlaması (Tinnitus) hakkında bilmeniz gereken her şey ve en modern terapi yöntemleri.',
                'image_path' => '/images/tinnitus.png',
                'content' => '
                    <h2>Kulak Çınlaması (Tinnitus) Nedir?</h2>
                    <p>Tinnitus, dış çevrede herhangi bir ses kaynağı olmamasına rağmen kişinin kulaklarında veya kafasının içinde duyduğu ses olarak tanımlanır. Hastalar bu sesi genellikle zil çalması, vızıltı, rüzgar uğultusu, su sesi veya kalp atışı şeklinde tarif ederler. Tinnitus başlı başına bir hastalık değil, genellikle altta yatan başka bir sorunun (örneğin işitme kaybı, kulak kiri, iç kulak hasarı veya dolaşım sistemi problemleri) belirtisidir. Dünya nüfusunun yaklaşık %15\'ini etkileyen bu durum, şiddetli olduğunda uykusuzluğa, konsantrasyon bozukluğuna, anksiyeteye ve depresyona yol açarak kişinin yaşam kalitesini ciddi şekilde düşürebilir.</p>
                    
                    <h3>Tinnitus Neden Olur?</h3>
                    <p>Tinnitusun en yaygın nedeni, iç kulaktaki (koklea) küçük tüy hücrelerinin hasar görmesidir. İlerleyen yaş, uzun süre yüksek sese maruz kalmak (konserler, fabrikalar veya yüksek sesle kulaklık kullanımı) tüy hücrelerine zarar verebilir. Beyin, bu hasarlı hücrelerden alamadığı ses sinyallerini telafi etmek için "hayalet" sesler (tinnitus) üretmeye başlar. Bunun yanı sıra boyun ve çene eklemi (TMJ) problemleri, bazı ilaçların yan etkileri, stres ve yüksek tansiyon da kulak çınlamasını tetikleyebilir.</p>
                    
                    <h3>Tinnitus Tedavi Yöntemleri ve Tinnitus Terapisi</h3>
                    <p>Tinnitusun "tek bir hapla" kesin bir tedavisi henüz bulunmasa da, modern odyolojik terapi yöntemleri ile çınlamanın şiddetini büyük ölçüde azaltmak ve hastanın bu sesi duymazdan gelmesini sağlamak mümkündür. <strong>Tinnitus Maskeleme (Ses Terapisi):</strong> Bu yöntemde amaç, beynin odak noktasını çınlama sesinden uzaklaştırmaktır. Özel olarak programlanmış işitme cihazları veya kulaklıklar aracılığıyla hastaya "beyaz gürültü", okyanus dalgası veya yağmur sesi gibi rahatlatıcı arka plan sesleri dinletilir. Bu sesler çınlamayı maskeleyerek rahatlama sağlar.</p>

                    <h3>İşitme Cihazları ile Tinnitus Tedavisi</h3>
                    <p>Tinnitus hastalarının büyük çoğunluğunda (%80) aynı zamanda işitme kaybı da mevcuttur. Çoğu hasta işitme kaybının farkında bile olmayabilir. İşitme cihazı kullanımı, dışarıdaki çevresel sesleri beynin tekrar duymasını sağlar. Beyin, gerçek seslere odaklandığı için kendi ürettiği hayali tinnitus sesini arka plana iter ve zamanla unutur. Kliniğimizde uygulanan modern işitme cihazları, içlerinde özel "Tinnitus Terapi" programları barındırır. Bu programlar, odyologlarımız tarafından tamamen sizin çınlama frekansınıza ve şiddetinize göre özel olarak ayarlanır.</p>

                    <h3>Bilişsel Davranışçı Terapi ve Yaşam Tarzı Değişiklikleri</h3>
                    <p>Tinnitus terapisinin bir diğer önemli ayağı da psikolojik destek ve yaşam tarzı düzenlemeleridir. Tinnitus Retraining Therapy (TRT - Tinnitus Yeniden Eğitme Terapisi), hastanın çınlama sesine verdiği duygusal tepkiyi değiştirmeyi hedefler. Stres, tinnitusu artıran en büyük faktördür. Meditasyon, yoga, kafein ve tütün tüketimini azaltmak, düzenli egzersiz yapmak ve uyku düzenine dikkat etmek çınlamanın kontrol altına alınmasına büyük yardımcı olur. Eğer kulak çınlaması sorunu yaşıyorsanız, Samsun Şehir İşitme Merkezimizde kapsamlı bir odyolojik değerlendirme yaptırarak size en uygun terapi yöntemini uzmanlarımızla belirleyebilirsiniz.</p>
                '
            ],
            [
                'title' => 'İşitme Cihazı Bakımı ve Temizliği: Uzun Ömürlü Kullanım Rehberi',
                'slug' => Str::slug('İşitme Cihazı Bakımı ve Temizliği: Uzun Ömürlü Kullanım Rehberi'),
                'excerpt' => 'İşitme cihazınızın performansını yıllarca ilk günkü gibi korumak için yapmanız gerekenler. Doğru pil kullanımı, filtre değişimi ve temizlik aksesuarları hakkında rehber.',
                'image_path' => '/images/accessories.png',
                'content' => '
                    <h2>İşitme Cihazı Bakımının Önemi</h2>
                    <p>İşitme cihazları, yüksek teknoloji ürünü hassas mikrobilgisayarlardır. Kulak içinde veya arkasında, sürekli neme, vücut ısısına, tere, kulak kirine (serumen) ve çevresel toza maruz kalarak çalışırlar. Bu zorlu çalışma koşulları göz önüne alındığında, cihazın düzenli ve doğru bakımı sadece kullanım ömrünü uzatmakla kalmaz, aynı zamanda ses kalitesinin her zaman net ve kesintisiz kalmasını sağlar. Bakımsız bir cihaz, sesleri boğuk iletir, sürekli arıza verir ve sonuç olarak işitme kalitenizi düşürür.</p>
                    
                    <h3>Günlük Bakım ve Temizlik Rutini</h3>
                    <p>İşitme cihazınız için oluşturacağınız 3 dakikalık günlük bir temizlik rutini, birçok arızanın önüne geçecektir. Cihazınızı her gece yatmadan önce kulağınızdan çıkardığınızda, mikrofiber bir bez veya cihazla birlikte verilen özel temizleme fırçası ile silmelisiniz. Özellikle kulak içi cihazlarda hoparlör çıkışında biriken kulak kirlerini fırçayla nazikçe temizlemek çok önemlidir. Asla su, alkol veya kimyasal temizleyiciler kullanmamalısınız, çünkü bu sıvılar mikrofon ve hoparlör (hoparlör) zarlarına kalıcı hasar verebilir.</p>
                    
                    <h3>İşitme Cihazı Pilleri ve Kullanım İpuçları</h3>
                    <p>Eğer pilli (şarjlı olmayan) bir cihaz kullanıyorsanız, doğru pil kullanımı performansı doğrudan etkiler. İşitme cihazı pilleri (Çinko-Hava) üzerindeki bant çıkarıldığı anda hava ile temas ederek aktifleşir. Bandı çıkardıktan sonra pili cihaza takmadan önce 1-2 dakika beklemek, pilin tam kapasiteye ulaşmasını sağlar ve pil ömrünü yaklaşık %20 oranında uzatır. Cihazınızı kullanmadığınız zamanlarda (örneğin gece uyurken) pil kapağını açık bırakmak hem pilin gereksiz yere bitmesini engeller hem de cihazın içinin havalanmasını sağlar.</p>

                    <h3>Filtre ve Kubbe (Dome) Değişimi</h3>
                    <p>Cihazınızın kulağa giren ucunda hoparlörü kulak kirinden koruyan beyaz bir filtre (wax guard) ve silikon bir kubbe (dome) bulunur. Eğer cihazınızdan hiç ses gelmiyor veya ses zayıf geliyorsa, %90 ihtimalle bu filtre kulak kiriyle tıkanmıştır. Filtreyi kullanım sıklığınıza ve kulak kiri üretiminize göre genellikle 3-4 haftada bir değiştirmeniz gerekir. Filtre değişimi son derece basittir ve odyoloğunuz size bunu uygulamalı olarak gösterecektir. Aynı şekilde zamanla sertleşen ve yıpranan silikon kubbelerin de ayda bir değiştirilmesi konforunuzu artıracaktır.</p>

                    <h3>Nem Alma Kutuları ve Smartcharger Şarj Üniteleri</h3>
                    <p>Nem, işitme cihazlarının bir numaralı düşmanıdır. Özellikle yaz aylarında terleme veya nemli iklimlerde yaşama durumunda cihazın içinde biriken görünmez nem, elektronik devrelere zarar verir. Nem alma kutuları (kurutucu tabletler) veya elektronik kurutma cihazları kullanmak bu sorunu kökünden çözer. Yeni nesil "Smartcharger" şarj üniteleri ise mükemmel bir çözüm sunar; cihazınızı gece şarj ederken aynı zamanda içindeki UV (ultraviyole) ışık sayesinde cihazı bakterilerden arındırır ve özel sistemiyle içindeki nemi kurutur. Cihaz bakım setleri ve aksesuarları hakkında detaylı bilgi almak için kliniğimizi ziyaret edebilirsiniz.</p>
                '
            ],
            [
                'title' => 'Profesyonel Odyolojik Testler ve İlk Randevuda Sizi Neler Bekliyor?',
                'slug' => Str::slug('Profesyonel Odyolojik Testler ve İlk Randevuda Sizi Neler Bekliyor'),
                'excerpt' => 'İşitme testi sürecinden korkmanıza gerek yok. İlk randevunuzda yapılacak testler, SGK destek süreci ve uzman odyologlarımızın yol haritası.',
                'image_path' => '/images/about_intro.png',
                'content' => '
                    <h2>İlk Adım: İşitme Sağlığınızı Keşfetmek</h2>
                    <p>Birçoğumuz yıllarca işitme kaybı yaşadığını kabullenmekte zorlanır ve bir uzmana başvurmayı erteler. Oysa işitme testi (odyometrik değerlendirme) son derece basit, ağrısız ve sadece 20-30 dakika süren bir işlemdir. Samsun Şehir İşitme Merkezine ilk kez geldiğinizde amacımız size bir cihaz satmak değil, işitme sağlığınızın mevcut durumunu en ince detayına kadar haritalandırmaktır. Rahat ve samimi bir ortamda gerçekleşen bu ilk randevu, daha iyi duymanız için atacağınız en önemli adımdır.</p>
                    
                    <h3>İşitme Testi (Odyometri) Nasıl Yapılır?</h3>
                    <p>İlk randevunuzda uzman odyoloğumuz öncelikle kulak kanalınızı bir otoskop ile inceleyerek işitmeyi engelleyecek bir kulak kiri veya kulak zarı problemi olup olmadığına bakar. Ardından özel olarak tasarlanmış, dışarıdan ses geçirmeyen akustik bir kabine alınırsınız. Size bir kulaklık takılır ve farklı frekanslarda (ince ve kalın sesler) ve farklı şiddetlerde (kısık ve yüksek) sesler dinletilir. En ufak bir ses duyduğunuzda elinizdeki butona basmanız istenir. Bu "Saf Ses Odyometrisi" işlemidir. Ayrıca, kelimeleri anlama oranınızı ölçmek için "Konuşma Odyometrisi" testi yapılır; size okunan kelimeleri tekrar etmeniz istenir. Bu testler sonucunda işitme kaybınızın derecesi, tipi ve konuşmayı anlama eşiğiniz tespit edilerek bir "Odyogram" grafiği oluşturulur.</p>
                    
                    <h3>Size En Uygun Cihazın Seçilmesi</h3>
                    <p>Test sonuçlarınız (Odyogram) odyoloğumuz tarafından size detaylı ve anlaşılır bir şekilde açıklanır. Eğer işitme cihazı kullanmanız gerekiyorsa, cihaz seçimi sadece test sonuçlarına göre yapılmaz. Mesleğiniz, sosyal yaşantınız, teknoloji kullanım alışkanlıklarınız ve bütçeniz detaylıca konuşulur. Evden pek çıkmayan yaşlı bir hasta ile sürekli toplantılara katılan aktif çalışan birinin ihtiyaç duyacağı cihaz teknolojisi farklıdır. İhtiyaçlarınıza en uygun 2-3 cihaz modeli belirlenerek kulaklarınıza takılır ve kliniğimizde veya gerçek dış ortamlarda deneme yapmanız sağlanır. Kendi sesinizi ve çevreyi dinleyerek kararı siz verirsiniz.</p>

                    <h3>SGK Desteği ve Devlet Ödemeleri</h3>
                    <p>Hastalarımızın en çok merak ettiği konulardan biri de SGK geri ödemeleridir. Samsun Şehir İşitme olarak SGK ile anlaşmalı olarak hizmet vermekteyiz. Devlet hastanelerinden veya anlaşmalı özel hastanelerden alacağınız "İşitme Cihazı Raporu ve Reçetesi" ile kliniğimize başvurduğunuzda, cihaz bedelinin SGK tarafından karşılanan tutarı toplam fiyattan düşülerek işlem yapılır. Çalışanlar, emekliler ve yaş gruplarına göre değişen SGK destek tutarları hakkında uzman personelimiz tüm evrak ve başvuru sürecini sizin adınıza yöneterek size en büyük kolaylığı sağlar.</p>

                    <h3>İşitme Cihazı Tamir ve Bakım Hizmetleri</h3>
                    <p>Merkezimizden cihaz aldığınızda, uzun yıllar sürecek bir dostluğun ve destek sürecinin adımını atmış olursunuz. Cihaz kullanımına adaptasyon süreci ilk birkaç hafta sabır gerektirir. Bu süreçte cihazınızın ince ayarları için sizi düzenli olarak kontrole çağırırız. Ayrıca teknik servis hizmetimizle, garanti kapsamındaki veya garanti dışı işitme cihazlarınızın arıza tespitini, hoparlör değişimini, mikrofon temizliğini ve genel bakımını laboratuvar ortamında titizlikle gerçekleştiririz. Sorunsuz bir işitme deneyimi için her zaman yanınızdayız.</p>
                '
            ]
        ];

        foreach ($blogs as $blog) {
            Blog::create($blog);
        }
    }
}
